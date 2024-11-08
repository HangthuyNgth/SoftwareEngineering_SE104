<?php
include "../../../Database/Config/config.php";

$HocKy = $_POST['HocKy'];
$NamHoc = $_POST['NamHoc'];

$sqlDD = "SELECT * FROM THAMSO";
$resultDD = $mysqli->query($sqlDD);
$rowDD = $resultDD->fetch_assoc();
$DiemDat = $rowDD["DiemDat"];

$sql = "
SELECT 
    danhsachlop.malop,
    danhsachlop.siso,
    lop.tenlop,
    COUNT(CASE WHEN bangdiem.dtbhk >= $DiemDat THEN 1 END) AS soluongdat
FROM 
    bangdiem
JOIN 
    chitietdanhsachlop ON bangdiem.mactdsl = chitietdanhsachlop.mactdsl
JOIN 
    danhsachlop ON chitietdanhsachlop.madsl = danhsachlop.madsl
JOIN 
    lop ON lop.malop = danhsachlop.malop
WHERE 
    bangdiem.mahocky = $HocKy AND
    danhsachlop.manamhoc = $NamHoc
GROUP BY 
    danhsachlop.malop
";

// Thực thi truy vấn SQL
$result = $mysqli->query($sql);

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
            $tiLe = ( $row['soluongdat'] / $row['siso'] ) * 100;
            echo '<tr>
                    <td class="text-center">' . $stt . '</td>
                    <td id="TenLop" class="text-center">' . $row['tenlop'] . '</td>
                    <td id="SiSo" class="text-center">' . $row['siso'] . '</td>
                    <td id="SoLuongDat" class="text-center">' . $row['soluongdat'] . '</td>
                    <td id="TiLe" >' . $tiLe . '</td>
                  </tr>';
        }
    } else {
        // Nếu không có dữ liệu, in ra thông báo không có dữ liệu
        echo '<tr><td colspan="3">Không có dữ liệu.</td></tr>';
    }
}
?>
