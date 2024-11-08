<?php
$sql = "SELECT * FROM THAMSO";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$DiemToiDa = $row["DiemToiDa"];
$DiemToiThieu = $row["DiemToiThieu"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý môn học</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
    <!-- AJAX  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
                            <div class="text-uppercase" style="text-align: center; font-weight: bolder; font-size: large;">Quản lý môn học</div>
                            <div class="card-body">
                                <button class="btn btn-primary btn-lg text-white mb-0 me-0 btn-Them" type="button"><i class='bx bx-plus btn-Them'></i>Thêm môn học mới</button>
                                <button style="float: right" class="btn btn-primary btn-lg text-white mb-0 me-0 btn-Nhap" type="button"><i class='bx bx-import btn-Nhap'></i>Nhập file</button><br><br><br>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form method="POST" enctype="multipart/form-data" action="pages/QuanLyMonHoc/ImportExcel.php">
                                                    <input type="file" name="file">
                                                    <button type="submit" id="ImportExcel" name="Send"> Nhập dữ liệu </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Mã môn học</th>
                                                <th class="text-center">Tên môn học</th>
                                                <th class="text-center">Số điểm đạt</th>
                                                <th class="text-center">Chỉnh sửa</th>
                                                <th class="text-center">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $monHocList = array();
                                            $sqlMonHoc = "SELECT * FROM MONHOC";
                                            $resultMonHoc = $mysqli->query($sqlMonHoc);
                                            while ($rowMonHoc = $resultMonHoc->fetch_assoc()) {
                                                $monHocList[] = $rowMonHoc['TenMonHoc'];
                                                echo '
                                                        <tr>
                                                            <td class="text-center">' . $rowMonHoc['MaMonHoc'] . '</td>
                                                            <td class="text-center">' . $rowMonHoc['TenMonHoc'] . '</td>
                                                            <td class="text-center">' . $rowMonHoc['DiemDat'] . '</td>
                                                            <td class="text-center">
                                                                <button style="background-color:transparent; border-width: 0;" type="button" class="btn btn-primary btn-Sua">
                                                                    <i class="bx bxs-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="pages/QuanLyMonHoc/DeleteMH.php?MaMonHoc=' . $rowMonHoc['MaMonHoc'] . '" type="button" class="btn-Xoa text-primary" style="color:black">
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
                                                <th class="text-center">Mã môn học</th>
                                                <th class="text-center">Tên môn học</th>
                                                <th class="text-center">Số điểm đạt</th>
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

        <!--Sửa Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTitle" style="text-align: center;">Chi tiết môn học</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" action="pages/QuanLyMonHoc/Update.php" method="post">
                            <label for="modalTenMonHoc" class="col-sm-3 col-form-label fw-bold pb-2 ">Mã môn học</label>
                            <input type="text" class="form-control mb-2 bg-secondary" id="modalMaMonHoc" name="maMonHoc" readonly>

                            <label for="modalTenMonHoc" class="col-sm-3 col-form-label fw-bold pb-2">Tên môn học</label>
                            <input type="text" class="form-control mb-2" id="modalTenMonHoc" name="tenMonHoc" placeholder="Toán học">
                            <span id="TenMHError" class="error-message"></span> <!-- Thông báo lỗi -->

                            <label for="modalDiemDat" class="col-sm-3 col-form-label fw-bold ">Số điểm đạt</label>
                            <input type="number" class="form-control mb-2" id="modalDiemDat" name="diemDat" placeholder="8">
                            <span id="DiemDatError" class="error-message"></span> <!-- Thông báo lỗi -->

                            <input type="submit" class="mt-4 fw-bold btn-Update" name="submit" value="Cập nhật" size="50" id="Suamodel">
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
                        <h4 class="modal-title fw-bold" id="modalTitle" style="text-align: center;">Thêm môn học</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="pages/QuanLyMonHoc/AddMH.php">
                            <!-- Trong form thêm modal -->
                            <label for="modalTenMonHoc" class="col-sm-3 col-form-label fw-bold pb-2">Tên môn học</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="ThemTenMH" name="tenMonHoc" placeholder="Toán học">
                                    <span id="ThemTenMHError" class="error-message"></span> <!-- Thông báo lỗi -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="modalDiemDat" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Số điểm đạt</label>
                                    <input type="number" class="form-control" id="ThemDiemDat" name="diemDat" placeholder="8">
                                    <span id="ThemDiemDatError" class="error-message"></span> <!-- Thông báo lỗi -->
                                </div>
                            </div>
                            <input type="submit" class="mt-4 fw-bold btnThem" name="submit" value="Thêm" size="50" id="Themmodel">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="pages/QuanLyMonHoc/ImportExcel.php">
                            <input id="file" type="file" class="importfile">
                            <button type="submit" id="ImportExcel" name="Send"> Nhập dữ liệu </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                // upload
                $(".btn-Nhap").click(function() {
                    $('#exampleModalCenter').modal('show');
                })

                // Sửa
                $('#example').on('click', '.btn-Sua', function() {
                    $('#myModal').modal('show');

                    var row = $(this).closest('tr');
                    var maMonHoc = row.find('td:eq(0)').text();
                    var tenMonHoc = row.find('td:eq(1)').text();
                    var diemDat = row.find('td:eq(2)').text();

                    // Điền dữ liệu vào modal
                    $('#modalMaMonHoc').val(maMonHoc);
                    $('#modalTenMonHoc').val(tenMonHoc);
                    $('#modalDiemDat').val(diemDat);
                });

                // Xóa
                $(".btn-Xoa").click(function() {
                    $(this).closest('tr').remove();
                });
                // Thêm
                $(".btn-Them").click(function() {
                    $('#myModal1').modal('show');
                    $("#Themmodel").prop("disabled", true);
                });
            });
        </script>

        <!-- sửa -->
        <script>
            $(document).ready(function() {
                var flag1 = false; // được submit
                var flag2 = false;
                var DiemToiDa = <?php echo json_encode($DiemToiDa); ?>;
                var DiemToiThieu = <?php echo json_encode($DiemToiThieu); ?>;
                var existingSubjects = <?php echo json_encode($monHocList); ?>;
                const originalSubjectName = $(modalTenMonHoc).val();

                $("#modalTenMonHoc").blur(function() {
                    var Ten = $(this).val();

                    var regex = /^[a-zA-Z\sÀ-ỹ]*$/; // Regular expression to allow only letters and spaces

                    if (!regex.test(Ten) || Ten.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#TenMHError").text("Tên môn học không được chứa số, ký tự đặc biệt và để trống");
                        flag1 = true;
                    } else if (existingSubjects.includes(Ten) && Ten !== originalSubjectName) {
                        $(this).addClass("is-invalid");
                        $("#TenMHError").text("Tên môn học đã tồn tại");
                        flag1 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenMHError").text("");
                        flag1 = false;
                    }
                    toggleSubmitButton();
                });

                $("#modalDiemDat").blur(function() {
                    var Diem = $(this).val();
                    if (Diem === "") {
                        $(this).addClass("is-invalid");
                        $("#DiemDatError").text("Điểm môn học không được để trống");
                        flag1 = true;
                    } else if (Diem < parseFloat(DiemToiThieu) || Diem > parseFloat(DiemToiDa)) {
                        $(this).addClass("is-invalid");
                        $("#DiemDatError").text("Điểm môn học phải nằm trong khoảng [" + DiemToiThieu + ";" + DiemToiDa + "]");
                        flag1 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#DiemDatError").text("");
                        flag1 = false;
                    }
                    toggleSubmitButton();
                });

                // Kích hoạt hoặc vô hiệu hóa nút "Thêm" dựa trên trạng thái của cả hai trường nhập liệu
                function toggleSubmitButton() {
                    if (flag1 == false && flag2 == false) {
                        $("#Suamodel").prop("disabled", false);
                    } else {
                        $("#Suamodel").prop("disabled", true);
                    }
                }
            });
        </script>



        <!-- thêm -->
        <script>
            $(document).ready(function() {
                var flag1 = true; // không được submit
                var flag2 = true;
                var DiemToiDa = <?php echo json_encode($DiemToiDa); ?>;
                var DiemToiThieu = <?php echo json_encode($DiemToiThieu); ?>;
                var existingSubjects = <?php echo json_encode($monHocList); ?>;

                $("#ThemTenMH").blur(function() {
                    var Ten = $(this).val();
                    var regex = /^[a-zA-Z\sÀ-ỹ]*$/; // Regular expression to allow only letters and spaces
                    if (!regex.test(Ten) || Ten.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#ThemTenMHError").text("Tên môn học không được chứa số hoặc ký tự đặc biệt và không được để trống");
                    } else if (existingSubjects.includes(Ten)) {
                        $(this).addClass("is-invalid");
                        $("#ThemTenMHError").text("Tên môn học đã tồn tại");
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#ThemTenMHError").text("");
                        flag1 = false;
                    }
                    toggleSubmitButton();
                });

                $("#ThemDiemDat").blur(function() {
                    var Diem = $(this).val();
                    if (Diem === "") {
                        $(this).addClass("is-invalid");
                        $("#ThemDiemDatError").text("Điểm môn học không được để trống");
                    } else if (Diem < parseFloat(DiemToiThieu) || Diem > parseFloat(DiemToiDa)) {
                        $(this).addClass("is-invalid");
                        $("#ThemDiemDatError").text("Điểm môn học phải nằm trong khoảng [" + DiemToiThieu + ";" + DiemToiDa + "]");
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#ThemDiemDatError").text("");
                        flag2 = false;
                    }
                    toggleSubmitButton();
                });

                // Kích hoạt hoặc vô hiệu hóa nút "Thêm" dựa trên trạng thái của cả hai trường nhập liệu
                function toggleSubmitButton() {
                    if (flag1 == false && flag2 == false) {
                        $("#Themmodel").prop("disabled", false);
                    } else {
                        $("#Themmodel").prop("disabled", true);
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