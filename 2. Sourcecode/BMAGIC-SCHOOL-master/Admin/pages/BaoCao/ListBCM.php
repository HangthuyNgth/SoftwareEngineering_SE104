<?php
include "../../../Database/Config/config.php";

$MonHoc = $_POST['MonHoc'];
$HocKy = $_POST['HocKy'];
$NamHoc = $_POST['NamHoc'];

$sqlDD = "SELECT * FROM MONHOC WHERE MAMONHOC = '$MonHoc'";
$resultDD = $mysqli->query($sqlDD);
$rowDD = $resultDD->fetch_assoc();
$DiemDat = $rowDD["DiemDat"];

$sql = "
SELECT 
    danhsachlop.malop,
    danhsachlop.siso,
    lop.tenlop,
    COUNT(CASE WHEN bangdiemmh.dtbmh >= $DiemDat THEN 1 END) AS soluongdat,
    COUNT(*) AS tonghocsinh,
    COUNT(CASE WHEN bangdiemmh.dtbmh >= $DiemDat THEN 1 END) / COUNT(*) * 100 AS tile
FROM 
    bangdiemmh
JOIN 
    bangdiem ON bangdiemmh.mabd = bangdiem.mabangdiem
JOIN 
    chitietdanhsachlop ON bangdiem.mactdsl = chitietdanhsachlop.mactdsl
JOIN 
    danhsachlop ON chitietdanhsachlop.madsl = danhsachlop.madsl
JOIN 
    lop ON lop.malop = danhsachlop.malop
WHERE 
    bangdiemmh.mamonhoc = '$MonHoc' AND
    bangdiem.mahocky = '$HocKy' AND
    danhsachlop.manamhoc = '$NamHoc'
GROUP BY 
    danhsachlop.malop
";

// Thực thi truy vấn SQL
$result = $mysqli->query($sql);
$data = [];
// Kiểm tra xem truy vấn có thành công không
if ($result === false) {
    // Xử lý trường hợp truy vấn không thành công
    echo "Lỗi: " . $mysqli->error;
} else {
    // Truy vấn thành công, tiếp tục xử lý kết quả
    $stt = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stt++;
            $data[] = [
                'STT' => $stt,
                'TenLop' => $row['tenlop'],
                'SiSo' => $siso,
                'SoLuongDat' => $row['soluongdat'],
                'TiLe' => $tile
            ];
        }
    } 
}

echo json_encode($data);
?>
