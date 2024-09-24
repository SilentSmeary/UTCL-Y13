<?php
    include 'db_connect.php';

    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $first_name = $_POST['fname'];
    $first_name = $_POST['sname'];
    $email = $_POST['email'];

    $sql = "INSERT INTO mem (username, password, fname, sname, email) VALUES(?,?,?,?,?)"; // col names NOT  values
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $uname, $pass, $first_name, $last_name, $email);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_error($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt);

    } else {
        echo "New record created successfully";
    }
?>