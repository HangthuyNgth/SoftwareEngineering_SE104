<?php
   include "../../../Database/Config/config.php";
    
   
    
    $sql = "SELECT DiemToiThieu FROM `thamso` WHERE 1";
    $result = mysqli_query($mysqli, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'DiemToiThieu' => $row['DiemToiThieu']
        ];
    }
    echo json_encode($data);
?>