<?php 
include "../../../Database/Config/config.php";
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Polyfill\Php72\Php72;

if (isset($_POST['Send']))
{

$file = $_FILES['file']['tmp_name'];


    $obj = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $data= $obj->getActiveSheet()->toArray();
    $first_row = true;
    foreach($data as $row)
    {      
      if ($first_row) {
      $first_row = false;
      continue; // Bỏ qua dòng đầu tiên (tiêu đề)
      }

        $TenMonHoc = $row['0'];
        $DiemDat= $row['1'];
        
        $sql_add = "INSERT INTO `monhoc`( `TenMonHoc`, `DiemDat`) VALUES ('$TenMonHoc','$DiemDat')";
       $insert =  mysqli_query($mysqli,$sql_add);
    }
 }
 header('Location:http://localhost:3000/BMAGIC-SCHOOL/Admin/index.php?action=QuanLyMonHoc');
?>