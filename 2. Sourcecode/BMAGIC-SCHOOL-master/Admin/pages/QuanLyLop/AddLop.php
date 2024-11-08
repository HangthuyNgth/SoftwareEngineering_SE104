<?php
include "../../../Database/Config/config.php";

if (isset($_POST['submit'])) {
    $tenLop = $_POST['tenLop'];
    $tenKhoi = $_POST['tenKhoi'];

    //MAKHOI
    $sql = "SELECT MAKHOI FROM KHOILOP WHERE TENKHOI = '$tenKhoi'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $maKhoi = $row['MAKHOI'];

    $sql6 = "SELECT count(*) as count FROM LOP WHERE tenlop = '$tenLop' and makhoi = '$maKhoi'";
    $result6 = $mysqli->query($sql6);
    $row6 = $result6->fetch_assoc();
    // Insert LOP 
    $sql1 = "INSERT INTO LOP (TenLop, MaKhoi) VALUES ('$tenLop', '$maKhoi')";
    $mysqli->query($sql1);


    $sql2 = "SELECT SiSo FROM thamso LIMIT 1";
    $result2 = $mysqli->query($sql2);
    if ($result2->num_rows == 1) {
        $row2 = $result2->fetch_assoc();
        $siso = $row2['SiSo'];
    }

    $sql3 = "SELECT MaLop FROM LOP WHERE tenlop = '$tenLop' and makhoi = '$maKhoi'";
    $result3 = $mysqli->query($sql3);
    if ($result3->num_rows == 1) {
        $row3 = $result3->fetch_assoc();
        $malop = $row3['MaLop'];
    }

    $sql4 = "SELECT MaNamHoc FROM namhoc";
    $result4 = $mysqli->query($sql4);
    while ($row4 = $result4->fetch_assoc()) {
        $manamhoc = $row4['MaNamHoc'];
        $sql5 = "INSERT INTO danhsachlop (manamhoc, malop, siso) VALUES ('$manamhoc', '$malop', '0')";
        $mysqli->query($sql5);
    }

    header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyLop");
    exit();
}
