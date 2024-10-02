<?php

include "db_connect.php";

try {  //try this code, catch errors
    session_start(); // It is better to start the session at the top before any credentials are added
    $usnm = $_POST['uname'];
    $pswd = $_POST['password'];

    $sql = "SELECT * FROM mem WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$usnm);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $_SESSION["ssnlogin"] = true;
        $_SESSION["uname"] = $usnm;
        $_SESSION["userid"] = $result["userid"];

        $act = "success_login";
        $audit_uid = $_SESSION["userid"];
        $source = "login.php";
        $logtime = time();

        $password = $result["password"];
        if (password_verify($pswd, $password)) {
            $sql = "INSERT INTO audit_log (user_id, activity_type, source, date) VALUES(?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1,$audit_uid);
            $stmt->bindParam(2,$act);
            $stmt->bindParam(3,$source);
            $stmt->bindParam(4,$logtime);

            $stmt->execute();
            header("location:profile.php");
            exit();
        } else{
            $act = "failed_login";
            $source = "login.php";
            $logtime = time();
            $sql = "INSERT INTO audit_log (user_id, activity_type, source, date) VALUES(?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1,$audit_uid);
            $stmt->bindParam(2,$act);
            $stmt->bindParam(3,$source);
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