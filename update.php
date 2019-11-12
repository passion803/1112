<?php
  include("connMySQL.php");
	if (isset($_POST["action"]) && $_POST["action"] == 'update') {

    $newAuthor = $_POST['mAuthor'];
    $newSubject = $_POST['mSubject'];
    $newContent = $_POST['mContent'];
    $userID = $_POST['userID'];

    $sql_query = "UPDATE message SET mAuthor = '$newAuthor', mSubject = '$newSubject', mContent = '$newContent' WHERE mID = $userID";

    mysqli_query($db_link,$sql_query);
    header('Location: index.php');
}
  $userID = isset($_GET['id']) ? $_GET['id'] : '';
  $sql_getDataQuery = "SELECT * FROM message WHERE mID = $userID";

  $result = mysqli_query($db_link, $sql_getDataQuery);
 
  $row = mysqli_fetch_assoc($result);
  $id = $row['mID'];
  $author = $row['mAuthor'];
  $subject = $row['mSubject'];
  $content = $row['mContent'];
 ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

  <script type="text/javascript">
    function check_data() {
      if (document.myForm.mAuthor.value.length == 0)
        alert("貼文者欄位不可以空白哦！");
      else if (document.myForm.mSubject.value.length == 0)
        alert("主旨欄位不可以空白哦！");
      else if (document.myForm.mContent.value.length == 0)
        alert("內容欄位不可以空白哦！");
      else
        myForm.submit();
    }
  </script>

  <title>留言板</title>
</head>

<body>
  <h1 align="center">修改資料</h1>

  <form name="myForm" method="post" action="update.php">
    <div>
      <h4>請在此修改留言</h4>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">貼文者</label>
      <input type="text" name="mAuthor" class="form-control" value="<?php echo $author ?>">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">主旨</label>
      <input type="text" name="mSubject" class="form-control" value="<?php echo $subject ?>">
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">內容</label>
      <input class="form-control" name="mContent" rows="3" value="<?php echo $content ?>">
    </div>
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="userID" value="<?php echo $userID ?>">

    <button type="submit" class="btn btn-info" onClick="check_data()">修改資料</button>
  </form>
</body>

</html>