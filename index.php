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
      <h1><b>留言板<b></h1>
    </div>
    <div class="row">
      <div class="col-12 col-md-8 mb-5">
        <table class="table table-striped table-bordered">
          <thread>
            <tr>
              <th>貼文者</th>
              <th>主旨</th>
              <th>內容</th>
              <th>日期</th>
              <th></th>
            </tr>
          </thread>
          <tbody>
            <?php
            include("connMySQL.php");
            $sSql = "SELECT * FROM message ORDER BY mID DESC";
            $oResult = mysqli_query($oDBLink, $sSql);
            $iTotalRecords = mysqli_num_rows($oResult);
            $iRecordsPerPage = 5;
            //取得要顯示第幾頁的記錄
            if (isset($_GET["page"]))
              $iPage = $_GET["page"];
            else
              $iPage = 1;
            //計算總頁數
            $iTotalPages = ceil($iTotalRecords / $iRecordsPerPage);
            //計算本頁第一筆記錄的序號
            $iStartedRecord = $iRecordsPerPage * ($iPage - 1);
            //將記錄指標移至本頁第一筆記錄的序號
            mysqli_data_seek($oResult, $iStartedRecord);

            //顯示記錄
            $iRecordCount = 1;
            while ($aArray = mysqli_fetch_assoc($oResult) and $iRecordCount <= $iRecordsPerPage) {
              echo '<tr>';
              echo '<td>' . $aArray['mAuthor'] . '</td>';
              echo '<td>' . $aArray['mSubject'] . '</td>';
              echo '<td>' . $aArray['mContent'] . '</td>';
              echo '<td>' . $aArray['mDate'] . '</td>';
              echo '<td width=200>';
              echo ' ';
              echo '<a class="btn btn-info" href="update.php?id=' . $aArray['mID'] . '">編輯</a>';
              echo ' ';
              echo '<a class="btn btn-danger" href="delete.php?id=' . $aArray['mID'] . '">刪除</a>';
              echo '</td>';
              echo '</tr>';
              $iRecordCount++;
            }
            echo "</tbody>";
            echo "</table>";

            //產生導覽列
            echo "<p align='center'>";

            if ($iPage > 1)
              echo "<a href='index.php?page=" . ($iPage - 1) . "'>上一頁</a> ";

            for ($iPageCount = 1; $iPageCount <= $iTotalPages; $iPageCount++) {
              if ($iPageCount == $iPage)
                echo "$iPageCount ";
              else
                echo "<a href='index.php?page=$iPageCount'>$iPageCount</a> ";
            }
            if ($iPage < $iTotalPages)
              echo "<a href='index.php?page=" . ($iPage + 1) . "'>下一頁</a> ";
            echo "</p>";
            ?>
      </div>
      <div class="col-12 col-md-4">
        <form name="myForm" method="post" action="create.php">
          <div class="form-group">
            <label>貼文者</label>
            <input type="text" name="mAuthor" class="form-control">
          </div>
          <div class="form-group">
            <label>主旨</label>
            <input type="text" name="mSubject" class="form-control">
          </div>
          <div class="form-group">
            <label>內容</label>
            <textarea class="form-control" name="mContent" rows="3"></textarea>
          </div>
          <input type="hidden" name="action" value="create">
          <button type="button" class="btn btn-secondary" onClick="checkData()">張貼留言</button>
          <button type="reset" class="btn btn-secondary" >重新輸入</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>