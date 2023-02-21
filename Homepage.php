<?php
include 'config/config.php';
if (strlen($_SESSION['property_id']) == 0) {
    header('location:index.php');
}
else{
    
    $propertyid = $_SESSION['property_id'];
    $citizenid = $_SESSION['property_citizenid'];

    // Read Property QRCode
    $sql = "SELECT qrcode FROM property WHERE citizenid= '$citizenid' AND id= '$propertyid'";
    $db=getDb();        
    $query= $db -> prepare($sql);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    $qrcodeis = $results->qrcode;

    // Read Status of ondemand
    $sql = "SELECT status FROM ondemand_binpickup WHERE citizenid= '$citizenid' ORDER BY id DESC LIMIT 1";
    $db=getDb();        
    $query= $db -> prepare($sql);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    $ondemand_status = $results->status;

    // Read Property Name
    $property_id = $_SESSION['property_id'];
    $sql = "SELECT citizenname , citizenid FROM property WHERE id='$property_id'";
    $db = getDb();
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $citizennameis = $result->citizenname;
    $citizenidis = $result->citizenid;
    $db = null;
}
$NextPaymentDate="";

  //reading complaints count
    $property_id = $_SESSION['property_id'];
    $sql = "SELECT COUNT(*) as complaints FROM `ondemand_binpickup`";
    $db = getDb();
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $countComplain = $result->complaints;
    $db = null;

     // Check Payement Status
    $db = getDb();
    $Pendingcnt=0;
    $sql = "SELECT id, duedate, amount, penalty, servicestatus, paymentreminderscount FROM payments 
    WHERE citizenid=(:citizenid) AND servicestatus = 'Pending' ORDER BY id DESC";
    $query = $db->prepare($sql);
    $query->bindParam(':citizenid', $citizenid, PDO::PARAM_STR);
    $query->execute();
    $results_payment = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      foreach($results_payment as $results_payments){

        date_default_timezone_set('Asia/Kolkata');
        $current_date_time =   date('Y-m-d H:i:s');

        $paymentreminderscount = $results_payments->paymentreminderscount;
        $paymentreminderscount = $paymentreminderscount + 1;

        // Update Payment Reminder Count
        $sql="UPDATE payments SET paymentreminderscount='$paymentreminderscount', updated_at='$current_date_time'
                  WHERE id ='$results_payments->id'";
            $db=getDb();        
            $query_update= $db -> prepare($sql);
            if($query_update->execute()){
              $Pendingcnt = $Pendingcnt+1;
            }
      }
    }
    else{
      $Pendingcnt = '0';
    }

  // Read Next Payment Date - Upcoming Payment
    $sql = "SELECT id, duedate, paymentreminderscount FROM payments 
    WHERE citizenid=(:citizenid) AND servicestatus = 'Upcoming' ORDER BY id DESC LIMIT 1";
    $query = $db->prepare($sql);
    $query->bindParam(':citizenid', $citizenid, PDO::PARAM_STR);
    $query->execute();
    $results_payment = $query->fetch(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {

      date_default_timezone_set('Asia/Kolkata');
      $current_date_time =   date('Y-m-d H:i:s');

      $paymentreminderscount = $results_payment->paymentreminderscount;
      $paymentreminderscount = $paymentreminderscount + 1;

        // Update Payment Reminder Count
        $sql="UPDATE payments SET paymentreminderscount='$paymentreminderscount', updated_at='$current_date_time'
        WHERE id ='$results_payment->id'";
        $db=getDb();        
        $query_update= $db -> prepare($sql);
        if($query_update->execute()){
          $NextPaymentDate = $results_payment->duedate;
        }
    }
    elseif (empty($NextPaymentDate)) {
      $NextPaymentDate=$Pendingcnt.' Due payment Available';
    }
    else{
      $NextPaymentDate = "All Payment Cleared.";
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>

  </head>

  <body class="nav-md">


    <?php    
      if($NextPaymentDate != "All Payment Cleared." && $Pendingcnt > 0){
            echo "<script type ='text/JavaScript'>
            Swal.fire({
                icon: 'warning',
                title: 'Your Payments are Pending!',
                text: 'Please go to payments page and pay your pending and upcoming amount. THANKS',
                button: 'Aww yiss!',
            })
          </script>"; 
        }
        else if($Pendingcnt > 0){
            echo "<script type ='text/JavaScript'>
            Swal.fire({
                icon: 'warning',
                title: 'Your Payments are Pending!',
                text: 'Please go to payments page and pay your pending amount. THANKS',
                button: 'Aww yiss!',
            })
          </script>"; 
        }
      //   else if($NextPaymentDate = "All Paymenet Cleared."){
      //     echo "<script type ='text/JavaScript'>
      //     Swal.fire({
      //         icon: 'success',
      //         title: 'Payment cleared',
      //         text: 'We will notify you. THANK YOU ',
      //         button: 'Aww yiss!',
      //     })
      //   </script>"; 
      // }
    ?>


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

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
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
                <!-- top tiles -->
                  <div class="tile_count row">
                      <div class="col-md-3 col-sm-4  tile_stats_count ">
                        <span class="count_top"><i class="fa fa-calendar"></i> Next Payment Date</span>
                        <div class=" green ml-3"> <?php echo $NextPaymentDate; ?></div>
                      </div>
                      <div class="col-md-3 col-sm-4  tile_stats_count ">
                        <span class="count_top"><i class="fa fa-calendar"></i> Pending Payment Count</span>
                          <div class=" red ml-3"> <h5><a href="payment.php"><?php echo $Pendingcnt; ?></a></h5>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-4  tile_stats_count ">
                        <span class="count_top"><i class="fa fa-calendar"></i> On Demand Request Count</span>
                        <div class=" green ml-3"> Total Pickup Request:- <?php echo $countComplain; ?></div>
                      </div>
                      <div class="col-md-3 col-sm-4  tile_stats_count  ">
                        <span class="count_top"><i class="fa fa-user"></i> Last OnDemand Request Status</span>
                        <div class="<?php if($ondemand_status == "Closed"){ echo 'green'; } else if ($ondemand_status == "Open"){ echo 'red'; } else if ($ondemand_status == "Inprogress"){ echo 'blue'; } ?> ml-3">  <?php if($ondemand_status == "Closed"){ echo 'Completed'; } elseif(empty($ondemand_status))echo'No  logs found'; else { echo $ondemand_status; } ?></div>
                      </div>
              
                  </div>
     
               
          <!-- /top tiles -->
          <!-- Charts Started -->
                <div class="row">
                          <div class="col-md-8 col-sm-4 ">
                          
                              <div class="x_panel">
                                <div class="x_title">
                                  <h2>Payment Collection History Chart <br><small>( Monthly fees=>Rs.150 + Penalty fees=>Rs.20 ) Payments=> <i style="color:#27ae60;" class="fa fa-stop"> Paid</i>  <i style ="color:#ae2b27" class="fa fa-stop"> Pending</i>  <i style ="color:#2747ae" class="fa fa-stop"> Upcoming</i></small> </h2>
                                  <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                               
                                    </li>
                                  </ul>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div id="chart"></div>
                                </div>
                              </div>
                      
                          </div>
                          <div class="col-md-4 col-sm-6 ">
                          
                              <div class="x_panel tile fixed_height_320 overflow_hidden" style="height:460px;">
                                <div class="x_title">
                                  <h2>Citizen Unique QR Code</h2>
                                  <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    
                                    </li>
                                  </ul>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                  <div class="container-fluid">
                                      <div class="text-center">
                                        <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $qrcodeis; ?>&chs=220x220&chld=L|0" class="qr-code img-thumbnail img-responsive mt-3" />
                                      </div>
                                  </div>  
                                </div>    
                                <div style="text-align:center; color:black; ">
                                  <?php  echo "<h6>Citizen id :" . $citizenidis."</h6>"; ?></span>
                                  </div>                       
                              </div> 
                              </div>
                          </div>

                         
                          <div class="col-md-12 col-sm-4  ">
                            <div class="x_panel tile fixed_height_320">
                            <div class="x_title">
                                <h2>Garbage Collection History </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up ml-5"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="mybarChart"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>


<!-- //Qr Code -->
<script>
  function htmlEncode(value) {
    return $('<div/>').text(value)
      .html();
  }

  $(function () {
    $('#generate').click(function () {

      let finalURL =
  'https://chart.googleapis.com/chart?cht=qr&chl=' +
        htmlEncode($('#content').val()) +
        '&chs=160x160&chld=L|0'
      $('.qr-code').attr('src', finalURL);
    });
  });
</script>


 
    <!-- All Charts Load -->
    


    <script>
            $(document).ready(function(){

            function Chart_data(){
                    $.ajax({
                    url: "api/paymenthistory.php",
                    success: function(response)
                    {  
                        console.log('Data is: '+JSON.parse(response));
                      var output = JSON.parse(response);

                      // Payment Chart Load
                      var options = {
                          series: [{
                            name: 'Total Amount: Rs.',
                            data: output.payments
                          }],
                            chart: {
                            height: 350,
                            type: 'bar',
                          },
                          plotOptions: {
                            bar: {
                              borderRadius: 10,
                              distributed : true,
                              dataLabels: {
                                position: 'top', // top, center, bottom
                              },
                            }
                          },
                          colors: output.color,
                          dataLabels: {
                            enabled: true,
                            formatter: function (val) {
                              return val + "";
                            },
                            offsetY: -20,
                            style: {
                              fontSize: '12px',
                              colors: ["#304758"]
                            }
                          },
                          
                          xaxis: {
                            categories: output.category,
                            position: 'top',
                            axisBorder: {
                              show: false
                            },
                            axisTicks: {
                              show: false
                            },
                            crosshairs: {
                              fill: {
                                type: 'gradient',
                                gradient: {
                                  colorFrom: '#D8E3F0',
                                  colorTo: '#BED1E6',
                                  stops: [0, 100],
                                  opacityFrom: 0.4,
                                  opacityTo: 0.5,
                                }
                              }
                            },
                            tooltip: {
                              enabled: true,
                            }
                          },
                          yaxis: {
                            axisBorder: {
                              show: false
                            },
                            axisTicks: {
                              show: false,
                            },
                            labels: {
                              show: false,
                              formatter: function (val) {
                                return val + "";
                              }
                            }
                          
                          },
                          title: {
                            // text: 'Monthly Payment History Collection Chart, '+output.year,
                            floating: true,
                            offsetY: 330,
                            align: 'center',
                            style: {
                              color: '#444'
                            }
                          }
                        };
                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();

                    }
                });
            }

            
            function Chart_data_dry_wet(){
                    $.ajax({
                    url: "api/dry_wet_garbage.php",
                    success: function(response)
                    {  
                        console.log('Data is: '+JSON.parse(response));
                      var output = JSON.parse(response);

                      var options = {
                            series: [{
                                name: 'Dry Garbage',
                                data: output.dry
                            }, {
                                name: 'Wet Garbage',
                                data: output.wet
                            }],
                            chart: {
                                type: 'bar',
                                height: 250

                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '55%',
                                    endingShape: 'rounded',

                                },
                            },
                            dataLabels: {
                                enabled: false

                            },
                            stroke: {
                                show: true,
                                width: 2,
                                colors: ['transparent']
                            },
                            xaxis: {
                                categories: output.catg,
                            },
                            yaxis: {
                                title: {
                                    text: 'Dry and Wet Garbage Collection'
                                }
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val) {
                                        return val+ ' kg'
                                    }
                                }
                            }
                        };

                      var chart = new ApexCharts(document.querySelector("#mybarChart"), options);
                      chart.render();

                    }
                });
            }

            Chart_data();
            Chart_data_dry_wet();
        });
    </script> 	



  </body>
</html>
