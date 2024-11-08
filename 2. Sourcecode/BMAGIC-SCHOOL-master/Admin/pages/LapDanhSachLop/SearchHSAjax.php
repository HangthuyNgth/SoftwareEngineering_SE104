<?php
$mysqli = new mysqli("localhost","root","","qlhs");
$Search = $_POST['Search'];
$namhoc = $_POST['namhoc'];

if ($Search != "") {
    $sql = "select * from hocsinh
    where hocsinh.MaHocSinh  NOT IN(
        select hocsinh.MaHocSinh from hocsinh, chitietdanhsachlop, danhsachlop where danhsachlop.MaDSL = chitietdanhsachlop.MaDSL 
        and chitietdanhsachlop.MaHocSinh = hocsinh.MaHocSinh and danhsachlop.MaNamHoc = '".$namhoc."'
    ) and hocsinh.TenHocSinh like '%" . $Search . "%'";
    // $sql = "select hocsinh.MaHocSinh,TenHocSinh, GioiTinh, NgaySinh, DiaChi, Email, Status from hocsinh where TenHocSinh like '%" . $Search . "%' and Status = 'Mới'";
    $rs = $mysqli->query($sql);
    $ind = 0;
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_row()) {
            $ind++;
            $phpdate = strtotime($row[2]);
            $mysqldate = date('Y', $phpdate);
            echo "<tr val='$row[0]' class='row_hs'>
                    <td> <input type='checkbox' id='select_checkbox' val='$row[0]'></td>
                    <td class='STT' style='text-align: center;'>$ind</td>
                    <td class='Ho_va_Ten' style='text-align: center;'>$row[1]</td>
                    <td class='Gioi_tinh' style='text-align: center;'>$row[3]</td>
                    <td class='Nam_sinh' style='text-align: center;'>$mysqldate</td>
                    <td class='Dia_chi' style='text-align: center;'>$row[4]</td>
                    <td class='Email' style='text-align: center;'>$row[5]</td>
                </tr>";
        }
    } else {
        echo "-1";
    }
}else{
    $sql = "select * from hocsinh
    where hocsinh.MaHocSinh  NOT IN(
        select hocsinh.MaHocSinh from hocsinh, chitietdanhsachlop, danhsachlop where danhsachlop.MaDSL = chitietdanhsachlop.MaDSL 
        and chitietdanhsachlop.MaHocSinh = hocsinh.MaHocSinh and danhsachlop.MaNamHoc = '".$namhoc."'
    )";
    $rs = $mysqli->query($sql);
    $ind = 0;
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_row()) {
            $ind++;
            $phpdate = strtotime($row[2]);
            $mysqldate = date('Y', $phpdate);
            echo "<tr val='$row[0]' class='row_hs'>
                    <td> <input type='checkbox' id='select_checkbox' val='$row[0]'></td>
                    <td class='STT' style='text-align: center;'>$ind</td>
                    <td class='Ho_va_Ten' style='text-align: center;'>$row[1]</td>
                    <td class='Gioi_tinh' style='text-align: center;'>$row[3]</td>
                    <td class='Nam_sinh' style='text-align: center;'>$mysqldate</td>
                    <td class='Dia_chi' style='text-align: center;'>$row[4]</td>
                    <td class='Email' style='text-align: center;'>$row[5]</td>
                </tr>";
        }
    } else {
        echo "-1";
    }
}
