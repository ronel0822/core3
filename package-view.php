
<?php 
  include 'header.php';
  include 'navigation.php';
?>

   <?php  /*
 $id = $_GET['id'];
 $sql ="DELETE FROM core3_med_pack WHERE id ='".$id."'; DELETE FROM core3_med_pack_inc WHERE med_pack_id = '".$id."'" ;
 $result3 = mysqli_query($conn,$sql);
 if($result3){
  echo "<script> Swal.fire('','Success','success').then(function(){
      location.href = 'package-list.php'; }); </script>";
 }else{
  echo "<script> Swal.fire('','Error','error'); </script>";
 }
*/
 if(isset($_POST['submit'])){
 $id = $_GET['id'];
 $sql = "DELETE core3_med_pack_inc, core3_med_pack FROM core3_med_pack INNER JOIN core3_med_pack_inc ON core3_med_pack.id = core3_med_pack_inc.med_pack_id WHERE core3_med_pack.id = '".$id."' ";
 $result3 = mysqli_query($conn,$sql);
 if($result3){
   echo "<script> Swal.fire('','Success','success').then(function(){
      location.href = 'package-list.php'; }); </script>";
 }else{
  echo "<script> Swal.fire('','Error','error'); </script>";
 }
}

    ?>
        <div class="container-fluid">

          <!-- Page Heading -->
          
          
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM CORE3_med_pack 
                    INNER JOIN core3_med_pack_inc 
                    ON CORE3_med_pack.id = core3_med_pack_inc.med_pack_id
                    WHERE core3_med_pack.id = '".$id."'";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_array($result)){
            ?> 
            <div class="col-md 8">
            <a  href="package-list.php" button class="btn btn-primary text-white"  style="float:right; ">BACK</a>
            <form action="package-view.php" method="GET">
            <button class="btn btn-danger" type="submit" name="delete"  style="float:right;">Delete Package</button>
            </form>
             <button class="btn btn-success "  style="float:right;">Update Package</button>

             <h1 class="h3 mb-4 text-gray-800">Package Info.</h1>
            </div>
            <div class="row">
          <div class="col-sm-6">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray-800"><b>Package Name: </b> <?php echo $row['mp_name']; ?></h4><br>
            </div>
            <h5 class="mb-0 text-gray-800"><b>Package Price: </b> <?php echo $row['mp_price']; ?></h4><br>
            <h5 class="mb-0 text-gray-800"><b>Package Descption: </b> <?php echo $row['mp_desc']; ?></h4><br>
            <br><br>
          <?php 
                 
        }else{
              echo 'error';
          } ?> 
           </div>
          <div class="col-sm-6">
          <h5 class="mb-0 text-gray-800">Inclusion(s)</h4><br>
            <?php 
            $result1 = mysqli_query($conn, $sql);
            while($rows = mysqli_fetch_array($result1)){ ?>
            <h5 class='mb-0 text-gray-800'><?php echo $rows['testname']; ?></h5><br>
            <?php
            } ?>
            </div>
            </div>
          <!-- Content Row -->
          <div class="row"></div>
      <!-- End of Main Content -->
      <?php 
 

  include 'footer.php';
?>