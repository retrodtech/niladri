<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}

$couponCode = '';
$couponType = '';
$minVal = '';
$expireOn = '';
$couponValue = '';
$btn = 'Add Coupon';
$header_text = 'Add Coupon';
$disable = '';

if(isset($_GET['update'])){
    $id = $_GET['update'];
    $header_text = 'Update Coupon';
    $disable = 'disabled';
    $sql = mysqli_query($conDB, "select * from couponcode where id = '$id'");
    if(mysqli_num_rows($sql) > 0){
        $update_row = mysqli_fetch_assoc($sql);
        $uid = $update_row['id'];
        $couponCode = $update_row['coupon_code'];
        // $couponType = $update_row['coupon_type'];
        $minVal = $update_row['min_value'];
        $expireOn = $update_row['expire_on'];
        $couponValue = $update_row['coupon_value'];
        $btn = 'Update Coupon';

        if(isset($_POST['submit'])){
            $minVal = $_POST['minVal'];
            $expireOn = $_POST['expireOn'];
            $sql = "update couponcode set min_value='$minVal', expire_on='$expireOn' where id = '$id'";
            if(mysqli_query($conDB,$sql)){
                $_SESSION['SuccessMsg'] = "Coupon Code Successfully Update";
                redirect('coupon_code.php');
            }
        }

    }else{
        $_SESSION['ErrorMsg'] = "Coupon Id not exist";
        redirect('coupon_code.php');
    }
    
}else{
    if(isset($_POST['submit'])){
        $couponCode = $_POST['couponCode'];
        // $couponType = $_POST['couponType'];
        $minVal = $_POST['minVal'];
        $expireOn = $_POST['expireOn'];
        $couponValue = $_POST['couponValue'];

        if($expireOn >= date('Y-m-d')){
            $sql = "insert into couponcode(coupon_code,coupon_type,min_value,coupon_value,expire_on) value('$couponCode','P','$minVal','$couponValue','$expireOn')";
            if(mysqli_query($conDB,$sql)){
                $_SESSION['SuccessMsg'] = "Coupon Code Successfully Added";
                redirect('coupon_code.php');
            }
        }else{
            $_SESSION['ErrorMsg'] = "Please Select Future Date";
            die();
        }

    }
}



