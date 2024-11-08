<?php 
include "../../../Database/Config/config.php";

if(isset($_POST['submit'])) {
    $tenMonHoc = $_POST['tenMonHoc'];
    $diemDat = $_POST['diemDat'];

    $sql = "INSERT INTO MONHOC (TenMonHoc, DiemDat) VALUES ('$tenMonHoc', '$diemDat')";
    
    $result =$mysqli->query($sql);
    header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyMonHoc");
    exit; 
}
?>
