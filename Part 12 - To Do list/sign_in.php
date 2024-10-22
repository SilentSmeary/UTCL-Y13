<?php

include "db_connect.php";

try {  //try this code, catch errors
    session_start(); // It is better to start the session at the top before any credentials are added
    $usnm = $_POST['email'];
    $pswd = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$usnm);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $_SESSION["ssnlogin"] = true;
        $_SESSION["uname"] = $usnm;
        $_SESSION["user_id"] = $result["user_id"];

        $defin = "success_login";
        $audit_uid = $_SESSION["user_id"];
        $source = "login.php";
        $logtime = date("U");

        $password = $result["password"];
        if (password_verify($pswd, $password)) {
            $sql = "INSERT INTO audit_log (user_id, source, definition, date) VALUES(?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1,$audit_uid);
            $stmt->bindParam(2,$source);
            $stmt->bindParam(3,$defin);
            $stmt->bindParam(4,$logtime);

            $stmt->execute();
            header("location:profile.php");
            exit();
        } else{
            $defin = "failed_login";
            $audit_uid = $_SESSION["userid"];
            echo "user id";
            echo $audit_uid;
            $source = "login.php";
            $logtime = date("U");
            $sql = "INSERT INTO audit_log (user_id, source, definition, date) VALUES(?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1,$audit_uid);
            $stmt->bindParam(2,$source);
            $stmt->bindParam(3,$defin);
            $stmt->bindParam(4,$logtime);

            $stmt->execute();
            session_destroy();
            header("location:index.html");
            echo "invalid password";
        }

    } else {
        echo "User not found";
    }

} catch (Exception $e) {
    echo $e;
}