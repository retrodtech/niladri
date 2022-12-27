<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}


$header = '';
$bedtype = '';
$totalroom = '';
$roomcapacity = '';
$uid = '';
$noAdult = '';
$extraAdult = '';
$extraChild = '';
$noChild = '';
$mrp='';
$btn = 'Add Room';
$header_text = 'Add Room';

$imgSize = '(900 x 1060)';

if(isset($_GET['update'])){
    $id = $_GET['update'];
    $header_text = 'Update Room';
    $sql = mysqli_query($conDB, "select * from room where id = '$id'");
    if(mysqli_num_rows($sql) > 0){
        $update_row = mysqli_fetch_assoc($sql);
        $uid = $update_row['id'];
        $header = $update_row['header'];
        $bedtype = $update_row['bedtype'];
        $totalroom = $update_row['totalroom'];
        $roomcapacity = $update_row['roomcapacity'];

        $noAdult = $update_row['noAdult'];
        $noChild = $update_row['noChild'];
        $mrp = $update_row['mrp'];
        $btn = 'Update Room';
    }else{
        $_SESSION['ErrorMsg'] = "Room Id not exist";
        redirect('list-room.php');
    }
}

if(isset($_GET['ustatus'])){
    $status =  $_GET['ustatus'];
    $sql = mysqli_query($conDB, "select * from room_detail where id = '$status' ");
    if(mysqli_num_rows($sql)>0){
        $query = mysqli_fetch_assoc($sql);
        $status_value = $query['status'];
        if($status_value == 1){
            $sql = "update room_detail set status='0' where id = '$status'";
        }else{
            $sql = "update room_detail set status='1' where id = '$status'";
        }
        
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Successfully Change Status";
            redirect('list-room.php');
        }
    }

}

if(isset($_GET['remove'])){
    $removeId =  $_GET['remove'];
    $sql = mysqli_query($conDB, "select * from room_detail where id = '$removeId' ");
    if(mysqli_num_rows($sql)>0){
        $sql = "delete from room_detail where id='$removeId'";
        $href = $_SERVER['HTTP_REFERER'];
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Successfully Delete Record";
            
            redirect($href);
        }
    }

}

