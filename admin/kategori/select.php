<?php
	$records = array();
	
	$results1 = $connect -> query("SELECT * FROM tblkategori");
	$total = $results1 -> num_rows;
	
	$jumhal = ceil($total/$data);
	
	if($results = $connect -> query("SELECT * FROM tblkategori LIMIT $mulai,$data")){
		if($results -> num_rows){
			while($row = $results -> fetch_object()){
				$records[] = $row;
			}
			$results -> free();
		}
	}
	
	
	
?>
<h1>Kategori</h1>
<a href="?menu=1&mode=2&page=1&data=1">Tambah Kategori</a>
<?php
	echo 'Jumlah data : '.$total;
?>
<table>
	<tr>
		<th>No</th>
		<th>Kategori</th>
		<th>Keterangan</th>
		<th>Ubah</th>
		<th>Hapus</th>
	</tr>
	<?php
		$n = $mulai + 1;
		foreach($records as $r) {
	?>
	<tr>
		<td><?php echo $n++; ?></td>
		<td><?php echo $r -> kategori; ?></td>
		<td><?php echo $r -> keterangan; ?></td>
		<td><a href="?menu=1&mode=3&page=1&data=<?php echo $r -> kategori; ?>">Ubah</a></td>
		<td><a href="?menu=1&mode=4&page=1&data=<?php echo $r -> kategori; ?>">Hapus</a></td>
	</tr>
	<?php
		}
	?>
</table>
	<section class="page-nav">
		<?php
			if ($hal > 1) {
				echo "<a href='?menu=1&mode=1&page=";
				echo $hal - 1;
				echo "&data=1'>PREV</a>&emsp;";
			}
			
			for ($i=1; $i<=$jumhal; $i++) {
				echo "<a href='?menu=1&mode=1&page=$i&data=1'>$i</a>&emsp;";
			}
			
			if ($hal < $jumhal) {
				echo "<a href='?menu=1&mode=1&page=";
				echo $hal + 1;
				echo "&data=1'>NEXT</a>";
			}
		?>
	</section>