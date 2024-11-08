<?php
// echo "xcv asdf xcv";
$mysqli = new mysqli("localhost","root","","qlhs");

$namhoc = $_POST['namhoc'];
$lop = $_POST['lop'];


$sql1 = "select chitietdanhsachlop.MaCTDSL, TenHocSinh, GioiTinh, NgaySinh, DiaChi, Email, hocsinh.MaHocSinh, Status from hocsinh, chitietdanhsachlop, danhsachlop WHERE danhsachlop.MaDSL = chitietdanhsachlop.MaDSL and chitietdanhsachlop.MaHocSinh = hocsinh.MaHocSinh and MaNamHoc = '" . $namhoc . "' and Malop = '" . $lop . "'";
$data = mysqli_query($mysqli, $sql1);

$result = array();

while ($row1 = mysqli_fetch_assoc($data)) {
    $result[] = ($row1);
}


echo json_encode($result);
