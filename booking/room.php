<?php

include ('admin/include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

$ip = $_SERVER['REMOTE_ADDR'];
visiter_count($ip);



$one_day = strtotime('1 day 00 second', 0);

$currentDate = date('Y-m-d',strtotime(date('Y-m-d')));

if(isset($_SESSION['checkIn'])){
    $currentDate = $_SESSION['checkIn'];
}

if(!isset($_SESSION['checkIn'])){
    $_SESSION['checkIn'] = $currentDate;
    $_SESSION['no_room'] = 1;
    $_SESSION['no_guest'] = 2;
    $_SESSION['night_stay'] = 1;
    $_SESSION['checkout'] = date('Y-m-d',$currentDate + (1 * $one_day));
}


if(!isset($_GET['id']) && empty($_GET['id'])){
    redirect('index.php');
    die();
}else{
    $slug = $_GET['id'];
    $sql = mysqli_query($conDB, "select * from room where slug = '$slug'");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);

        $room_id = $row['id'];
        $header = $row['header'];
        $bedtype = $row['bedtype'];
        $roomcapacity = $row['roomcapacity'];
        $mrp = $row['mrp'];
        
        if($mrp != 0 ){
            $lowstPrice = $mrp - getRoomLowPriceByIdWithDate($room_id,  $_SESSION['checkIn']);
            $mrpPercentage = intval(($lowstPrice /  $mrp) * 100);
        }
    }else{
        $_SESSION['ErrorMsg'] = "Room Id Not Exist";
        redirect('index.php');
        die();
    }
}


$id = getRoomIdBySlug($_GET['id']);



?>

<!doctype html>
<html lang="en">

