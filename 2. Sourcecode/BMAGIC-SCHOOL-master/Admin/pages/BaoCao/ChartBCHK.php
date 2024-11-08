<?php
include "../../../Database/Config/config.php";

$HocKy = $_POST['HocKy'];
$NamHoc = $_POST['NamHoc'];

// Fetch DiemDat from THAMSO table
$sqlDD = "SELECT * FROM THAMSO";
$resultDD = $mysqli->query($sqlDD);
$rowDD = $resultDD->fetch_assoc();
$DiemDat = -1;
if($rowDD > 0){
    $DiemDat = $rowDD["DiemDat"];
}

$sql = "
SELECT 
    danhsachlop.malop,
    danhsachlop.siso,
    lop.tenlop,
    COUNT(CASE WHEN bangdiem.dtbhk >= ' " .$DiemDat. "' THEN 1 END) AS soluongdat
FROM 
    bangdiem
JOIN 
    chitietdanhsachlop ON bangdiem.mactdsl = chitietdanhsachlop.mactdsl
JOIN 
    danhsachlop ON chitietdanhsachlop.madsl = danhsachlop.madsl
JOIN 
    lop ON lop.malop = danhsachlop.malop
WHERE 
    bangdiem.mahocky = '$HocKy' AND
    danhsachlop.manamhoc = '$NamHoc'
GROUP BY 
    danhsachlop.malop
";

// Thực thi truy vấn SQL
$result = $mysqli->query($sql);

$data = [];
$stt = 0;
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        $stt++;
        $data[] = [
            'STT' => $stt,
            'TenLop' => $row['tenlop'],
            'SiSo' => $row['siso'],
            'SoLuongDat' => $row['soluongdat'],
            // Calculate TiLe here
            'TiLe' => ($row['soluongdat'] / $row['siso']) * 100
        ];
    }
}

echo json_encode($data);
?>
