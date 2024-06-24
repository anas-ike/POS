<?php

if (userLogin()['level'] == 3) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data){
    global $conn;

    $nama   = mysqli_real_escape_string($conn, $data['nama']);
    $telpon   = mysqli_real_escape_string($conn, $data['telpon']);
    $alamat   = mysqli_real_escape_string($conn, $data['alamat']);
    $ketr   = mysqli_real_escape_string($conn, $data['ketr']);


    $sqlCustomer    = "INSERT INTO tbl_customer VALUES (null, '$nama', '$telpon', '$ketr', '$alamat')";
    mysqli_query($conn, $sqlCustomer);

    return mysqli_affected_rows($conn);
}

function delete($id){
    global $conn;

    $sqlDelete = "DELETE FROM tbl_customer WHERE id_customer = $id";

    mysqli_query($conn, $sqlDelete);
    return mysqli_affected_rows($conn);
}

function update($data){
    global $conn;

    $id     = mysqli_real_escape_string($conn, $data['id']);
    $nama   = mysqli_real_escape_string($conn, $data['nama']);
    $telpon   = mysqli_real_escape_string($conn, $data['telpon']);
    $alamat   = mysqli_real_escape_string($conn, $data['alamat']);
    $ketr   = mysqli_real_escape_string($conn, $data['ketr']);


    $sqlCustomer    = "UPDATE tbl_customer SET
                        nama    = '$nama',
                        telpon  = '$telpon',
                        deskripsi = '$ketr',
                        alamat  = '$alamat'
                        WHERE id_customer = $id
                        ";
    mysqli_query($conn, $sqlCustomer);

    return mysqli_affected_rows($conn);
}
?>