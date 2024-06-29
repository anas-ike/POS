<?php

function generateNo(){
    global $conn;

    $queryNo = mysqli_query($conn, "SELECT max(no_jual) as maxno FROM tbl_jual_head");
    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row["maxno"];

    // Ensure $maxno is not null before passing it to substr
    if ($maxno !== null) {
        $noUrut = (int) substr($maxno, 2, 4);
    } else {
        $noUrut = 0; // or handle this case appropriately
    }

    $noUrut++;
    $maxno = 'PJ' . sprintf("%04s", $noUrut);

    return $maxno;
}

function totalJual($noJual){
    global $conn;

    $totalJual = mysqli_query($conn, "SELECT sum(jml_harga) AS total FROM tbl_jual_detail WHERE no_jual = '$noJual'");
    $data = mysqli_fetch_assoc($totalJual);
    $total = $data["total"];

    return $total;
}

function insert($data){
    global $conn;

    $no     = mysqli_real_escape_string($conn, $data['nojual']);
    $tgl     = mysqli_real_escape_string($conn, $data['tglNota']);
    $kode     = mysqli_real_escape_string($conn, $data['barcode']);
    $nama     = mysqli_real_escape_string($conn, $data['namaBrg']);
    $qty     = mysqli_real_escape_string($conn, $data['qty']);
    $harga     = mysqli_real_escape_string($conn, $data['harga']);
    $jmlharga     = mysqli_real_escape_string($conn, $data['jmlHarga']);
    $stok     = mysqli_real_escape_string($conn, $data['stok']);

    // cek barang sudah diinput atau belum
    $cekbrg = mysqli_query($conn, "SELECT * FROM tbl_jual_detail WHERE no_jual = '$no' AND barcode = '$kode'");
    if (mysqli_num_rows($cekbrg)) {
        echo "<script>
            alert('barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty...');
        </script>";
        return false;
    }

    // qty brg tidak boleh kosong

    if (empty($qty)) {
        echo "<script>
            alert('Qty barang tidak boleh kosong');
        </script>";
        return false;
    } else if ($qty > $stok){
        echo "<script>
            alert('Stok barang tidak mencukupi');
        </script>";
        return false;
    } else{
        $sqlJual = "INSERT INTO tbl_jual_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
        mysqli_query($conn, $sqlJual);
    }

    mysqli_query($conn, "UPDATE tbl_barang SET stock = stock - $qty WHERE barcode = '$kode'");

    return mysqli_affected_rows($conn);
}

function delete($barcode, $idjual, $qty){
    global $conn;

    $sqlDel = "DELETE FROM tbl_jual_detail WHERE barcode = '$barcode' AND no_jual = '$idjual'";
    mysqli_query($conn, $sqlDel);

    mysqli_query($conn, "UPDATE tbl_barang SET stock = stock + $qty WHERE barcode = '$barcode'");

    return mysqli_affected_rows($conn);
}

function simpan($data){
    global $conn;
    $nojual = mysqli_real_escape_string($conn, $data['nojual']);
    $tgl = mysqli_real_escape_string($conn, $data['tglNota']);
    $total = mysqli_real_escape_string($conn, $data['total']);
    $customer = mysqli_real_escape_string($conn, $data['customer']);
    $keterangan = mysqli_real_escape_string($conn, $data['ketr']);
    $bayar = mysqli_real_escape_string($conn, $data['bayar']);
    $kembalian = mysqli_real_escape_string($conn, $data['kembalian']);

    $sqljual = "INSERT INTO tbl_jual_head VALUES ('$nojual', '$tgl', '$customer', $total, '$keterangan', $bayar, $kembalian)";

    mysqli_query($conn, $sqljual);

    return mysqli_affected_rows($conn);
}