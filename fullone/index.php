<?php require 'config.php'; ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Import Excel To MySQL</title>
	</head>
	<body>
		<form class="" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="excel" required value="">
			<button type="submit" name="import">Import</button>
		</form>
		<hr>
		<table border = 1>
			<tr>
			<th>So serial</th>
                <th>MaHang</th>
                <th>TenHang</th>
                <th>NgayXuat</th>
                <th>ThoiHanBH</th>
			</tr>
			<?php
			$i = 1;
			$rows = mysqli_query($conn, "SELECT FROM tb_sanpham");
			$result = $conn->query($sql);
			$conn->close();
			foreach($rows as $row) :
			?>
			<tr>
				<td><?php echo $row['SoSerial']; ?></td>
                <td><?php echo $row['MaHang']; ?></td>
                <td><?php echo $row['TenHang']; ?></td>
                <td><?php echo $row['NgayXuat']; ?></td>
                <td><?php echo $row['ThoiHanBH']; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
		if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$name = $row[0];
				$age = $row[1];
				$country = $row[2];
				mysqli_query($conn, "INSERT INTO tb_data VALUES('', '$name', '$age', '$country')");
			}

			echo
			"
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
		}
		?>
	</body>
</html>
