<?php
if (isset($_POST["action"])&&($_POST["action"] == "create")) {
  include("connMySQL.php");
	
  $sAuthor = $_POST["mAuthor"];
  $sSubject = $_POST["mSubject"];
  $sContent = $_POST["mContent"];
  $dDate = date("Y-m-d H:i:s");

  //執行SQL查詢
  $sSql = "INSERT INTO message(mAuthor, mSubject, mContent, mDate)
          VALUES('$sAuthor', '$sSubject', '$sContent', '$dDate')";

  mysqli_query($oDBLink,$sSql);

  //導回index.php
  header("location:index.php");
}
?>