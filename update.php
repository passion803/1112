<?php
include("connMySQL.php");
if (isset($_POST["action"]) && $_POST["action"] == 'update') {

  $sNewAuthor = $_POST['mAuthor'];
  $sNewSubject = $_POST['mSubject'];
  $sNewContent = $_POST['mContent'];
  $iUserID = $_POST['userID'];

  $sSql = "UPDATE message SET mAuthor = '$sNewAuthor', mSubject = '$sNewSubject', mContent = '$sNewContent' WHERE mID = $iUserID";

  mysqli_query($oDBLink, $sSql);
  header('location:index.php');
}
$iUserID = isset($_GET['id']) ? $_GET['id'] : '';
$sSqlGetDataQuery = "SELECT * FROM message WHERE mID = $iUserID";

$oResult = mysqli_query($oDBLink, $sSqlGetDataQuery);

$aArray = mysqli_fetch_assoc($oResult);
$iID = $aArray['mID'];
$sAuthor = $aArray['mAuthor'];
$sSubject = $aArray['mSubject'];
$sContent = $aArray['mContent'];
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript">
    function checkData() {
      if (document.myForm.mAuthor.value.length == 0)
        swal('貼文者欄位不可以空白哦！', '', 'error');
      else if (document.myForm.mSubject.value.length == 0)
        swal('主旨欄位不可以空白哦！', '', 'error');
      else if (document.myForm.mContent.value.length == 0)
        swal('內容欄位不可以空白哦！', '', 'error');
      else
        myForm.submit();
    }
  </script>
  <title>留言板</title>
</head>

<body>
  <div class="container">
    <div class="w3-container w3-center w3-padding-32"">
      <h1><b>編輯留言板<b></h1>
    </div>
    <form name=" myForm" method="post" action="update.php">
      <div class="form-group">
        <label>貼文者</label>
        <input type="text" name="mAuthor" class="form-control" value="<?php echo $sAuthor ?>">
      </div>
      <div class="form-group">
        <label>主旨</label>
        <input type="text" name="mSubject" class="form-control" value="<?php echo $sSubject ?>">
      </div>
      <div class="form-group">
        <label>內容</label>
        <input class="form-control" name="mContent" rows="3" value="<?php echo $sContent ?>">
      </div>
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="userID" value="<?php echo $iUserID ?>">

      <button type="button" class="btn btn-info" onClick="checkData()">修改資料</button>
      </form>
    </div>
</body>

</html>