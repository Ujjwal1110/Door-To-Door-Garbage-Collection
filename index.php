<?php
include 'config/config.php';

if (isset($_POST['signin'])) {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];
    $db = getDb();
    $sql = 'SELECT id, username, areacode, citizenname, citizenid, flatno, streetno, city, state, pincode FROM property WHERE username=:username and password=:password';
    $query = $db->prepare($sql);
    $query->bindParam(':username', $admin_username, PDO::PARAM_STR);
    $query->bindParam(':password', $admin_password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    $db = null;
    if ($query->rowCount() > 0) {
        $_SESSION['property_id'] = $results->id;
        $_SESSION['property_username'] = $results->username;
        $_SESSION['property_areacode'] = $results->areacode;
        $_SESSION['property_citizenname'] = $results->citizenname;
        $_SESSION['property_citizenid'] = $results->citizenid;
        $address= $results->flatno.', '.$results->streetno.', '.$results->city.', '.$results->state.', '.$results->pincode;
        $_SESSION['property_address']= $address;
        
        echo "<script type='text/javascript'> document.location = 'Homepage.php'; </script>";
    } else {
        echo '<script>alert("Invalid login Username or Password")</script>';
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

    <title>Smart Eye | Robato Systems Pvt Ltd</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
               
                <button class="btn btn-default submit" name="signin" >Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa "></i> Robato Systems</h1>
                  <p>Creted By Robato Systems Pvt. ltd. . Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit"  href="index.php">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin"  class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa "></i> Robato Systems</h1>
                  <p>Creted By Robato Systems Pvt. ltd. . Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
