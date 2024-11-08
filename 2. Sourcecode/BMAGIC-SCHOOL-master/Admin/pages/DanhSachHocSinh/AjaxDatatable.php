<?php
include "../../../Database/Config/config.php";

$namHoc = $_POST['namHoc'];

$sql = "
    SELECT DISTINCT HS.TenHocSinh, L.TenLop, D.MACTDSL
    FROM HOCSINH HS, LOP L, BANGDIEM D, CHITIETDANHSACHLOP CTDSL, DANHSACHLOP DS
    WHERE DS.MANAMHOC = '$namHoc' AND
          DS.MALOP = L.MALOP AND
          CTDSL.MADSL = DS.MADSL AND
          CTDSL.MAHOCSINH = HS.MAHOCSINH AND
          D.MACTDSL = CTDSL.MACTDSL
";

$result = $mysqli->query($sql);
$data = [];
$stt = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stt++;

        // Query for DTBHK1
        $sqlDiemhk1 = "SELECT DTBHK FROM BANGDIEM WHERE MACTDSL = " . $row['MACTDSL'] . " AND MAHOCKY = 1";
        $resultDiemhk1 = $mysqli->query($sqlDiemhk1);
        $DTBHK1 = $resultDiemhk1 ? $resultDiemhk1->fetch_assoc()['DTBHK'] : "N/A";

        // Query for DTBHK2
        $sqlDiemhk2 = "SELECT DTBHK FROM BANGDIEM WHERE MACTDSL = " . $row['MACTDSL'] . " AND MAHOCKY = 2";
        $resultDiemhk2 = $mysqli->query($sqlDiemhk2);
        $DTBHK2 = $resultDiemhk2 ? $resultDiemhk2->fetch_assoc()['DTBHK'] : "N/A";

        $data[] = [
            'STT' => $stt,
            'TenHocSinh' => $row['TenHocSinh'],
            'TenLop' => $row['TenLop'],
            'DTBHK1' => $DTBHK1,
            'DTBHK2' => $DTBHK2
        ];
    }
}

echo json_encode($data);
?>
