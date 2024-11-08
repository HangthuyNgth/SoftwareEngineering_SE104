<?php
include "../../../Database/Config/config.php";

if (isset($_GET['MaHocSinh'])) {
    $MaHocSinh = $_GET['MaHocSinh'];

    $sql1 = "Select * from namhoc";
    $result1 = $mysqli->query($sql1);
    while($row1 = $result1->fetch_assoc()){
        $namhoc = $row1['MaNamHoc'];
        $sql2 = "select count(*) as count from chitietdanhsachlop, danhsachlop where chitietdanhsachlop.MaDSL = danhsachlop.MaDSL 
        and chitietdanhsachlop.MaHocSinh = '".$MaHocSinh."' and danhsachlop.MaNamHoc = '".$namhoc."'";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_assoc();
        $d = $row2['count'];
        
        if($row2['count'] > 0){
            echo "<script>
            alert('Không xóa được học sinh. Học sinh đã được phân lớp.');
            window.location.href='http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=TiepNhanHocSinh';
          </script>";
        }
        
    }

    $sql1 = "DELETE FROM HocSinh WHERE MaHocSinh = '$MaHocSinh'";
    
    if($mysqli->query($sql1) == true){
        echo "<script>
        alert('Xóa thành công');
        window.location.href='http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=TiepNhanHocSinh';
        </script>";
    }
    
}