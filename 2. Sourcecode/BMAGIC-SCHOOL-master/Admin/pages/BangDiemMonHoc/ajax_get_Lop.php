<?php
   include "../../../Database/Config/config.php";
    
   $MaNamHoc = $_GET['MaNamHoc'] ;
    
    $sql = "SELECT lop.MaLop,lop.TenLop FROM namhoc,danhsachlop,lop where namhoc.MaNamHoc=danhsachlop.MaNamHoc and lop.MaLop=danhsachlop.MaLop and namhoc.MaNamHoc=$MaNamHoc";
    $result = mysqli_query($mysqli, $sql);

    $data[0] = [
        'MaLop' => null,
        'TenLop' => 'Chọn lớp'
    ];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'MaLop' => $row['MaLop'],
            'TenLop'=> $row['TenLop']
        ];
    }
    echo json_encode($data);
?>