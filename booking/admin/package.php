<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}

$name = '';
$slug = '';
$places = '';
$price = '';
$desc = '';
$rooms = '';
$time ='';
$couponValue = '';
$header_text = 'Add Package';
$disable = '';
$car = '';
$required = 'required';
$btn = 'Add Package';
$pickup = 'Null';
$id = '';
if(isset($_GET['update'])){
    $id = $_GET['update'];
    $header_text = 'Update Package';
    $disable = 'disabled';
    $required = '';
    $sql = mysqli_query($conDB, "select * from package where id = '$id'");
    if(mysqli_num_rows($sql) > 0){
        $update_row = mysqli_fetch_assoc($sql);

        $name = $update_row['name'];
        $slug = $update_row['slug'];
        $desc = $update_row['description'];
        $rooms = $update_row['room'];
        $time = $update_row['duration'];
        $couponValue = $update_row['discount'];
        $car = $update_row['car'];
        $pickup = $update_row['pickup'];

        $btn = 'Update Package';

        if(isset($_POST['submit'])){ 

            $name = $_POST['name'];
            $places = $_POST['places'];
            $price = $_POST['price'];
            $desc = $_POST['desc'];
            $rooms = $_POST['rooms'];
            $rdid = $_POST['roomDetail'];
            $time = $_POST['time'];
            $couponValue = $_POST['discount'];
            $car = $_POST['carBox'];
            if($_POST['pickup']){
                $pickup = 'Yes';
            }
    
            $banner = $_FILES['banner']['name'];

            if($banner == ''){
                $sql = "update package set name='$name',duration='$time',description='$desc',room='$rooms',discount='$couponValue',rdid='$rdid',car='$car',pickup='$pickup' where id = '$id'";
                    
                
            }else{
                $bannerTemp = $_FILES['banner']['tmp_name'];
                $extension=array('jpeg','jpg','JPG','png','gif');
                $ext=pathinfo($banner,PATHINFO_EXTENSION);
                if(in_array($ext,$extension)){
                    $newfilename=rand(100000,999999).".".$ext;
                    move_uploaded_file($bannerTemp, SERVER_ADMIN_IMG.'package/'.$newfilename);
        
                    $sql = "update package set name='$name',img='$newfilename',duration='$time',description='$desc',room='$rooms',discount='$couponValue',rdid='$rdid',car='$car',pickup='$pickup' where id = '$id'";
                    
                    
                }
            }
    
            if(mysqli_query($conDB,$sql)){
                $_SESSION['SuccessMsg'] = "Package Successfully Upadate";
                redirect('package.php');
            }
            
    
        }

    }else{
        $_SESSION['ErrorMsg'] = "Package not exist";
        redirect('coupon_code.php');
    }
    
}else{
    if(isset($_POST['submit'])){ 
        
        $slug = $_POST['slug'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $rooms = $_POST['rooms'];
        $rdid = $_POST['roomDetail'];
        $time = $_POST['time'];
        $couponValue = $_POST['discount'];
        $car = $_POST['carBox'];
        if($_POST['pickup']){
            $pickup = 'Yes';
        }

        if(checkPackageSlug($slug) == 'Yes'){
            $_SESSION['ErrorMsg'] = "Slug Already Exists";
            redirect('package.php');
        }else{

            $banner = $_FILES['banner']['name'];
            $bannerTemp = $_FILES['banner']['tmp_name'];
            $extension=array('jpeg','jpg','JPG','png','gif');
            $ext=pathinfo($banner,PATHINFO_EXTENSION);
            if(in_array($ext,$extension)){
                $newfilename=rand(100000,999999).".".$ext;
                move_uploaded_file($bannerTemp, SERVER_ADMIN_IMG.'package/'.$newfilename);

                $sql = "insert into package(slug,name,img,duration,description,room,rdid,discount,car,pickup) value('$slug','$name','$newfilename','$time','$desc','$rooms','$rdid','$couponValue','$car','$pickup')";
                if(mysqli_query($conDB,$sql)){

                    
                }

                $dayActivityArr = $_POST['dayActivity'];
                $pkId =mysqli_insert_id($conDB);
                foreach($dayActivityArr as $activityList){
                    mysqli_query($conDB, "insert into packageactivity(pid,description) values('$pkId', '$activityList')");
                }

                $_SESSION['SuccessMsg'] = "Package Successfully Added";
                redirect('package.php');
            }

        }

                     

    }
}



if(isset($_GET['status'])){
    $sid = $_GET['status'];

    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from package where id='$sid'"));
    if($sql['status'] == 1){
        mysqli_query($conDB, "update package set status = '0' where id='$sid'");
        $_SESSION['SuccessMsg'] = "Successfull Status Change";
        redirect('package.php');
    }else{
        mysqli_query($conDB, "update package set status = '1' where id='$sid'");
        $_SESSION['SuccessMsg'] = "Successfull Status Change";
        redirect('package.php');
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

  <title>Packages</title>

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
                            Packages
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
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Packages</li>
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
                            <div class="col-12 col-lg-12 m-auto">
                            <?php echo SuccessMsg(); echo ErrorMsg() ?>

                            <a style="background: #e9e9e9;border: 1px solid #00000038;padding: 5px 10px;display: inline-block;margin-bottom: 15px;border-radius: 3px;" href="package-policies.php">Add Package Policies</a>
                            <form action="" id="managePackageForm" method="post" enctype="multipart/form-data">

                                <div class="row p0">
                                    <div class="form_group col-md-6 mb-3">
                                        <label for="name">Package Name *</label>
                                        <input required class="form-control" type="text" id="name" name="name" placeholder="Enter Package Name." value="<?php echo $name ?>">
                                    </div>
                                    <div class="form_group col-md-6 mb-3">
                                        <label for="slug">Slug *</label>
                                        <input <?php echo $disable ?> required class="form-control" type="text" id="slug" name="slug" placeholder="Enter Package Slug." value="<?php echo $slug ?>">
                                    </div>
                                </div> 
                                <input type="hidden" id="packageId" name="packageId" value="<?php echo $id ?>">
                                <div class="row p0">
                                    <div class="form_group col-md-6 mb-3">
                                        <label for="rooms">Rooms</label>
                                        <select name="rooms" id="rooms" class="form-control">
                                            <option value="0">Select Room</option>
                                            <?php
                                            
                                                foreach(getRoomArr() as $list){
                                                    $id= $list['id'];
                                                    $name= $list['name']; 
                                                    if($rooms == $id){
                                                        echo "<option selected value='$id'>$name</option>";
                                                    }else{
                                                        echo "<option value='$id'>$name</option>";
                                                    }
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form_group col-md-6 mb-3">
                                        <label for="roomDetail">Rate Plan</label>
                                        <select disabled name="roomDetail" id="roomDetail" class="form-control">
                                            <option value="0">Please Select Room</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form_group mb-3">
                                    <label for="banner">Banner Image * (600 * 500)</label>
                                    <input accept="image/*" <?php echo $required ?> class="form-control" type="file" id="banner" name="banner">
                                </div>

                                <div class="form-group pickup mb-3" style="margin-bottom: 15px;">
                                    <?php
                                    
                                    if($pickup == 'Yes'){
                                        echo '<input checked type="checkbox" id="pickup" name="pickup">';
                                    }else{
                                        echo '<input type="checkbox" id="pickup" name="pickup">';
                                    }
                                    
                                    ?>
                                    
                                    <label for="pickup" class="pickup">Pick Up</label>
                                </div>

                                <div class="row carBox p0">
                                        
                                    <?php
                                    
                                        foreach(getCarArr() as $carList){
                                            $carId = $carList['id'];
                                            $carName = $carList['name'];
                                            $carImg = FRONT_SITE_IMG.'car/'.$carList['img'];
                                            $price = getCarPriceById($carId);
                                            $select = '';
                                            if($car == $carId){
                                                $select = 'checked';
                                            }
                                            echo "
                                                    <div class='col-md-2 form-group'><input required='required' $select name='carBox' type='radio' id='$carId' value='$carId'> <label for='$carId'><img style='width:50px' src='$carImg' title='$carName'> <h4>$price</h4></label></div>
                                                ";
                                            
                                        }
                                    
                                    ?>
                                </div>

                                <div class="row p0">
                                    <div class="form_group col-md-6 mb-3">
                                        <label for="discount">Discount Percentage *</label>
                                        <input class="form-control" type="number" id="discount" name="discount" placeholder="Enter Discount." value="<?php echo $couponValue ?>">
                                    </div>
                                    <div class="form_group col-md-6 mb-3">
                                        <label for="time">Package Duration In Night *</label>
                                        <input required class="form-control" type="number" id="time" name="time" placeholder="Enter Package Time." value="<?php echo $time ?>">
                                    </div>
                                </div>

                                <input type="hidden" name="type" value="loadPrice">

                                <div id="loadDaysActivity">

                                </div>

                                <div class="form_group">
                                    <label for="desc">Description *</label>
                                    <textarea required class="form-control" name="desc" id="desc"><?php echo $desc ?></textarea>
                                </div>
                                

                                <div class="s25"></div>
                                
                                <div id="add_content"></div>
                                <div class="s25"></div>
                                <button class="btn bg-gradient-primary mb-0 mt-lg-auto" type="submit" name="submit"><?php echo $btn ?></button>
                            </form>
                        </div>
                        <div class="col_4">
                            <div class="content">
                                <h4>Price</h4>
                                <ul id="loadPriceBox">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col_12" style="background: white;box-shadow: 0 5px 25px #00000040;padding: 30px 20px;border-radius: 10px;">
                        <?php echo SuccessMsg(); echo ErrorMsg() ?>
                        <!-- <a href="<?php echo FRONT_BOOKING_SITE.'/admin/manage-room.php' ?>" class="btn dark mb15">Add Room</a> -->
                            
                                <div class="table table-responsive">
                                    <table class="table align-items-center mb-0">
                                    <tr>
                                        <th width="5%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SI</th>
                                        <th width="5%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                        <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Discount </th>
                                        <th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration</th>
                                        <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                    <?php 
                                        $si = 0;
                                        $sql = mysqli_query($conDB, "select * from package");
                                        if(mysqli_num_rows($sql) > 0){
                                            while($row = mysqli_fetch_assoc($sql)){
                                                $si++;
                                                $id = $row['id'];
                                                $time = formatingDate($row['addOn']);
                                                if($row['status'] == 1){
                                                    $status = "<a class='status btn deactive' href='package.php?status=$id' ><i class='far fa-eye'></i></a>";
                                                }else{
                                                    $status = "<a class='status btn active' href='package.php?status=$id' ><i class='far fa-eye-slash'></i></a>";
                                                }
                                                $update = "<a class='update btn' href='package.php?update=$id' ><i class='far fa-edit'></i></a>";

                                                $img = FRONT_SITE_IMG.'package/'.$row['img'];
                                                echo "
                                                
                                                    <tr>
                                                        <td class='mb-0 text-sm'><b>$si</b></td>
                                                        <td class='mb-0 text-sm'><img style='width: 80px;' src='$img'></td>
                                                        <td class='mb-0 text-sm'>{$row['name']}</td>
                                                        <td class='mb-0 text-sm'>{$row['discount']} %</td>
                                                        <td class='mb-0 text-sm'>{$row['duration']}</td>
                                                        <td class='mb-0 text-sm'>
                                                            $update
                                                            $status
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
        $('.packageLink').addClass('active');
        $('.roomLink').addClass('active');
        

        function loadPrice(){
            $.ajax({
                url: 'include/ajax/package.php',
                type: 'post',
                data: $('#managePackageForm').serialize(),
                success: function(data){
                    $('#loadPriceBox').html(data);
                }
            });
        }

        function loadRoom($id,$packageId){
            var id = $id;
            var packageId = $packageId;
            if(id == 0){
                $('#roomDetail option').html('Please Select Room');
                $('#roomDetail').prop('disabled', true);
            }else{
                $.ajax({
                    url: 'include/ajax/package.php',
                    type: 'post',
                    data: {type: 'updateRatePlan', rid:id,packageId:packageId},
                    success: function(data){
                        $('#roomDetail').html(data);
                        $('#roomDetail').prop('disabled', false);
                        // console.log(data);
                    }
                });
            }
        }

        $(document).ready(function(){
            
            var roomId = $('#rooms').val();
            var packageId = $('#packageId').val();
            console.log(packageId);
            loadRoom(roomId, packageId);
            // loadPrice();
            $('#rooms').change(function(){
                var id = $(this).val();
                $('#roomDetail option').html('Please Wait...');
                loadRoom(id);
                
            });

            $(document).on('click','#roomDetail',function(){                
                loadPrice();
            });

            $('input[name="carBox"]').change(function(){
                loadPrice();
            });

            $('#discount').change(function(){
                loadPrice();
            });

            $('.pickup').click(function(){
                loadPrice();
            });

            $('#time').change(function(){
                var night = $(this).val();
                $.ajax({
                    url: 'include/ajax/package.php',
                    type: 'post',
                    data: {type:'updateNight',night:night},
                    success: function(data){
                        console.log(data);
                        loadPrice();
                    }
                });
                $.ajax({
                    url: 'include/ajax/package.php',
                    type: 'post',
                    data: {type:'loadDaysActivity'},
                    success: function(data){
                        console.log(data);
                        $('#loadDaysActivity').html(data);
                    }
                });
            });
            

        });
  </script>




</body>

</html>