<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="../../../../BMAGIC-SCHOOL/Admin/Css/Giao_vien_bo_mon.css">
    <script src="../../../Teacher/js/Giao_vien_bo_mon.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <!-- jQuery -->
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <!-- Additional DataTables Buttons Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.min.js"></script>
    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <section>
        <!-- CHỌN COMBOBOX MÔN, HỌC KỲ -->
        <div class="row">
            <div class="col">
                <select class="form-select" id="NamHoc">
                    <option selected disabled>Năm học</option>
                    <?php
                    $sqlNamHoc = "SELECT * FROM NAMHOC ORDER BY Nam1 DESC";
                    $resultNamHoc = $mysqli->query($sqlNamHoc);
                    while ($rowNamHoc = $resultNamHoc->fetch_assoc()) {
                        echo '<option value="' . $rowNamHoc["MaNamHoc"] . '">' . $rowNamHoc["Nam1"] . ' - ' . $rowNamHoc["Nam2"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-select" id="MonHoc" disabled>
                    <option selected disabled>Môn học</option>
                    <?php
                    $sql = "SELECT *
                                FROM MONHOC MH";
                    $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["MaMonHoc"] . '">' . $row["TenMonHoc"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-select" id="HocKy" disabled>
                    <option selected disabled>Học kỳ</option>
                    <?php
                    $sql1 = "SELECT *
                                FROM HOCKY";
                    $result1 = $mysqli->query($sql1);
                    while ($row1 = $result1->fetch_assoc()) {
                        echo '<option value="' . $row1["MaHocKy"] . '">' . $row1["TenHocKy"] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>

        <!-- MAIN -->
        <div class=" col-sm-12">
            <div class="home-tab">
                <!-- Lựa chọn tab -->
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Danh sách</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">Biểu đồ</a>
                        </li>
                    </ul>
                </div>

                <!-- Nội dung chọn tab -->
                <div class="tab-content tab-content-basic">
                    <!-- table -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <br>
                                <div class="text-uppercase" style="text-align: center; font-weight: bolder; font-size: large;">BÁO CÁO TỔNG KẾT MÔN</div>
                                <p class="card-description"></p>
                                <div class="table-responsive">
                                    <table class="display corder-column" id="BaoCaoBoMon" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center">Lớp</th>
                                                <th class="text-center">Sĩ số</th>
                                                <th class="text-center">Số lượng đạt</th>
                                                <th class="text-center">Tỉ lệ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tb">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center">Lớp</th>
                                                <th class="text-center">Sĩ số</th>
                                                <th class="text-center">Số lượng đạt</th>
                                                <th class="text-center">Tỉ lệ</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- chart-->
                    <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="d-sm-flex justify-content-between align-items-start">
                                            <div>
                                                <h4 class="card-title card-title-dash">Bảng điểm môn học</h4>
                                                <div class="row chart-container">
                                                    <div id="chartSiSo" style="width:100%;max-width:700px"></div>
                                                </div>
                                                <div class="row chart-container">
                                                    <div id="chartTiLe" style="width:100%;max-width:700px"></div>
                                                </div>
                                            </div>
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
</body>

</html>

<!-- CHART -->
<script>
    $(document).ready(function() {
        $.noConflict(true);
        var table = $('#BaoCaoBoMon').DataTable({
            "Processing": true,
            "ajax": {
                "type": "POST",
                "url": "pages/BaoCao/ChartBCM.php",
                "dataSrc": "",
                "data": function(d) {
                    d.NamHoc = $('#NamHoc').val();
                    d.MonHoc = $('#MonHoc').val();
                    d.HocKy = $('#HocKy').val();
                }
            },
            "columns": [{
                    "data": "STT",
                    "className": "text-center"
                },
                {
                    "data": "TenLop",
                    "className": "text-center"
                },
                {
                    "data": "SiSo",
                    "className": "text-center"
                },
                {
                    "data": "SoLuongDat",
                    "className": "text-center"
                },
                {
                    "data": "TiLe",
                    "className": "text-center"
                },
            ],


            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json',
            },
            layout: {
                topStart: {
                    buttons: [
                        'pdf',
                        'csv',
                        'excel',
                        'copy',
                        'colvis'
                    ]
                },
                topEnd: 'search',
                bottomStart: 'pageLength',
                bottomEnd: 'info',
                bottom2center: 'paging'
            }
        });

        $("#HocKy").change(function(e) {
            var NamHoc = document.getElementById("NamHoc").value;
            var MonHoc = document.getElementById("HocKy").value;
            var HocKy = document.getElementById("HocKy").value;

            $("#tb").empty();
            table.ajax.reload();
        });

        $('#NamHoc').change(function() {
            var NamHoc = $(this).val();
            $('#MonHoc').prop('disabled', false).val("Môn học");
            $('#HocKy').prop('disabled', false).val("Học kỳ");
            $('#MonHoc').change(function() {
                var MonHoc = $(this).val();
                $('#HocKy').prop('disabled', false).val("Học kỳ"); // Reset dropdown when subject changes
                $('#tb').empty(); // Clear table content when subject changes

                $('#HocKy').change(function() {
                    var HocKy = $(this).val();

                    $.post("pages/BaoCao/ChartBCM.php", {
                        MonHoc: MonHoc,
                        HocKy: HocKy,
                        NamHoc: NamHoc
                    }, function(data, status) {
                        if (status == "success") {
                            var chartData = JSON.parse(data);

                            var labels = chartData.map(item => item.TenLop);
                            var siSoData = chartData.map(item => item.SiSo);
                            var tiLeData = chartData.map(item => item.TiLe);

                            var layoutSiSo = {
                                title: 'Sĩ số theo lớp'
                            };
                            var layoutTiLe = {
                                title: 'Tỉ lệ theo lớp'
                            };

                            var dataSiSo = [{
                                x: labels,
                                y: siSoData,
                                type: 'bar'
                            }];

                            var dataTiLe = [{
                                x: labels,
                                y: tiLeData,
                                type: 'bar'
                            }];

                            Plotly.newPlot('chartSiSo', dataSiSo, layoutSiSo);
                            Plotly.newPlot('chartTiLe', dataTiLe, layoutTiLe);
                        }
                    });


                });
            });

        });
    });
</script>

<style>
    td.highlight {
        background-color: rgba(var(--dt-row-hover), 0.052) !important;

    }
</style>

