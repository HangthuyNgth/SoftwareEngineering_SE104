<?php

include("../../../Database/Config/config.php");

if(isset($_GET['MaBDMH']))
{   
$MaBDMH = $_GET['MaBDMH'];
$Diem15p = $_GET['Diem15p'];
$Diem1tiet = $_GET['Diem1tiet'];
$Diemhocky = $_GET['Diemhocky'];

 
if ($Diem15p!= null ){ 
$sql = "INSERT INTO `bangdiemthanhphan`(`MaBDMH`, `MaLKT`, `ketqua`) VALUES ($MaBDMH,1,$Diem15p)";
    mysqli_query($mysqli,$sql);

}
else echo 0;

if ($Diem1tiet!= null ){ 
    $sql = "INSERT INTO `bangdiemthanhphan`(`MaBDMH`, `MaLKT`, `ketqua`) VALUES ($MaBDMH,2,$Diem1tiet)";
        mysqli_query($mysqli,$sql);
    
    }
    else echo 0;
    
    if ($Diemhocky!= null ){ 
        $sql = "INSERT INTO `bangdiemthanhphan`(`MaBDMH`, `MaLKT`, `ketqua`) VALUES ($MaBDMH,3,$Diemhocky)";
            mysqli_query($mysqli,$sql);
        
        }
        else echo 0;

}

?>