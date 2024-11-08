<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lớp học</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Bootstrap JS (yêu cầu jQuery) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS (yêu cầu jQuery) -->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.min.js"></script>

    <!-- Additional DataTables Buttons Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- jQuery Validation Plugin -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<style>
    .btnThem,
    .btn-Update {
        border-radius: 25px;
        width: 90px;
        height: 40px;
        background-color: transparent;
        margin-left: 80%;
    }

    .btnThem:hover,
    .btn-Update:hover {
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

<body>
    <section>
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <br>
                            <div class="text-uppercase" style="text-align: center; font-weight: bolder; font-size: large;">Danh sách lớp học</div>
                            <div class="card-body">
                                <button class="btn btn-primary btn-lg text-white mb-0 me-0 btn-Them" type="button"><i class='bx bx-plus btn-Them'></i>Thêm lớp học mới</button><br><br>
                                <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center" style="display:none">Mã Lớp</th>
                                                <th class="text-center">Tên lớp học</th>
                                                <th class="text-center">Khối lớp</th>
                                                <th class="text-center">Chỉnh sửa</th>
                                                <th class="text-center">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $Loplist = array();
                                            $sqlLop = "SELECT MaLop, TenLop, Lop.MaKhoi, TenKhoi FROM LOP, KHOILOP WHERE LOP.MAKHOI = KHOILOP.MAKHOI";
                                            $resultLop = $mysqli->query($sqlLop);
                                            $stt = 0;
                                            while ($rowLop = $resultLop->fetch_assoc()) {
                                                $Loplist[] = $rowLop['TenLop'];
                                                $stt += 1;
                                                echo '
                                                        <tr>
                                                            <td class="text-center">' . $stt . '</td>
                                                            <td class="text-center" style="display:none">' . $rowLop['MaLop'] . '</td>
                                                            <td class="text-center">' . $rowLop['TenLop'] . '</td>
                                                            <td class="text-center">' . $rowLop['TenKhoi'] . '</td>
                                                            <td class="text-center">
                                                                <button style="background-color:transparent; border-width: 0;" type="button" class="btn btn-primary btn-Sua">
                                                                    <i class="bx bxs-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="pages/QuanLyLop/DeleteLop.php?MaLop=' . $rowLop['MaLop'] . '" type="button" class="btn-Xoa text-primary" style="color:black">
                                                                    <i class="bx bx-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    ';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center" style="display:none">Mã Lớp</th>
                                                <th class="text-center">Tên lớp học</th>
                                                <th class="text-center">Khối lớp</th>
                                                <th class="text-center">Chỉnh sửa</th>
                                                <th class="text-center">Xóa</th>
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
                        <h4 class="modal-title" id="modalTitle" style="text-align: center;">Chi tiết lớp học</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" action="pages/QuanLyLop/Update.php" method="post">
                            <label for="modalMaLop" class="col-sm-3 col-form-label fw-bold pb-2 ">Mã lớp học</label>
                            <input type="text" class="form-control mb-2 bg-secondary" id="modalMaLop" name="maLop" readonly>

                            <label for="modalTenLop" class="col-sm-3 col-form-label fw-bold pb-2">Tên lớp học</label>
                            <input type="text" class="form-control mb-2" id="modalTenLop" name="tenLop" placeholder="10A1">
                            <span id="TenLHError" class="error-message"></span> <!-- Thông báo lỗi -->

                            <br />
                            <label for="modalTenKhoi" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Tên khối</label>
                            <select class="form-select" id="modalTenKhoi" name="tenKhoi" required>
                                <option value="" selected>Chọn khối</option>
                                <option value="Khối 10">Khối 10</option>
                                <option value="Khối 11">Khối 11</option>
                                <option value="Khối 12">Khối 12</option>
                            </select>
                            <input type="submit" class="mt-4 fw-bold btn-Update" name="submit" value="Cập nhật" size="50">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thêm Modal -->
        <div class="modal" id="myModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fw-bold" id="modalTitle" style="text-align: center;">Thêm lớp học</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="addLopForm" action="pages/QuanLyLop/AddLop.php">
                            <!-- Trong form thêm modal -->
                            <label for="modalTenLopadd" class="col-sm-3 col-form-label fw-bold pb-2">Tên lớp học</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="modalTenLopadd" name="tenLop" placeholder="Lớp 10A1" required>
                                    <span id="TenLopErroradd" class="error-message"></span> <!-- Thông báo lỗi -->

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="modalTenKhoiadd" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Tên khối</label>
                                    <select class="form-select" id="modalTenKhoiadd" name="tenKhoi" required>
                                        <option value="" disabled selected>Chọn khối</option>
                                        <option value="Khối 10">Khối 10</option>
                                        <option value="Khối 11">Khối 11</option>
                                        <option value="Khối 12">Khối 12</option>
                                    </select>
                                    <span id="TenKhoiErroradd" class="error-message"></span> <!-- Thông báo lỗi -->
                                </div>
                            </div>

                            <input type="submit" class="btnThem mt-4 fw-bold" id="btnThem" name="submit" value="Thêm" size="50">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                // Sửa
                $('#example').on('click', '.btn-Sua', function() {
                    $('#myModal').modal('show');

                    var row = $(this).closest('tr');
                    var maLop = row.find('td:eq(1)').text();
                    var tenLop = row.find('td:eq(2)').text();
                    var tenKhoi = row.find('td:eq(3)').text();

                    // Điền dữ liệu vào modal
                    $('#modalMaLop').val(maLop);
                    $('#modalTenLop').val(tenLop);
                    $('#modalTenKhoi').val(tenKhoi);
                });

                // Xóa
                $(".btn-Xoa").click(function() {
                    $(this).closest('tr').remove();
                });

                // Thêm
                $(".btn-Them").click(function() {
                    $('#myModal1').modal('show');
                });

                // Xử lý validation cho modal Sửa
                var updateFlag1 = false; // được submit
                var updateFlag2 = false;
                var existing = <?php echo json_encode($Loplist); ?>;
                const originalupdate = $(modalTenLop).val();

                $("#modalTenLop").blur(function() {
                    var Lop = $(this).val();
                    var regex = /^[a-zA-ZÀ-ỹ\s0-9]*$/;
                    if (!regex.test(Lop) || Lop.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#TenLHError").text("Tên lớp học không được chứa ký tự đặc biệt và để trống");
                        updateFlag1 = true;
                    } else if (existing.includes(Lop) && Lop !== originalupdate) {
                        $(this).addClass("is-invalid");
                        $("#TenLHError").text("Tên lớp học đã tồn tại");
                        updateFlag1 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenLHError").text("");
                        updateFlag1 = false;
                    }
                    toggleUpdateButton();
                });

                $("#modalTenKhoi").blur(function() {
                    var Khoi = $(this).val();
                    if (Khoi.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#TenKhoiError").text("Tên khối lớp không được để trống");
                        updateFlag2 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenKhoiError").text("");
                        updateFlag2 = false;
                    }
                    toggleUpdateButton();
                });

                function toggleUpdateButton() {
                    if (!updateFlag1 && !updateFlag2) {
                        $(".btn-Update").prop("disabled", false);
                    } else {
                        $(".btn-Update").prop("disabled", true);
                    }
                }

                // Xử lý validation cho modal Thêm
                var addFlag1 = true; // không được submit
                var addFlag2 = true;
                const originaladd = $(modalTenLopadd).val();
                $("#modalTenLopadd").blur(function() {
                    var Lop = $(this).val();
                    var regex = /^[a-zA-ZÀ-ỹ\s0-9]*$/;
                    if (!regex.test(Lop) || Lop.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#TenLopErroradd").text("Tên lớp học không được chứa ký tự đặc biệt và không được để trống");
                        addFlag1 = true;
                    } else if (existing.includes(Lop) && Lop !== originaladd) {
                        $(this).addClass("is-invalid");
                        $("#TenLopErroradd").text("Tên lớp học đã tồn tại");
                        addFlag1 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenLopErroradd").text("");
                        addFlag1 = false;
                    }
                    toggleAddButton();
                });

                $("#modalTenKhoiadd").blur(function() {
                    var Khoi = $(this).val();
                    if (Khoi.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#TenKhoiErroradd").text("Tên khối không được để trống");
                        addFlag2 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenKhoiErroradd").text("");
                        addFlag2 = false;
                    }
                    toggleAddButton();
                });

                function toggleAddButton() {
                    if (!addFlag1 && !addFlag2) {
                        $("#btnThem").prop("disabled", false);
                    } else {
                        $("#btnThem").prop("disabled", true);
                    }
                }
            });
        </script>



        <!-- datatable -->
        <script>
            var table = new DataTable('#example', {
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
        </script>
    </section>

</body>

</html>