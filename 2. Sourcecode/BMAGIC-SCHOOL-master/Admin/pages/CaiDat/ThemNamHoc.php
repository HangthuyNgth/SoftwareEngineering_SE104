<?php
include "../../../Database/Config/config.php";

if (isset($_POST['submit'])) {
    $nam1 = $_POST['nam1'];
    $nam2 = $nam1 + 1;

    $mysqli->begin_transaction();

    try {
        $sql = "INSERT INTO NAMHOC (nam1, nam2) VALUES ('$nam1', '$nam2')";
        $mysqli->query($sql);

        $maNamHoc = $mysqli->insert_id;

        $sql = "SELECT MaLop FROM lop";
        $result = $mysqli->query($sql);


        while ($row = $result->fetch_assoc()) {
            $maLop = $row['MaLop'];
            $sqlInsertDanhSachLop = "INSERT INTO danhsachlop (MaNamHoc, MaLop, SiSo) VALUES ('$maNamHoc', '$maLop', 0)";
            $mysqli->query($sqlInsertDanhSachLop);
        }

        $mysqli->commit();

        header("Location: http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=CaiDat");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if something went wrong
        $mysqli->rollback();
        echo "Error: " . $e->getMessage();
    }
}