<head>
    <?php include(SERVER_BOOKING_PATH.'/screen/head.php') ?>
    <title><?php echo $header ?></title>

    <style>
        a.btn-action {
            background: #222;
            color: #fff;
            padding: 9px 13px;
            margin: 0 0 0 15px;
        }

        .carousel-inner img {
            width: 100%;
        }
        
        #loadingScreen {
            position: fixed;
            top: 0;
            left: 0;
            border: 0;
            right: 0;
            background: white;
            z-index: 105;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .loadingBox {
            width: 500px;
            margin: 0 auto;
            text-align: center;
            overflow: hidden;
            position: relative;
        }
        .loadingBox img {
            width: 150px;
            height: auto;
        }
        .loadingBox .loadingBarContainer {
            width: 100%;
            background: #eee;
            height: 4px;
            display: block;
            margin: 50px 0 0;
            overflow: hidden;
            border-radius: 5px;
        }
        .loadingBarContainer .loadingbar {
        	width: 100%;
        	height:4px;
        	background: #000;
        	position: absolute;
        	left: -100%;
        	border-radius: 5px;
        }
        .loadingCircle {
        	width: 75px;
        	height: 75px;
        	margin: 30px auto 0;
        	background: #fff;
        	display: block;
        	border-radius: 50%;
        	position: relative;
        	overflow: hidden;
        }
        .circleOuter {
        	width: 60px;
        	height: 60px;
        	background: #fff;
        	border-radius: 50%;
        	position: absolute;
        	left: 50%;
        	top: 50%;
        	transform: translate(-50%, -50%);
        	z-index: 2;
        }
        .circleLoader {
        	width: 75px;
        	height: 75px;
        	background: linear-gradient(to bottom, rgba(0,0,0,1) 0%,rgba(125,185,232,0) 100%);
        	position: absolute;
        	right: 50%;
        	bottom: 50%;
        	transform-origin: bottom right;
        	z-index: 1;
        	animation: rotateLoader 1.5s linear infinite;
        }
        @keyframes rotateLoader {
            from {transform: rotate(0deg);}
            to {transform: rotate(360deg);}
        }
        .btn-grad{
            color: #000 !important;
            cursor:pointer;
        }
        .btn-grad:hover{
            color:#fff !important;
        }
        .btn-danger{
            color:#fff !important;
        }
        .arrow{
            width: 22px;
            position: relative;
            display: inline-block;
            margin: 20px;
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
        .arrow::before, .arrow::after {
            position: absolute;
            display: block;
            content: "";
            background-color: currentColor;
            border-radius: 0;
            top: 0;
            width: 10px;
            height: 100%;
        }
        .arrow::before {
            left: 0;
            transform-origin: left top;
            transform: rotate(-45deg);
        }
        .arrow::after {
            left: 0;
            transform-origin: left bottom;
                transform: rotate(45deg);
        }
        .arrow__line{
            width: 100%;
            height: 2px;
            display: block;
            background-color: currentColor;
            border-radius: 0;
        }
    </style>
</head>
    <body>
        <div id="loadingScreen">
            <div class="loadingBox">
            	<img src="<?php echo FRONT_SITE_IMG.hotelDetail()['logo'] ?>">
            	<div class="loadingBarContainer">
            		<div class="loadingbar"></div>
            	</div>
            
            	<div class="loadingCircle">
            		<div class="circleOuter"></div>
            		<div class="circleLoader"></div>
            	</div>
            </div>
        </div>
 
    <?php include(SERVER_BOOKING_PATH.'/screen/navbar.php'); echo "<input type='hidden' value='$id' id='PageId'>"; ?>
 
    <section class="p-0 height-700 parallax-bg" style="overflow:hidden">
        <div id="demo" class="carousel slide" data-ride="carousel">

            
            
            <div class="carousel-inner">
                <?php
                
                    $sql = mysqli_query($conDB, "select * from herosection limit 5");
                    if(mysqli_num_rows($sql)>0){
                        $count = 0;
                        while($row = mysqli_fetch_assoc($sql)){
                            $img = FRONT_SITE_HERO_IMG.$row['img'];
                            $count ++;
                            if($count == 1){
                                $active = 'active';
                            }else{
                                $active = '';
                            }
                            echo "
                                <div class='carousel-item $active'>
                                    <img src='$img' alt='Los Angeles' width='1100' height='500'>
                                </div>
                            ";
                        }
                    } 
                ?>
                
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>

        
        
    </section>
    <!-- =======================
	Main banner -->


    <section id="date_select" style="position: relative;z-index: 7; background: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-6">
                    <a href="<?php echo FRONT_BOOKING_SITE ?>" style="border-radius: 3px;display: inline-flex;justify-content: center;align-items: center;border: 1px dashed #0000003b;"><span class="arrow"><span class="arrow__line"></span></span></a>
                </div>
                <div class="col-md-6 col-6">
                <div class="row">
                    <div class="col-6">
                        <p class="mb-3" style="font-weight: 700;color: #1e90ff;">Checkin Date: <input class="form-control" type='text' id='dateLoadPick' value="" data-rdid="<?php echo getRoomIdBySlug($_GET['id']) ?>"></p>
                    </div>
                    <div class="col-6">
                        <p class="mb-3" style="font-weight: 700;color: #1e90ff;">Checkout Date: <input class="form-control" type='text' id='dateLoadPickTo' value="" data-rdid="<?php echo getRoomIdBySlug($_GET['id']) ?>"></p>
                    </div>
                </div>

                </div>
            </div>
            
            <div id="loadRoomDate"></div>
        </div>
    </section>


    <section id="roomSection" class="Categories pt80 pb60 ">
        <div class="container">

            

        </div>
    </section>
    

    <div id="side_checkout">
        <div id="closeBoxSection"></div>
        <div class="box">
            <div class="close_side_checkout">X</div>
            <div id="content"></div>
            <div id="personalDetail"></div>
        </div>
    </div>

    <div class="img_overflow">
        <div class="close">X</div>
        <img id="img_overflow_content" src="" alt="">
    </div>
    
    <?php include(SERVER_BOOKING_PATH.'/screen/footer.php') ?>

    <div id="verifyForm"></div>

    <?php include(SERVER_BOOKING_PATH.'/screen/script.php') ?>

    <input type="hidden" id="checkDateAvailableOrNot">

    <script>




function checkDateAvailableOrNot($date,$rdid){
    var date = $date;
    var rdid = $rdid;
    $.ajax({
        url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
        type: 'post',
        data: { type: 'checkDateAvailableOrNot',date: date,rdid:rdid},
        success: function (data) {
            $('#checkDateAvailableOrNot').val(data);
        }
    });

    
}



function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");

  if (n > slides.length) {slideIndex = 1}   
   
  if (n < 1) {slideIndex = slides.length}

    //   for (i = 0; i < slides.length; i++) {
    //     slides[i].style.display = "none";  
    //   }
    //   console.log(slideIndex);
    //   slides[slideIndex-1].style.display = "block";  
} 

