<?php
	
	$data = $_GET['data'];
	$records= array();
	if($result = $connect -> query("SELECT * FROM tblkategori WHERE kategori = '$data'")) {
		while($r = $result -> fetch_object()) {
			$records[] = $r;
		}
		$result -> free();
	}
	
	foreach($records as $row) {
?>

<h1>Ubah Kategori Barang</h1>
<form method="post" action="">
	<label>
		<span>Kategori</span> <input type="text" name="kategori" value="<?php echo $row -> kategori; ?>"/>
	</label>
	<label>
		<span>Keterangan</span> <textarea name="keterangan" rows="5"><?php echo $row -> keterangan; ?></textarea>
	</label>
	<input type="submit" name="submit" value="Ubah"/>
</form>

<?php

	}
	
	if(!empty($_POST)) {
		if(isset($_POST['submit'])) {
			$kategori = $_POST['kategori'];
			$keterangan = $_POST['keterangan'];
			
			$connect -> query("UPDATE tblkategori SET kategori = '$kategori' , keterangan = '$keterangan' WHERE kategori = '$data'");
			
			header("location: ?menu=1&mode=1&page=1&data=1");
		}
	}
	
?>