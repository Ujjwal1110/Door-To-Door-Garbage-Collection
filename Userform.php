<?php
include 'config/config.php';

$property_id = $_SESSION['property_id'];
$sql = "SELECT citizenname  FROM property WHERE id='$property_id'";
$db = getDb();
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
$citizennameis = $result->citizenname;
$db = null;

if ($_REQUEST['Editdemand']) {
    $id = $_REQUEST['Editdemand'];
    $db = getDb();
    $stmt = $db->prepare(
        'SELECT id, propertytype, citizenid, citizenname, ownertype, phonenumber, email, areacodeid, flatno, city, membersince FROM users WHERE id=(:id)'
    );
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_OBJ);
    $db = null;
}

if (isset($_POST['submit'])) {
    $propertyType = $_POST['propertytype'];
    $citzId = $_POST['citizenid'];
    $citName = $_POST['citizenname'];
    $ownType = $_POST['ownertype'];
    $phNum = $_POST['phonenumber'];
    $eMail = $_POST['email'];
    $areaCode = $_POST['areacodeid'];
    $flatNo = $_POST['flatno'];
    $ciTy = $_POST['city'];
    $memberSince = $_POST['membersince'];

    $sql =
        'UPDATE users SET propertytype=(:propertyType), citizenid=(:citzId), citizenname=(:citName), phonenumber=(:phNum), ownertype=(:ownType), email=(:eMail), areacodeid=(:areaCode), flatno=(:flatNo), city=(:ciTy), membersince=(:memberSince) WHERE id=(:id)';
    $db = getDb();
    $query = $db->prepare($sql);
    $query->bindParam(':propertyType', $propertyType, PDO::PARAM_STR);
    $query->bindParam(':citName', $citName, PDO::PARAM_STR);
    $query->bindParam(':citzId', $citzId, PDO::PARAM_STR);
    $query->bindParam(':phNum', $phNum, PDO::PARAM_STR);
    $query->bindParam(':ownType', $ownType, PDO::PARAM_STR);
    $query->bindParam(':eMail', $eMail, PDO::PARAM_STR);
    $query->bindParam(':areaCode', $areaCode, PDO::PARAM_STR);
    $query->bindParam(':flatNo', $flatNo, PDO::PARAM_STR);
    $query->bindParam(':ciTy', $ciTy, PDO::PARAM_STR);
    $query->bindParam(':memberSince', $memberSince, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    if ($query->execute()) {
        echo '<script>alert("Data Updated")</script>';
        echo "<script type='text/javascript'> document.location = 'User_profile.php'; </script>";
    } else {
        echo 'Not updating';
    }
    $db = null;
}

// Getting Id For Updating the form
if (isset($_GET['Editdemand'])) {
    $id = $_GET['Editdemand'];
}

// echo $id;
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
									<h2>User Details<small></small></h2>
							
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
                  <?php
                  $sql = "SELECT * FROM `users` WHERE id='$id'";
                  $db = getDb();
                  $query = $db->prepare($sql);
                  $query->execute();
                  $editresult = $query->fetch(PDO::FETCH_OBJ);
                  $db = null;
                  ?>
									 <form method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                   <!-- <?php echo 'Proprty Type: 
                   '.$editresult->propertytype; ?> -->
                    
                    <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align">Property Type<span class="required">*</span>
											</label>
                      <div class="col-md-6 col-sm-6 ">
                      <select class="form-control" name="propertytype">
                      <option > Select</option>
                      <option <?php if($editresult->propertytype=="House") echo 'Selected';?> value="House">House</option>
                      <option <?php if($editresult->propertytype=="Flat") echo 'Selected';?> value="Flat">Flat</option>
                      <option <?php if($editresult->propertytype=="Resturant") echo 'Selected';?> value="Resturant">Resturant</option>
                      <option <?php if($editresult->propertytype=="Hotel") echo 'Selected';?> value="Hotel">Hotel</option>
                      </select>
                      </div>
                    </div>
                      <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Citizen Name<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" value="<?php echo $editresult->citizenname; ?>" autocomplete="off" name="citizenname" placeholder="Enter Your Name ">
											</div>
										</div>
                        <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align">Owner Type<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                      <select class="browser-default custom-select form-control"value="<?php echo $editresult->ownertype; ?>"  name="ownertype">
                                            <option selected>Select</option>
                                            <option <?php if ($editresult->ownertype =='Owner'
                                            ) {
                                                echo 'selected';
                                            } ?> value="Owner">Owner</option>
                                            <option <?php if (
                                                $editresult->ownertype ==
                                                'Tenant'
                                            ) {
                                                echo 'selected';
                                            } ?> value="Tenant">Tenant</option>
                                            <option <?php if (
                                                $editresult->ownertype ==
                                                'Manager'
                                            ) {
                                                echo 'selected';
                                            } ?> value="Manager">Manager</option>                     
                                            </select>
											</div>
										</div>
                      <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align"   for="first-name">Citizen Id <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control "  value="<?php echo $editresult->citizenid; ?>" autocomplete="off" name="citizenid" placeholder="Unique auto generated ID">
											</div>
										</div>
                       <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Phone Number <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" value="<?php echo $editresult->phonenumber; ?>" autocomplete="off" name="phonenumber" placeholder="Contact Number">
											</div>
										</div>
                    <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Email <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control" value="<?php echo $editresult->email; ?>" autocomplete="off" name="email" placeholder="Email">
											</div>
										</div>
                    
                       <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Area Code<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control " value="<?php echo $editresult->areacodeid; ?>" autocomplete="off" name="areacodeid" placeholder="Your Area Code">
											</div>
										</div>
                      <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Flat No/House No. <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control " value="<?php echo $editresult->flatno; ?>" autocomplete="off" name="flatno" placeholder="Flat No/House No. etc...">
											</div>
										</div>
                     
                        <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">City <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control " value="<?php echo $editresult->city; ?>" autocomplete="off" name="city" placeholder="Your City Name">
											</div>
										</div>
                      
                    <!-- <div class="item form-group">
											<label class="col-form-label col-md-4 col-sm-3 label-align">Member Since <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" value="<?php echo $editresult->membersince; ?>" name="membersince" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
												<script>
													function timeFunctionLong(input) {
														setTimeout(function() {
															input.type = 'text';
														}, 60000);
													}
												</script>
											</div>
										</div>	 -->
								
														
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-5">
												<button type="submit" name="submit" class="btn btn-success ml-6">Update</button>
											</div>
										</div>

									</form>
								</div>
							</div>
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
