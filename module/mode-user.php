<?php

function insert($data){
    global $conn;

    $username   = strtolower(mysqli_real_escape_string($conn, $data['username']));
    $fullname   = mysqli_real_escape_string($conn, $data['fullname']);
    $password   = mysqli_real_escape_string($conn, $data['password']);
    $password2   = mysqli_real_escape_string($conn, $data['password2']);
    $level   = mysqli_real_escape_string($conn, $data['level']);
    $address   = mysqli_real_escape_string($conn, $data['address']);
    $gambar   = mysqli_real_escape_string($conn, $_FILES['image']['name']);

    if ($password !== $password2) {
        echo '<script>
                alert("Konfirmasi password tidak sama, user baru gagal dibuat");
            </script>';
            return false;
    }

    $pass   = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername    = mysqli_query($conn, "SELECT username FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
       echo '<script>
                alert("Username sudah terpakai, user baru gagal dibuat");
            </script>';
            return false;
    }

    if ($gambar != null) {
        $gambar = uploadimg();
    }else {
        $gambar = 'default-user.png';
    }

    //gambar tidak sesuai validasi
    if($gambar == '') {
        return false;
    }

    $sqlUser    = "INSERT INTO tbl_user VALUE (null, '$username', '$fullname', '$pass', '$address', '$level', '$gambar')";
    mysqli_query($conn, $sqlUser);

    return mysqli_affected_rows($conn);
}


function delete($id, $foto){
    
    global $conn;

    $sqlDel = "DELETE FROM tbl_user WHERE userid = $id";
    mysqli_query($conn, $sqlDel);
    if($foto != 'default.png') {
        unlink('../asset/image/' . $foto);
    }

    return mysqli_affected_rows($conn);
}
?>