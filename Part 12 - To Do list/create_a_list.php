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
session_start();

include "db_connect.php";

$user_id = $_SESSION["user_id"];
$list_name = $_POST['list_name'];
$list_description = $_POST['list_description'];
$list_date_creation = date("U");

    
        try {
            $sql = "INSERT INTO lists (user_id, list_name, list_description, list_date_creation) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$user_id);
            $stmt->bindParam(2,$list_name);
            $stmt->bindParam(3,$list_description);
            $stmt->bindParam(4,$list_date_creation);
            $stmt->execute();

            $defin = "create_a_list";
            $audit_uid = $_SESSION["user_id"];
            $source = "create_a_list.php";
            $logtime = date("U");

            $sql = "INSERT INTO audit_log (user_id, source, definition, date) VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1,$audit_uid);
            $stmt->bindParam(2,$source);
            $stmt->bindParam(3,$defin);
            $stmt->bindParam(4,$logtime);
            $stmt->execute();

             header("refresh:5; url=profile.php");
            echo '<br>';
            echo "List was successfully created";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

?>
</body>
</html>

