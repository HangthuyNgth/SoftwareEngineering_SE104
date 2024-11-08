<?php
// echo "xcv asdf xcv";
$mysqli = new mysqli("localhost", "root", "", "qlhs");

$MaCTDSL = $_POST['MaCTDSL'];
$MaHocSinh = $_POST['MaHocSinh'];
$namhoc = $_POST['namhoc'];


// $sql = "DELETE FROM chitietdanhsachlop WHERE MaCTDSL = '" . $MaCTDSL . "'";

// if (!$mysqli -> query($sql)) {
//     echo("Error description: ");
// }
$sql = "Select * from bangdiem where MaCTDSL = '" . $MaCTDSL . "'";
$rs = $mysqli->query($sql);

$ind = -1;
$arr[] = [];
if ($rs->num_rows > 0) {
    while ($row = $rs->fetch_row()) {
        if ($row[3] == "0") {
            $ind++;
            $arr[$ind] = "$row[0]";
        }
    }
}

if ($ind == 1) {
    $flag = false;
    for ($i = 0; $i < sizeof($arr); $i++) {
        // Xoa bang diem mon hoc
        $sql1 = "DELETE FROM bangdiemmh WHERE MaBD = '" . $arr[$i] . "'";

        if (mysqli_query($mysqli, $sql1) == true) {
            // Xoa bang diem
            $sql2 = "DELETE FROM bangdiem WHERE MaBangDiem = '" . $arr[$i] . "'";
            mysqli_query($mysqli, $sql2);
        } else {
            echo "Không thể xóa vì đã có điểm môn học";
            $flag = true;
            break;
        }
    }

    if ($flag != true) {
        // Xoa Chi tiet danh sach lop
        $sql3 = "DELETE FROM chitietdanhsachlop WHERE MaCTDSL = '" . $MaCTDSL . "'";
        mysqli_query($mysqli, $sql3);

        $sql4 = "UPDATE hocsinh SET Status='Mới' WHERE MaHocSinh = '" . $MaHocSinh . "'";
        mysqli_query($mysqli, $sql4);
        echo "Thành công";
    }
} else {
    echo "Không thể xóa vì đã có điểm môn học";
}



// $row5 = $rs5->fetch_assoc();
// $DTBHK = $row5['DTBHK'];

// if($DTBHK == "0"){
//     echo "Xoa dc";
// }else{
//     echo "Khong xoa dc";
// }

// try {
//     $sql = "DELETE FROM chitietdanhsachlop WHERE MaCTDSL = '" . $MaCTDSL . "'";
//     mysqli_query($mysqli, $sql);

//     echo "Thanh cong";
//     // send emails, etc
// } catch (Throwable $e) {
//     // do your handling here

//     echo "Khong the xoa";
// }



// $check = mysqli_query($mysqli, $sql);
// if($check == true){
//     echo "true";
// }else{
//     echo "false";
// }
// echo (mysqli_query($mysqli, $sql));
