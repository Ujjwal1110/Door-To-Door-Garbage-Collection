<?php
include 'config/config.php';

$OnDemand_select = $_SESSION['OnDemandselect'];
$OnDemand_fromdate = $_SESSION['OnDemanddatefrom'];
$OnDemand_todate = $_SESSION['OnDemanddateto'];

// echo 'complaint_fromdate: ' .
//     $complaint_fromdate .
//     ' complaint_todate: ' .
//     $complaint_todate;

if ($OnDemand_select == 'Open') {
    $sql =
        "SELECT areacodeid , pickupdatetime , material , quantitykg , status , created_at FROM `ondemand_binpickup` WHERE date_format(created_at, '%Y-%m-%d') between (:fromdate) and (:todate) AND status='OPEN'";
    $db = getDb();
    $query = $db->prepare($sql);
    $query->bindParam('fromdate', $OnDemand_fromdate, PDO::PARAM_STR);
    $query->bindParam('todate', $OnDemand_todate, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
} elseif ($OnDemand_select == 'Closed') {
    $sql =
        "SELECT areacodeid , pickupdatetime , material , quantitykg , status , created_at FROM `ondemand_binpickup` WHERE date_format(created_at, '%Y-%m-%d') between (:fromdate) and (:todate) AND status='CLOSED'";
    $db = getDb();
    $query = $db->prepare($sql);
    $query->bindParam('fromdate', $OnDemand_fromdate, PDO::PARAM_STR);
    $query->bindParam('todate', $OnDemand_todate, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
} elseif ($OnDemand_select == 'Inprogress') {
    $sql =
        "SELECT areacodeid , pickupdatetime , material , quantitykg , status , created_at FROM `ondemand_binpickup` WHERE date_format(created_at, '%Y-%m-%d') between (:fromdate) and (:todate) AND status='INPROGRESS'";
    $db = getDb();
    $query = $db->prepare($sql);
    $query->bindParam('fromdate', $OnDemand_fromdate, PDO::PARAM_STR);
    $query->bindParam('todate', $OnDemand_todate, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
} else {
    $sql =
        'SELECT areacodeid , pickupdatetime , material , quantitykg , status , created_at FROM `ondemand_binpickup` ORDER BY id ASC';
    $db = getDb();
    $query = $db->prepare($sql);
    $query->bindParam('fromdate', $OnDemand_fromdate, PDO::PARAM_STR);
    $query->bindParam('todate', $OnDemand_todate, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
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

<title>Smart Eye | Robato Systems Pvt??Ltd</title>

<!-- Bootstrap -->
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->

<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="build/css/custom.min.css" rel="stylesheet">

<!-- For timestamp -->
<link href=???https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css??? rel=???stylesheet???> 
<link href=???https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css??? rel=???stylesheet???>
<!-- For timestamp end -->
</head>

<body>
<div class="container body">
<div class="main_container">
<!-- Page content Started -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
                        
                  <!-- OnDemad PickUP Data  -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>OnDemand PickUp Report Details<small><?php echo 'From date: ' .$OnDemand_fromdate .' To date: ' .$OnDemand_todate; ?></small></h2>
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
                                                            <th>Area code</th>
                                                            <th>PickUp Date & Time</th>
                                                            <th>Material Type</th>
                                                            <th>Quantity</th>
                                                            <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>
                                                    <?php
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach (
                                                    $results
                                                    as $result
                                                ) { ?>
                                                    <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $result->areacodeid; ?></td>
                                                    <td><?php echo $result->pickupdatetime; ?></td>
                                                    <td><?php echo $result->material; ?></td>
                                                    <td><?php echo $result->quantitykg; ?></td>  
                                                    <td><?php echo $result->status; ?></td>  
                                                    </tr>
                                        
                                               </tbody>
                                               <?php $cnt = $cnt + 1;}
                                            }
                                            ?>
                                                       
                                                    </tbody>
                                                
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>
                </div>
                <!--OnDemand  Data End -->
               
                
        </div>
    </div>
<!-- Page content Ended -->

        <!-- footer content -->
        <!-- <footer>
            <div class="pull-right">
            System created by Robato Systems Pvt. ltd. <a href="https://robatosystems.com/">Robato Systems</a>
            </div>
            <div class="clearfix"></div>
        </footer> -->
        <!-- /footer content -->
</div>
</div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<!-- for timestamp -->
<script src=???https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js???></script> 
<script src=???https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js???></script>
<script type=???text/javascript??? src=???https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js???></script>
<script src=???https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js???> </script>
</body>
</html>
