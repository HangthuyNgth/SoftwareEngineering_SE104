<!DOCTYPE html>
<html lang="en">
<?php
                    $sql = "SELECT * FROM THAMSO";
                    $result = $mysqli->query($sql);
                    $row = $result->fetch_assoc();
                    $DiemToiDa = $row["DiemToiDa"];
                    $DiemToiThieu = $row["DiemToiThieu"];
                    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điểm môn học</title>
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
<style>
    .btnThem {
        border-radius: 25px;
        width: 90px;
        height: 40px;
        background-color: transparent;
        margin-left: 80%;
    }

    .btnThem:hover {
        background-color: #1F3BB3;
        color: white;
        border: 2px white;
    }

    /* Định dạng cho biểu hiện viền đỏ và icon tick */
    .error-message {
        color: red;
        font-size: 0.8em;
    }

    .validation-icon {
        margin-left: 5px;
        vertical-align: middle;
        /* Đặt icon ở giữa */
    }

    /* Định dạng màu của nút submit khi không được kích hoạt */
    .btn-Them:disabled {
        background-color: gray;
        cursor: not-allowed;
    }
</style>
<?php
$sqlNienKhoa = "select * from namhoc";
$resultNienKhoa = mysqli_query($mysqli, $sqlNienKhoa);
?>

