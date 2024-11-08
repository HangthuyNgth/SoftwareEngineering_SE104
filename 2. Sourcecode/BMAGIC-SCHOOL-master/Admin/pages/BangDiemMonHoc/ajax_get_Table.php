<?php
include "../../../Database/Config/config.php";

if(isset($_GET['MaMonHoc'])&& isset($_GET['MaLopHoc'])&&isset($_GET['MaHocKy'])&&isset($_GET['NienKhoa']))
{
$MaMonHoc = $_GET['MaMonHoc'];
$MaLopHoc = $_GET['MaLopHoc'];
$MaHocKy =  $_GET['MaHocKy'];
$NienKhoa = $_GET['NienKhoa'];

$sql1 = 'select chitietdanhsachlop.MaCTDSL,chitietdanhsachlop.MaHocSinh,hocsinh.TenHocSinh from danhsachlop
     join chitietdanhsachlop on chitietdanhsachlop.MaDSL=danhsachlop.MaDSL 
     join namhoc on namhoc.MaNamHoc=danhsachlop.MaNamHoc
     join hocsinh on hocsinh.MaHocSinh=chitietdanhsachlop.MaHocSinh
     join lop on lop.MaLop= danhsachlop.MaLop
     where namhoc.MaNamHoc= "'. $NienKhoa . '"and lop.MaLop="' . $MaLopHoc . '"';

$result1 = mysqli_query($mysqli, $sql1);
//vòng lặp lấy mã ctdsl 
$i = 0;
$data=array();
while ($row1 = mysqli_fetch_assoc($result1)) {

    $sql2 = 'select bangdiemmh.MaBDMH from bangdiem 
    join hocky on bangdiem.MaHocKy=hocky.MaHocKy
    join bangdiemmh on bangdiemmh.MaBD=bangdiem.MaBangDiem
    join monhoc on monhoc.MaMonHoc=bangdiemmh.MaMonHoc
    where bangdiem.MaCTDSL=' . $row1["MaCTDSL"] . ' and hocky.MaHocKy= ' . $MaHocKy . ' and monhoc.MaMonHoc=' . $MaMonHoc . ' ';

    $result2 = mysqli_query($mysqli, $sql2);

    // Vòng lặp lấy mã bảng điểm thành phần 
    while ($row2 = mysqli_fetch_assoc($result2)) {

        // xử lý cột điểm 15p 

        $sql15p = 'SELECT bangdiemthanhphan.ketqua, bangdiemthanhphan.MaBDTP 
           FROM bangdiemthanhphan
           JOIN loaikiemtra ON bangdiemthanhphan.MaLKT = loaikiemtra.MaLKT
           WHERE bangdiemthanhphan.MaBDMH = ' . $row2['MaBDMH'] . ' 
           AND loaikiemtra.TenLoaiKiemTra = "Kiểm tra 15 phút"';

        // Thực thi câu truy vấn
        $result15p = mysqli_query($mysqli, $sql15p);

        // Khởi tạo các mảng để lưu trữ kết quả
        $MaBDTP15p = [];
        $Kiemtra15p = [];

        // Kiểm tra nếu truy vấn thành công
        if ($result15p) {
            // Kiểm tra nếu có bất kỳ hàng nào được trả về
            if (mysqli_num_rows($result15p) > 0) {
                // Lấy kết quả và lưu trữ vào các mảng
                while ($row15p = mysqli_fetch_assoc($result15p)) {
                    $MaBDTP15p[] = $row15p['MaBDTP'];
                    $Kiemtra15p[] = $row15p['ketqua'];
                }
            } else {
                // Nếu không có hàng nào được trả về, lưu trữ giá trị null
                $MaBDTP15p[] = null;
                $Kiemtra15p[] = null;
            }
        } else {
            // Nếu câu truy vấn thất bại, lưu trữ giá trị null
            $MaBDTP15p[] = null;
            $Kiemtra15p[] = null;
        }


        // Xử lý cột điểm 1 tiết 
        // Truy vấn kết quả kiểm tra 1 tiết
        $sql1tiet = 'SELECT bangdiemthanhphan.ketqua, bangdiemthanhphan.MaBDTP 
FROM bangdiemthanhphan
JOIN loaikiemtra ON bangdiemthanhphan.MaLKT = loaikiemtra.MaLKT
WHERE bangdiemthanhphan.MaBDMH = ' . $row2['MaBDMH'] . ' 
AND loaikiemtra.TenLoaiKiemTra = "Kiểm tra 1 tiết"';
        $result1tiet = mysqli_query($mysqli, $sql1tiet);

        // Khởi tạo các mảng để lưu trữ kết quả
        $MaBDTP1tiet = [];
        $Kiemtra1tiet = [];

        if ($result1tiet) {
            if (mysqli_num_rows($result1tiet) > 0) {
                while ($row1tiet = mysqli_fetch_assoc($result1tiet)) {
                    $MaBDTP1tiet[] = $row1tiet['MaBDTP'];
                    $Kiemtra1tiet[] = $row1tiet['ketqua'];
                }
            } else {
                $MaBDTP1tiet[] = null;
                $Kiemtra1tiet[] = null;
            }
        } else {
            $MaBDTP1tiet[] = null;
            $Kiemtra1tiet[] = null;
        }

        // Truy vấn kết quả kiểm tra học kỳ
        $sqlhocky = 'SELECT bangdiemthanhphan.ketqua, bangdiemthanhphan.MaBDTP 
FROM bangdiemthanhphan
JOIN loaikiemtra ON bangdiemthanhphan.MaLKT = loaikiemtra.MaLKT
WHERE bangdiemthanhphan.MaBDMH = ' . $row2['MaBDMH'] . ' 
AND loaikiemtra.TenLoaiKiemTra = "Kiểm tra học kỳ"';
        $resulthocky = mysqli_query($mysqli, $sqlhocky);

        // Khởi tạo các mảng để lưu trữ kết quả
        $MaBDTPhocky = [];
        $Kiemtrahocky = [];

        if ($resulthocky) {
            if (mysqli_num_rows($resulthocky) > 0) {
                while ($rowhocky = mysqli_fetch_assoc($resulthocky)) {
                    $MaBDTPhocky[] = $rowhocky['MaBDTP'];
                    $Kiemtrahocky[] = $rowhocky['ketqua'];
                }
            } else {
                $MaBDTPhocky[] = null;
                $Kiemtrahocky[] = null;
            }
        } else {
            $MaBDTPhocky[] = null;
            $Kiemtrahocky[] = null;
        }


        $data[$i] = [
            'TenHocSinh' => $row1['TenHocSinh'],
            'KiemTra15p' => $Kiemtra15p,
            'KiemTra1tiet' => $Kiemtra1tiet,
            'KiemTraHocKy' =>  $Kiemtrahocky,
            'MaBDMH' => $row2['MaBDMH'],
            'MaBDTP15p' => $MaBDTP15p,
            'MaBDTP1tiet' => $MaBDTP1tiet,
            'MaBDTPhocky' => $MaBDTPhocky
        ];

        unset($Kiemtra15p);
        unset($Kiemtra1tiet);
        unset($Kiemtrahocky);
        unset($MaBDTP15p);
        unset($MaBDTP1tiet);
        unset($MaBDTPhocky);
    }
    $i++;
}
echo json_encode($data);
}
