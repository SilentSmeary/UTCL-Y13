<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php';

    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['sname'];
    $email = $_POST['email'];

    // Password validation
    $error = '';

    if (strlen($pass) < 8) {
        $error = "Password must be at least 8 characters long.";
    } elseif (!preg_match('/[A-Z]/', $pass)) {
        $error = "Password must include at least one uppercase letter.";
    } elseif (!preg_match('/[0-9]/', $pass)) {
        $error = "Password must include at least one number.";
    } elseif (!preg_match('/[\W]/', $pass)) {
        $error = "Password must include at least one special character.";
        header("location: index.html");
    }

    // If any validation error occurs, show the error message
    if ($error) {
        echo "<p style='color:red;'>Error: $error</p>";
    } else {
        // If the password is valid, proceed with the database insertion
        $sql = "INSERT INTO mem (username, password, fname, sname, email) VALUES(?,?,?,?,?)"; 
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $uname, $pass, $first_name, $last_name, $email);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            echo '<br>';
            echo "New record created successfully";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
