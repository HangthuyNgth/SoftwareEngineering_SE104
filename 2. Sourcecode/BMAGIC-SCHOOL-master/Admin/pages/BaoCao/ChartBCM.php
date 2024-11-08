<?php
// Bắt đầu kết nối cơ sở dữ liệu và lấy dữ liệu
include "../../../Database/Config/config.php";

$MonHoc = $_POST['MonHoc'];
$HocKy = $_POST['HocKy'];
$NamHoc = $_POST['NamHoc'];

// Fetch DiemDat for the specific subject
$sqlDD = "SELECT * FROM MONHOC WHERE MAMONHOC = ' " .$MonHoc . "'";
$resultDD = $mysqli->query($sqlDD);
$rowDD = $resultDD->fetch_assoc();
$DiemDat = -1;
if($rowDD > 0){
    $DiemDat = $rowDD ["DiemDat"];
}
$DiemDat = -1;
if($rowDD > 0){
    $DiemDat = $rowDD["DiemDat"];
}


$sql = "
SELECT 
    danhsachlop.malop,
    danhsachlop.siso,
    lop.tenlop,
    COUNT(CASE WHEN bangdiemmh.dtbmh >= ' " . $DiemDat . " ' THEN 1 END) AS soluongdat
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
$stt = 0;
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        $stt++;
        // Check if 'siso' index exists in the row array
        // $siso = isset($row['siso']) ? $row['siso'] : 'N/A';
        // Calculate TiLe here
        // $tile = ($row['soluongdat'] / $siso) * 100;  
        $percentage = round(( $row['soluongdat'] / $row['siso']) * 100, 3);

        $data[] = [
            'STT' => $stt,
            'TenLop' => $row['tenlop'],
            'SiSo' => $row['siso'],
            'SoLuongDat' => $row['soluongdat'],
            'TiLe' => $percentage
        ];
    }
}
echo json_encode($data);
?>
