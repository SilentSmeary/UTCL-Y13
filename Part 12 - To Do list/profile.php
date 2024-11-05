<?php

echo '<link rel="stylesheet" href="style.css">';

session_start();

echo '<div id="heading">';
            echo "<h1>Welcome " . $_SESSION["first_name"] . "</h1>";
            echo '<hr>';
echo '</div>';

include "db_connect.php";

$sql = "SELECT list_name, list_description, list_date_creation FROM lists WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1,$_SESSION["user_id"]);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div id="heading">';
    echo '<h3>Create a new list</h3>';
    echo '<form action="create_a_list.php" method="post">';
        echo '<label for="list_name">List Name: *</label><input class="firstname" type="text" id="list_name" name="list_name" required><br>';
        echo '<label for="list_description">List Description: *</label><input class="firstname" type="text" id="list_description" name="list_description" required><br>';
        echo '<input class="custom_submit" type="submit" name="" id="">';
    echo '</form>';
echo '</div>';

echo '<div id="heading">';
echo '<h3>Your Lists</h3>';
echo "<table class='custom_table'>";
//foreach ($result as $row) {
//    echo "<tr><td>List Name: " . $row['list_name'] . "</td><td>List Description: " . $row['list_name'] ."</td><td>Date: " . date("Y-m-d H:i", $row['list_date_creation']) . "</td></tr>";
//}

echo "<table class='custom_table'>";
foreach ($result as $row) {
    echo "<form action='list_admin.php' method='POST' name='form_".$row['list_id']."'>";
    echo "<input type='hidden' name='lid' value='".$row['list_id']."'>";
    echo "<tr>";
    echo "<td>List Name: ".$row['list_name']."</td>";
    echo "<td>List Description: ".$row['list_description']."</td>";
    echo "<td>Date: ".date("Y-m-d H:i", $row['list_date_creation'])."</td>";
    echo "<td><input type='submit' name='edit' value='Edit'></td>";
    echo "<td><input type='submit' name='delete' value='Delete'></td>";
    echo "</tr>";
    echo "</form>";
}
echo "</tabe>";
echo '</div>';
?>
