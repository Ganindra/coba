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
	
	$result = $connect -> query("SELECT * FROM tblbarang");
	$total = $result -> num_rows;
	$jumhal = ceil($total/$data);
	
?>
<h1>Data Barang</h1>
<a href="?menu=2&mode=2&page=1&data=1">Tambah Data Barang</a>
<?php
	$barang = array();
	
	$query = "SELECT * FROM tblbarang LEFT JOIN tblkategori ON
	tblbarang.kategori = tblkategori.kategori LIMIT $mulai,$data";
	
	if($result = $connect -> query($query)) {
		if($result -> num_rows) {
			while($row = $result -> fetch_object()) {
				$barang[] = $row;
			}
			$result -> free();
		}
	}

	if(isset($_POST['submitKategori'])) {
		$select = $_POST['select'];
		
		$query = "SELECT * FROM tblbarang LEFT JOIN tblkategori ON
		tblbarang.kategori = tblkategori.kategori
		WHERE tblbarang.kategori = '$select'";
		
		$barang = array();
		if($result = $connect -> query($query)) {
			if($result -> num_rows) {
				while($row = $result -> fetch_object()) {
					$barang[] = $row;
				}
				$result -> free();
			}
		}
	}
?>
<form action="" method="post">
	<select name="select">
		<?php
			foreach($record as $r) {
				echo "<option value='$r->kategori'>$r->kategori</option>";
			}
		?>
	</select>
	<input type="submit" value="Cari" name="submitKategori"/>
</form>
<table>
	<tr>
		<th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Kategori</th>
		<th>Harga</th>
		<th>Jumlah</th>
		<th>Deskripsi</th>
		<th>Foto</th>
		<th>Ubah</th>
		<th>Hapus</th>
	</tr>
	<?php
		$n = $mulai + 1;
		foreach($barang as $r) {
	?>
	<tr>
		<td><?php echo $n++; ?></td>
		<td><?php echo $r -> idBarang; ?></td>
		<td><?php echo $r -> namaBarang; ?></td>
		<td><?php echo $r -> kategori; ?></td>
		<td><?php echo $r -> harga; ?></td>
		<td><?php echo $r -> jumlah; ?></td>
		<td><?php echo $r -> deskripsi; ?></td>
		<td><img src="<?php echo $r -> foto; ?>"/></td>
		<td><a href="?menu=2&mode=3&page=1&data=<?php echo $r -> idBarang; ?>">Ubah</a></td>
		<td><a href="?menu=2&mode=4&page=1&data=<?php echo $r -> idBarang; ?>">Hapus</a></td>
	</tr>
	<?php
		}
	?>
</table>
	<section class="page-nav">
		<?php
			if($hal > 1) {
				echo "<a href='?menu=2&mode=1&page=";
				echo $hal - 1;
				echo "&data=1'>PREV</a>&emsp;";
			}
			
			for($i=1; $i<=$jumhal; $i++) {
				echo "<a href='?menu=2&mode=1&page=$i&data=1'>$i</a>&emsp;";
			}
			
			if($hal < $jumhal) {
				echo "<a href='?menu=2&mode=1&page=";
				echo $hal + 1;
				echo "&data=1'>NEXT</a>";
			}
		?>
	</section>