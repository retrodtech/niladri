<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}

$title = '';
if(isset($_GET['delete'])){
    $uid = $_GET['delete'];
    $sql = "delete from amenities where id ='$uid'";
    if(mysqli_query($conDB, $sql)){
        $_SESSION['SuccessMsg'] = "Delete Record";
        redirect('amenities.php');
    }
}
if(isset($_GET['update'])){
    $uid = $_GET['update'];
    $sql = mysqli_query($conDB, "select * from amenities where id ='$uid'");
    $row = mysqli_fetch_assoc($sql);
    $title = $row['title'];
    if(isset($_POST['submit'])){
        $title = $_POST['amenities'];
        $sql = "update amenities set title='$title' where id ='$uid'";
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Update Successfull";
            redirect('amenities.php');
        }
    }
}
if(isset($_POST['submit'])){
    
        $title = $_POST['amenities'];
        $sql = "insert into amenities(title) values('$title')";
        if(mysqli_query($conDB, $sql)){
            $_SESSION['SuccessMsg'] = "Update Successfull";
            redirect('amenities.php');
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


    <title> Booking </title>

    <?php include(SERVER_ADMIN_SCREEN_PATH.'link.php') ?>


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
                                Booking
                            </h5>
                            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                <li class="breadcrumb-item text-sm">
                                    <a class="opacity-3 text-dark" href="javascript:;.html">
                                        <svg width="12px" height="12px" class="mb-1" viewbox="0 0 45 40" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>shop </title>
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-1716.000000, -439.000000)" fill="#252f40"
                                                    fill-rule="nonzero">
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
                                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                        href="<?php echo FRONT_BOOKING_SITE ?>">Home</a></li>
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Booking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4" id="manage_room">

            <div class="row">
                <div class="col-12">
                    <div class="card">


                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-12 m-auto">
                                    <?php // echo SuccessMsg(); echo ErrorMsg() ?>
                                    <div id="tabContainer">

                                        <header class="tabs-nav">
                                            <ul>
                                                <?php
                                                    foreach (getHotelService() as $key => $value) {
                                                        $service = $value['serviceName'];
                                                        $status = $value['status'];
                                                        $slag = $value['slag'];
                                                        ($key == 0) ? $active = 'active' : $active = '';
                                                        if($status == 1){
                                                            echo "<li class='$active'><a href='#$slag'>$service</a></li>";
                                                        }
                                                    }
                                                ?>
                                                
                                            </ul>
                                        </header>

                                        <section class="tabs-content">

                                            <div id="booking" class="tabContent">

                                                <h3>Booking Detail</h3>

                                                <div class="row mb15">
                                                    <div class="col-md-6">
                                                        <ul class="paymentStatusList">
                                                            <li>
                                                                <div class="form-group">
                                                                    <input type="radio" checked id="success"
                                                                        name="paymentStatus" value="complete">
                                                                    <label for="success">Success <div
                                                                            class="icon check"><i
                                                                                class="fa fa-check"></i></div></label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <input type="radio" id="failed" name="paymentStatus"
                                                                        value="pending">
                                                                    <label for="failed">Failed <div class="icon times">
                                                                            <i class="fa fa-times"></i>
                                                                        </div></label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <p>Date: <input class="form-control" type="text" id="datepicker"
                                                                name="datepicker"></p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p>Search: <input class="form-control" type="text" name="search"
                                                                id="booking_search"></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col_12">


                                                        <div id="load_data"></div>


                                                    </div>
                                                </div>


                                            </div>

                                            <div id="quickPay" class="tabContent">
                                                <h3>Quick Pay Detail</h3>

                                                <div class="row mb15">
                                                    <div class="col-md-6">
                                                        <ul class="paymentStatusList">

                                                            <li>
                                                                <div class="form-group">
                                                                    <input type="radio" checked id="qpsuccess"
                                                                        name="QPPaymentStatus" value="complete">
                                                                    <label for="qpsuccess">Success <div
                                                                            class="icon check"><i
                                                                                class="fa fa-check"></i></div></label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="form-group">
                                                                    <input type="radio" id="qpfailed"
                                                                        name="QPPaymentStatus" value="pending">
                                                                    <label for="qpfailed">Failed <div
                                                                            class="icon times"><i
                                                                                class="fa fa-times"></i></div></label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-md-3">

                                                    </div>
                                                    <div class="col-md-3">
                                                        <p>Search: <input class="form-control" type="text" name="search"
                                                                id="qp_search"></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">



                                                        <div id="load_qpdata"></div>



                                                    </div>
                                                </div>

                                            </div>

                                            <div id="walkIn" class="tabContent">
                                                <div class="dFlex jcsb aic">
                                                    <h3>Walk In Detail</h3>
                                                    <button id="walkInAddBtn" class="btn bg-gradient-info">Add Booking</button>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">



                                                        <div id="load_widata"></div>



                                                    </div>
                                                </div>

                                            </div>

                                        </section>

                                        <div id="sideBar"> </div>

                                    </div>


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
            <div class="close icon icon-shape bg-gradient-danger shadow text-center border-radius-md"></div>
            <div class="box">

            </div>
        </div>
    </div>


    <div id="addBookingPopUpBox">
        <div class="closePopUpBox"></div>
        <div class="content">
            <div class="closeContent">X</div>
            <div class="popUpBoxContent">
                <form id="addBookingForm" action="">
                    <div class="topCon">

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="checkInDate">Check In</label>
                                    <input type="date" id="checkInDate" name="checkInDate" required value="<?= date('Y-m-d') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="checkOutDate">Check Out</label>
                                    <input type="date" id="checkOutDate" name="checkOutDate" required value="<?= date("Y-m-d", strtotime("$today +1 day")) ?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label for="couponCode">Coupon Code</label>
                                    <select name="couponCode" id="couponCode" class="form-control">
                                        <?php
                                            echo "<option value='0'>No Coupon</option>";
                                            foreach(getCouponArry() as $couponList){
                                                
                                                $id = $couponList['id'];
                                                $code = $couponList['coupon_code'];

                                                echo "<option value='$code'>$code</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="type" value="addWalkInBooking">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="roomType">Room Type</label>
                                    <select name="roomType[]" id="roomType" class="form-control">
                                        
                                        <?php
                                        
                                            foreach(getRoomArr() as $roomList){
                                                
                                                $id = $roomList['id'];
                                                $name = $roomList['name'];

                                                echo "<option value='$id'>$name</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rateType">Rate Type</label>
                                    <select name="rateType[]" id="rateType" class="form-control">
                                        <?php
                                            
                                            foreach(getRatePlanByRoomId() as $roomDetailList){
                                                
                                                $id = $roomDetailList['id'];
                                                $title = $roomDetailList['title'];

                                                echo "<option value='$id'>$title</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="adult">Adult</label>
                                    <select name="adult[]" id="adult" class="form-control">
                                        <?php 
                                        
                                            for ($i=1; $i <= getRoomCapacityById(); $i++) { 
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="child">Child</label>
                                    <select name="child[]" id="child" class="form-control">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="otherRoomContent"></div>
                        <!-- <div
                         id="addRoomBtn" class="btn btn-outline-primary btn-sm" >Add Room</div> -->

                        <div class="row">
                            <div class="col-12">
                                <h4>Guest Information</h4>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guestName">Guest Name</label>
                                    <input type="text" id="guestName" name="guestName" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guestEmail">Guest Email</label>
                                    <input type="text" id="guestEmail" name="guestEmail" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="guestNumber">Guest Number</label>
                                    <input type="text" id="guestNumber" name="guestNumber" required
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <h6 id="guestExtraInformationBtn">Extra <i class="fa fa-caret-right"></i></h6>
                            </div>

                        </div>


                        <div class="row guestExtraInformation">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="companyName">Company Name</label>
                                    <input type="text" id="companyName" name="companyName" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="companyGstNumber">Company GST Number</label>
                                    <input type="text" id="companyGstNumber" name="companyGstNumber"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="priceDetailText">Price Detail</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="totalPrice">Gross Price</label>
                                    <input type="number" name="totalPrice" id="totalPrice" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userPay">User Price</label>
                                    <input type="number" name="userPay" id="userPay" class="form-control" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="BtmCon dFlex jcsb aic">
                        <div id="closePopUpBox" class="btn bg-gradient-secondary">Close</div>
                        <button class="btn bg-gradient-primary" type="submit">Submit</button>
                    </div>
            </div>

            </form>
        </div>
    </div>

    </div>

    <?php include(SERVER_ADMIN_SCREEN_PATH.'script.php') ?>







    <script>

    $('#navTopBar').hide();
    $(function() {
        $("#datepicker").datepicker();
    });

    $(function() {
        $('.tabs-nav a').click(function() {


            $('.tabs-nav li').removeClass('active');
            $(this).parent().addClass('active');


            let currentTab = $(this).attr('href');
            $('.tabs-content .tabContent').hide();
            $(currentTab).show();

            return false;
        });
    });

    </script>

    <script>
    $('.nav-link').removeClass('active');
    $('.bookingLink').addClass('active');

    function load_book($page, $paymentStatus) {
        var page = $page;
        var paymentStatus = $paymentStatus;
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'load_book',
                page_no: page,
                paymentStatus: paymentStatus
            },
            success: function(data) {
                $('#load_data').html(data);
            }
        });
    }

    function load_quickPay($page, $paymentStatus) {
        var page = $page;
        var paymentStatus = $paymentStatus;
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'load_quickPay',
                page_no: page,
                paymentStatus: paymentStatus
            },
            success: function(data) {
                $('#load_qpdata').html(data);
            }
        });
    }

    function load_wibooking($page, $paymentStatus) {
        var page = $page;
        var paymentStatus = $paymentStatus;
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'load_wibooking',
                page_no: page,
                paymentStatus: paymentStatus
            },
            success: function(data) {
                $('#load_widata').html(data);
            }
        });
    }

    $('#datepicker').on('change', function() {
        var date = $(this).val();
        $('#booking_search').val('');
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'load_book',
                date: date
            },
            success: function(data) {
                $('#load_data').html(data);
            }
        });
    });

    $('#booking_search').on('change', function() {
        var search = $(this).val();
        $('#datepicker').val('');
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'load_book',
                search: search
            },
            success: function(data) {
                $('#load_data').html(data);
            }
        });
    });


    $('#qp_search').on('change', function() {
        var search = $(this).val();
        $('#datepicker').val('');
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'load_quickPay',
                search: search
            },
            success: function(data) {
                $('#load_qpdata').html(data);
            }
        });
    });

    $(document).ready(function() {

        load_book(1, 'complete');

        load_quickPay(1, 'complete');

        load_wibooking(1, 'complete');

        $(document).on('click', '#pagination a', function(e) {
            e.preventDefault();
            $('#pagination a').removeClass('active');
            $(this).addClass('active');
            var page = $(this).html();
            var status = $("input[type=radio][name=paymentStatus]:checked").val();
            load_book(page, status);
        });

        $(document).on('change', 'input[type=radio][name=paymentStatus]', function(e) {
            e.preventDefault();
            var status = $("input[type=radio][name=paymentStatus]:checked").val();
            load_book(1, status);
        });

        $(document).on('click', '#qppagination a', function(e) {
            e.preventDefault();
            $('#qppagination a').removeClass('active');
            $(this).addClass('active');
            var page = $(this).html();
            var status = $("input[type=radio][name=QPPaymentStatus]:checked").val();
            load_quickPay(page, status);
        });

        $(document).on('change', 'input[type=radio][name=QPPaymentStatus]', function(e) {
            e.preventDefault();
            var status = $("input[type=radio][name=QPPaymentStatus]:checked").val();
            load_quickPay(1, status);
        });

        $(document).on('click', '.removeBooking', function(e) {
            e.preventDefault();
            var bid = $(this).data('id');
            var page = $(this).data('page');
            $.ajax({
                url: 'include/ajax/booking.php',
                type: 'post',
                data: {
                    type: 'removeBooking',
                    bid: bid
                },
                success: function(data) {
                    load_book(page, 'pending');
                }
            });
        });

        $(document).on('change', '.quickPayGross', function() {
            var price = $(this).val().trim();
            var qpid = $(this).data('qpid');
            var page = $(this).data('page');
            $.ajax({
                url: 'include/ajax/booking.php',
                type: 'post',
                data: {
                    type: 'updateGross',
                    price: price,
                    qpid: qpid,
                    page: page
                },
                success: function(data) {
                    if (data == 1) {
                        load_quickPay(page, 'complete');
                    }
                }
            })
        });


    });

    $(document).on('click', '.personDetailBtn', function() {
        $('.personDetailBtn').show();
        $(this).hide();
        $('.personDetailContent').hide();
        $(this).parent().find('.personDetailContent').show();
    });

    $(document).on('click', '.roomDetailBtn', function() {
        $('.roomDetailBtn').show();
        $(this).hide();
        $('.roomDetailContent').hide();
        $(this).parent().find('.roomDetailContent').show();
    });


    $(document).on('click', '.roomDetail', function() {
        var bid = $(this).data('bid');
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {
                type: 'roomDetail',
                bid: bid
            },
            success: function(data) {
                $('#sideBar').addClass('show').html(data);
            }
        });
    });

    $(document).on('click', '.closeSideBar', function() {
        $('#sideBar').removeClass('show');
    });

    $(document).on('click', '#sideBar .close', function() {
        $('#sideBar').removeClass('show');
    });

    $(document).on('click', '.editGrossCharge', function() {
        var qpid = $(this).data('qpid');
        var page = $(this).data('page');
        $html = "<input data-qpid='" + qpid + "' data-page='" + page +
            "' value='' placeholder='Gross Charge' class='quickPayGross form-control'>";
        $(this).parent().html($html);
    });

    $(document).on('click', '.toggleGross', function(e) {
        e.preventDefault();
        alert('Please Enter The Correct Gross Amount To The Generate Voucher.');
        // $( ".quickPayGross" ).focus();
    });

    $(document).on('change', '#roomType', function(){
        var roomId = $(this).val();

        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {type:'changeRoomDetailById',id:roomId},
            success: function(data) {
                $('#rateType').html(data);
            }
        });

    });

    $(document).on('change', '#roomType', function(){
        var roomId = $(this).val();

        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: {type:'changeAdultById',id:roomId},
            success: function(data) {
                $('#adult').html(data);
            }
        });

    });

    $(document).on('submit', '#addBookingForm', function(e){
        e.preventDefault();
        $.ajax({
            url: 'include/ajax/booking.php',
            type: 'post',
            data: $('#addBookingForm').serialize(),
            success: function(data) {
                load_wibooking();
                $("#addBookingForm").trigger('reset');
                $('#addBookingPopUpBox').removeClass('show');
            }
        });
    }); 


    $(document).on('click', '#walkInAddBtn', function(){
        $('#addBookingPopUpBox').addClass('show');
    });

    $(document).on('click', '#addBookingPopUpBox .closePopUpBox', function(){
        $('#addBookingPopUpBox').removeClass('show');
    });

    $(document).on('click', '#addBookingPopUpBox .closeContent', function(){
        $('#addBookingPopUpBox').removeClass('show');
    });

    $(document).on('click', '#addBookingPopUpBox #closePopUpBox', function(){
        $('#addBookingPopUpBox').removeClass('show');
    });

    $(document).on('click','#guestExtraInformationBtn', function(){
        $('.guestExtraInformation').toggleClass('show');
    });



    </script>




</body>

</html>