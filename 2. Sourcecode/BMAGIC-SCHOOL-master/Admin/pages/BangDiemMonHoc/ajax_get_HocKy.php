<?php
   include "../../../Database/Config/config.php";
    
   
    
    $sql = "SELECT * FROM `hocky`  ";
    $result = mysqli_query($mysqli, $sql);

    $data[0] = [
        'MaHocKy' => null,
        'TenHocKy' => 'Chọn học kỳ'
    ];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'MaHocKy' => $row['MaHocKy'],
            'TenHocKy'=> $row['TenHocKy']
        ];
    }
    echo json_encode($data);
?>