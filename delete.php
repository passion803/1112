<?php
    $userID = $_GET['id'];
    include ('connMySQL.php');
    $sql_query = "DELETE FROM message WHERE mID = $userID";
    mysqli_query($db_link,$sql_query);
    $db_link->close();
    header("Location: index.php");
?>