
<?php 
  include 'header.php';
  include 'navigation.php';
?>

        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Avail Info.</h1>
            <a href="avail.php" class="btn btn-primary h3 btn-lg"><span class="fa fa-back"> </span><b>BACK</b></a>
          </div>
          <!-- Content Row -->
          <div class="row">
            <div class="col-sm-6">
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM core3_med_avail 
                    INNER JOIN core3_med_pack
                    ON core3_med_avail.med_pack_id = core3_med_pack.id
                    INNER JOIN core3_med_pack_inc 
                    ON core3_med_pack.id = core3_med_pack_inc.med_pack_id
                    WHERE core3_med_avail.id = '".$id."'";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_array($result)){
            ?> 
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray"><b>Patient Name: </b> <?php echo $row['patient_name']; ?></h4>
            </div>
             <h5 class="mb-0 text-gray"><b>Department: </b> <?php echo $row['department']; ?></h5>
             <br>
             <br>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 text-gray"><b>Package </b></h4>
            </div>
            <h5 class="mb-0 text-gray"><b>Package Name: </b> <?php echo $row['mp_name']; ?></h5>
            <h5 class="mb-0 text-gray"><b>Package Price: </b> <?php echo $row['mp_price']; ?></h5>
            <h5 class="mb-0 text-gray"><b>Package Descption: </b> <?php echo $row['mp_desc']; ?></h5>
            
          </div>
          <?php 
                 
        }else{
              echo 'error';
          } ?> 
          <div class="col-sm-6">
          <h4 class="mb-0 text-gray-800"><b>Inclusion(s)</b></h4><br>
            <?php 
            $result1 = mysqli_query($conn, $sql);
            while($rows = mysqli_fetch_array($result1)){ ?>
            <h5 class='mb-0 text-gray-800'><?php echo $rows['testname']; ?></h5>
            <?php
            } ?>
            </div>
          </div>
      <!-- End of Main Content -->
      <?php 
  include 'footer.php';
?>