<h1>Input Kategori Barang</h1>
<form method="post" action="">
	<label>
		<span>Kategori</span> <input type="text" name="kategori"/>
	</label>
	<label>
		<span>Keterangan</span> <textarea name="keterangan" rows="5"></textarea>
	</label>
	<input type="submit" name="submit" value="input"/>
</form>
<?php

	if (!empty($_POST)){
	
		if(isset($_POST['submit'],$_POST['kategori'],$_POST['keterangan'])){
			
			$kategori = $_POST['kategori'];
			$keterangan = $_POST['keterangan'];
		
			if(!empty($kategori) && !empty($keterangan)){
				$insert = $connect -> prepare("INSERT INTO tblkategori (kategori,keterangan) VALUES(?,?)");
				$insert -> bind_param('ss',$kategori,$keterangan);	
				
				if($insert->execute()){
					header("location: ?menu=1&mode=1&page=1&data=1");
					die();
				}
			
			}	
		}
	}

?>