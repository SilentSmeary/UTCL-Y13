<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php

include "db_connect.php";

$usnm = $_POST['username'];
$pswd = $_POST['password'];
$cpswd = $_POST['confirm_password'];
$fname = $_POST['first_name'];
$sname = $_POST['last_name'];
$email = $_POST['email'];
$signupdate = date("U");


if($pswd!=$cpswd){
    header("refresh:5; url=index.html");
    echo '<br>';
    echo"Your passwords do not match";
}elseif(strlen($pswd)<8){
    header("refresh:5; url=index.html");
    echo '<br>';
    echo"Your passwords do not match";
} else {
    try {
        $sql = "SELECT username FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$usnm);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            header("refresh:5; url=index.html");
            echo '<br>';
            echo "User Exists, try another name";

        } else {
            try {

                $hpswd = password_hash($pswd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, password, first_name, last_name, email, sign_up_date) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1,$usnm);
                $stmt->bindParam(2,$hpswd);
                $stmt->bindParam(3,$fname);
                $stmt->bindParam(4,$sname);
                $stmt->bindParam(5,$email);
                $stmt->bindParam(6,$signupdate);

                $stmt->execute();
                header("refresh:5; url=sign_in.html");
                echo '<br>';
                echo "Successfully registered";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


}
?>
</body>
</html>

