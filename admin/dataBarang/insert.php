<h1>Input Data Barang</h1>
<?php

	$record = array();
	
	if($result = $connect -> query("SELECT * FROM tblkategori")) {
		if($result -> num_rows) {
			while($row = $result -> fetch_object()) {
				$record[] = $row;
			}
			$result -> free();
		}
	}

?>
<form method="post" action="" enctype="multipart/form-data">
	<select name="kategori">
		<option>Pilih Kategori</option>
		<?php
			foreach($record as $r) {
				$rr = $r -> kategori;
				echo "<option>$rr</option>";
			}
		?>
	</select>
	<label>
		<span>Id Barang</span> <input type="text" name="id"/>
	</label>
	<label>
		<span>Nama Barang</span> <input type="text" name="barang"/>
	</label>
	<label>
		<span>Harga Barang</span> <input type="text" name="harga"/>
	</label>
	<label>
		<span>Jumlah Barang</span> <input type="text" name="jumlah"/>
	</label>
	<label>
		<span>Deskripsi Barang</span> <textarea name="keterangan" rows="5"></textarea>
	</label>
	<label>
		<span>Foto Barang</span> <input type="file" name="file"/>
	</label>
	<input type="submit" name="submit" value="input"/>
</form>
<?php

	if(!empty($_POST) && !empty($_FILES)) {
		
		if(isset($_POST['submit'],$_POST['id'],$_POST['barang'],$_POST['harga'],$_POST['jumlah'],$_POST['keterangan'],$_POST['kategori'],$_FILES['file'])) {
		
			$id = $_POST['id'];
			$barang = $_POST['barang'];
			$harga = $_POST['harga'];
			$jumlah = $_POST['jumlah'];
			$keterangan = $_POST['keterangan'];
			$kategori = $_POST['kategori'];
			$file = $_FILES['file'];
			
			$fileName = $file['name'];
			$fileTmp = $file['tmp_name'];
			$fileSize = $file['size'];
			$fileError = $file['error'];
			
			$fileExt = explode('.', $fileName);
			$fileExt = strtolower(end($fileExt));
			
			$allowed = array('jpg', 'jpeg', 'png', 'bmp');
			
			if(!empty($id) && !empty($barang) && !empty($harga) && !empty($jumlah) && !empty($keterangan) && !empty($kategori) && !empty($file)) {
			
				if(in_array($fileExt, $allowed)) {
				
					$fileDestination = 'image/' . $fileName;
					$insert = $connect -> prepare("INSERT INTO tblbarang (idBarang,namaBarang,deskripsi,kategori,jumlah,harga,foto) VALUES(?,?,?,?,?,?,?)");
					$insert -> bind_param('ssssiis',$id,$barang,$keterangan,$kategori,$jumlah,$harga,$fileDestination);
					
					if(move_uploaded_file($fileTmp, $fileDestination)) {
						if($insert ->execute()) {
							header("location: ?menu=2&mode=1&page=1&data=1");
							die();
						}		
					}
				}
			}
		}
	}
	
	if(isset($_POST['s'])) {
		$file = $_FILES['file'];
		
		print_r($file);
	}

?>