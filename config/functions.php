<?php

function uploadimg($url = null){
    $namafile   = $_FILES['image']['name'];
    $ukuran     = $_FILES['image']['size'];
    $tmp        = $_FILES['image']['tmp_name'];

    // validasi file gambar yg boleh di upload
    $ekstensiGambarValid    = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar         = explode('.', $namafile);
    $ekstensiGambar         = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        if ($url != null) {
            echo '<script>
            alert("File yg anda upload bukan gambar, data gagal diupload ! ");
            document.location.href = "' . $url . '";
            </script>';
            die();
        } else{

        echo '<script>
                alert("File yg anda upload bukan gambar, data gagal ditambahkan ! ");
        
            </script>';
            return false;
        }
    }


    // validasi ukuran gambar max 1 MB
    if ($ukuran > 1000000) {
        if ($url != null) {
            echo '<script>
            alert("Ukuran gambar melebihi 1MB, data gagal diupdate! ");
            document.location.href = "' . $url . '";
            </script>';
            die();
        } else{
        echo '<script>
                alert("Ukuran gambar tidak boleh lebih dari 1 MB ");
        
            </script>';
            return false;
        }
    }

    $namaFileBaru   = rand(10, 1000) . '-' . $namafile;
    move_uploaded_file($tmp, '../asset/image/' . $namaFileBaru);
    return $namaFileBaru;

}

function getData($sql){
    global $conn;

    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

?>