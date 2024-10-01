<?php
session_start(); //connects to the session data

include "db_connect.php";  // connects to the database

$usnm = $_POST['username'];  // pulls data from posted form
$fname = $_POST['fname']; // pulls data from posted form
$sname = $_POST['sname']; // pulls data from posted form
$email = $_POST['email']; // pulls data from posted form
$userid = $_SESSION["userid"]; //pulls data from session variable
$susnm = $_SESSION["uname"]; //pulls the current username from session variables

try {  // attempts this code

    if ($susnm!=$usnm) { //if the username stored and typed dont match then do this
        $sql = "SELECT * FROM mem WHERE username = ?";  // Selects usernames from database that match entered
        $stmt = $conn->prepare($sql);  //perpares the statement
        $stmt->bindParam(1,$usnm);  // secures this parameters, good coding method
        $stmt->execute();  //executes the code

        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //fetches the result

        if($result){  //if there is a result
            header("refresh:5; url=prof.php");  //error message and redirect
            echo "Usernames Exists, try another name";
            exit();  // this was needed as below code still executed... which is bad
        }
    }


    $sql = "UPDATE mem SET username=?, fname=?, sname=?, email=? WHERE userid = ?";  //sets up the statement
    $stmt = $conn->prepare($sql);  //prepares it
    $stmt->bindParam(1,$usnm);  //binding all the parameters
    $stmt->bindParam(2,$fname);
    $stmt->bindParam(3,$sname);
    $stmt->bindParam(4,$email);
    $stmt->bindParam(5,$userid);
    $stmt->execute();  //execute the code
    $_SESSION["uname"]=$usnm;  //update session variable
    header("refresh:5; url=profile.php");  //redirect with confirmation message
    echo "Details updated successfully";
} catch(PDOException $e){   //catch error if one occurs
    header("refresh:5; url=profile.php");
    echo $e->getMessage();

}

?>