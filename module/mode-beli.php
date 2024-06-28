<?php

function generateNo(){
    global $conn;

    $queryNo = mysqli_query($conn, "SELECT max(no_beli) as maxno FROM tbl_beli_head");
    $row = mysqli_fetch_assoc($queryNo);
    $maxno = $row["maxno"];

    // Ensure $maxno is not null before passing it to substr
    if ($maxno !== null) {
        $noUrut = (int) substr($maxno, 2, 4);
    } else {
        $noUrut = 0; // or handle this case appropriately
    }

    $noUrut++;
    $maxno = 'PB' . sprintf("%04s", $noUrut);

    return $maxno;
}

function totalBeli($nobeli){
    global $conn;

    $totalBeli = mysqli_query($conn, "SELECT sum(jml_harga) AS total FROM tbl_beli_detail WHERE no_beli = '$nobeli'");
    $data = mysqli_fetch_assoc($totalBeli);
    $total = $data["total"];

    return $total;
}

function insert($data){
    global $conn;

    $no     = mysqli_real_escape_string($conn, $data['nobeli']);
    $tgl     = mysqli_real_escape_string($conn, $data['tglNota']);
    $kode     = mysqli_real_escape_string($conn, $data['kodeBrg']);
    $nama     = mysqli_real_escape_string($conn, $data['namaBrg']);
    $qty     = mysqli_real_escape_string($conn, $data['qty']);
    $harga     = mysqli_real_escape_string($conn, $data['harga']);
    $jmlharga     = mysqli_real_escape_string($conn, $data['jmlHarga']);

    $cekbrg = mysqli_query($conn, "SELECT * FROM tbl_beli_detail WHERE no_beli = '$no' AND kode_brg = '$kode'");
    if (mysqli_num_rows($cekbrg)) {
        echo "<script>
            alert('barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty...');
        </script>";
        return false;
    }

    if (empty($qty)) {
        echo "<script>
            alert('Qty barang tidak boleh kosong');
        </script>";
        return false;
    } else{
        $sqlbeli = "INSERT INTO tbl_beli_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
        mysqli_query($conn, $sqlbeli);
    }

    mysqli_query($conn, "UPDATE tbl_barang SET stock = stock + $qty WHERE id_barang = '$kode'");

    return mysqli_affected_rows($conn);
}

function delete($idbrg, $idbeli, $qty){
    global $conn;

    $sqlDel = "DELETE FROM tbl_beli_detail WHERE kode_brg = '$idbrg' AND no_beli = '$idbeli'";
    mysqli_query($conn, $sqlDel);

    mysqli_query($conn, "UPDATE tbl_barang SET stock = stock - $qty WHERE id_barang = '$idbrg'");

    return mysqli_affected_rows($conn);
}


function simpan($data){
    global $conn;
    $nobeli = mysqli_real_escape_string($conn, $data['nobeli']);
    $tgl = mysqli_real_escape_string($conn, $data['tglNota']);
    $total = mysqli_real_escape_string($conn, $data['total']);
    $suplier = mysqli_real_escape_string($conn, $data['suplier']);
    $keterangan = mysqli_real_escape_string($conn, $data['ketr']);

    $sqlbeli = "INSERT INTO tbl_beli_head VALUES ('$nobeli', '$tgl', '$suplier', $total, '$keterangan')";

    mysqli_query($conn, $sqlbeli);

    return mysqli_affected_rows($conn);
}

?>
