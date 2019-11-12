<?php
if (isset($_POST["action"])&&($_POST["action"] == "create")) {
  include("connMySQL.php");
	
  $author = $_POST["mAuthor"];
  $subject = $_POST["mSubject"];
  $content = $_POST["mContent"];
  $current_time = date("Y-m-d H:i:s");

  //執行SQL查詢
  $sql_query = "INSERT INTO message(mAuthor, mSubject, mContent, mDate)
          VALUES('$author', '$subject', '$content', '$current_time')";

  mysqli_query($db_link,$sql_query);

  //導回index.php
  header("location:index.php");
}
?>