</script>       
            
        

<script>
    


    $('.loadingbar').delay(500).animate({left: '0'}, 1500);
    $('.loadingBox').delay(500).animate({opacity: '1'}, 1000);
    $('#loadingScreen').delay(1500).animate({top: '-100%'}, 500);
    $('.loadingCircle').delay(4500).animate({opacity: '0'}, 500);
    
    
    $('#side_checkout').hide();

    var bigImg = $('#bigImg').attr('src');
    $('#img_overflow_content').attr('src', bigImg);

    $( function() {
        var array = $('#checkDateAvailableOrNot').val();
        console.log(array);
        $('#dateLoadPick').datepicker({
            minDate: 0,
            dateFormat: 'dd/mm/yy' ,
            beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [ array.indexOf(string) == -1 ]
            }
        });

        $('#dateLoadPickTo').datepicker({
            minDate: 0,
            dateFormat: 'dd/mm/yy' ,
            beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [ array.indexOf(string) == -1 ]
            }
        });

    } );

    function loadCheckoutSection() {
        $.ajax({
            url:"<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room.php' ?>",
            type: 'post',
            data: { type: 'load_checkout_section',page: 'detail' },
            success: function (data) {
                if(data == ''){
                    $('#side_checkout').hide();
                    $('.add_room_detail').hide();
                    $('.add_guest_btn').css("opacity", "1");
                }else{
                    $('#side_checkout #content').html(data);
                    $('#side_checkout .box').css({ 'max-width': '370px'});
                }
            }
        });
    }

    function loadRoomDateSlide($date,$rdid){
        var date = $date;
        var rdid = $rdid;
        
        $.ajax({
            url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
            type: 'post',
            data: { type: 'loadRoomDataSlide',date: date, rdid:rdid},
            success: function (data) {
                $('#loadRoomDate').html(data);
            }
        });
    }

    function loadRoomDetail(){
        var id = '<?php echo $_GET['id'] ?>';
        $('#roomSection .container').html('');
        $.ajax({
            url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
            type: 'post',
            data: { type: 'loadRoom', id:id},
            success: function (data) {
                $('#roomSection .container').html(data);
            }
        });
    }

    function loadInputDate(){
        var rdid = $('#dateLoadPick').data('rdid');
        $.ajax({
            url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
            type: 'post',
            data: { type: 'loadInputDate',},
            success: function (data) {
                $('#dateLoadPick').val(data);
                loadRoomDateSlide(data,rdid);
            }
        });
    }

    function loadCheckOutDate(){
        $.ajax({
            url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
            type: 'post',
            data: { type: 'loadCheckOutDate',},
            success: function (data) {
                $('#dateLoadPickTo').val(data);
            }
        });
    }

    $('#dateLoadPick').change(function(){
        var date = $(this).val();
        var rdid = $('#dateLoadPick').data('rdid');
        $.ajax({
            url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
            type: 'post',
            data: { type: 'addDate',date:date},
            success: function (data) {
                loadRoomDetail();
                loadCheckOutDate();
                loadRoomDateSlide(date,rdid);
            }
        });
    });

    $('#dateLoadPickTo').change(function(){
        var date = $(this).val();
        $.ajax({
            url: "<?php echo FRONT_BOOKING_SITE.'/admin/include/ajax/room_detail.php' ?>",
            type: 'post',
            data: { type: 'checkOutDate',date:date},
            success: function (data) {
                loadRoomDetail();
            }
        });
    });

    $(document).ready(function () {
        loadCheckoutSection();
        loadRoomDetail();
        loadInputDate();
        checkDateAvailableOrNot('2022-05-27','2');
        loadCheckOutDate();
        $('#footerDescReadMoreBtn').on('click',function(){
            $('#footerDescReadMoreBtn').hide();
            $('#footerDescReadLessCaption').slideDown();
        });
        $('#footerDescReadLessBtn').on('click',function(){
            $('#footerDescReadMoreBtn').show();
            $('#footerDescReadLessCaption').slideUp();
        });

        let slideIndex = 1;
        showSlides(slideIndex);
        var checkDate = $('#checkDateAvailableOrNot').val();
        console.log(checkDate);
    });

    $('.listroBox .owl-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:3
            },
            600:{
                items:4
            },
            1000:{
                items:5
            }
        }
    });

</script>


</body>
</html>