<?php
	
	if(isset($_GET['data'])) {
		$data = $_GET['data'];
		$query = "SELECT * FROM tblbarang WHERE idBarang = '$data'";
		
		if($result = $connect -> query($query)) {
			if($result -> num_rows) {
				$r = $result -> fetch_object();
				
				$id = $r -> idBarang;
				$barang = $r -> namaBarang;
				$kategori = $r -> kategori;
				$deskripsi = $r -> deskripsi;
				$harga = $r -> harga;
				$jumlah = $r -> jumlah;
				$foto = $r -> foto;
				
				$result -> free();
			}
		}
	}
	
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
<h1>Ubah Data Barang</h1>
<form method="post" action="" enctype="multipart/form-data">
	<label>
		<span>Kategori</span>
		<select name="kategori">
			<?php
				foreach($record as $r) {
					if($r -> kategori == $kategori) {
						echo "<option selected>$r->kategori</option>";
					}
					else {
						echo "<option>$r->kategori</option>";
					}
				}
			?>
		</select>
	</label>
	<label>
		<span>Id Barang</span> <input type="text" name="id" value="<?php echo $id; ?>"/>
	</label>
	<label>
		<span>Nama Barang</span> <input type="text" name="barang" value="<?php echo $barang; ?>"/>
	</label>
	<label>
		<span>Harga Barang</span> <input type="text" name="harga" value="<?php echo $harga; ?>"/>
	</label>
	<label>
		<span>Jumlah Barang</span> <input type="text" name="jumlah" value="<?php echo $jumlah; ?>"/>
	</label>
	<label>
		<span>Deskripsi Barang</span> <textarea name="deskripsi" rows="5"><?php echo $deskripsi; ?></textarea>
	</label>
	<input type="file" name="file"/>
	<input type="submit" name="submit"/>
</form>
<?php
	if(isset($_FILES['file'])){
		$file = $_FILES['file'];
		
		$fileName = $file['name'];
		$fileTmp = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileDestination = 'image/' . $fileName;
		if(move_uploaded_file($fileTmp, $fileDestination)) {
		
		}
	}
?>
<?php
	if(!empty($_POST)) {
		if(isset($_POST['submit'],$_POST['id'],$_POST['barang'],$_POST['kategori'],$_POST['harga'],$_POST['jumlah'],$_POST['deskripsi'])) {
			$id = $_POST['id'];
			$barang = $_POST['barang'];
			$harga = $_POST['harga'];
			$jumlah = $_POST['jumlah'];
			$kategori = $_POST['kategori'];
			$deskripsi = $_POST['deskripsi'];
			global $fileDestination;
			
			if(!empty($id) && !empty($barang) && !empty($harga) && !empty($jumlah) && !empty($deskripsi) && !empty($kategori)) {
				$connect -> query("UPDATE tblbarang SET idBarang = '$id', 
				namaBarang = '$barang', kategori = '$kategori', 
				harga = '$harga', jumlah = '$jumlah', 
				deskripsi = '$deskripsi', foto = '$fileDestination' 
				WHERE idBarang = '$data'");
				
				header("location: ?menu=2&mode=1&page=1&data=1");
				die();
			}
		}
	}

?>