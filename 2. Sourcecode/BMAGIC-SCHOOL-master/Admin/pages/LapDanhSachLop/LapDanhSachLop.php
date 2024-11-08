<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học sinh</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <!-- AJAX  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <!-- Chart -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script> -->
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
    <link rel="stylesheet" href="../../../../BMAGIC-SCHOOL/Admin/Css/LapDanhSachLop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Datatable Dependency start -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

</head>

<!-- Kết nối cơ sở dữ liệu -->
<?php
$mysqli = new mysqli("localhost", "root", "", "qlhs");
?>

<body>
    <section>
        <!-- Chọn khối lớp liên khóa học kỳ -->
        <div class="row" style="width: 700px;">
            <div class="col">
                <select class="form-select" id="NamHoc">
                    <option selected disabled value="-1">Năm học</option>
                    <?php
                    $sqlNamHoc = "SELECT * FROM NAMHOC";
                    $resultNamHoc = $mysqli->query($sqlNamHoc);
                    while ($rowNamHoc = $resultNamHoc->fetch_assoc()) {
                        echo '<option value="' . $rowNamHoc["MaNamHoc"] . '">' . $rowNamHoc["Nam1"] . ' - ' . ($rowNamHoc["Nam1"] + 1) .  '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col">
                <select class="form-select" id="Lop">
                    <option selected value="-1" disabled>Lớp</option>
                    <?php
                    $sqlLop = "SELECT * FROM LOP";
                    $resultLop = $mysqli->query($sqlLop);
                    while ($rowLop = $resultLop->fetch_assoc()) {
                        echo '<option value="' . $rowLop["MaLop"] . '">' . $rowLop["TenLop"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col">
                <input type="text" class="form-control" id="SiSo" style="height: 80%;">
            </div>
        </div>
        <br>
        <!-- End Chọn khối lớp liên khóa học kỳ -->

        <!-- MAIN -->
        <div class="col-sm-12">
            <div class="home-tab">
                <!-- Nội dung chọn tab -->
                <div class="tab-content tab-content-basic">
                    <!-- Danh sách học sinh -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-lg-12 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <br>
                                            <div class="text-uppercase" style="text-align:center; font-weight: bolder; font-size: large;">
                                                Danh sách lớp
                                                <!-- <span id="them" class="btn btn-primary text-white me-0" style="float:right; font-size:medium; padding:15px; width:100px"><i class="fa fa-download"></i> Thêm</span> -->
                                                <!-- Button trigger modal -->
                                                <br><br>
                                                <button style="float: left; margin-left: 25px;" id="btn_them" class="btn btn-primary btn-lg text-white mb-0 me-0 btn-Them" type="button"><i class='bx bx-plus btn-Them'></i>Thêm học sinh vào danh sách</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Danh sách học sinh</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body" style="height: 500px !important; overflow-y: scroll">
                                                                <div class="topnav">
                                                                    <div class="search-container">
                                                                        <input type="text" id="search" placeholder="Search.." name="search" style="background-color: #e9e9e9;">
                                                                        <button type="submit"><i class="fa fa-search"></i></button>
                                                                    </div>

                                                                    <div id="table-wrapper">
                                                                        <div id="table-scroll">
                                                                            <table id="table_HS">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="width: 2%;"></th>
                                                                                        <th style="text-align: center;">STT</th>
                                                                                        <th style="text-align: center;">Họ và tên</th>
                                                                                        <th style="text-align: center;">Giới tính</th>
                                                                                        <th style="text-align: center;">Năm sinh</th>
                                                                                        <th style="text-align: center;">Địa chỉ</th>
                                                                                        <th style="text-align: center;">Email</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="table_HS_body">

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:medium; padding:15px; width:100px">Close</button>
                                                                <button type="button" id="save" class="btn btn-primary" style="font-size:medium; padding:15px; width:200px">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="display corder-column" id="DanhSachLop" width=100%>
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">STT</th>
                                                                <th style="text-align: center;">Họ và tên</th>
                                                                <th style="text-align: center;">Giới tính</th>
                                                                <th style="text-align: center;">Năm sinh</th>
                                                                <th style="text-align: center;">Địa chỉ</th>
                                                                <th style="text-align: center;">Email</th>
                                                                <th style="text-align: center; display:none;">MaHS</th>
                                                                <th style="text-align: center;">Tình trạng</th>
                                                                <th style="text-align: center;"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_body">
                                                        </tbody>
                                                        <!-- <tfoot>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Họ và tên</th>
                                                                <th>Điểm 15 phút</th>
                                                                <th>Điểm 1 tiết</th>
                                                                <th>Điểm học kỳ</th>
                                                                <th>Điểm trung bình</th>
                                                                <th>Chỉnh sửa</th>
                                                            </tr>
                                                        </tfoot> -->
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Kết thúc Danh sách học sinh -->
                </div>
                <!--Kết thúc Nội dung chọn tab -->
            </div>

        </div>

        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> -->
        </script>


        <!-- <script src="../../../../BMAGIC-SCHOOL/Admin/Js/jquery.simple-checkbox-table.min.js"></script> -->


        <style>
            td.highlight {
                background-color: rgba(var(--dt-row-hover), 0.052) !important;
            }
        </style>
        <!-- AJAX -->

    </section>
</body>

<script>
    // var table = new DataTable('#DanhSachLop', {
    //     language: {
    //         url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/vi.json',
    //     },

    //     layout: {
    //         topStart: {
    //             buttons: [
    //                 'pdf',
    //                 'csv',
    //                 'excel',
    //                 'copy',
    //                 'colvis'
    //             ]
    //         },
    //         topEnd: 'search',
    //         bottomStart: 'pageLength',
    //         bottomEnd: 'info',
    //         bottom2center: 'paging'
    //     }

    // });

    // $('#submit').on('click', function(e) {
    //     e.preventDefault();

    //     var data = table.$('input, select').serialize();
    // });

    // table.on('mouseenter', 'td', function() {
    //     let colIdx = table.cell(this).index().column;

    //     table
    //         .cells()
    //         .nodes()
    //         .each((el) => el.classList.remove('highlight'));

    //     table
    //         .column(colIdx)
    //         .nodes()
    //         .each((el) => el.classList.add('highlight'));
    // });
</script>

<script>
    var listSelectHS = [];


    $(document).ready(function() {
        $.noConflict(true);
        var table = $('#DanhSachLop').DataTable({
            "Processing": true,
            "ajax": {
                "type": "POST",
                "url": "pages/LapDanhSachLop/LoadTableAjax.php",
                "dataSrc": "",
                data: function(d) {
                    d.namhoc = document.getElementById("NamHoc").value;
                    d.lop = document.getElementById("Lop").value;
                }
            },
            "columns": [{
                    "data": "MaCTDSL"
                },
                {
                    "data": "TenHocSinh"
                },
                {
                    "data": "GioiTinh"
                },
                {
                    "data": "NgaySinh"
                },
                {
                    "data": "DiaChi"
                },
                {
                    "data": "Email"
                },
                {
                    "data": "MaHocSinh",
                    visible: false,
                },
                {
                    "data": "Status",
                    visible: false,
                }, {
                    defaultContent: '<input type="button" class="delete" value="Xóa"/>'
                },
            ],
            dom: 'Bfrtip',
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

        });;

        $("#NamHoc").on("change", function() {
            $('#Lop').val(-1)
        });

        $("#Lop").change(function(e) {
            var namhoc = document.getElementById("NamHoc").value;
            var lop = document.getElementById("Lop").value;

            if (namhoc == "-1") {
                alert("Vui lòng chọn năm học!!!");
            } else {
                $("#table_body").empty();
                $.post("pages/LapDanhSachLop/GetSiSoAjax.php", {
                        namhoc: namhoc,
                        lop: lop,
                    },
                    function(data, status) {
                        if (status == "success") {
                            document.getElementById("SiSo").value = data;
                            table.ajax.reload();
                        }
                    }
                );
            }

        });

        $('#DanhSachLop tbody').on('click', '.delete', function() {
            var row = $(this).closest('tr');

            var MaCTDSL = table.row(row).data().MaCTDSL;
            var MaHocSinh = table.row(row).data().MaHocSinh;

            var namhoc = document.getElementById("NamHoc").value;
            var lop = document.getElementById("Lop").value;

            let text = "Bạn có muốn xóa không?";
            if (confirm(text) == true) {
                $.post("pages/LapDanhSachLop/XoaHocSinh.php", {
                        MaCTDSL: MaCTDSL,
                        MaHocSinh: MaHocSinh,
                        namhoc: namhoc,
                    },
                    function(data, status) {
                        if (status == "success") {
                            alert(data);
                            table.ajax.reload();

                            $.post("pages/LapDanhSachLop/GetSiSoAjax.php", {
                                    namhoc: namhoc,
                                    lop: lop,
                                },
                                function(data, status) {
                                    if (status == "success") {
                                        document.getElementById("SiSo").value = data;
                                        table.ajax.reload();
                                    }
                                }
                            );
                        }
                    }
                );
                // $(this).parents("tr").remove();
            }
        });



        // Xu ly su kien nhan row thi check checkbox
        $(document).on('click', '.row_hs', function(event) {
            mahs = $(this).closest('tr').attr("val");
            var checkBoxes = $(this).closest('tr').find('input:checkbox')

            checkBoxes.prop("checked", !checkBoxes.prop("checked"));

            listSelectHS.push(mahs);
        })

        // Xu ly su kien luu hs
        $('#save').click(function(e) {
            // $("[name=checkbox_val]:checked").each(function() {
            //     listSelectHS.push($(this).closest('tr').attr("val")) //push value in array
            // });

            var namhoc = document.getElementById("NamHoc").value;
            var lop = document.getElementById("Lop").value;

            if (listSelectHS.length == 0) {} else {
                $.post("pages/LapDanhSachLop/ThemHSVaoLopAjax.php", {
                        listSelectHS: listSelectHS,
                        namhoc: namhoc,
                        lop: lop
                    },
                    function(data, status) {
                        if (status == "success") {
                            alert(data);
                            table.ajax.reload();
                            $.post("pages/LapDanhSachLop/GetSiSoAjax.php", {
                                    namhoc: namhoc,
                                    lop: lop,
                                },
                                function(data, status) {
                                    if (status == "success") {
                                        document.getElementById("SiSo").value = data;
                                        table.ajax.reload();
                                    }
                                }
                            );
                        }
                    }
                );
            }

            $("#exampleModalLong").modal('hide');
        });

        // Khi an modal thi reset table
        $("#exampleModalLong").on("hidden.bs.modal", function() {
            $("#table_HS_body").empty();
            listSelectHS = [];
        });

        // Hien thi table HS khi nhan them
        $('#btn_them').click(function(e) {
            e.preventDefault();
            document.getElementById("search").value = "";

            var namhoc = document.getElementById("NamHoc").value;
            var lop = document.getElementById("Lop").value;

            if (namhoc == "-1" || lop == "-1") {
                alert("Chưa chọn năm học hoặc lớp!!!");
            } else {
                $("#exampleModalLong").modal('show');
                // Load table them hs
                $.post("pages/LapDanhSachLop/LoadTableHS.php", {
                        namhoc: namhoc
                    },
                    function(data, status) {
                        if (status == "success") {
                            if (data != -1) {
                                $('#table_HS').find('tbody').append(data);
                            }
                        }
                    }

                );
            }



        });

        $("#search").keyup(function() {
            listSelectHS = [];
            var Search = $("#search").val();
            var namhoc = document.getElementById("NamHoc").value;
            if ($(this).val().length >= 0) {
                $.post("pages/LapDanhSachLop/SearchHSAjax.php", {
                        Search: Search,
                        namhoc: namhoc
                    },
                    function(data, status) {
                        if (status == "success") {
                            if (data != -1) {
                                $("#table_HS_body").empty();
                                $('#table_HS').find('tbody').append(data);
                            }
                        }
                    }
                );
            }
        });

    });
</script>