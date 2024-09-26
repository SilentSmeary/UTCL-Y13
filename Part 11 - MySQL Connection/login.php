<?php

include "db_connect.php";

try {
    session_start();
    $usnm = $_POST['uname'];
    $pswd = $_POST['password'];

    $sql = "SELECT password FROM mem WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$usnm);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $_SESSION["ssnlogin"] = true;
        $_SESSION["uname"] = $usnm;
        $password = $result["password"];
        if (password_verify($pswd, $password)) {
            header("location:prof.php");
            exit();
        } else{
            session_destroy();
            echo '<br>';
            header("refresh:5; url=login.html");
            echo "Invalid password";
            echo '<br>';
            echo "You will be redirected to login";
        }

    } else {
        echo "User not found";
    }

} catch (Exception $e) {
    echo $e;
}