if(isset($_GET['status'])){
    $sid = $_GET['status'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from couponcode where id='$sid'"));
    if($sql['status'] == 1){
        mysqli_query($conDB, "update couponcode set status = '0' where id='$sid'");
        $_SESSION['SuccessMsg'] = "Successfull Status Change";
        redirect('coupon_code.php');
    }else{
        mysqli_query($conDB, "update couponcode set status = '1' where id='$sid'");
        $_SESSION['SuccessMsg'] = "Successfull Status Change";
        redirect('coupon_code.php');
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

  <title>Coupon Code</title>

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

    <?php include(SERVER_ADMIN_SCREEN_PATH.'navbar.php') ?>

        <div class="container-fluid">
            <div class="page-header min-height-140 border-radius-xl mt-4"
                style="background-image: url('<?php echo FRONT_SITE_IMG.'headerBg.webp' ?>'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                Coupon Code
                            </h5>
                            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                <li class="breadcrumb-item text-sm">
                                    <a class="opacity-3 text-dark" href="javascript:;.html">
                                    <svg width="12px" height="12px" class="mb-1" viewbox="0 0 45 40" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>shop </title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1716.000000, -439.000000)" fill="#252f40" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path
                                                d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path
                                                d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                            </g>
                                        </g>
                                        </g>
                                    </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?php echo FRONT_BOOKING_SITE ?>">Home</a></li>
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Coupon Code</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid py-4" id="manage_room">

            <div class="row">
                <div class="col-12">
                    <div class="multisteps-form">
                        

                        <div class="row">
                            <div class="col-12 col-lg-8 m-auto">
                            <?php echo SuccessMsg(); echo ErrorMsg() ?>
                            <!-- <a href="<?php echo FRONT_BOOKING_SITE.'/admin/list-room.php' ?>" class="btn dark mb15">Manage Room</a> -->
                                <form action="" id="manageForm" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="couponCode">Coupon Code</label>
                                        <input <?php echo $disable ?> required class="form-control" type="text" id="couponCode" name="couponCode" placeholder="Enter Coupon Code." value="<?php echo $couponCode ?>">
                                    </div>
                                    <!--<div class="form-group">-->
                                    <!--    <label for="couponType">Coupon Type</label>-->
                                    <!--    <select <?php echo $disable ?> required class="form-control" name="couponType" id="couponType">-->
                                    <!--        <option value="">Select Coupon Type</option>-->
                                            <?php
                                            
                                                // $coupontype = ['P' => 'Percentage','F' => 'Fixed'];
                                                // foreach($coupontype as $key=>$val){
                                                //     echo "<option value='$key'>$val</option>";
                                                // }
                                            
                                            ?>
                                    <!--    </select>-->
                                    <!--</div>-->
                                    
                                    <div class="row p0">
                                        <div class="form-group col-md-6">
                                            <label for="minVal">Minimum Price</label>
                                            <input required class="form-control" type="number" id="minVal" name="minVal" placeholder="Enter Minimum Value." value="<?php echo $minVal ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="expireOn">Expire On</label>
                                            <input required class="form-control" type="date" id="expireOn" name="expireOn" value="<?php echo $expireOn ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="couponValue">Coupon Percentage</label>
                                        <input <?php echo $disable ?> required class="form-control" type="number" id="couponValue" name="couponValue" placeholder="Enter Coupon Value." value="<?php echo $couponValue ?>">
                                    </div>

                                    <div class="s25"></div>
                                    
                                    <div id="add_content"></div>
                                    <button class="btn bg-gradient-primary mb-0 mt-lg-auto" type="submit" name="submit"><?php echo $btn ?></button>
                                    <div class="s25"></div>
                                    <div class="s25"></div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-10 offset-md-1" style="background: white;box-shadow: 0 5px 25px #00000040;padding: 30px 20px;border-radius: 10px;">
                            <?php echo SuccessMsg(); echo ErrorMsg() ?>
                            <!-- <a href="<?php echo FRONT_BOOKING_SITE.'/admin/manage-room.php' ?>" class="btn dark mb15">Add Room</a> -->
                                <div class="table table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <tr>
                                            <th width="5%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SI</th>
                                            <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Coupon Code</th>
                                            <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">coupon Type</th>
                                            <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Coupon Value</th>
                                            <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Minimum value</th>
                                            <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expire On</th>
                                            <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        </tr>
                                        <?php 
                                            $si = 0;
                                            $sql = mysqli_query($conDB, "select * from couponcode");
                                            if(mysqli_num_rows($sql) > 0){
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $si++;
                                                    $id = $row['id'];
                                                    $time = formatingDate($row['add_on']);
                                                    if($row['status'] == 1){
                                                        $status = "<a class='tableIcon status bg-gradient-success deactive' href='coupon_code.php?status=$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Deactive'><i class='far fa-eye'></i></a>";
                                                    }else{
                                                        $status = "<a class='tableIcon status bg-gradient-warning  active' href='coupon_code.php?status=$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Active'><i class='far fa-eye-slash'></i></a>";
                                                    }
                                                    $update = "<a class='tableIcon update bg-gradient-info' href='coupon_code.php?update=$id' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-original-title='Edit'><i class='far fa-edit'></i></a>";
                                                    $date = formatingDate($row['expire_on']);
                                                    echo "
                                                    
                                                        <tr>
                                                            <td class='mb-0 text-sm'><b>$si</b></td>
                                                            <td class='mb-0 text-sm'>{$row['coupon_code']}</td>
                                                            <td class='mb-0 text-sm'>{$row['coupon_type']}</td>
                                                            <td class='mb-0 text-sm'>{$row['coupon_value']}</td>
                                                            <td class='mb-0 text-sm'>{$row['min_value']}</td>
                                                            <td class='mb-0 text-sm'>{$date}</td>
                                                            <td>
                                                                
                                                                <div class='tableCenter'>
                                                                    <span class='tableHide'><i class='fas fa-ellipsis-h'></i></span>
                                                                    <span class='tableHoverShow'>
                                                                    $status
                                                                    $update
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    
                                                    ";
                                                }
                                            }else{
                                                echo "
                                                    
                                                        <tr>
                                                            <td calspan='7'>No Data</td>
                                                        </tr>
                                                    
                                                    ";
                                            }
                                        
                                        ?>
                                    </table>
                                </div>
                            
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <?php include(SERVER_ADMIN_SCREEN_PATH.'footer.php') ?>
        </div>

  </main>

  <div id="indexSlidBar">
      <div class="closeContent"></div>
      <div class="contatent">
          <div class="close"></div>
          <div class="box">

          </div>
      </div>
  </div>

  <?php include(SERVER_ADMIN_SCREEN_PATH.'script.php') ?>

  
  

  


  <script>
      $('#navTopBar').hide();
      $('.nav-link').removeClass('active'); 
      $('.couponLink').addClass('active');
      $('.roomLink').addClass('active');
  </script>




</body>

</html>