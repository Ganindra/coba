<!DOCTYPE html>
<?php
	
	require_once('connect/connect.php');
	require_once('function/cart.php');
	
	$data = 8;
	
	if(!isset($_GET['page'])) {
		$mulai = 0;
		$hal = 1;
	}
	else {
		$mulai = ($_GET['page']-1) * $data;
		$hal = $_GET['page'];
	}
	
	$result = $connect -> query("SELECT * FROM tblbarang");
	$total = $result -> num_rows;
	$jumhal = ceil($total/$data);
	
?>
<html>
	<head>
		<link rel="stylesheet" href="style/main.css"/>
		<title>Ganang Shop</title>
	</head>
	<body>
		<?php
		if(!isset($_GET['checkOut'])) {
		?>
		<div>
			<header>
				<section class="cart">
				</section>
			</header>
			<section class="container">
				<section class="main">
					<section class="slider">
					</section>
					<article>
						<?php 
							products();
							echo "<br/>";
							if($hal > 1) {
								echo "<a href='?page=";
								echo $hal - 1;
								echo "'>PREV</a>&emsp;";
							}
							
							for($i=1; $i<=$jumhal; $i++) {
								echo "<a href='?page=$i'>$i</a>&emsp;";
							}
							
							if($hal < $jumhal) {
								echo "<a href='?page=";
								echo $hal + 1;
								echo "'>NEXT</a>";
							}
						?>
					</article>
				</section>
				<aside>
					<?php 
						cart();
					?>
				</aside>
			</section>
			<footer>
			
			</footer>
		</div>
		<?php
		}
		else {
		?>
		<div class="checkout">
			<section>
				<?php
					foreach($_SESSION['cart'] as $name => $value){
						$query = "SELECT * FROM tblbarang WHERE idBarang = '$name'";
						$result = $connect -> query($query);
						if($_SESSION['cart'][$name]['jumlah'] > 0){
							while($row = $result -> fetch_assoc()){
								$sub = $value['jumlah'] * $row['harga'];
								$_SESSION['cart'][$name]['harga'] = $sub;
								
								echo "<section>";
								echo "<h4>".$row['namaBarang']."<a href='?checkOut&delete=".$row['idBarang']."' class='x'>X</a></h4>";
								echo "<p>Jumlah : <a href='?checkOut&beli=".$row['idBarang']."'>[+]</a> ".$value['jumlah']." <a href='?checkOut&remove=".$row['idBarang']."'>[-]</a></p>";
								echo "<p>Harga : Rp ".number_format($value['harga'],0,',','.')."</p>";
								echo "</section>";
							}
						}	
						else {
							unset($_SESSION['cart'][$name]);
						}
					}
					if(empty($_SESSION['cart'])) {
						header('location: index.php');
					}
				?>
				<a href="index.php" class="kembali">Kembali Belanja</a>
			</section>
		</div>
		<?php
		}
		?>
	</body>
</html>