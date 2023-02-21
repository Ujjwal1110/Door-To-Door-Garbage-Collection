<?php

include 'config/config.php';
if (strlen($_SESSION['property_id']) == 0) {
    header('location:index.php');
}
else{
  // Read Property Name
  $property_id = $_SESSION['property_id'];
  $sql = "SELECT citizenname  FROM property WHERE id='$property_id'";
  $db = getDb();
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_OBJ);
  $citizennameis = $result->citizenname;
  $db = null;

  if (isset($_POST['submit'])) {
      $PickupDateTime = $_POST['pickupdatetime'];
      $maTerial = $_POST['material'];
      $quantityKG = $_POST['quantitykg'];
      $Areacode = $_SESSION['property_areacode'];
      $status = 'Open';
      $citizenid = $_SESSION['property_citizenid'];
    

      $sql = "INSERT INTO ondemand_binpickup(pickupdatetime, material, quantitykg, areacodeid, citizenid, status) 
                                  VALUES(:PickupDateTime, :maTerial, :quantityKG, :Areacode, :citizenid, :status)";
      $db = getDb();
      $query = $db->prepare($sql);
      $query->bindParam(':PickupDateTime', $PickupDateTime, PDO::PARAM_STR);
      $query->bindParam(':maTerial', $maTerial, PDO::PARAM_STR);
      $query->bindParam(':quantityKG', $quantityKG, PDO::PARAM_STR);
      $query->bindParam(':Areacode', $Areacode, PDO::PARAM_STR);
      $query->bindParam(':citizenid', $citizenid, PDO::PARAM_STR);
      $query->bindParam(':status', $status, PDO::PARAM_STR);
      if ($query->execute()) {
          echo '<script>alert("On Demand Pickup Request")</script>';
          echo "<script type='text/javascript'> document.location = 'Demand_pickup.php'; </script>";
      } else {
          echo 'Not updating';
      }
      $db = null;
  }
  // Getting Id For Updating the form
  if (isset($_GET['Editdemand'])) {
      $id = $_GET['Editdemand'];
  }

}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="" type="image/ico" />

    <title>Smart Eye | Robato Systems Pvt Ltd </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
<div class="container body">
  <div class="main_container">
          <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
              <div class="navbar nav_title" style="border: 0;">
                <a href="Homepage.php" class="site_title"> <span><i class="fa fa-trash"></i> Smart Eye</span></a>
              </div>

              <div class="clearfix"></div>

              <!-- menu profile quick info -->
              <div class="profile clearfix">
                <div class="profile_pic">
                <a href="Homepage.php"> <img style="width:70px;" src="images/citizen.png" alt="user animated image" class="img-circle profile_img"></a>
                </div>
                <div class="profile_info">
                <span style="color: white;"><?php echo $citizennameis; ?></span>
                <div class="d-flex">
                          <h2><i class="fa fa-circle-thin ml-2" style="background-color:green; border-radius:20px;" ></i> Active</h2>                 
                       
                          </div> 
                </div>
              </div>
              <!-- /menu profile quick info -->

              <br />

              <!-- sidebar menu -->
              <?php include './sidebar.php'; ?>
              <!-- /sidebar menu -->

              <!-- /menu footer buttons -->
              <div class="sidebar-footer hidden-small">
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="index.php">
                  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </a>
              </div>
              <!-- /menu footer buttons -->
            </div>
          </div>

        <!-- top navigation -->
          <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="images/user.png" alt=""><?php echo $citizennameis; ?>

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                   
                      <a class="dropdown-item"  href="index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->
    

      
