<?php
   include "../../../Database/Config/config.php";
    
   
    
    $sql = "SELECT * FROM `monhoc`  ";
    $result = mysqli_query($mysqli, $sql);

    $data[0] = [
        'MaMonHoc' => null,
        'TenMonHoc' => 'Chọn môn học'
    ];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'MaMonHoc' => $row['MaMonHoc'],
            'TenMonHoc'=> $row['TenMonHoc']
        ];
    }
    echo json_encode($data);
?>