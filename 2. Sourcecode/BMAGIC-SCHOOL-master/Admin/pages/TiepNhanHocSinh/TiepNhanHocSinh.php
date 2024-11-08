<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiếp Nhận Học Sinh</title>
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

    <!-- moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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

    <!-- Add Validate data form -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>


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

    form .error {
        color: #ff0000;
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
                            <div class="text-uppercase" style="text-align: center; font-weight: bolder; font-size: large;">Tiếp nhận học sinh</div>
                            <div class="card-body">
                                <button style="float: left" class="btn btn-primary btn-lg text-white mb-0 me-0 btn-Them" type="button"><i class='bx bx-plus btn-Them'></i>Thêm học sinh mới</button>
                                <button style="float: right" class="btn btn-primary btn-lg text-white mb-0 me-0 btn-Nhap" type="button"><i class='bx bx-import btn-Nhap'></i>Nhập file</button><br><br><br>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form method="POST" enctype="multipart/form-data" action="pages/TiepNhanHocSinh/ImportExcel.php">
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
                                                <th class="text-center">Mã học sinh</th>
                                                <th class="text-center">Tên học sinh</th>
                                                <th class="text-center">Ngày sinh</th>
                                                <th class="text-center">Giới tính</th>
                                                <th class="text-center">Địa chỉ</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Trạng thái</th>
                                                <th class="text-center">Chỉnh sửa</th>
                                                <th class="text-center">Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $HSlist = array();
                                            $sqlHOCSINH = "SELECT * FROM HOCSINH";
                                            $resultHOCSINH = $mysqli->query($sqlHOCSINH);
                                            while ($rowHOCSINH = $resultHOCSINH->fetch_assoc()) {
                                                $HSlist[] = $rowHOCSINH['Email'];
                                                echo '
                                                        <tr>
                                                            <td class="text-center">' . $rowHOCSINH['MaHocSinh'] . '</td>
                                                            <td class="text-center">' . $rowHOCSINH['TenHocSinh'] . '</td>
                                                            <td class="text-center">' . $rowHOCSINH['NgaySinh'] . '</td>
                                                            <td class="text-center">' . $rowHOCSINH['GioiTinh'] . '</td>
                                                            <td class="text-center">' . $rowHOCSINH['DiaChi'] . '</td>
                                                            <td class="text-center">' . $rowHOCSINH['Email'] . '</td>
                                                            <td class="text-center">' . $rowHOCSINH['status'] . '</td>
                                                            <td class="text-center">
                                                                <button style="background-color:transparent; border-width: 0;" type="button" class="btn btn-primary btn-Sua">
                                                                    <i class="bx bxs-edit"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="pages/TiepNhanHocSinh/DeleteHS.php?MaHocSinh=' . $rowHOCSINH['MaHocSinh'] . '" type="button" class="btn-Xoa text-primary" style="color:black">
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
                                                <th class="text-center">Mã học sinh</th>
                                                <th class="text-center">Tên học sinh</th>
                                                <th class="text-center">Ngày sinh</th>
                                                <th class="text-center">Giới tính</th>
                                                <th class="text-center">Địa chỉ</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Trạng thái</th>
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
        <!-- Modal cập nhật thông tin học sinh -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTitle" style="text-align: center;">Thông tin học sinh</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" action="pages/TiepNhanHocSinh/Update.php" method="post" id="updateForm">
                            <label for="modalMaHocSinh" class="col-sm-3 col-form-label fw-bold pb-2">Mã học sinh</label>
                            <input type="text" class="form-control mb-2 bg-secondary" id="modalMaHocSinh" name="maHocSinh" readonly>

                            <label for="modalTenHocSinh" class="col-sm-3 col-form-label fw-bold pb-2">Tên học sinh</label>
                            <input type="text" class="form-control mb-2" id="modalTenHocSinh" name="tenHocSinh" placeholder="Trần Văn A" required>
                            <span id="TenHSError" class="error-message"></span>

                            <label for="modalNgaySinh" class="col-sm-3 col-form-label fw-bold">Ngày sinh</label>
                            <input type="date" class="form-control mb-2" id="modalNgaySinh" name="ngaySinh" required>
                            <span id="NgaySinhError" class="error-message"></span>

                            <label for="modalGioiTinh" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Giới tính</label>
                            <select class="form-select" id="modalGioiTinh" name="gioiTinh" required>
                                <option value="" selected>Chọn giới tính</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                            <span id="GTrror" class="error-message"></span>

                            <label for="modalDiaChi" class="col-sm-3 col-form-label fw-bold pb-2">Địa chỉ</label>
                            <input type="text" class="form-control mb-2" id="modalDiaChi" name="diaChi" placeholder="" required>
                            <span id="DiaChiError" class="error-message"></span>

                            <label for="modalEmail" class="col-sm-3 col-form-label fw-bold pb-2">Email</label>
                            <input type="email" class="form-control mb-2" id="modalEmail" name="email" placeholder="abc@gmail.com" required>
                            <span id="EmailError" class="error-message"></span>

                            <label for="modalMaHocSinh" class="col-sm-3 col-form-label fw-bold pb-2">Trạng thái</label>
                            <input type="text" class="form-control mb-2 bg-secondary" id="modaltrangthai" name="trangthai" readonly>

                            <input type="submit" class="mt-4 fw-bold btn-Update" id="btn-Update" name="submit" value="Cập nhật" size="50">
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
                        <h4 class="modal-title fw-bold" id="modalTitle" style="text-align: center;">Thêm học sinh</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form name="registration" id="addForm" method="post" action="pages/TiepNhanHocSinh/AddHS.php">
                            <label for="modalTenHocSinhAdd" class="col-sm-3 col-form-label fw-bold pb-2">Tên học sinh</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="modalTenHocSinhAdd" name="tenHocSinh" placeholder="Trần Văn A" required>
                                    <span id="TenHSErrorAdd" class="error-message"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="modalNgaySinhAdd" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Ngày sinh</label>
                                    <input type="date" class="form-control" id="modalNgaySinhAdd" name="ngaySinh" required>
                                    <span id="NgaySinhErrorAdd" class="error-message"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="modalGioiTinhAdd" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Giới tính</label>
                                <select class="form-select" id="modalGioiTinhAdd" name="gioiTinh" required>
                                    <option value="" disabled selected>Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                <span id="GioiTinhErrorAdd" class="error-message"></span>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="modalDiaChiAdd" class="col-sm-3 col-form-label fw-bold pb-2 mt-3">Địa chỉ</label>
                                    <input type="text" class="form-control" id="modalDiaChiAdd" name="diaChi" placeholder="Thành phố Hồ Chí Minh" required>
                                    <span id="DiaChiErrorAdd" class="error-message"></span>
                                </div>
                            </div>
                            <label for="modalEmailAdd" class="col-sm-3 col-form-label fw-bold pb-2">Email</label>
                            <div class="row">
                                <div class="col-12">
                                    <input type="email" class="form-control" id="modalEmailAdd" name="email" placeholder="TranVanA@gmail.com" required>
                                    <span id="EmailErrorAdd" class="error-message"></span>
                                </div>
                            </div>
                            <input type="submit" class="mt-4 fw-bold btnThem" name="submit" value="Thêm" size="50">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php
        $sql = "SELECT MinAge, MaxAge FROM THAMSO";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        $minAge = $row["MinAge"];
        $maxAge = $row["MaxAge"];
        ?>

        <script>
            $(document).ready(function() {
                //Biến minAge, maxAge
                var minAge = <?php echo json_encode($minAge); ?>;
                var maxAge = <?php echo json_encode($maxAge); ?>;
                var existing = <?php echo json_encode($HSlist); ?>;
                const originalupdate = $(modalEmail).val();
                const originalinsert = $(modalEmailAdd).val();

                // Biến cờ cho form cập nhật
                var updateFlag1 = true;
                var updateFlag2 = true;
                var updateFlag3 = true;
                var updateFlag4 = true;
                var updateFlag5 = true;

                // Biến cờ cho form thêm
                var addFlag1 = true;
                var addFlag2 = true;
                var addFlag3 = true;
                var addFlag4 = true;
                var addFlag5 = true;

                // Kiểm tra hợp lệ cho form cập nhật
                $("#modalTenHocSinh").blur(function() {
                    var tenHocSinh = $(this).val();
                    var regex = /^[a-zA-ZÀ-ỹ\s]*$/;
                    if (!regex.test(tenHocSinh) || tenHocSinh.trim() === "") {
                        $(this).addClass("is-invalid");
                        s
                        $("#TenHSError").text("Tên học sinh không được chứa ký tự đặc biệt và không được để trống");
                        updateFlag1 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenHSError").text("");
                        updateFlag1 = false;
                    }

                });


                $("#modalNgaySinh").blur(function() {
                    var ngaySinh = $(this).val();
                    if (ngaySinh.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#NgaySinhError").text("Ngày sinh không được để trống");
                        updateFlag2 = true;
                    } else {
                        var age = moment().diff(moment(ngaySinh), 'years');
                        // alert(age);
                        if (age < minAge || age > maxAge) {
                            $(this).addClass("is-invalid");
                            $("#NgaySinhError").text("Tuổi của học sinh phải nằm trong khoảng từ " + minAge + " đến " + maxAge + " tuổi");
                            updateFlag2 = true;
                        } else {
                            $(this).removeClass("is-invalid");
                            $("#NgaySinhError").text("");
                            updateFlag2 = false;
                        }
                    }

                });


                $("#modalGioiTinh").blur(function() {
                    var gioiTinh = $(this).val();
                    if (gioiTinh === "") {
                        $(this).addClass("is-invalid");
                        $("#GTrror").text("Giới tính không được để trống");
                        updateFlag3 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#GTrror").text("");
                        updateFlag3 = false;
                    }
                });

                $("#modalDiaChi").blur(function() {
                    var diaChi = $(this).val();
                    if (diaChi.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#DiaChiError").text("Địa chỉ không được để trống");
                        updateFlag4 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#DiaChiError").text("");
                        updateFlag4 = false;
                    }
                });

                $("#modalEmail").blur(function() {
                    var email = $(this).val();
                    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
                    if (!emailPattern.test(email) || email.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#EmailError").text("Email không hợp lệ và không được để trống");
                        updateFlag5 = true;
                    } else if (existing.includes(email) && email !== originalupdate) {
                        $(this).addClass("is-invalid");
                        $("#EmailError").text("Email đã tồn tại");
                        updateFlag5 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#EmailError").text("");
                        updateFlag5 = false;
                    }
                });

                function toggleUpdateButton() {
                    if (!updateFlag1 && !updateFlag2 && !updateFlag3 && !updateFlag4 && !updateFlag5) {
                        $("#btn-Update").prop("disabled", false);
                    } else {
                        $("#btn-Update").prop("disabled", true);
                    }
                }

                // Kiểm tra hợp lệ cho form thêm
                $("#modalTenHocSinhAdd").blur(function() {
                    var tenHocSinh = $(this).val();
                    var regex = /^[a-zA-ZÀ-ỹ\s]*$/;
                    if (!regex.test(tenHocSinh) || tenHocSinh.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#TenHSErrorAdd").text("Tên học sinh không được chứa ký tự đặc biệt và không được để trống");
                        addFlag1 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#TenHSErrorAdd").text("");
                        addFlag1 = false;
                    }
                    toggleAddButton();
                });

                $("#modalNgaySinhAdd").blur(function() {
                    var ngaySinh = $(this).val();
                    if (ngaySinh.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#NgaySinhErrorAdd").text("Ngày sinh không được để trống");
                        addFlag2 = true;
                    } else {
                        var birthday = moment(ngaySinh);
                        var now = moment();
                        var age = now.diff(birthday, 'years');
                        if (age < minAge || age > maxAge) {
                            $(this).addClass("is-invalid");
                            $("#NgaySinhErrorAdd").text("Tuổi phải từ " + minAge + " đến " + maxAge);
                            addFlag2 = true;
                        } else {
                            $(this).removeClass("is-invalid");
                            $("#NgaySinhErrorAdd").text("");
                            addFlag2 = false;
                        }
                    }
                    toggleAddButton();
                });


                $("#modalGioiTinhAdd").blur(function() {
                    var gioiTinh = $(this).val();
                    if (gioiTinh === "") {
                        $(this).addClass("is-invalid");
                        $("#GioiTinhErrorAdd").text("Giới tính không được để trống");
                        addFlag3 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#GioiTinhErrorAdd").text("");
                        addFlag3 = false;
                    }
                    toggleAddButton();
                });

                $("#modalDiaChiAdd").blur(function() {
                    var diaChi = $(this).val();
                    if (diaChi.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#DiaChiErrorAdd").text("Địa chỉ không được để trống");
                        addFlag4 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#DiaChiErrorAdd").text("");
                        addFlag4 = false;
                    }
                    toggleAddButton();
                });

                $("#modalEmailAdd").blur(function() {
                    var email = $(this).val();
                    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
                    if (!emailPattern.test(email) || email.trim() === "") {
                        $(this).addClass("is-invalid");
                        $("#EmailErrorAdd").text("Email không hợp lệ và không được để trống");
                        addFlag5 = true;
                    } else if (existing.includes(email) && email !== originalinsert) {
                        $(this).addClass("is-invalid");
                        $("#EmailErrorAdd").text("Email đã tồn tại");
                        addFlag5 = true;
                    } else {
                        $(this).removeClass("is-invalid");
                        $("#EmailErrorAdd").text("");
                        addFlag5 = false;
                    }
                    toggleAddButton();
                });

                function toggleAddButton() {
                    if (!addFlag1 && !addFlag2 && !addFlag3 && !addFlag4 && !addFlag5) {
                        $(".btnThem").prop("disabled", false);
                    } else {
                        $(".btnThem").prop("disabled", true);
                    }
                }

                // Mở modal sửa và điền dữ liệu vào modal
                $(document).on('click', '.btn-Sua', function(event) {
                    $('#myModal').modal('show');
                    var row = $(this).closest('tr');
                    var maHocSinh = row.find('td:eq(0)').text();
                    var tenHocSinh = row.find('td:eq(1)').text();
                    var ngaySinh = row.find('td:eq(2)').text();
                    var gioiTinh = row.find('td:eq(3)').text();
                    var diaChi = row.find('td:eq(4)').text();
                    var email = row.find('td:eq(5)').text();
                    var trangthai = row.find('td:eq(6)').text();

                    $('#modalMaHocSinh').val(maHocSinh);
                    $('#modalTenHocSinh').val(tenHocSinh);
                    $('#modalNgaySinh').val(ngaySinh);
                    $('#modalGioiTinh').val(gioiTinh);
                    $('#modalDiaChi').val(diaChi);
                    $('#modalEmail').val(email);
                    $('#modaltrangthai').val(trangthai);
                });



                // Xóa
                $(".btnXoa").click(function() {

                    var row = $(this).closest('tr');

                    var MaHS = $(this).attr('id');
                    // let text = "Bạn có muốn xóa không?";
                    // if (confirm(text) == true) {
                    // $.post("Admin\pages\TiepNhanHocSinh\DeleteHS.php", {
                    //         MaHocSinh: MaHS,
                    //     },
                    //     function(data, status) {
                    //         if (status == "success") {
                    //             alert(data);
                    //             $(this).parents("tr").remove();
                    //         }
                    //     }
                    // );
                    $.ajax({

                        url: 'pages/TiepNhanHocSinh/TiepNhanHocSinh.php',
                        method: 'GET',
                        dataType: "json",
                        data: {
                            MaHocSinh: MaHS
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

                    // }
                });

                // Thêm
                $(".btn-Them").click(function() {
                    $('#myModal1').modal('show');
                });

                //Import 
                $(".btn-Nhap").click(function() {
                    $('#exampleModalCenter').modal('show');
                });
            });
            // });
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