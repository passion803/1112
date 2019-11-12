<?php
    include("connMySQL.php");
    $sql_query = "SELECT * FROM message ORDER BY mID DESC";
    $result = mysqli_query($db_link,$sql_query);
    $total_records = mysqli_num_rows($result);
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
  <h1 align="center">留言板</h1> 

  <!-- 新增 -->
  <div class="container">
    <div class="row">
      <div class="col">
      <?php
        //指定每頁顯示幾筆記錄
        $records_per_page = 3;

        //取得要顯示第幾頁的記錄
        if (isset($_GET["page"]))
        $page = $_GET["page"];
        else
        $page = 1;

        //計算總頁數
        $total_pages = ceil($total_records / $records_per_page);

        //計算本頁第一筆記錄的序號
        $started_record = $records_per_page * ($page - 1);

        //將記錄指標移至本頁第一筆記錄的序號
        mysqli_data_seek($result, $started_record);

        //表格背景色彩
        $bg[0] = "#ebebe0";
        $bg[1] = "#ccccb3";
        $bg[2] = "#ebebe0";

        echo "<table width='800' align='center' cellspacing='3'>";

        //顯示記錄
        $j = 1;
        while ($row = mysqli_fetch_assoc($result) and $j <= $records_per_page) { 
          echo "<tr bgcolor='" . $bg[$j - 1] . "'>"; 
          // echo "<td width='120' align='center'>
          //       <img src='" . mt_rand(0, 9) . ".gif'></td>" ; 
          echo "<td>貼文者：" . $row["mAuthor"] . "<br>" ; 
          echo "主旨：" . $row["mSubject"] . "<br>" ; 
          echo "日期：" . $row["mDate"] . "<br>" ; 
          echo "<a href='update.php?id=" .$row['mID']."'>編輯</a>". "<br>";
          echo "<a href='delete.php?id=".$row['mID']."'>刪除</a>". "<hr>";
          echo $row["mContent"] . "</td></tr>";
          $j++;
          }
          echo "</table>" ;
        
          //產生導覽列
          echo "<p align='center'>";

            if ($page > 1)
            echo "<a href='index.php?page=". ($page - 1) . "'>上一頁</a> ";

            for ($i = 1; $i <= $total_pages; $i++){ 
              if ($i==$page) 
              echo "$i " ; 
              else 
              echo "<a href='index.php?page=$i'>$i</a> "; 
            } if ($page < $total_pages) 
            echo "<a href='index.php?page=" . ($page + 1) . "'>下一頁</a> " ; 
            echo "</p>"; 
            ?>
      </div>
      <div class="col">
        <form name="myForm" method="post" action="create.php">
          <!-- <div>
            <font>請在此輸入新的留言</font>
          </div> -->
          <div class="form-group">
            <label for="exampleInputEmail1">貼文者</label>
            <input type="text" name="mAuthor" class="form-control">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">主旨</label>
            <input type="text" name="mSubject" class="form-control">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">內容</label>
            <textarea class="form-control" name="mContent" rows="3"></textarea>
          </div>
          <input type="hidden" name="action" value="create">
          <button type="button" class="btn btn-info" onClick="check_data()">張貼留言</button>
          <button type="reset" class="btn btn-info">重新輸入</button>
        </form>
      </div>      
    </div>
  </div>

</body>

</html>