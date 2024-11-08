
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <!-- HỌC SINH -->
    <li class="nav-item nav-category">Quản lý HỌC SINH</li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=DanhSachHocSinh">
        <i class="menu-icon"><span class="material-symbols-outlined">assignment_ind</span></i>
        <span class="menu-title">Danh sách học sinh</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=TiepNhanHocSinh">
        <i class="menu-icon"><span class="material-symbols-outlined">person</span></i>
        <span class="menu-title">Tiếp nhận học sinh</span>
        <i class="menu-arrow"></i>
      </a>
    </li>

    <!-- LỚP HỌC -->
    <li class="nav-item nav-category">Quản lý lớp học</li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=QuanLyLop" >
        <i class="menu-icon"> <span class="material-symbols-outlined">assignment</span></i>
        <span class="menu-title">Quản lý lớp học</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=LapDanhSachLop">
        <i class="menu-icon"><span class="material-symbols-outlined">tenancy</span></i>
        <span class="menu-title">Danh sách lớp</span>
        <i class="menu-arrow"></i>
      </a>
    </li>

    <!-- MÔN HỌC -->
    <li class="nav-item nav-category">Quản lý môn học</li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=QuanLyMonHoc">
        <i class="menu-icon "><span class="material-symbols-outlined">prescriptions</span></i>
        <span class="menu-title">Quản lý môn học</span>
        <i class="menu-arrow"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=BangDiemMonHoc">
        <i class="menu-icon "><span class="material-symbols-outlined">filter_list</span></i>
          <span class="menu-title">Bảng điểm môn học</span>
        <i class="menu-arrow"></i>
      </a>
    </li>

    <!-- BÁO CÁO -->
    <li class="nav-item nav-category">Chức năng</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
        <i class="menu-icon"><span class="material-symbols-outlined">analytics</span></i>
        <span class="menu-title">Báo cáo</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="report">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?action=BaoCaoTongKetMon"> Báo cáo theo môn </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?action=BaoCaoTongKetHocKy"> Báo cáo theo kỳ </a></li>
        </ul>
      </div>
    </li>
    <!-- CÀI ĐẶT -->
    <li class="nav-item">
      <a class="nav-link" href="index.php?action=CaiDat">
        <i class="menu-icon bx bx-cog"></i>
        <span class="menu-title">Cài đặt</span>
      </a>
    </li>

  </ul>
</nav>