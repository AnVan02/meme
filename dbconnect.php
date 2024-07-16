<?php
function dbconnect(){
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "hanghoa";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT  SoSerial, MaHang, TenHang, NgayXuat, ThoiHanBH FROM sanpham";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
    // if ($result->num_rows > 0) {
    //   // output data of each row
    //   while($row = $result->fetch_assoc()) {
    //     echo "SoSerial: ".$row["SoSerial"]."<br>";
    //         echo "MaHang: " . $row["MaHang"]. "<br>";
    //         echo "TenHang: " . $row["TenHang"]. "<br>";
    //         echo "NgayXuat: " . $row["NgayXuat"]. "<br>";
    //         echo "ThoiHanBH: " . $row["ThoiHanBH"]. "<br>";
    //         echo "------------------------------<br>";
    //   }
    // } else {
    //   echo "0 results";
    // }

};

?>

