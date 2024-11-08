<section>
<?php
//Lấy thông tin trang cần tìm
if(isset($_GET['action'])){
    $action=$_GET['action'];
}
else 
{
    $action='';
}

//chọn trang web cần xử lý
    if( $action=='TiepNhanHocSinh')
    {
        include("pages/TiepNhanHocSinh/TiepNhanHocSinh.php");
    }
else if( $action=='QuanLyLop')
    {
        include("pages/QuanLyLop/QuanLyLop.php");
    }
    else if( $action=='LapDanhSachLop')
    {
        include("pages/LapDanhSachLop/LapDanhSachLop.php");
    }
    else if( $action=='DanhSachHocSinh')
    {
        include("pages/DanhSachHocSinh/DanhSachHocSinh.php");
    }
    else if( $action=='QuanLyMonHoc')
    {
        include("pages/QuanLyMonHoc/QuanLyMonHoc.php");
    }
    else if( $action=='BangDiemMonHoc')
    {
        include("pages/BangDiemMonHoc/BangDiemMonHoc.php");
    }
    else if( $action=='BaoCaoTongKetMon')
    {
        include("pages/BaoCao/BaoCaoMon.php");
    }
    else if( $action=='BaoCaoTongKetHocKy')
    {
        include("pages/BaoCao/BaoCaoHocKy.php");
    }
    else if( $action=='CaiDat')
    {
        include("pages/CaiDat/CaiDat.php");
    }
    else 
    {
        include("pages/TiepNhanHocSinh/TiepNhanHocSinh.php");
    }
?>
</section>