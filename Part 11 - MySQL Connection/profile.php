<!DOCTYPE html>  <!-- Declares doctype, important -->

<html lang="en">
<head>
<?php
session_start();  //starts a sessions which is needed to stay logged in
if(!$_SESSION["ssnlogin"]){  //if no login has been completed

    header("refresh:5;url=login.html");  //redirects them to login
    echo"You are not currently logged in, redirecting to login page";  //error message to reflect that
}else{
    $usnm = $_SESSION['uname'];  //copies session name
    $userid = $_SESSION['userid'];  //copies session userid
    echo "<title>". $usnm. "'s profile page</title>";  //echoes title to the page
}

?>
</head>
<body>
<?php


echo "Welcome ".$usnm. " To your profile page";  //welcome comment to the page

?>
<br><br>
Here is your data
<?php

include "db_connect.php";  //connects to the database


$sql = "SELECT * FROM mem WHERE userid = ?";  //prepares sql to get details for logged in user

$stmt = $conn->prepare($sql); //prepares the sql

$stmt->bindParam(1,$userid);  //binds the parameters ready for execute

$stmt->execute();  // runs the query

$result = $stmt->fetch(PDO::FETCH_ASSOC);  //gets the result
echo "<form method='post' action='updater.php'>";  //echos out start of the form

foreach($result as $key=>$value){  //runs loop to go through each of the returned items

    if($key=="userid"){  // if its the userid data
        echo $key.": ". $value."<br>";  //echo out as text, not editable
    } elseif ($key!="password"){  //if its the password data, don't output
        echo "<label for='".$key."'>".$key."</label>";  //produce label and form element using data in assoc array
        echo "<input type='text' name='".$key."' value='".$value."'><br>";

    }

}
echo "<input type='submit'' value='Update'>";  //outputs button to allow update to be called
?>

</body>
</html>