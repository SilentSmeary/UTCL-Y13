<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php';

    $uname = $_POST['username'];
    $pass = $_POST['password'];

    // echo '<br>';
    // echo $uname;
    // echo '<br>';
    // echo $pass;


    $stmt = $mysqli->prepare("INSERT INTO users (username) VALUES (?)");
    $stmt->bind_param('s', $uname);

}
?>