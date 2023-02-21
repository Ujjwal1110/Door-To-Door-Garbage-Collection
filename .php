<?php
include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="" type="image/ico" />

    <title>Smart Eye | Robato Systems Pvt Ltd </title>

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
                <span style="color: white;">Welcome UJJWAL</span>
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
                      <img src="images/user.png" alt="">UJJWAL

                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                   
                      <a class="dropdown-item"  href="index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>

                  <li role="presentation" class="nav-item dropdown open">
                
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
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
                          <h2>Payment Report<small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                              
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <br />
                          <form id="demo-form2" required="required" data-parsley-validate class="form-horizontal form-label-left">
                                                

                                            <div class="row">
                                                
                                                  <div class="col-xs-6 col-md-2">
                                                    
                                                    <select class="browser-default custom-select" required>
                                                    <option selected>All</option>
                                                    <option value="1">Paid</option>
                                                    <option value="2">Pending</option>
                                                    <option value="3">Uncoming</option>
                                                    </select>
                                                    </div>
                                                <div class="col-xs-6 col-md-4">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-6 col-sm-5 label-align">Payment Date From<span >*</span>
                                                            </label>
                                                            <div class="col-lg-6 col-md-3 ">
                                                                <input id="birthday" class="date-picker form-control" name="datefrom" required placeholder="dd-mm-yyyy" type="text"  type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function() {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-6 col-sm-5 label-align">Payment Date To<span >*</span>
                                                            </label>
                                                            <div class="col-lg-6 col-md-3 ">
                                                                <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function() {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                </div>
                                              <div class="col-xs-6 col-md-2">
                                                <div class="item form-group">
                                                  <div class="col-md-6 col-sm-6">
                                                  <a href="PaymentRepo.php" class="btn btn-success" name="submit"> Submit</a>
                                                  <!-- <button class="btn btn-success" name="submit" >Submit</button> -->
                                                  </div>
                                                </div>
                                              </div>
                                            </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Complaint Report<small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                           
                              
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <br />
                          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                

                                            <div class="row">
                                                
                                                <div class="col-xs-6 col-md-2">
                                                    
                                                    <select class="browser-default custom-select">
                                                    <option selected>All</option>
                                                    <option value="1">Closed</option>
                                                    <option value="2">Open</option>
                                                    <option value="3">Inprogress</option>
                                                    </select>
                                                    </div>
                                                <div class="col-xs-6 col-md-4">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-6 col-sm-5 label-align">Date From<span class="required">*</span>
                                                            </label>
                                                            <div class="col-lg-6 col-md-3 ">
                                                                <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function() {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                        <div class="item form-group">
                                                            <label class="col-form-label col-md-6 col-sm-5 label-align">Date To<span class="required">*</span>
                                                            </label>
                                                            <div class="col-lg-6 col-md-3 ">
                                                                <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function() {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-xs-6 col-md-2">
                                                    <div class="item form-group">
                                                      <div class="col-md-6 col-sm-6">
                                                      <a href="compRepo.php" class="btn btn-success"> Submit</a>
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>On Demand Request Report<small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <br />
                          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                

                              <div class="row">
                                  
                                    <div class="col-xs-6 col-md-2">
                                      
                                      <select class="browser-default custom-select">
                                      <option selected>All</option>
                                      <option value="1">Closed</option>
                                      <option value="2">Open</option>
                                      <option value="3">Inprogress</option>
                                      </select>
                                    </div>
                                  <div class="col-xs-6 col-md-4">
                                          <div class="item form-group">
                                              <label class="col-form-label col-md-6 col-sm-5 label-align">Date From<span class="required">*</span>
                                              </label>
                                              <div class="col-lg-6 col-md-3 ">
                                                  <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                  <script>
                                                      function timeFunctionLong(input) {
                                                          setTimeout(function() {
                                                              input.type = 'text';
                                                          }, 60000);
                                                      }
                                                  </script>
                                              </div>
                                          </div>
                                  </div>
                                  <div class="col-xs-6 col-md-4">
                                          <div class="item form-group">
                                              <label class="col-form-label col-md-6 col-sm-5 label-align"> Date To<span class="required">*</span>
                                              </label>
                                              <div class="col-lg-6 col-md-3 ">
                                                  <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                  <script>
                                                      function timeFunctionLong(input) {
                                                          setTimeout(function() {
                                                              input.type = 'text';
                                                          }, 60000);
                                                      }
                                                  </script>
                                              </div>
                                          </div>
                                  </div>
                                  <div class="col-xs-6 col-md-2">
                                    <div class="item form-group">
                                      <div class="col-md-6 col-sm-6">
                                       <a href="OndemandRepo.php" class="btn btn-success"> Submit</a>
                                      </div>
                                    </div>
                                  </div>

                              </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 col-sm-12 ">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Garbage Collection Report<small></small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                              
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <br />
                          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                

                              <div class="row">
                                  
                                    <div class="col-xs-6 col-md-2">
                                      
                                      <select class="browser-default custom-select">
                                      <option selected>All</option>
                                      <option value="1">Pending</option>
                                      <option value="2">Collected</option>
                                      
                                      </select>
                                    </div>
                                  <div class="col-xs-6 col-md-4">
                                          <div class="item form-group">
                                              <label class="col-form-label col-md-6 col-sm-5 label-align">Date From<span class="required">*</span>
                                              </label>
                                              <div class="col-lg-6 col-md-3 ">
                                                  <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                  <script>
                                                      function timeFunctionLong(input) {
                                                          setTimeout(function() {
                                                              input.type = 'text';
                                                          }, 60000);
                                                      }
                                                  </script>
                                              </div>
                                          </div>
                                  </div>
                                  <div class="col-xs-6 col-md-4">
                                          <div class="item form-group">
                                              <label class="col-form-label col-md-6 col-sm-5 label-align"> Date To<span class="required">*</span>
                                              </label>
                                              <div class="col-lg-6 col-md-3 ">
                                                  <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                  <script>
                                                      function timeFunctionLong(input) {
                                                          setTimeout(function() {
                                                              input.type = 'text';
                                                          }, 60000);
                                                      }
                                                  </script>
                                              </div>
                                          </div>
                                  </div>
                                  <div class="col-xs-6 col-md-2">
                                    <div class="item form-group">
                                      <div class="col-md-6 col-sm-6">
                                       <a href="GarbageRepo.php" class="btn btn-success"> Submit</a>
                                      </div>
                                    </div>
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
