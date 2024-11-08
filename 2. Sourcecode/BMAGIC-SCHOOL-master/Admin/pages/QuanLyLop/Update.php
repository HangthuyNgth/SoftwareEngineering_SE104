<?php
include "../../../Database/Config/config.php";
if (isset($_POST['submit']) && ($_POST['submit'] == 'Cập nhật')) {

    $maLop = $_POST['maLop'];
    $tenLop = $_POST['tenLop'];
    $tenKhoi = $_POST['tenKhoi'];

    $sql = "Select MAKHOI FROM KHOILOP WHERE TENKHOI = '$tenKhoi' ";
    $result = $mysqli->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $maKhoi = $row['MAKHOI'];
    }


    $sql1 = "UPDATE LOP SET TenLop='$tenLop', MaKhoi='$maKhoi' WHERE MaLop='$maLop'";
    $mysqli->query($sql1);

    header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyLop");
    exit();
}
