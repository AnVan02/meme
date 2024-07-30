<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Include PhpSpreadsheet library autoloader 
require_once 'vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 
 
if(isset($_POST['importSubmit'])){ 
     
    // Allowed mime types 
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
     
    // Validate whether selected file is a Excel file 
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){ 
         
        // If the file is uploaded 
        if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
            $reader = new Xlsx(); 
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']); 
            $worksheet = $spreadsheet->getActiveSheet();  
            $worksheet_arr = $worksheet->toArray(); 
 
            // Remove header row 
            unset($worksheet_arr[0]); 
 
            foreach($worksheet_arr as $row){ 
                $so_serial = $row[0]; 
                $mahang = $row[1]; 
                $tenhang = $row[2]; 
                $ngayxuat = $row[3]; 
                $thoihanbh = $row[4]; 
 
                // Check whether member already exists in the database with the same email 
                $prevQuery = "SELECT id FROM members WHERE email = '".$email."'"; 
                $prevResult = $db->query($prevQuery); 
                 
                if($prevResult->num_rows > 0){ 
                    // Update member data in the database 
                    $db->query("UPDATE members SET so_serial= '".$so_serial."', mahang = '".$mahang."', tenhang = '".$tenhang."', ngayxuat = '".$ngayxuat."', thoihanbh = '".$thoihanbh."', modified = NOW() WHERE email = '".$email."'"); 
                }else{ 
                    // Insert member data in the database 
                    $db->query("INSERT INTO members (sitename, so_serial, mahang, tenhang, ngayxuat, thoihanbh,  status, created, modified) VALUES ('".$so_serial."', '".$mahang."', '".$tenhang."', '".$ngayxuat."', '".$thoihanbh."', NOW(), NOW())"); 
                } 
            } 
             
            $qstring = '?status=succ'; 
        }else{ 
            $qstring = '?status=err'; 
        } 
    }else{ 
        $qstring = '?status=invalid_file'; 
    } 
} 
 
// Redirect to the listing page 
header("Location: index.php".$qstring); 
 
?>