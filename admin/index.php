<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../style/style.css">
	</head>
	<body>
		<?php
		
			require_once("../connect/connect.php");
	
		?>
		<section class="balok b1">
			<ul>
				<li>Barang
					<ul>
						<li><a href="?menu=1&mode=1&page=1&data=1">Kategori</a></li>
						<li><a href="?menu=2&mode=1&page=1&data=1">Data Barang</a></li>
					</ul>
				</li>
				<li>Transaksi
					<ul>
						<li><a href="?menu=3&mode=1&page=1&data=1">Pembelian</a></li>
						<li><a href="?menu=4&mode=1&page=1&data=1">Pembayaran</a></li>
						<li><a href="?menu=5&mode=1&page=1&data=1">Pelanggan</a></li>
					</ul>
				</li>
				<li>Laporan
					<ul>
						<li><a href="?menu=6&mode=1&page=1&data=1">Laporan Pembelian</a></li>
						<li><a href="?menu=7&mode=1&page=1&data=1">Laporan Pembayaran</a></li>
					</ul>
				</li>
				<li>Utilitas
					<ul>
						<li><a href="?menu=8&mode=1&page=1&data=1">Identitas</a></li>
						<li><a href="?menu=9&mode=1&page=1&data=1">User</a></li>
					</ul>
				</li>
			</ul>
		</section>
		<section class="header b2">
			<h1>Admin Page</h1>
		</section>
		<section class="balok b2">
			<?php
				
				$data = 3;
				
				if(!isset($_GET['page'])) {
					$mulai = 0;
					$hal = 1;
				}
				else {
					$mulai = ($_GET['page']-1) * $data;
					$hal = $_GET['page'];
				}
				
				if(isset($_GET['menu'],$_GET['mode'],$_GET['page'],$_GET['data'])) {
					$menu = $_GET['menu'];
					$mode = $_GET['mode'];
					$page = $_GET['page'];
					
					
					switch($menu) {
						case 1:
							$dir = "kategori";
							global $dir;
							break;
						case 2:
							$dir = "dataBarang";
							global $dir;
							break;
						case 3:
							$dir = "pembelian";
							global $dir;
							break;
						case 4:
							$dir = "pembayaran";
							global $dir;
							break;
						case 5:
							$dir = "pelanggan";
							break;
						case 6:
							$dir = "laporanPembelian";
							break;
						case 7:
							$dir = "laporanPembayaran";
							break;
						case 8:
							$dir = "identitas";
							break;
						case 9:
							$dir = "user";
							break;
					}
					
					switch($mode) {
						case 1: 
							$file = "select.php";
							global $file;
							break;
						case 2: 
							$file = "insert.php";
							global $file;
							break;
						case 3: 
							$file = "update.php";
							global $file;
							break;
						case 4: 
							$file = "delete.php";
							global $file;
							break;
					}
					
					require_once($dir."/".$file);
				}
				else {
					
					require_once("kategori/select.php");
				}
			
			?>
		</section>
	</body>
</html>