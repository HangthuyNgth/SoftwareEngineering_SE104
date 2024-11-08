<?php
include "../../../Database/Config/config.php";

// Lấy giá trị hiện tại từ cơ sở dữ liệu
$sql = "SELECT * FROM THAMSO";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$MinAge = $row["MinAge"];
$MaxAge = $row["MaxAge"];
$DiemToiDa = $row["DiemToiDa"];
$DiemToiThieu = $row["DiemToiThieu"];
$DiemDat = $row["DiemDat"];
$SiSo = $row["SiSo"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if ($_POST['submit'] == 'Lưu') {
        // Lấy dữ liệu gửi từ biểu mẫu nếu có, nếu không sử dụng giá trị hiện tại
        $MinAge = isset($_POST['MinAge']) ? $_POST['MinAge'] : $MinAge;
        $MaxAge = isset($_POST['MaxAge']) ? $_POST['MaxAge'] : $MaxAge;
        $DiemToiThieu = isset($_POST['DiemToiThieu']) ? $_POST['DiemToiThieu'] : $DiemToiThieu;
        $DiemToiDa = isset($_POST['DiemToiDa']) ? $_POST['DiemToiDa'] : $DiemToiDa;
        $DiemDat = isset($_POST['DiemDat']) ? $_POST['DiemDat'] : $DiemDat;
        $SiSo = isset($_POST['SiSo']) ? $_POST['SiSo'] : $SiSo;

        $sql = "UPDATE THAMSO SET MinAge='$MinAge', MaxAge='$MaxAge', DiemToiThieu='$DiemToiThieu', DiemToiDa='$DiemToiDa', DiemDat='$DiemDat', SiSo='$SiSo'";
        $mysqli->query($sql);

        // Chuyển hướng người dùng sau khi cập nhật dữ liệu
        header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=CaiDat");
        exit();
    }
}
?>
