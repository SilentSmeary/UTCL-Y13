<?php
session_start();
include "db_connect.php";  // Connect to the database

if (isset($_POST['delete'])) {
    $_SESSION['lid'] = $_POST['lid'];
    header("Location: listdelete.php");
    die();
} elseif (isset($_POST['edit'])) {
    $_SESSION["lid"] = $_POST['lid'];
}

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<link rel='stylesheet' href='style.css'>";
echo "<title>To Do List website</title>";
echo "</head>";
echo "<body>";
echo "<div id='container'>";

// Header section
echo "<div id='title'>";
echo "<h3 id='banner'>To Do List</h3>";
echo "</div>";


echo "</ul>";
echo "</div>";

// List content section
echo "<div id='listcontent'>";
echo "<hr>";
echo "<br>";
echo "<form action='task_add.php' method='POST'>";
echo "<label for='listname'>Add a task: </label>";
echo "<input type='text' name='task' placeholder='Task text'>";
echo "<input type='date' name='date' value='2024-10-23'>";
echo "<input type='time' name='time' value='12:00'>";
echo "<input type='submit' name='submit' value='Submit'>";
echo "</form>";
echo "<hr>";
echo "<br>";

// Fetch tasks from the database
$sql = "SELECT * FROM tasks WHERE listid = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_SESSION['lid']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    $working = []; // store uncompleted tasks
    $completed = []; // store completed tasks

    // Split tasks into working and completed arrays
    foreach ($result as $row) {
        if ($row['complete'] == "n") {
            $working[] = $row;
        } elseif ($row['complete'] == "y") {
            $completed[] = $row;
        }
    }

    echo "<h4>Quick Stats: Total Tasks: " . count($result) . " | Current Tasks: " . count($working) . " | Completed Tasks: " . count($completed) . "</h4>";
    echo "<hr><br>";

    // Display Current Tasks
    echo "<h4>Current Tasks</h4><br>";
    echo "<table>";
    foreach ($working as $row) {
        echo "<form action='taskadmin.php' method='POST' name='form_" . $row['taskid'] . "'>";
        echo "<input type='hidden' name='tid' value='" . $row['taskid'] . "'>";
        echo "<tr>";
        echo "<td>Task: " . htmlspecialchars($row['task']) . "</td>";
        echo "<td>Due Date: " . date("Y-m-d H:i:s", strtotime($row['duedate'])) . "</td>";
        echo "<td><input type='submit' name='Complete' value='Complete'></td>";
        echo "<td><input type='submit' name='Delete' value='Delete'></td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
    echo "<hr><br>";

    // Display Completed Tasks
    echo "<h4>Completed Tasks</h4><br>";
    echo "<table>";
    foreach ($completed as $row) {
        echo "<form action='taskadmin.php' method='POST' name='form_" . $row['taskid'] . "'>";
        echo "<input type='hidden' name='tid' value='" . $row['taskid'] . "'>";
        echo "<tr>";
        echo "<td>Task: " . htmlspecialchars($row['task']) . "</td>";
        echo "<td>Due Date: " . date("Y-m-d H:i:s", strtotime($row['duedate'])) . "</td>";
        echo "<td><input type='submit' name='Uncomplete' value='Uncomplete'></td>";
        echo "<td><input type='submit' name='Delete' value='Delete'></td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
} else {
    echo "There are no tasks to display here right now!";
}

echo "<br></div>";
echo "</div>";
echo "</body>";
echo "</html>";
?>
