<?php
include 'dbconnect.php';

?>

  <head>
    <title>Công ty Cổ Phần tin học Viết Sơn</title>
    <meta name="keywords" content="Công ty Cổ Phần tin học Viết Sơn"/>
    <meta name="description" content="Công ty Cổ Phần tin học Viết Sơn"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
		<script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
		<script type="text/javascript"></script>
		<style type="main.css"></style>

<div class="bg-yellow text-black dark:bg-zinc-900 dark:text-white">
  <header class="bg-blue-700 text-white p-4 flex justify-between items-center">
    <div class="flex items-center">
      <img src="https://placehold.co/100x50?text=Logo" alt="Company Logo" class="mr-4" />
      <nav class="flex space-x-4">
        <a href="#" class="hover:underline">Trang chủ</a>
        <a href="#" class="hover:underline">Sản phẩm</a>
        <a href="#" class="hover:underline">Tin tức</a>
        <a href="#" class="hover:underline">Chính sách đại lý</a>
        <a href="#" class="hover:underline">Check Serial</a>
        <a href="#" class="hover:underline">Hỗ trợ</a>
      </nav>
    </div>
  
  </header>
  
  <main class="p-4">
    <div class="flex justify-between items-center mb-4">
      <div class="flex items-center">
        <button class="bg-blue-600 text-yellow px-3 py-1 rounded">DANH MỤC SẢN PHẨM</button>
      </div>
    </div>

    <div class="border border-zinc-300 p-4 rounded mb-4">
      <form name="test" action="#" method="POST">
        <input name="search" type="text" placeholder="NHẬP MÃ SERIAL CẦN TÌM" class="border border-zinc-300 p-2 rounded w-full" />
      </form>
    </div>
    <?php
     if(isset($_POST['search'])) {
        $search=$_POST['search'];
        $result = dbconnect();
        $flag = 0;
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
                if ( $row["SoSerial"] === $search) {
                  $flag = 1; 
                  echo "SoSerial: ".$row["SoSerial"]."<br>";
                  echo "MaHang: " . $row["MaHang"]. "<br>";
                  echo "TenHang: " . $row["TenHang"]. "<br>";
                  echo "NgayXuat: " . $row["NgayXuat"]. "<br>";
                  echo "ThoiHanBH: " . $row["ThoiHanBH"]. "<br>";
                  echo "------------------------------<br>";
                }
          }
        }
        if ($flag == 0)
          echo 'Không tìm thấy '.$search.' trong cơ sở dữ liệu';
      }
    ?>
    
<script type="project.js"></script>

