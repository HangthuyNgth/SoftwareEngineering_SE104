<?php
$mysqli = new mysqli("localhost","root","","qlhs");

$listSelectHS = $_POST['listSelectHS'];
$namhoc = $_POST['namhoc'];
$lop = $_POST['lop'];

$sql = "Select MaDSL from danhsachlop where MaNamHoc = '" . $namhoc . "' and MaLop = '" . $lop . "' LIMIT 1";
$rs = $mysqli->query($sql);
$row = $rs->fetch_assoc();
$MaDSL = $row['MaDSL'];

$sql3 = "Select Count(*) AS SUM
    From chitietdanhsachlop, hocsinh
    WHERE chitietdanhsachlop.MaHocSinh = hocsinh.MaHocSinh and chitietdanhsachlop.MaDSL = '" . $MaDSL . "'";
$rs3 = $mysqli->query($sql3);
$row3  = $rs3->fetch_assoc();
$SoLuongHocSinhTrongLop = $row3['SUM'];

$sql4 = "Select SiSo from thamso";
$rs4 = $mysqli->query($sql4);
$row4 = $rs4->fetch_assoc();
$SiSo = $row4['SiSo'];

$check = 0;
for ($i = 0; $i < sizeof($listSelectHS); $i++) {
    // $sql5 = "Select Status from hocsinh where MaHocSinh = '" . $listSelectHS[$i] . "'";
    // $rs5 = $mysqli->query($sql5);
    // $row5 = $rs5->fetch_assoc();
    // $Status = $row5['Status'];

    if ($SoLuongHocSinhTrongLop < $SiSo) {
        $sql2 = "INSERT INTO chitietdanhsachlop(`MaDSL`, `MaHocSinh`) VALUES ('" . $MaDSL . "','" . $listSelectHS[$i] . "')";
        $rs1 = mysqli_query($mysqli, $sql2);

        if ($rs1 == true) {
            $sql1 = "UPDATE hocsinh SET Status='' WHERE MaHocSinh = '" . $listSelectHS[$i] . "'";
            mysqli_query($mysqli, $sql1);
        }

        $SoLuongHocSinhTrongLop++;
    } else {
        $check = 1;
    }
}

if($check == 1){
    echo "Lớp đã đầy!!!!";
}else{
    echo "Thành công";
}

