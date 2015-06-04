<?php

	session_start();
	
	require_once('connect/connect.php');
	
	if(isset($_GET['beli'])){
		if(empty($_SESSION['cart'][$_GET['beli']])){
			$_SESSION['cart'][$_GET['beli']]['jumlah']=1;
			header("location: index.php");
		}else{
			$id = $_GET['beli'];
			$query="SELECT * FROM tblbarang WHERE idBarang = '$id'";
			$result = $connect -> query ($query);
			$row = $result -> fetch_assoc();
			if($row['jumlah'] > $_SESSION['cart'][$_GET['beli']]['jumlah']){
				$_SESSION['cart'][$_GET['beli']]['jumlah']+=1;
				if(!isset($_GET['checkOut'])) {
					header("location: index.php");
				}
				else {
					header("location: index.php?checkOut");
				}
			}
		}
	}
	
	if(isset($_GET['remove']) and $_SESSION['cart'][$_GET['remove']]['jumlah'] > 0){
		$_SESSION['cart'][$_GET['remove']]['jumlah']--;
		if(isset($_GET['checkOut'])) {
			header("location: index.php?checkOut");
		}
		else {
			header("location: index.php");
		}
	}
	
	if(isset($_GET['delete'])){
		unset($_SESSION['cart'][$_GET['delete']]);
		if(isset($_GET['checkOut'])) {
			if(empty($_SESSION['cart'])) {
				header("location: index.php");
			}
			else {
				header("location: index.php?checkOut");
			}
		}
	}
	
	function cart(){
		global $connect;
		
		if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])) {
			echo "
				<table>
				<tr>
					<th>Nama Barang</th>
					<th>Jumlah</th>
					<th>Total Harga</th>
				</tr>
			";
			
			foreach($_SESSION['cart'] as $name => $value){
				$query = "SELECT * FROM tblbarang WHERE idBarang = '$name'";
				$result = $connect -> query($query);
				
				if($_SESSION['cart'][$name]['jumlah'] > 0){
					while($row = $result -> fetch_assoc()){
						$sub = $value['jumlah'] * $row['harga'];
						$_SESSION['cart'][$name]['harga'] = $sub;
						
						echo "<tr><td>";
						echo $row['namaBarang'];
						echo "</td><td>";
						echo "<a href='?beli=".$row['idBarang']."'>[+]</a> ".$value['jumlah']." <a href='?remove=".$row['idBarang']."'>[-]</a>";
						echo "</td><td>";
						echo "Rp " . number_format($sub,0,',','.');
						echo "</td></tr>";
					}
				}	
				else {
					unset($_SESSION['cart'][$name]);
					die();
				}
			}
			
			function multi_array($total, $next) {
				$total += $next['harga'];
				return $total;
			}
			
			$totalCost = array_reduce($_SESSION['cart'],'multi_array');
			
			echo "
				<tr>
					<th colspan='2'>Jumlah Keseluruhan</th>
					<td>Rp " . 
						number_format($totalCost,0,',','.').
					"</td>
				</tr>
				</table>
				<a href='?checkOut'>Check Out</a>
			";
		}
		else {
			echo "cart masih kosong";
		}
	}
	
	function products(){
		global $connect, $mulai, $data;
		$query = ("SELECT * FROM tblbarang WHERE jumlah > 0 ORDER BY namaBarang ASC LIMIT $mulai,$data");
		$result= $connect->query($query);
		if($result->num_rows){
			while($row = $result->fetch_array()){
			
				echo "<article>";
				echo "<img src='admin/".$row[6]."'/>";
				echo "<a href='#'>".$row[1]."</a>";
				echo "<span>Rp ".number_format($row[5],0,',','.')."</span>";
				echo "<a href='?beli=$row[0]' class='buy'> Beli </a>";
				echo "</article>";
			}
		}else{
			echo "Stok Kosong";
		}
	}
	
	
	
?>