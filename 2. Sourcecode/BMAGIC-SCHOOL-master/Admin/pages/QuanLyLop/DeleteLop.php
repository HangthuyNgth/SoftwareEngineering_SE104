<?php
include "../../../Database/Config/config.php";

if (isset($_GET['MaLop'])) {
    $MaLop = $_GET['MaLop'];
    $flag = true;

    $sql1 = "SELECT MADSL FROM DANHSACHLOP WHERE MALOP = $MaLop";
    $result1 = $mysqli->query($sql1);

    while ($row1 = $result1->fetch_assoc()) {
        $maDSL = $row1['MADSL'];
        $sql2 = "SELECT COUNT(*) AS SUM FROM CHITIETDANHSACHLOP WHERE MADSL = $maDSL";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_assoc();

        if ($row2['SUM'] > 0) {
            $flag = false;
            echo "<script>
            alert('Không xóa được lớp. Lớp học đang có học sinh.');
            window.location.href='http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyLop';
          </script>";
            break;
        }
    }
    if ($flag == true) {


        $sql3 = "DELETE FROM DANHSACHLOP WHERE MaLop = $MaLop";
        $mysqli->query($sql3);

        $sql4 = "DELETE FROM LOP WHERE MaLop = $MaLop";
        $mysqli->query($sql4);
        echo "<script>
        alert('Xóa thành công');window.location.href='http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyLop';
        </script>";
    }
}
