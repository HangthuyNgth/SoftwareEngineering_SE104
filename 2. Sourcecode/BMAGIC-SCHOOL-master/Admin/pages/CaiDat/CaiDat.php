<?php
$sql = "SELECT * FROM THAMSO";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$MinAge = $row["MinAge"];
$MaxAge = $row["MaxAge"];
$DiemToiDa = $row["DiemToiDa"];
$DiemToiThieu = $row["DiemToiThieu"];
$DiemDat = $row["DiemDat"];
$SiSo = $row["SiSo"];

$existingYears = [];
$minYear = PHP_INT_MAX;

$sqlNamHoc = "SELECT * FROM NAMHOC ORDER BY Nam1 DESC";
$resultNamHoc = $mysqli->query($sqlNamHoc);
while ($rowNamHoc = $resultNamHoc->fetch_assoc()) {
    $year = $rowNamHoc["Nam1"];
    $existingYears[] = $year;
    if ($year < $minYear) {
        $minYear = $year;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Settings</title>
    <style>
        .btnMinAge,
        .btnMaxAge {
            background-color: transparent;
            width: 20%;
            height: 30px;
            float: left;
            border-left: none;
            border: solid 1px black;
            border-radius: 0px 10px 10px 0px;
            color: #1F3BB3;
            font-weight: bold;
        }

        .btnMinAge:hover,
        .btnMaxAge:hover {
            background-color: #1F3BB3;
            color: aliceblue;
        }

        .MinAge,
        .MaxAge {
            background-color: transparent;
            width: 70%;
            height: 30px;
            float: left;
            padding-left: 20px;
            border: solid 1px black;
            border-right: none;
            border-radius: 10px 0px 0px 10px;
        }

        .list {
            width: 200px;
            height: 40px;
            overflow-x: hidden;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <section>
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic">
                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash text-primary">THÊM NĂM HỌC</h4>
                                            <p class="card-subtitle card-subtitle-dash">Thêm niên khóa mới chỉ cần nhập năm hiện tại ứng dụng sẽ tự động lưu.<br>Ví dụ: Nhập 2023. Cơ sở dữ liệu sẽ lưu dưới dạng (2023-2024)</p>
                                        </div>
                                        <div>
                                            <h4 class="card-title card-title-dash text-primary">Danh sách năm học đã học</h4>
                                            <div class="list">
                                                <?php
                                                foreach ($existingYears as $year) {
                                                    echo '<option value="' . $year . '">' . $year . ' - ' . ($year + 1) . '</option>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="fw-bold pb-2 mt-3">Năm học</label>
                                        <div class="col">
                                            <form action="pages/CaiDat/ThemNamHoc.php" method="post" onsubmit="return validateYear()">
                                                <input style="width: 75.2%;" type="number" class="form-control MaxAge" id="nienkhoa" name="nam1" required>
                                                <input name="submit" value="Thêm" class="btnMinAge" type="submit" id="ThemNamHoc">
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash text-primary">CÀI ĐẶT SỐ TUỔI</h4>
                                            <p class="card-subtitle card-subtitle-dash">Cài đặt số tuổi tối thiểu và tối đa để có thể nhập học</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="fw-bold pb-2 mt-3">Số tuổi tối thiểu</label>
                                            <div class="col">
                                                <form action="pages/CaiDat/UpdateCD.php" method="post" onsubmit="return validateAge()">
                                                    <input type="number" class="form-control MinAge" id="MinAge" name="MinAge" value="<?php echo $MinAge; ?>">
                                                    <input name="submit" value="Lưu" class="btnMinAge" type="submit">
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="fw-bold pb-2 mt-3">Số tuổi tối đa</label>
                                            <div class="col">
                                                <form action="pages/CaiDat/UpdateCD.php" method="post" onsubmit="return validateAge()">
                                                    <input type="number" class="form-control MaxAge" id="MaxAge" name="MaxAge" value="<?php echo $MaxAge; ?>">
                                                    <input name="submit" value="Lưu" class="btnMinAge" type="submit">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash text-primary">CÀI ĐẶT ĐIỂM SỐ</h4>
                                            <p class="card-subtitle card-subtitle-dash">Cài đặt số điểm có thể để lên lớp hoặc ở lại lớp & thang điểm</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label class="fw-bold pb-2 mt-3">Số điểm tối thiểu</label>
                                            <div class="col">
                                                <form action="pages/CaiDat/UpdateCD.php" method="post" onsubmit="return validateScore()">
                                                    <input type="number" class="form-control MinAge" id="DiemToiThieu" name="DiemToiThieu" value="<?php echo $DiemToiThieu; ?>" step="0.1">
                                                    <input name="submit" value="Lưu" class="btnMinAge" type="submit">
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label class="fw-bold pb-2 mt-3">Số điểm tối đa</label>
                                            <div class="col">
                                                <form action="pages/CaiDat/UpdateCD.php" method="post" onsubmit="return validateScore()">
                                                    <input type="number" class="form-control MaxAge" id="DiemToiDa" name="DiemToiDa" value="<?php echo $DiemToiDa; ?>" step="0.1">
                                                    <input name="submit" value="Lưu" class="btnMinAge" type="submit">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="fw-bold pb-2 mt-3">Điểm đạt</label>
                                        <div class="col">
                                            <form action="pages/CaiDat/UpdateCD.php" method="post" onsubmit="return validateScore()">
                                                <input style="width: 75.2%;" type="number" class="form-control MaxAge" id="DiemDat" name="DiemDat" value="<?php echo $DiemDat; ?>" step="0.1">
                                                <input name="submit" value="Lưu" class="btnMinAge" type="submit">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash text-primary">CÀI ĐẶT SĨ SỐ</h4>
                                            <p class="card-subtitle card-subtitle-dash">Cài đặt sĩ số học sinh tối đa</p>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="fw-bold pb-2 mt-3">Sĩ số</label>
                                        <div class="col">
                                            <form action="pages/CaiDat/UpdateCD.php" method="post" onsubmit="return validateClassSize()">
                                                <input style="width: 75.2%;" type="number" class="form-control MaxAge" id="SiSo" name="SiSo" value="<?php echo $SiSo; ?>">
                                                <input name="submit" value="Lưu" class="btnMinAge" type="submit">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        const existingYears = <?php echo json_encode($existingYears); ?>;
        const currentYear = new Date().getFullYear();
        const minYear = <?php echo $minYear; ?>;


        function validateYear() {
            const inputYear = parseInt(document.getElementById('nienkhoa').value);
            const maxAllowedYear = currentYear + 3;


            if (isNaN(inputYear)) {
                alert("Vui lòng nhập năm hợp lệ.");
                return false;
            }

            if (inputYear > maxAllowedYear) {
                alert("Năm phải nhỏ hơn hoặc bằng " + maxAllowedYear);
                return false;
            }


            for (let i = 0; i < existingYears.length; i++) {
                if (existingYears[i] == inputYear) {
                    alert("Năm này đã tồn tại.");
                    return false;
                }
            }


            if (inputYear <= minYear) {
                alert("Năm phải lớn hơn " + minYear);
                return false;
            }

            return true;
        }

        function validateAge() {
            const minAge = parseInt(document.getElementById('MinAge').value);
            const maxAge = parseInt(document.getElementById('MaxAge').value);

            if (isNaN(minAge) || isNaN(maxAge)) {
                alert("Vui lòng nhập tuổi hợp lệ.");
                return false;
            }

            if (minAge < 0 || maxAge < 0) {
                alert("Tuổi không được âm.");
                return false;
            }

            if (minAge >= maxAge) {
                alert("Tuổi tối thiểu phải nhỏ hơn tuổi tối đa.");
                return false;
            }

            return true;
        }

        function validateScore() {
            const minScore = parseFloat(document.getElementById('DiemToiThieu').value);
            const maxScore = parseFloat(document.getElementById('DiemToiDa').value);
            const passScore = parseFloat(document.getElementById('DiemDat').value);

            if (isNaN(minScore) || isNaN(maxScore) || isNaN(passScore)) {
                alert("Vui lòng nhập điểm hợp lệ.");
                return false;
            }

            if (minScore < 0 || maxScore < 0 || passScore < 0) {
                alert("Điểm không được âm.");
                return false;
            }

            if (minScore >= maxScore) {
                alert("Điểm tối thiểu phải nhỏ hơn điểm tối đa.");
                return false;
            }

            if (passScore < minScore || passScore > maxScore) {
                alert("Điểm đạt phải nằm giữa điểm tối thiểu và tối đa.");
                return false;
            }

            return true;
        }

        function validateClassSize() {
            const classSize = parseInt(document.getElementById('SiSo').value);

            if (isNaN(classSize) || classSize <= 0) {
                alert("Sĩ số phải là số dương.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>