if(isset($_GET['removeImage'])){
    $removeImgId =  $_GET['removeImage'];
    $sql = mysqli_query($conDB, "select * from room_img where id = '$removeImgId' ");
    if(mysqli_num_rows($sql)>0){
        unlink(SERVER_ROOM_IMG.getImageByImgId($removeImgId));
        $sql = "delete from room_img where id='$removeImgId'";
        $href = $_SERVER['HTTP_REFERER'];
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Successfully Delete Record";
            redirect($href);
        }
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

  <title>Room</title>

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
                                <?php echo $header_text ?>
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
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Room</li>
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
                                <div class="card p-4">
                                <form action="" id="manageForm" method="post" enctype="multipart/form-data">

                                
                                    
                                    <div class="row p0">
                                        <div class="form_group col-12 col-sm-6 mb-3">
                                            <label for="header">Room</label>
                                            <input class="form-control" type="text" id="header" name="header" placeholder="Enter Room Name." value="<?php echo $header ?>">
                                        </div>
                                        <div class="form_group col-12 col-sm-6 mb-3">
                                            <label for="bedType">Bed Type</label>
                                            <input class="form-control" type="text" id="bedType" name="bedType" placeholder="Enter Bed Type" value="<?php echo $bedtype ?>">
                                        </div>
                                    </div>

                                    <div class="row p0">
                                        <div class="form_group col_12 mb-3">
                                            <label for="slug">Slug</label>
                                            <input class="form-control" type="text" id="slug" name="slug" placeholder="Enter Slug." value="<?php echo $header ?>">
                                        </div>
                                    </div>

                                    <div class="row p0">
                                        <div class="form_group col-12 col-sm-6 mb-3">
                                            <label for="totalRoom">Total Inventory</label>
                                            <select class="form-control" name="totalRoom" id="totalRoom">
                                                <option value="">Total no. of Inventory</option>
                                                <?php
                                                    for($i=0; $i<=15; $i++){
                                                        if($i == $totalroom){
                                                            echo "<option selected value='$i'>$i</option>";
                                                        }else{
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form_group col-12 col-sm-6 mb-3">
                                            <label for="roomCapacity">Room Capacity</label>
                                            <select class="form-control" name="roomCapacity" id="roomCapacity">
                                                <option value="">Select Room Capacity</option>
                                                <?php
                                                    for($i=1; $i<=settingValue()['maxRoomCapacity']; $i++){
                                                        if($i == $roomcapacity){
                                                            echo "<option selected value='$i'>$i</option>";
                                                        }else{
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row p0">
                                        
                                        <div class="col-md-4 mb-3">
                                            <div class="form_group">
                                                <label for="noAdult">No of Adult</label>
                                                <input class="form-control" type="text" id="noAdult" name="noAdult" placeholder="Enter No of Adult" value="<?php echo $noAdult ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form_group">
                                                <label for="noChild">No of Child ( Above 5 Years )</label>
                                                <input class="form-control" type="text" id="noChild" name="noChild" placeholder="Enter No of Child" value="<?php echo $noChild ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form_group">
                                                <label for="mrp">Rack Rate</label>
                                                <input class="form-control" type="number" id="mrp" name="mrp" placeholder="Enter Room MRP" value="<?php echo $mrp ?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <?php

                                        if(isset($_GET['update'])){
                                            echo "<div class='row p0'>";
                                            $imageSql = mysqli_query($conDB, "select * from room_img where room_id= {$_GET['update']}");

                                            while($image_row = mysqli_fetch_assoc($imageSql)){

                                                $img_path = FRONT_SITE_ROOM_IMG.$image_row['image'];
                                                $img_remove_path = FRONT_BOOKING_SITE.'/admin/manage-room.php?removeImage='.$image_row['id'];

                                                echo "
                                                    
                                                    <div class='img_old'>
                                                        <a href='$img_remove_path'>X</a>
                                                        <img style='width:80px' src='$img_path' >
                                                    </div>
                                                    
                                                ";
                                            }
                                            echo "</div> <br/>";
                                            
                                            echo '
                                                <div class="row p0" id="roomImgContent">
                                                    <div class="form_group col-md-6 col-sm-12 mb-3">
                                                        <label for="roomImage1">Room Image '.$imgSize.'</label>
                                                        <input class="form-control checkRoomImg" type="file" id="roomImage1" accept="image/png, image/jpeg,image/webp" name="roomImage[]">
                                                        <span id="errorImage1"></span>
                                                    </div>
                                                    <div class="form_group col-md-6 col-sm-12 mb-3">
                                                        <label for="roomImage2">Room Image '.$imgSize.'</label>
                                                        <input class="form-control checkRoomImg" type="file" id="roomImage2" accept="image/png, image/jpeg,image/webp" name="roomImage[]">
                                                        <span id="errorImage2"></span>
                                                    </div>
                                                </div>
                                            
                                            ';
                                        }else{
                                            echo '
                                            
                                            <div class="row p0" id="roomImgContent">
                                                <div class="form_group col-md-6 col-sm-12 mb-3">
                                                    <label for="roomImage1">Room Image '.$imgSize.'</label>
                                                    <input class="form-control checkRoomImg" type="file" id="roomImage1" accept="image/png, image/jpeg,image/webp" name="roomImage[]">
                                                    <span id="errorImage1"></span>
                                                </div>
                                                <div class="form_group col-md-6 col-sm-12 mb-3">
                                                    <label for="roomImage2">Room Image '.$imgSize.'</label>
                                                    <input class="form-control checkRoomImg" type="file" id="roomImage2" accept="image/png, image/jpeg,image/webp" name="roomImage[]">
                                                    <span id="errorImage2"></span>
                                                </div>
                                            </div>
                                            
                                            ';
                                        }

                                    ?>


                                    <?php

                                        if(isset($_GET['update'])){
                                            echo '<input type="hidden" value="update_room" name="type">';
                                            echo "<input type='hidden' value='$uid' name='update_id'>";
                                        }else{
                                            echo '<input type="hidden" value="add_room" name="type">';
                                        }

                                    ?>

                                    <div class="s25"></div>



                                    <div class="form_group amenities mb-3" id="amenitiesContent">
                                        <label for="amenities">Amenities</label> <br/><br/>
                                        <?php

                                            $query = "select * from amenities";
                                            $sql = mysqli_query($conDB, $query);
                                            if(mysqli_num_rows($sql) > 0){
                                                if(isset($_GET['update'])){
                                                    $rid = $_GET['update'];
                                                    echo "<input type='hidden' name='amenitieRoomId' value='$rid'>";
                                                }else{
                                                    $rid = '';
                                                }
                                                
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $title = ucfirst($row['title']);
                                                    $id = $row['id'];
                                                    
                                                    
                                                    if(checkAmenitiesById($rid, $row['id']) == 1){
                                                        echo "
                                                    
                                                        <span style='display: inline-block;margin-right: 10px;'>
                                                            <input checked type='checkbox' id='amenitie{$row['id']}' name='amenities[]' value='{$row['id']}'>
                                                            <label for='amenitie{$row['id']}'> $title</label>
                                                        </span>
                                                    
                                                        ";
                                                    }else{
                                                        echo "
                                                    
                                                        <span style='display: inline-block;margin-right: 10px;'>
                                                            <input type='checkbox' id='amenitie{$row['id']}' name='amenities[]' value='{$row['id']}'>
                                                            <label for='amenitie{$row['id']}'> $title</label>
                                                        </span>
                                                    
                                                    ";
                                                    }
                                                    
                                                    
                                                }
                                            }
                                        
                                        ?>
                                        
                                    </div>

                                    <?php

                                    if(isset($_GET['update'])){
                                        $detail_sql = mysqli_query($conDB, "select * from room_detail where room_id = '$uid'");
                                        $count = 0;
                                        if(mysqli_num_rows($sql)>0){

                                            while($detail_row = mysqli_fetch_assoc($detail_sql)){ $count++?>
                                            <input type="hidden" name="room_detail_id[]" value="<?php echo $detail_row['id'] ?>">
                                                <div class="row p0" style="align-items: flex-end;">
                                                    <div class="form_group col-md-4 mb-3">
                                                        <label for="">Rate Plane</label>
                                                        <input class="form-control" type="text" id="" name="titleUpload[]" placeholder="Enter Title." value="<?php echo $detail_row['title'] ?>">
                                                    </div>
                                                    <div class="form_group col-md-3 col-sm-6 col-xs-12 mb-3">
                                                        <label for="">Room Price</label>
                                                        <input class="form-control mb-3" type="number" id="" name="singleRoomPriceUpload[]" placeholder="Enter Room Price." value="<?php echo $detail_row['singlePrice'] ?>">
                                                    </div>
                                                    <div class="form_group col-md-3 col-sm-6 col-xs-12 mb-3">
                                                        <label for="">Room Price</label>
                                                        <input class="form-control" type="number" id="" name="doubleRoomPriceUpload[]" placeholder="Enter Room Price." value="<?php echo $detail_row['doublePrice'] ?>">
                                                    </div>
                                                    
                                                    <?php
                                                        if($count == 1){
                                                            echo '<div class="add_sub col-md-2 "  data-id="1"><div class="btn update">Add</div></div>';
                                                        }else{
                                                            echo "<div class='col-md-2'><a href='manage-room.php?remove={$detail_row['id']}'><div class='btn delete'>Remove</div></a></div>";
                                                        }
                                                    
                                                    ?>
                                                    <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                                                        <div class="form_group">
                                                            <label for="">Extra charge of Adult</label>
                                                            <input class="form-control" type="number" id="" name="extraAdultUpload[]" placeholder="Enter Extra charge of Adult" value="<?php echo $detail_row['extra_adult'] ?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                                                        <div class="form_group">
                                                            <label for="">Extra charge of Child</label>
                                                            <input class="form-control" type="number" id="" name="extraChildUpload[]" placeholder="Enter Extra charge of Child" value="<?php echo $detail_row['extra_child'] ?>">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                        <?php }
                                        }
                                    }else{ ?>

                                    <div class="row p0" style="align-items: flex-end;" id="add_content_id1">
                                        
                                        <div class="form_group col-md-4 mb-3">
                                            <label for="title">Rate Plan</label>
                                            <input class="form-control" type="text" id="title" name="title[]" placeholder="Enter Title.">
                                        </div>
                                        <div class="form_group col-md-3 col-sm-6 col-xs-12 mb-3">
                                            <label for="singleRoomPrice">Single occupancy</label>
                                            <input class="form-control" type="number" id="singleRoomPrice" name="singleRoomPrice[]" placeholder="Enter Single Price.">
                                        </div>
                                        <div class="form_group col-md-3 col-sm-6 col-xs-12 mb-3">
                                            <label for="doubleRoomPrice">Double occupancy</label>
                                            <input class="form-control" type="number" id="doubleRoomPrice" name="doubleRoomPrice[]" placeholder="Enter Double Price.">
                                        </div>
                                        <div class="add_sub col-md-2 mb-3 "  data-id="1"><div class="btn update">Add</div></div>
                                        
                                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                                            <div class="form_group">
                                                <label for="extraAdult">Extra charge of Adult</label>
                                                <input class="form-control" type="number" id="extraAdult" name="extraAdult[]" placeholder="Enter Extra charge of Adult" value="<?php echo $extraAdult ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3">
                                            <div class="form_group">
                                                <label for="extraChild">Extra charge of Child</label>
                                                <input class="form-control" type="number" id="extraChild" name="extraChild[]" placeholder="Enter Extra charge of Child" value="<?php echo $extraChild ?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <?php }

                                    ?>

                                    <div id="add_content"></div>
                                    <div class="s25"></div>
                                    <button class="btn bg-gradient-primary mb-0 mt-lg-auto deactive" type="submit" name="addRoom"><?php echo $btn ?></button>
                                    </form>
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
      $('.addRoomLink').addClass('active');
      $('.roomLink').addClass('active');
       
        $attr_count = 1;
        $(document).on('click', '.add_sub',function(){
            $attr_count ++;
            $html = '<div class="row p0" id="add_content_id' + $attr_count + '" style="align-items: flex-end;">';
            $html += '<div class="form_group col-md-4"><label for="title' + $attr_count + '">Rate Plan</label><input class="form-control" type="text" id="title' + $attr_count + '" name="title[]" placeholder="Enter Title."></div>';
            $html += '<div class="form_group col-md-3 col-sm-6 col-xs-12"><label for="singleRoomPrice' + $attr_count + '">Room Price</label><input class="form-control" type="text" id="singleRoomPrice' + $attr_count + '" name="singleRoomPrice[]" placeholder="Enter Room Price."></div>';
            $html += '<div class="form_group col-md-3 col-sm-6 col-xs-12"><label for="doubleRoomPrice' + $attr_count + '">Room Price</label><input class="form-control" type="text" id="doubleRoomPrice' + $attr_count + '" name="doubleRoomPrice[]" placeholder="Enter Room Price."></div>';
            $html += '<div class="add_sub col-md-2" data-id="' + $attr_count + '"><div class="btn update">Add</div></div>';
            $html += '<div class="col-md-4 col-sm-6 col-xs-12"><div class="form_group"><label for="extraAdult' + $attr_count + '">Extra charge of Adult</label><input class="form-control" type="text" id="extraAdult' + $attr_count + '" name="extraAdult[]" placeholder="Enter Extra charge of Adult"></div></div>';
            $html += '<div class="col-md-4 col-sm-6 col-xs-12"><div class="form_group"><label for="extraChild' + $attr_count + '">Extra charge of Child</label><input class="form-control" type="text" id="extraChild' + $attr_count + '" name="extraChild[]" placeholder="Enter Extra charge of Child"></div></div>';
            $html += '</div>';
            var content = $(this).find('.btn');
            $(this).removeClass('add_sub').addClass('remove_sub');
            $(content).removeClass('update').addClass('delete').html('Remove');
            $('#add_content').append($html);
        });
        $(document).on('click', '.remove_sub',function(){
            var id = $(this).data('id');
            $('#add_content_id'+id).remove();
        });

        $(document).on('submit', '#manageForm', function(e){
			e.preventDefault();
			$('#manageForm button').prop('disabled', false);
			$('#manageForm button').html('Loading..');
			$.ajax({
				url: 'include/ajax/room.php',
				type: 'post',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success : function(data){
                    window.location.href = "list-room.php";
				}
			});

		});

        $(document).on('change', '#parentId', function(){
            var id = $(this).val();
            if(id == 0){
                $('#header').val('').prop('disabled', false);
                $('#bedType').val('').prop('disabled', false);
                $('#roomCapacity').val('').prop("checked","checked");
                $('#noChild').val('').prop('disabled', false);
                $('#slug').val('').prop('disabled', false);

                $('#roomImgContent').show();
                $('#amenitiesContent').show();
            }else{
                $.ajax({
                    url : 'include/ajax/room.php',
                    type : 'post',
                    data: {id:id, type:'getParentIdData'},
                    success : function(data){
                        var returnedData = JSON.parse(data);
                        // console.log(returnedData);
                        var roomName = returnedData.header;
                        var bedtype = returnedData.bedtype;
                        var totalroom = returnedData.totalroom;
                        var roomcapacity = returnedData.roomcapacity;
                        var noChild = returnedData.noChild;
                        var slug = returnedData.slug;


                        $('#header').val(roomName).prop('disabled', true);
                        $('#bedType').val(bedtype).prop('disabled', true);
                        $('#roomCapacity').val(roomcapacity).prop("checked","checked");
                        $('#noChild').val(noChild).prop('disabled', true);
                        $('#slug').val(slug).prop('disabled', true);

                        $('#roomImgContent').hide();
                        $('#amenitiesContent').hide();
                    }
                });
            }
        });
  </script>




</body>

</html>