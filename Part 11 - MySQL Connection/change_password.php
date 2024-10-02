<?php

    include "db_connect.php";

    session_start();
    $cpassword = $_POST['c_password'];
    $npassword = $_POST['n_password'];
    $cnpassword = $_POST['cn_password'];

    $user_id = $_SESSION['userid'];

    $sql = "SELECT * FROM mem WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<br>";

    if (!password_verify($cpassword, $result['password'])) {
//        Fail audit entry
        session_destroy();
        header("refresh:5; url=index.html");
    } elseif ($npassword != $cnpassword) {
//        Failed audit entry
        header("refresh:5; url=change_password.html");
    } else {
        $new_hashed_password = password_hash($npassword, PASSWORD_DEFAULT);
        $sql = "UPDATE mem SET password = ? WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$new_hashed_password);
        $stmt->bindParam(2,$user_id);
        $stmt->execute();
        session_destroy();
        header("refresh:5; url=login.html");
        echo "Password update, login again!";
    }