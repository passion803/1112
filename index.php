<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
      if (document.myForm.author.value.length == 0)
        alert("作者欄位不可以空白哦！");
      else if (document.myForm.subject.value.length == 0)
        alert("主題欄位不可以空白哦！");
      else if (document.myForm.content.value.length == 0)
        alert("內容欄位不可以空白哦！");
      else
        myForm.submit();
    }
  </script>

  <title>留言板</title>
</head>

<body>
  <p align="center">留言板</p>
  <?php
      require_once("dbtools.inc.php");
			
      //指定每頁顯示幾筆記錄
      $records_per_page = 5;

      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;

      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
      $sql = "SELECT * FROM message ORDER BY date DESC";	
      $result = execute_sql($link, "guestbook", $sql);

      //取得記錄數
      $total_records = mysqli_num_rows($result);

      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);

      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);

      //將記錄指標移至本頁第一筆記錄的序號
      mysqli_data_seek($result, $started_record);

      //使用 $bg 陣列來儲存表格背景色彩
      $bg[0] = "#ebebe0";
      $bg[1] = "#ccccb3";
      $bg[2] = "#ebebe0";
      $bg[3] = "#ccccb3";
      $bg[4] = "#ebebe0";


      echo "<table width='800' align='center' cellspacing='3'>";

      //顯示記錄
      $j = 1;
      while ($row = mysqli_fetch_assoc($result) and $j <= $records_per_page)
      {
        echo "<tr bgcolor='" . $bg[$j - 1] . "'>";
        // echo "<td width='120' align='center'>
        //       <img src='" . mt_rand(0, 9) . ".gif'></td>";
        echo "<td>貼文者：" . $row["author"] . "<br>";
        echo "主旨：" . $row["subject"] . "<br>";
        echo "日期：" . $row["date"] . "<hr>";
        echo $row["content"] . "</td></tr>";
        $j++;
      }
      echo "</table>" ;

      //產生導覽列
      echo "<p align='center'>";

      if ($page > 1)
        echo "<a href='index.php?page=". ($page - 1) . "'>上一頁</a> ";

      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='index.php?page=$i'>$i</a> ";
      }

      if ($page < $total_pages)
        echo "<a href='index.php?page=". ($page + 1) . "'>下一頁</a> ";
      echo "</p>";

      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
    ?>
  <form name="myForm" method="post" action="post.php">
    <table border="0" width="800" align="center" cellspacing="0">
      <tr bgcolor="#94b8b8" align="center">
        <td colspan="2">
          <font>請在此輸入新的留言</font>
        </td>
      </tr>
      <tr bgcolor="#c2d6d6">
        <td>貼文者</td>
        <td><input name="author" type="text"></td>
      </tr>
      <tr bgcolor="#f0f5f5">
        <td>主旨</td>
        <td><input name="subject" type="text"></td>
      </tr>
      <tr bgcolor="#c2d6d6">
        <td>內容</td>
        <td><textarea name="content" ></textarea></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="張貼留言" onClick="check_data()">　
          <input type="reset" value="重新輸入">
        </td>
      </tr>
    </table>
  </form>
</body>

</html>