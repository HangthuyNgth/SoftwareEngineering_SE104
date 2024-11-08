<?php
$mysqli = new mysqli("localhost","root","","qlhs");

$namhoc = $_POST['namhoc'];
$lop = $_POST['lop'];

$sql1 = "select * from danhsachlop where  MaNamHoc = '" . $namhoc . "' and Malop = '" . $lop . "' ";
$rs = $mysqli->query($sql1);
if ($rs->num_rows > 0) {
    while ($row = $rs->fetch_row()) {
        echo $row[3];
    }
} else {
    echo "-1";
}