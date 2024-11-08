<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học sinh</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <!-- AJAX  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
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
</head>
<!-- Lấy mã lớp -->

<body>
    <section>
        <!-- Chọn niên khóa -->
        <div class="row">
            <div class="col-3">
                <select class="form-select" id="NamHoc">
                    <option selected disabled>Năm học</option>
                    <?php
                    $sqlNamHoc = "SELECT DISTINCT nh.MaNamHoc, nh.Nam1, nh.Nam2 FROM NAMHOC NH";
                    $resultNamHoc = $mysqli->query($sqlNamHoc);
                    while ($rowNamHoc = $resultNamHoc->fetch_assoc()) {
                        echo '<option value="' . $rowNamHoc["MaNamHoc"] . '">' . $rowNamHoc["Nam1"] . ' - ' . $rowNamHoc["Nam2"] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <!--End Chọn niên khóa-->
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <br>
                            <div class="text-uppercase" style="text-align: center; font-weight: bolder; font-size: large;">Danh sách học sinh</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center">Họ và tên</th>
                                                <th class="text-center">Lớp</th>
                                                <th class="text-center">Điểm TB học kì I</th>
                                                <th class="text-center">Điểm TB học kì II</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbDs">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center">Họ và tên</th>
                                                <th class="text-center">Lớp</th>
                                                <th class="text-center">Điểm TB học kì I</th>
                                                <th class="text-center">Điểm TB học kì II</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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

<script>
    var listSelectHS = [];

    $(document).ready(function() {
        $.noConflict(true);
        var table = $('#example').DataTable({
            "Processing": true,
            "ajax": {
                "type": "POST",
                "url": "pages/DanhSachHocSinh/AjaxDatatable.php",
                "dataSrc": "",
                "data": function(d) {
                    d.namHoc = $('#NamHoc').val();
                }
            },
            "columns": [
                {
                    "data": "STT",
                    "className": "text-center"
                },
                {
                    "data": "TenHocSinh"
                },
                {
                    "data": "TenLop",
                    "className": "text-center"
                },
                {
                    "data": "DTBHK1"
                },
                {
                    "data": "DTBHK2"
                }
            ],
            // dom: 'Bfrtip',

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

        $('#NamHoc').on("change", function() {
            table.ajax.reload();
        });
    });
</script>