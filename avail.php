<?php 
  include 'header.php';
  include 'navigation.php';
?>
<div class="container">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">List of Avails</h1>
</div>
	<div class="card"><br>
<div>
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="float: right;margin-right: 10px;">Add Avail</button></div>
<br>

<table id="dt-basic-checkbox" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>#</th>
      <th class="th-sm">Patient Name
      </th>
      <th class="th-sm">Package Name
      </th>
      <th class="th-sm">Department
      </th>
      <th class="th-sm">Avail Date
      </th>
      <th class="th-sm">Action
      </th>
    </tr>
  </thead>
  <tbody>
  <?php
    // fetch table INNER JOIN core3_med_pack_inc ON core3_med_pack.id = core3_med_pack_inc.med_pack_id
			
    $count = 1;
    $sql = "SELECT * FROM core3_med_avail 
			INNER JOIN core3_med_pack
			ON core3_med_avail.med_pack_id = core3_med_pack.id
			";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
  ?>
    <tr>
      <td><?php echo $count++ ?></td>
      <td><?php echo $row['patient_name'] ?></td>
      <td><?php echo $row['mp_name'] ?></td>
      <td><?php echo $row['department'] ?></td>
      <td><?php echo date_format(date_create($row['created_at']),"F d, Y H:s a") ?></td>
      <td><a href="avail-view.php?id=<?php echo $row['0'] ?>"><span class="fa fa-eye"> </span> View</a></td>
    </tr>
    <?php
    }
    }
    else{
      echo" <td colspan='6' align='center'>No Data Found</td>";
    }
    ?>
  </tbody>
</table>
</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
 <form action="avail.php" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Patient Name:</label>
		  <input type="text" name="name" class="form-control" id="name">
		</div>
		<div class="form-group">
		  <label for="package">Patient Name:</label>
		  <select name="package" class="form-control">
		  	<option selected disabled>--SELECT PACKAGE--</option>
		  	<?php
		  	$sql = "SELECT * FROM core3_med_pack";
		  	$result = mysqli_query($conn, $sql);
    		if(mysqli_num_rows($result)>0){
		  	 while($row = mysqli_fetch_array($result)){
		  	 	echo "<option value='".$row['id']."' >".$row['mp_name']."</option>";
			  	}
			  }
		  	 ?>
		  	</select>
		  	<div class="form-group">
			  <label for="name">Department:</label>
			  <select name="department" class="form-control">
			  <option selected disabled>--SELECT DEPARTMENT--</option>
			  <option value="Inpatient" >Inpatient</option>
			  <option value="Outpatient" >Outpatient</option>
			</select>
			</div>

		  </select>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </div>
    </div>
</form>
  </div>
</div>
<?php 
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$package=mysqli_real_escape_string($conn,$_POST['package']);
	$department=mysqli_real_escape_string($conn,$_POST['department']);
	$sql = "INSERT INTO core3_med_avail(med_pack_id,patient_name,department,created_at)
			VALUES ('".$package."','".$name."','".$department."',NOW())";
	$result = mysqli_query($conn, $sql);
	if($result){
		echo "<script> Swal.fire('','Success','success').then(function(){
			location.href = 'avail.php'; }); </script>";
	}else{
		echo "<script> Swal.fire('','Error','error').then(function(){
			location.href = 'avail.php'; }); </script>";
	}
}	
  include 'footer.php';

?>