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
        $act = "failed_password_update";
        $source = "change_password.php";
        $logtime = time();

        $sql = "INSERT INTO audit_log (user_id, activity_type, source, date) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);


        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $act);
        $stmt->bindParam(3, $source);
        $stmt->bindParam(4, $logtime);

        $stmt->execute();
//        Fail audit entry
        session_destroy();
        header("refresh:5; url=index.html");
    } elseif ($npassword != $cnpassword) {
        $act = "failed_password_update";
        $source = "change_password.php";
        $logtime = time();

        $sql = "INSERT INTO audit_log (user_id, activity_type, source, date) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);


        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $act);
        $stmt->bindParam(3, $source);
        $stmt->bindParam(4, $logtime);

        $stmt->execute();
//        Failed audit entry
        header("refresh:5; url=login.html");
    } else {
        $new_hashed_password = password_hash($npassword, PASSWORD_DEFAULT);
        $sql = "UPDATE mem SET password = ? WHERE userid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$new_hashed_password);
        $stmt->bindParam(2,$user_id);
        $stmt->execute();


        $act = "successful_password_update";
        $source = "change_password.php";
        $logtime = time();

        $sql = "INSERT INTO audit_log (user_id, activity_type, source, date) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);


        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $act);
        $stmt->bindParam(3, $source);
        $stmt->bindParam(4, $logtime);

        $stmt->execute();
        session_destroy();
        header("refresh:5; url=login.html");
        echo "Password update, login again!";
    }