<body>
    <section>
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <br>
                            <div class="text-uppercase" style="text-align: center; font-weight: bolder; font-size: large;">Danh sách Bảng điểm môn học</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nienkhoa">Niên khóa:</label>
                                            <select id="nienkhoa" name="nienkhoa" class="form-control">
                                                <option value="">Chọn niên khóa</option>
                                                <?php while ($row = mysqli_fetch_array($resultNienKhoa)) { ?>
                                                    <option value="<?php echo $row['MaNamHoc'] ?>"><?php echo $row['Nam1'] ?>-<?php echo $row['Nam2'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="lop">Lớp:</label>
                                            <select id="lop" class="form-control">
                                                <!-- Các lớp sẽ được cập nhật sau khi chọn niên khóa -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mon">Môn:</label>
                                            <select id="mon" class="form-control">
                                                <!-- Các môn sẽ được cập nhật sau khi chọn lớp -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="hocKy">Học kỳ:</label>
                                            <select id="hocKy" class="form-control">
                                                <!-- Thêm các học kỳ khác nếu cần -->
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Họ tên</th>
                                                <th class="text-center">Kiểm tra 15 phút</th>
                                                <th class="text-center">Kiểm tra 1 tiết</th>
                                                <th class="text-center">Kiểm tra học kỳ</th>
                                                <th class="text-center">Chỉnh sửa</th>
                                                <th class="text-center">Thêm điểm</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tbody">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Họ tên</th>
                                                <th class="text-center">Kiểm tra 15 phút</th>
                                                <th class="text-center">Kiểm tra 1 tiết</th>
                                                <th class="text-center">Kiểm tra học kỳ</th>
                                                <th class="text-center">Chỉnh sửa</th>
                                                <th class="text-center">Thêm điểm</th>

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




        <!-- Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTitle" style="text-align: center;">Chi tiết bảng điểm môn học </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <label for="HoTen" class="col-sm-3 col-form-label fw-bold pb-2 ">Họ tên</label>
                        <input type="text" class="form-control mb-2" id="HoTen" name="HoTen" disabled>

                        <label for="modalKiemtra15p" class="col-sm-3 col-form-label fw-bold pb-2">điểm kiểm tra 15 phút </label>
                        <input type="text" class="form-control mb-2" id="15p" name="15p" placeholder="điểm 15 phút">

                        <input type="text" id="MaBDTP15p" name="MaBDTP15p" hidden>

                        <label for="modalKiemtra1tiet" class="col-sm-3 col-form-label fw-bold pb-2">điểm kiểm tra 1 tiết </label>
                        <input type="text" class="form-control mb-2" id="1tiet" name="1tiet" placeholder="điểm 1 tiết ">

                        <input type="text" id="MaBDTP1tiet" name="MaBDTP1tiet" hidden>

                        <label for="modalKiemtrahocky" class="col-sm-3 col-form-label fw-bold pb-2">điểm kiểm tra học kỳ </label>
                        <input type="text" class="form-control mb-2" id="hocky" name="hocky" placeholder="điểm kiểm tra học ky">

                        <input type="text" id="MaBDTPhocky" name="MaBDTPhocky" hidden>

                        <input type="submit" class="mt-4 fw-bold btnThem" name="submit" id="SuaDiem" value="Cập nhật" size="50">

                    </div>
                </div>
            </div>
        </div>


        <div class="modal" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addModalTitle" style="text-align: center;">Thêm bảng điểm môn học</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="scoreForm">
                            <input type="text" class="form-control mb-2" id="BDMH" name="MaBDMH" hidden>
                            <label for="Diem15p" class="col-sm-3 col-form-label fw-bold pb-2">Thêm điểm 15 phút</label>
                            <input type="text" class="form-control mb-2" id="Diem15p" name="Diem15p" placeholder="Thêm điểm" value=''>
                            <label for="Diem1tiet" class="col-sm-3 col-form-label fw-bold pb-2">Thêm điểm 1 tiết</label>
                            <input type="text" class="form-control mb-2" id="Diem1tiet" name="Diem1tiet" placeholder="Thêm điểm" value=''>
                            <label for="Diemhocky" class="col-sm-3 col-form-label fw-bold pb-2">Thêm điểm học kỳ</label>
                            <input type="text" class="form-control mb-2" id="Diemhocky" name="Diemhocky" placeholder="Thêm điểm" value=''>
                            <input type="submit" class="mt-4 fw-bold btnThem btn " id="ThemDiem" value="Thêm" size="50">
                        </form>
                    </div>
                </div>
            </div>
        </div>






        <script>
            $(document).ready(function() {
                $.noConflict(true);

                var table = $('#example').DataTable({
                    "Processing": true,
                    "ajax": {
                        "type": "GET",
                        "url": "pages/BangDiemMonHoc/ajax_get_Table.php",
                        "dataSrc": "",
                        data: function(d) {
                            d.NienKhoa = $('#nienkhoa').val();
                            d.MaLopHoc = $('#lop').val();
                            d.MaMonHoc = $('#mon').val();
                            d.MaHocKy = $('#hocKy').val();
                        }
                    },
                    "columns": [{
                            "data": "TenHocSinh",
                            "className": "text-center"
                        },
                        {
                            "data": "KiemTra15p",
                            "className": "text-center"
                        },
                        {
                            "data": "KiemTra1tiet",
                            "className": "text-center"
                        },
                        {
                            "data": "KiemTraHocKy",
                            "className": "text-center"
                        },

                        {
                            defaultContent: '<button style="background-color:transparent; border-width: 0; " type="button" class="btn btn-primary btn-Sua"><i class="bx bxs-edit"></i></button> ',
                            "className": "text-center"
                        },
                        {
                            defaultContent: '<button style="background-color:transparent; border-width: 0;" type="button" class="btn btn-primary btn-Them">Thêm</button>',
                            "className": "text-center"
                        },
                        {
                            "data": "MaBDMH",
                            visible: false,
                        },
                        {
                            "data": "MaBDTP15p",
                            visible: false,
                        },
                        {
                            "data": "MaBDTP1tiet",
                            visible: false,
                        },
                        {
                            "data": "MaBDTPhocky",
                            visible: false,
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]

                })

                $(document).on('click', '.btn-Sua', function(event) {
                    $('#myModal').modal('show');

                    var row = $(this).closest('tr');
                    var HoTen = table.row(row).data().TenHocSinh;
                    var Kiemtra15p = table.row(row).data().KiemTra15p;
                    var Kiemtra1tiet = table.row(row).data().KiemTra1tiet;
                    var Kiemtrahocky = table.row(row).data().KiemTraHocKy;
                    var MaBDTP15p = table.row(row).data().MaBDTP15p;
                    var MaBDTP1tiet = table.row(row).data().MaBDTP1tiet;
                    var MaBDTPhocky = table.row(row).data().MaBDTPhocky;

                    $('#BDMH').val(BDMH);
                    // Điền dữ liệu vào modal
                    $('#HoTen').val(HoTen);
                    $('#15p').val(Kiemtra15p);
                    $('#MaBDTP15p').val(MaBDTP15p);
                    $('#1tiet').val(Kiemtra1tiet);
                    $('#MaBDTP1tiet').val(MaBDTP1tiet);
                    $('#hocky').val(Kiemtrahocky);
                    $('#MaBDTPhocky').val(MaBDTPhocky);

                });

                $('#nienkhoa').on('change', function() {
                    var MaNamHoc = $(this).val();
                    if (MaNamHoc) {
                        $.ajax({
                            url: 'pages/BangDiemMonHoc/ajax_get_Lop.php',
                            method: 'GET',
                            dataType: "json",
                            data: {
                                MaNamHoc: MaNamHoc
                            },
                            success: function(data) {
                                //làm sạch dropbox lớp
                                $('#lop').empty();

                                // thêm data vào dropbox lớp
                                for (var key in data) {
                                    if (data.hasOwnProperty(key)) {
                                        // Thêm mỗi mục vào dropdown "lop"
                                        $('#lop').append($('<option>', {
                                            value: data[key].MaLop,
                                            text: data[key].TenLop
                                        }));
                                    }
                                }

                                $('#mon').empty();
                                $('#hocKy').empty();
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log('Error: ' + errorThrown);
                            }
                        });
                        $('#hocKy').empty();
                    } else {

                        $('#lop').empty();
                        $('#mon').empty();
                        $('#hocKy').empty();
                    }


                });

                $('#lop').on('change', function() {

                    $.ajax({
                        url: 'pages/BangDiemMonHoc/ajax_get_MonHoc.php',
                        method: 'GET',
                        dataType: "json",
                        data: "",
                        success: function(data) {
                            $('#mon').empty();
                            $('#hocKy').empty();

                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {
                                    $('#mon').append($('<option>', {
                                        value: data[key].MaMonHoc,
                                        text: data[key].TenMonHoc
                                    }));
                                }
                            }

                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log('Error: ' + errorThrown);
                        }
                    });


                });

                $('#mon').on('change', function() {
                    $.ajax({
                        url: 'pages/BangDiemMonHoc/ajax_get_HocKy.php',
                        method: 'GET',
                        dataType: "json",
                        data: "",
                        success: function(data) {
                            $('#hocKy').empty();
                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {

                                    $('#hocKy').append($('<option>', {
                                        value: data[key].MaHocKy,
                                        text: data[key].TenHocKy
                                    }));
                                }
                            }

                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log('Error: ' + errorThrown);
                        }
                    });

                });
                /* $('#hocKy').on('change', function() {
                    var NienKhoa = $('#nienkhoa').val();
                    var MaLop = $('#lop').val();
                    var MaMonHoc = $('#mon').val();
                    var MaHocKy = $('#hocKy').val();
                    $.ajax({
                        url: 'pages/BangDiemMonHoc/ajax_get_Table.php', // Đường dẫn tới file PHP xử lý yêu cầu AJAX
                        method: 'GET',
                        dataType: 'json',
                        data: {
                            MaMonHoc: MaMonHoc,
                            MaLopHoc: MaLop,
                            MaHocKy: MaHocKy,
                            NienKhoa: NienKhoa
                        },
                        success: function(data) {
                            // Xóa bảng hiện tại (nếu có)
                            $('#example tbody').empty();
                            // Thêm dữ liệu vào bảng
                            $.each(data, function(index, item) {
                                $('#example tbody').append(
                                    `<tr>
                  <td class="text-center">${item.TenHocSinh}</td>
                  <td class="text-center">${item.KiemTra15p} </td>
                  <td class="text-center" >${item.KiemTra1tiet}</td>
                  <td class="text-center" >${item.KiemTraHocKy}</td>
                  <td class="text-center " hidden >${item.MaBDMH}</td>
                  <td class="text-center " hidden>${item.MaBDTP15p}</td>
                  <td class="text-center "hidden>${item.MaBDTP1tiet}</td>
                  <td class="text-center " hidden>${item.MaBDTPhocky}</td>
                  <td class="text-center" >
                  <button style="background-color:transparent; border-width: 0;" type="button" class="btn btn-primary btn-Sua">
                 <i class="bx bxs-edit"></i>
                  </button></td>   
                  <td class="text-center" >
                  <button style="background-color:transparent; border-width: 0;" type="button" class="btn btn-primary btn-Them">Thêm
                  </button></td>    
              </tr>`
                                );
                            });
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log('Error: ' + errorThrown);
                        }
                    });
                }); */


                $('#hocKy').on('change', function() {
                    var NienKhoa = $('#nienkhoa').val();
                    var MaLop = $('#lop').val();
                    var MaMonHoc = $('#mon').val();
                    var MaHocKy = $('#hocKy').val();
                    $("#tbody").empty();
                    table.ajax.reload();
                });

                $('#ThemDiem').on('click', function(event) {
                    event.preventDefault();

                    var MaBDMH = $('#BDMH').val();
                    var Diem15p = parseFloat($('input[name="Diem15p"]').val());
                    var Diem1tiet = parseFloat($('input[name="Diem1tiet"]').val());
                    var Diemhocky = parseFloat($('input[name="Diemhocky"]').val());

                    var isNotEmpty = $('#Diem15p').val() !== '' || $('#Diem1tiet').val() !== '' || $('#Diemhocky').val() !== '';

                    // Kiểm tra điểm có hợp lệ không nếu có giá trị
                    var isValid = true;

                    // Kiểm tra từng trường input

                    var isValid = true;

                   
                   $DiemToiDa  =  <?php echo $DiemToiDa  ?>;
                   $DiemToiThieu = <?php echo $DiemToiThieu ?>;
                    if (Diem15p < $DiemToiThieu || Diem15p > $DiemToiDa) {
                        alert('Điểm 15 phút phải là số và nằm trong khoảng từ <?php echo $DiemToiThieu ?> đến <?php echo $DiemToiDa  ?>.');
                        isValid = false;
                    }

                    if (Diem1tiet < $DiemToiThieu || Diem1tiet > $DiemToiDa) {
                        alert('Điểm 15 phút phải là số và nằm trong khoảng từ <?php echo $DiemToiThieu ?> đến <?php echo $DiemToiDa  ?>.');
                        isValid = false;
                    }

                    if (Diemhocky < $DiemToiThieu || Diemhocky > $DiemToiDa) {
                        alert('Điểm 15 phút phải là số và nằm trong khoảng từ <?php echo $DiemToiThieu ?> đến <?php echo $DiemToiDa  ?>.');
                        isValid = false;
                    }
                    if (isValid) {
                        if (isNaN(Diem15p))
                        {
                            Diem15p=null;
                        }
                        if (isNaN(Diem1tiet))
                        {
                            Diem1tiet=null;
                        }
                        if (isNaN(Diemhocky))
                        {
                            Diemhocky=null;
                        }
                        $.ajax({
                            url: 'pages/BangDiemMonHoc/ThemBangDiemMonhoc.php',
                            method: 'GET',
                            dataType: "json",
                            data: {
                                MaBDMH: MaBDMH,
                                Diem15p: Diem15p,
                                Diem1tiet: Diem1tiet,
                                Diemhocky: Diemhocky
                            },
                            success: function(response) {
                                // Handle success
                                console.log('Data submitted successfully');
                                // Hide the modal

                            },
                            error: function(xhr, textStatus, errorThrown) {
                                // Handle error
                                console.log('Error: ' + errorThrown);
                            }
                        });
                    }

                    var NienKhoa = $('#nienkhoa').val();
                    var MaLop = $('#lop').val();
                    var MaMonHoc = $('#mon').val();
                    var MaHocKy = $('#hocKy').val();
                    var inputDiem15p = document.getElementById("Diem15p");
                    // Xóa dữ liệu trong trường nhập liệu
                    inputDiem15p.value = "";
                    var inputDiem1tiet = document.getElementById("Diem1tiet");
                    // Xóa dữ liệu trong trường nhập liệu
                    inputDiem1tiet.value = "";

                    var inputDiemhocky = document.getElementById("Diemhocky");
                    // Xóa dữ liệu trong trường nhập liệu
                    inputDiemhocky.value = "";
                    $("#tbody").empty();
                    table.ajax.reload();
                    $('#addModal').modal('hide');
                });


                $(document).on('click', '.btn-Them', function(event) {

                    $('#addModal').modal('show');
                    var row = $(this).closest('tr');
                    var BDMH = table.row(row).data().MaBDMH;
                    $('#BDMH').val(BDMH);
                });



                // sửa điểm ajax 
                $(document).ready(function() {
                    $('#SuaDiem').on('click', function() {

                        var Diem15p = $('input[name="15p"]').val();
                        var Diem1tiet = $('input[name="1tiet"]').val();
                        var Diemhocky = $('input[name="hocky"]').val();
                        var MaBDTP15p = $('input[name="MaBDTP15p"]').val();
                        var MaBDTP1tiet = $('input[name="MaBDTP1tiet"]').val();
                        var MaBDTPhocky = $('input[name="MaBDTPhocky"]').val();
                        $DiemToiDa  =  <?php echo $DiemToiDa  ?>;
                       $DiemToiThieu = <?php echo $DiemToiThieu ?>;
                        function validateScore(score) {
                            return score >= $DiemToiThieu && score <= $DiemToiDa ;
                        }

                        var isValid = true;
                        var Diem15pArray = Diem15p.split(',');
                        var Diem1tietArray = Diem1tiet.split(',');
                        var DiemhockyArray = Diemhocky.split(',');

                        for (var i = 0; i < Diem15pArray.length; i++) {
                            if (!validateScore(Diem15pArray[i])) {
                                isValid = false;
                                alert('Điểm kiểm tra 15 phút phải là số và nằm trong khoảng từ <?php echo $DiemToiThieu ?> đến <?php echo $DiemToiDa  ?>.');
                                break;
                            }
                        }

                        for (var i = 0; i < Diem1tietArray.length; i++) {
                            if (!validateScore(Diem1tietArray[i])) {
                                isValid = false;
                                alert('Điểm kiểm tra 1 tiết phải là số và nằm trong khoảng từ <?php echo $DiemToiThieu ?> đến <?php echo $DiemToiDa  ?>.');
                                break;
                            }
                        }

                        for (var i = 0; i < DiemhockyArray.length; i++) {
                            if (!validateScore(DiemhockyArray[i])) {
                                isValid = false;
                                alert('Điểm kiểm tra học kỳ phải là số và nằm trong khoảng từ <?php echo $DiemToiThieu ?> đến <?php echo $DiemToiDa  ?>.');
                                break;
                            }
                        }
                        if (isValid) {

                            $.ajax({
                                url: 'pages/BangDiemMonHoc/SuaBangDiemMonhoc.php',
                                method: 'GET',
                                dataType: "json",
                                data: {
                                    Diem15p: Diem15p,
                                    Diem1tiet: Diem1tiet,
                                    Diemhocky: Diemhocky,
                                    MaBDTP15p: MaBDTP15p,
                                    MaBDTP1tiet: MaBDTP1tiet,
                                    MaBDTPhocky: MaBDTPhocky
                                },
                                success: function(response) {
                                    // Handle success
                                    console.log('Data submitted successfully');
                                    // Hide the modal

                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    // Handle error
                                    console.log('Error: ' + errorThrown);
                                }
                            });
                            var NienKhoa = $('#nienkhoa').val();
                            var MaLop = $('#lop').val();
                            var MaMonHoc = $('#mon').val();
                            var MaHocKy = $('#hocKy').val();
                            table.ajax.reload();
                            $('#myModal').modal('hide');
                        }

                    });


                });


            });
        </script>

        <!-- datatable -->


    </section>

</body>

</html>