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


function selectUser1($level){
    $result = null;
    if ($level == 1) {
        $result = "selected";
    }
    return $result;
}

function selectUser2($level){
    $result = null;
    if ($level == 2) {
        $result = "selected";
    }
    return $result;
}

function selectUser3($level){
    $result = null;
    if ($level == 3) {
        $result = "selected";
    }
    return $result;
}

function update($data){
    global $conn;
    $iduser     = mysqli_real_escape_string($conn, $data['id']);
    $username   = strtolower(mysqli_real_escape_string($conn, $data['username']));
    $fullname   = mysqli_real_escape_string($conn, $data['fullname']);
    $level   = mysqli_real_escape_string($conn, $data['level']);
    $address   = mysqli_real_escape_string($conn, $data['address']);
    $gambar   = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $fotoLama   = mysqli_real_escape_string($conn, $data['oldImg']);

    // cek username sekarang
    $queryUsername = mysqli_query($conn, "SELECT * FROM tbl_user WHERE userid = $iduser");
    $dataUsername   = mysqli_fetch_assoc($queryUsername);
    $curUsername    = $dataUsername['username'];

    // cek username baru
    $newUsername    = mysqli_query($conn, "SELECT username FROM tbl_user WHERE username = '$username'");

    if ($username !== $curUsername) {
        if (mysqli_num_rows($newUsername)) {
            echo '<script>
                alert("Username sudah terpakai, user gagal diedit");
                document.location.href = "data-user.php";
            </script>';
            return false;
        }
    }

    // cek gambar
    if ($gambar != null) {
        $url        = "data-user.php";
        $imgUser    = uploadimg($url);
        if ($fotoLama != 'default.png') {
            @unlink('../asset/image' . $fotoLama);
        }
    } else{
        $imgUser = $fotoLama;
    }

    mysqli_query($conn, "UPDATE tbl_user SET
                                        username    = '$username',    
                                        fullname    = '$fullname',    
                                        address    = '$address', 
                                        level    = '$level', 
                                        foto    = '$imgUser'
                                        WHERE userid = $iduser 
                                            ");
   
    return mysqli_affected_rows($conn);
}
?>