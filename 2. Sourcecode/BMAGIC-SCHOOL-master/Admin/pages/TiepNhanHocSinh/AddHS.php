<?php
include "../../../Database/Config/config.php";

if (isset($_POST['submit'])) {

    $tenHocSinh = $_POST['tenHocSinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];



    $sql = "INSERT INTO HOCSINH (`TenHocSinh`, `NgaySinh`, `GioiTinh`, `DiaChi`, `Email`, `status`) VALUES ('$tenHocSinh', '$ngaySinh', '$gioiTinh', '$diaChi', '$email','Mới')";
    $mysqli->query($sql);

    header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=TiepNhanHocSinh");
    exit; // It's a good practice to include an exit after redirection
}
