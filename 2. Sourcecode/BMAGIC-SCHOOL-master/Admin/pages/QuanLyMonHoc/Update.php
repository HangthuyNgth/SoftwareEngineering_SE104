<?php
include "../../../Database/Config/config.php";
if (isset($_POST['submit']) && ($_POST['submit'] == 'Cập nhật')) {

    $maMonHoc = $_POST['maMonHoc'];
    $tenMonHoc = $_POST['tenMonHoc'];
    $diemDat = $_POST['diemDat'];

    $sql = "UPDATE MONHOC SET TenMonHoc='$tenMonHoc', DiemDat='$diemDat' WHERE MaMonHoc='$maMonHoc'";
    $mysqli->query($sql);

    header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyMonHoc");
    exit();
}
