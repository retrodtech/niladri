<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(isset($_POST['loginSubmit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password)){

        if(isset($_POST['username'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = mysqli_query($conDB, "select * from admin where username = '$username'");
              if(mysqli_num_rows($sql)>0){
      
                $sql = mysqli_query($conDB, "select * from admin where username = '$username' and password = '$password'");
      
                if(mysqli_num_rows($sql)>0){
                    $sql = mysqli_query($conDB, "select * from admin where username = '$username' and password = '$password' and status='1'");
                    if(mysqli_num_rows($sql) > 0){
                      $row = mysqli_fetch_assoc($sql);
                      $admin_name = $row['name'];
                      $_SESSION['ADMIN_ID']= $row['id'];
                        $_SESSION['ADMIN_NAME']= $row['name'];
                      
                      $_SESSION['SuccessMsg'] = "Welcome to ".$admin_name;
                        redirect('index.php');
      
                    }else{
                      $_SESSION['ErrorMsg'] = "Deactivate your account!";
                        redirect('login.php');
                    }
                }else{
                    $_SESSION['ErrorMsg'] = "Password not match!";
                    redirect('login.php');
                }
            }else{
                $_SESSION['ErrorMsg'] = "Username not exist!";
                redirect('login.php');
            }
          }else{
            redirect('login.php');
            die();
          }
    }
}


if(isset($_GET['username']) && isset($_GET['pass'])){
    $username = $_GET['username'];
    $password = $_GET['pass'];



    $sql = mysqli_query($conDB, "select * from admin where username = '$username'");
          if(mysqli_num_rows($sql)>0){
  
            $sql = mysqli_query($conDB, "select * from admin where username = '$username' and password = '$password'");
  
            if(mysqli_num_rows($sql)>0){
                $sql = mysqli_query($conDB, "select * from admin where username = '$username' and password = '$password' and status='1'");
                if(mysqli_num_rows($sql) > 0){
                  $row = mysqli_fetch_assoc($sql);
                  $admin_name = $row['name'];
                  $_SESSION['ADMIN_ID']= $row['id'];
                    $_SESSION['ADMIN_NAME']= $row['name'];
                  
                  $_SESSION['SuccessMsg'] = "Welcome to ".$admin_name;
                    redirect('index.php');
  
                }else{
                  $_SESSION['ErrorMsg'] = "Deactivate your account!";
                    redirect('login.php');
                }
            }else{
                $_SESSION['ErrorMsg'] = "Password not match!";
                redirect('login.php');
            }
        }else{
            $_SESSION['ErrorMsg'] = "Username not exist!";
            redirect('login.php');
        }

}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="favicons/img-apple-icon.png">
    <link rel="icon" type="image/png" href="favicons/img-favicon.png">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <meta name="twitter:card" content="">
    <meta name="twitter:site" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image" content="">

    <meta property="fb:app_id" content="">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property=" og:description" content="">
    <meta property="og:site_name" content="">

    <title> </title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">
    <link href="css/svg.css" rel="stylesheet">
    <link id="pagestyle" href="css/getbootstrap.css" rel="stylesheet">
    <link id="pagestyle" href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">


</head>

<body class="g-sidenav-show  bg-gray-100">

    <?php include(SERVER_ADMIN_SCREEN_PATH.'sidebar.php') ?>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">


        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="post">
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email"
                                                aria-label="Email" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" aria-label="Password" name="password">
                                        </div>
                                        <div class="text-center">
                                                <input class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" type="submit" name="loginSubmit" value="Sign in">
                                            
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Contact Us</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                                <img src="<?php echo FRONT_SITE_IMG ?>pattern-lines.svg" alt="pattern-lines"
                                    class="position-absolute opacity-4 start-0">
                                <div class="position-relative">
                                    <img class="max-width-500 w-100 position-relative z-index-2"
                                        src="<?php echo FRONT_SITE_IMG ?>chat.png" alt="chat-img">
                                </div>
                                <h4 style="font-size: 2.5rem;margin-bottom: 3rem;" class="mt-5 text-white font-weight-bolder">"One Platform To Manage Everything"</h4>
                                <p style="font-size: 1.5rem;font-weight: 700; " class="text-white">Sell anywhere, to anyone, with one platform.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>



    <?php include(SERVER_ADMIN_SCREEN_PATH.'script.php') ?>







    <script>
        $('#navTopBar').hide();
        $('#sidenav-main').hide();
        $('.nav-link').removeClass('active');
        $('.amenitiesLink').addClass('active');
        $('.roomLink').addClass('active');
    </script>




</body>

</html>