<?php 
include 'header.php';
include 'navigation.php';
include 'class/db.php';
include 'class/controller.php';
$object = new Controller;
$stmt = $object->getDrugById($_GET['id']);
?>

<div class="container">
	<?php
		if($row = $stmt->fetch()){
	?>
	<div class="container">
		<button style="float:right;margin-left: 5px; width:10%;" class="btn btn-secondary">UPDATE</button>
		<button style="float:right;" class="btn btn-primary">ADD STOCK</button>	
		<h3>Viewing of Drug ID: <span><b>&nbsp;<?php echo $row['drug_id']; ?></b></span></h3>
	</div>
	<br>
	<div class="container">
		<div class="container-fluid">
			<div class="row">
			<div class="col-4">
				<span>Name of Drug :</span>
				<br>
					<?php echo ucfirst($row['drug_name']); ?>	
			</div>
			<div class="col-4">
				<span>Type of Drugs :</span>
				<br>
					<?php echo ucfirst($row['drug_type']); ?>
			</div>
			<div class="col-4">
				<span> Manufactured </span>
			<br>
				<?php
	                $convert = new DateTime($row["created_at"]); //create datetime object with received data
	                $date = $convert->format('M d, Y'); 
	                $time = $convert->format('h:m A');
	                echo "<small>Date : &nbsp;<strong>".$date."</strong> &nbsp; Time: &nbsp;<strong>".$time."</strong></small>";
            	?>
            	</div>
            <div class="col-6">
            	<br>
				<span>Price : 
					<strong style="font-family:DejaVu Sans Mono; font-size:16px;">
						<u>P <?php echo ucfirst($row['drug_price']);  ?>.00</u>
					</strong>
				</span>
			</div>
			<div class="col-lg-12">
				<hr>
				<span style="font-size:22px;"><b>Description :</b></span>
				<br>
					&emsp;&emsp;&emsp;<?php echo ucfirst($row['drug_description']); ?>
				<hr>
			</div>
			</div>
		</div>
	</div>
		
	<?php
		}
	?>
</div>

<?php 
include 'footer.php';
?>