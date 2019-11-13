<?php
$iUserID = $_GET['id'];
include('connMySQL.php');
$sSql = "DELETE FROM message WHERE mID = $iUserID";
mysqli_query($oDBLink, $sSql);
$oDBLink->close();
header("location:index.php");
?>

<script>
    function swalDelete() {
        $(document).ready(function(){
	fetch();
 
	$(document).on('click', '.delete_product', function(){
		var id = $(this).data('id');
        swal({
                title: "刪除照片?",
                text: "所選照片都將刪除!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "刪除",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                closeOnCancel: true,
                allowOutsideClick: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    //這邊是模擬 ajax 請求並回應成功後的function
                    setTimeout(function() {
                        $('.listTb').find('input[type="checkbox"]:checked').each(function() {
                            var id = $(this).val();
                            $('#' + id).remove();
                        });
                        swal("刪除完成!", "所選照片已成功刪除!", "success");
                    }, 1000);
                }
            });
    }
</script>