<!-- Page content Started -->
<div class="right_col" role="main">
			<div class="">
        <div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>On Demand Pickup<small></small></h2>
                  <h2 style="margin-left:180px;"></h2>
                  <!-- <a href="NewUser.php" ><button  style="margin-left: 250px; " class="btn btn-primary btn-sm">New User</button></a> -->
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
								<form method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                          <!-- <?php
                          $db = getDb();
                          $stmt = $db->prepare('SELECT * FROM property');
                          $stmt->execute();
                          $clients = $stmt->fetchAll(PDO::FETCH_OBJ);
                          $cnt = 1;
                          $db = null;

                          foreach ($clients as $userDetail) { ?>
                                                    
                            <option value="<?php echo $userDetail->citizenid; ?>"><?php echo $userDetail->citizenid; ?>--<?php echo $userDetail->citizenname; ?></option>                                             
                           <?php $cnt = $cnt + 1;}
                          ?> -->
                       
                          </select>
											</div>
									</div> 

                  <?php
                  $sql = "SELECT pickupdatetime, material, quantitykg, areacodeid FROM `ondemand_binpickup` WHERE id=$id";
                  $db = getDb();
                  $query = $db->prepare($sql);
                  $query->execute();
                  $editresult = $query->fetch(PDO::FETCH_OBJ);
                  $db = null;
                  ?>
                        
                     <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Date & Time <span class="required">*</span>
											</label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="datetime-local" id="birthdaytime" autocomplete="off" name="pickupdatetime" class="form-control " value="<?php echo $editresult->pickupdatetime; ?>">  
											</div>
										</div>


										<!-- <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Material <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" name="material" autocomplete="off" required="required" class="form-control " value="<?php echo $editresult->material; ?>">
											</div>
										</div> -->
                    <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Material <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                        <select name="material" id="first-name" required="required" class="form-control " value="<?php echo $editresult->material; ?>">
                        <option value="Dry & Wet" >Dry & Wet</option>
                        <option value="Wet Garbage" >Wet Garbage</option>
                        <option value="Dry Garbage" >Dry Garbage</option>
                        </select>
											
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Quantity<span class="required">*</span>
											</label>

                      <div class="col-md-6 col-sm-6">
                        <!-- <label class="sr-only" for="inlineFormInputGroupUsername">Username</label> -->
                        <div class="input-group">
                          <input type="number" class="form-control" name="quantitykg" placeholder="0" required value="<?php echo $editresult->quantitykg; ?>">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Kg</div>
                          </div>
                        </div>
                      </div>
										</div>
                  
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-5">
											
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
											</div>
										</div>

								</form>
								</div>
							</div>

              <!-- Another Form -->
              <div class="x_panel">
                    <div class="x_title">
                      <h2>PickUp Details<small> </small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                         
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                        <div class="x_content">
                          <br />
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                          <div class="card-box table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                        <th>SNo</th>
                                                        <th>Material</th>
                                                        <th>Quantity</th>
                                                        <th>Area Code</th>
                                                        <th>PickUp Date & Time</th>
                                                        <th>Action</th>
                                                        <th>status</th>
                                                        </tr>
                                                    </thead>
                                          <tbody>
                                            <?php
                                            $db = getDb();
                                            $stmt = $db->prepare(
                                                'SELECT * FROM `ondemand_binpickup` ORDER BY id DESC'
                                            );
                                            $stmt->execute();
                                            $clients = $stmt->fetchAll(
                                                PDO::FETCH_OBJ
                                            );
                                            $cnt = 1;
                                            $db = null;
                                            foreach ($clients as $userDetail) { $pickupdatetime = str_replace(
                                                    ':00',
                                                    ' ',
                                                    $PickDT
                                                ); ?>
                                                    <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $userDetail->material; ?></td>
                                                    <td><?php echo $userDetail->quantitykg; ?></td>
                                                    <td><?php echo $userDetail->areacodeid; ?></td>
                                                    <td><?php echo date(
                                                        'jS \of F Y',
                                                        strtotime(
                                                            $userDetail->pickupdatetime
                                                        )
                                                    ); ?></td>
                                                    <td class="d-flex">
                                                    <a href="demand_pickup_update.php?Editdemand=<?php echo $userDetail->id; ?>" class="btn btn-success">Edit</a>
                                                
                                                    </td>    
                                                    <td><?php echo $userDetail->status; ?></td>                                            
                                                    </tr>
                                        
                                          </tbody>
                                               <?php $cnt = $cnt + 1;
                                            }
                                            ?>
                                            </table>
                                          </div>
                                        </div>
                                    </div>
                                </div>
								         </div>
							   </div>
							</div>
              <!-- Another Form End -->
						</div>
				</div>
      </div>
    </div>
<!-- Page content Ended -->

            <!-- footer content -->
            <footer>
              <div class="pull-right">
                System created by Robato Systems Pvt. ltd. <a href="https://robatosystems.com/">Robato Systems</a>
              </div>
              <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
    </div>
  </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
	
  </body>
</html>
