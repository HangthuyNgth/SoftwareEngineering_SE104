<?php

include("../../../Database/Config/config.php");





$Diem15p = $_GET['Diem15p'];
$MaBDTP15p = $_GET['MaBDTP15p'];

$Diem1tiet = $_GET['Diem1tiet'];
$MaBDTP1tiet = $_GET['MaBDTP1tiet'];

$Diemhocky = $_GET['Diemhocky'];
$MaBDTPhocky = $_GET['MaBDTPhocky'];



// echo $Diem15p . '|' . $MaBDTP15p . '<br>';

// echo $Diem1tiet . '|' . $MaBDTP1tiet . '<br>';

// echo  $Diemhocky . '|' . $MaBDTPhocky . '<br>';


// xử lý array điểm 15p 
$Diem15pArray = explode(',', $Diem15p);
$MaBDTP15pArray = explode(',', $MaBDTP15p);

// Cập nhật và theo dõi các giá trị đã được cập nhật thành công
$updatedMaBDTP15p = [];

for ($i = 0; $i < count($Diem15pArray); $i++) {
    $value1 = $Diem15pArray[$i];
    $value2 = $MaBDTP15pArray[$i];

    $sql = "UPDATE `bangdiemthanhphan` SET `ketqua`= '$value1' WHERE MaBDTP= '$value2'";
    if (mysqli_query($mysqli, $sql)) {
        $updatedMaBDTP15p[] = $value2;
    }
}

// Tìm các giá trị không được cập nhật
$remainingMaBDTP15p = array_diff($MaBDTP15pArray, $updatedMaBDTP15p);

// Xóa các giá trị không được cập nhật
foreach ($remainingMaBDTP15p as $value) {
    $sql = "DELETE FROM `bangdiemthanhphan` WHERE MaBDTP= '$value'";
    mysqli_query($mysqli, $sql);
}
 

// Xử lý array điểm 1 tiết
$Diem1tietArray = explode(',', $Diem1tiet);
$MaBDTP1tietArray = explode(',', $MaBDTP1tiet);

$updatedMaBDTP1tiet = [];
for ($i = 0; $i < count($Diem1tietArray); $i++) {
    $value1 = $Diem1tietArray[$i];
    $value2 = $MaBDTP1tietArray[$i];

    $sql = "UPDATE `bangdiemthanhphan` SET `ketqua`='$value1' WHERE MaBDTP= '$value2'";
    if (mysqli_query($mysqli, $sql)) {
        $updatedMaBDTP1tiet[] = $value2;
    }
}

$remainingMaBDTP1tiet = array_diff($MaBDTP1tietArray, $updatedMaBDTP1tiet);
foreach ($remainingMaBDTP1tiet as $value) {
    $sql = "DELETE FROM `bangdiemthanhphan` WHERE MaBDTP='$value'";
    mysqli_query($mysqli, $sql);
}

// Xử lý array điểm học kỳ
$DiemhockyArray = explode(',', $Diemhocky);
$MaBDTPhockyArray = explode(',', $MaBDTPhocky);

$updatedMaBDTPhocky = [];
for ($i = 0; $i < count($DiemhockyArray); $i++) {
    $value1 = $DiemhockyArray[$i];
    $value2 = $MaBDTPhockyArray[$i];

    $sql = "UPDATE `bangdiemthanhphan` SET `ketqua`= '$value1' WHERE MaBDTP='$value2'";
    if (mysqli_query($mysqli, $sql)) {
        $updatedMaBDTPhocky[] = $value2;
    }
}

$remainingMaBDTPhocky = array_diff($MaBDTPhockyArray, $updatedMaBDTPhocky);
foreach ($remainingMaBDTPhocky as $value) {
    $sql = "DELETE FROM `bangdiemthanhphan` WHERE MaBDTP='$value'";
    mysqli_query($mysqli, $sql);
}
