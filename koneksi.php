<?php
    $db_host = 'localhost'; //server
    $db_user = 'root'; //username
    $db_pass = ''; //password
    $db_name = 'uas-spk'; //nama database
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); //sintaks untuk connect ke database mysql

    if (!$conn) {
        die ('Gagal terhubung dengan database MySQL : ' . mysqli_connect_error());
    }
?>