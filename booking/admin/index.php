<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="favicons/img-apple-icon.png">
  <link rel="icon" type="image/png" href="favicons/img-favicon.png">
  
  <title>Dashboard </title>

<?php include(SERVER_ADMIN_SCREEN_PATH.'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

<?php include(SERVER_ADMIN_SCREEN_PATH.'sidebar.php') ?>
  

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <?php include(SERVER_ADMIN_SCREEN_PATH.'navbar.php') ?>

    <div class="container-fluid py-4" >
      <div class="row">
        <div class="col-lg-12 position-relative z-index-2">
          <div class="card card-plain mb-4">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-lg-6">
                  <div class="d-flex flex-column h-100">
                    <h2 class="font-weight-bolder mb-0">Booking Statistics</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="dashboardCard">

            <div class="col-lg-3 col-sm-6">
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="BE: <?php echo custom_number_format(roomBooking()) ?>, QP: <?php echo custom_number_format(qpRoomBooking()) ?>">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Booking</p>
                        <h5 class="font-weight-bolder mb-0" >
                          <?php echo custom_number_format(roomBooking() + qpRoomBooking()) ?>
                          <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Lifetime Earning</p>
                        <?php
                          
                            foreach(getHotelService() as $serviceList){
                              $short = $serviceList['short'];
                              $name = $serviceList['serviceName'];
                              $status = $serviceList['status'];
                              if($status == 1){
                                if($short == 'BE'){
                                  $price = custom_number_format(earnig()['gross']);
                                }
                                if($short == 'QP'){
                                  $price = qpTodayCheckIn();
                                }
                                if($short == 'WI'){
                                  $price = custom_number_format(wiEarnig()['gross']);
                                }
                                echo '
                                  <h6 style="margin-bottom: .1rem;display: inline-block;"><small>'.$short.': </small> <strong>'.$price.'</strong></h6>
                                ';
                              }
                            }
                          
                          
                          ?>
                          
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                        <i class="fas fa-wallet text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card " >
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Checkin</p>
                        <ul class="dashboardCard">
                          <?php
                          
                            foreach(getHotelService() as $serviceList){
                              $short = $serviceList['short'];
                              $name = $serviceList['serviceName'];
                              $status = $serviceList['status'];
                              if($status == 1){
                                if($short == 'BE'){
                                  $price = todayCheckIn();
                                }
                                if($short == 'QP'){
                                  $price = qpTodayCheckIn();
                                }
                                if($short == 'WI'){
                                  $price = wiTodayCheckIn();
                                }
                                echo '
                                    <li id="todayCheckIn">
                                      <span>'.$short.'</span>
                                      <h6 class="font-weight-bolder mb-0">'.$price.'</h6>
                                    </li>
                                ';
                              }
                            }
                          
                          
                          ?>

                        </ul>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-warning  shadow text-center border-radius-md">
                        <i class="far fa-calendar-plus text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mt-sm-0 mt-4">
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Room Night</p>
                        <h5 class="font-weight-bolder mb-0">
                          <?php echo roomNight() ?>
                          <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span> -->
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-success  shadow text-center border-radius-md">
                        
                        <i class="fas fa-cloud-moon text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <?php
                      $totalPrice = 0;
                      foreach(getHotelService() as $serviceList){
                        $short = $serviceList['short'];
                        $name = $serviceList['serviceName'];
                        $status = $serviceList['status'];
                        if($status == 1){
                          $existService[] = $short;
                          if($short == 'BE'){
                            $price = earnig()['gross'];
                          }
                          if($short == 'QP'){
                            $price = qpTodayCheckIn();
                          }
                          if($short == 'WI'){
                            $price = wiEarnig()['gross'];
                          }
                          $totalPrice += $price;
                        }
                      }
                      
                      $strService = implode(',', $existService);
                      $totalPrice = custom_number_format($totalPrice);
                        echo '
                        
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Lifetime '.$strService.' Earning</p>
                                <h6 class="font-weight-bolder mb-0">
                                  '.$totalPrice.'
                                </h6>
                              </div>
                            </div>
                        
                        ';
                      ?>
                      
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-warning   shadow text-center border-radius-md">
                        <i class="fas fa-coins text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card " >
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Checkout</p>
                        
                        <ul class="dashboardCard">
                          <?php
                            
                              foreach(getHotelService() as $serviceList){
                                $short = $serviceList['short'];
                                $name = $serviceList['serviceName'];
                                $status = $serviceList['status'];
                                if($status == 1){
                                  if($short == 'BE'){
                                    $price = todayCheckOut();
                                  }
                                  if($short == 'QP'){
                                    $price = qpTodayCheckOut();
                                  }
                                  if($short == 'WI'){
                                    $price = wiTodayCheckOut();
                                  }
                                  echo '
                                      <li id="todayCheckIn">
                                        <span>'.$short.'</span>
                                        <h6 class="font-weight-bolder mb-0">'.$price.'</h6>
                                      </li>
                                  ';
                                }
                              }
                            
                            
                            ?>

                        </ul>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="far fa-calendar-minus text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6">
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Booking Revenue</p>
                          <?php
                          
                            foreach(getHotelService() as $serviceList){
                              $short = $serviceList['short'];
                              $name = $serviceList['serviceName'];
                              $status = $serviceList['status'];
                              if($status == 1){
                                if($short == 'BE'){
                                  $price = custom_number_format(dailyBookingEarningByAddOn(date('Y-m-d')));
                                  $persion = dailyBookingEarningByAddOnCount(date('Y-m-d'));
                                  $paid = custom_number_format(dailyUserPayBookingEarningByAddOn(date('Y-m-d')));
                                }
                                if($short == 'QP'){
                                  $price =  custom_number_format(dailyQuickPayEarningByAddOn(date('Y-m-d')));
                                  $persion = dailyQuickPayEarningByAddOnCount(date('Y-m-d'));
                                  $paid = custom_number_format(dailyUserPayQuickPayEarningByAddOn(date('Y-m-d')));
                                }
                                if($short == 'WI'){
                                  $price = custom_number_format(dailyWalkInEarningByAddOn(date('Y-m-d')));
                                  $persion = dailyWalkInEarningByAddOnCount(date('Y-m-d'));
                                  $paid = custom_number_format(dailyUserPayWalkInEarningByAddOn(date('Y-m-d')));
                                }
                                echo '
                                  <h6 style="margin-bottom: .1rem;display: inline-block;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Total: '.$price.', Paid: '.$paid.'"><small>'.$short.': </small> <strong>'.$price.' / '.$persion.'</strong></h6>
                                ';
                              }
                            }
                          
                          
                          ?>

                      </div>                    
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-primary  shadow text-center border-radius-md">
                      
                        <i class="fas fa-hand-holding-usd text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Month Earnings</p>
                      <?php
                          
                          foreach(getHotelService() as $serviceList){
                            $short = $serviceList['short'];
                            $name = $serviceList['serviceName'];
                            $status = $serviceList['status'];
                            $i = 1;
                            $currentDate = strtotime(date('Y-m-d'));
                            $months = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));
                            $timestamp    = strtotime($months);
                            $first_second = date('Y-m-01 ', $timestamp);
                            $last_second  = date('Y-m-t ', $timestamp); 
                            if($status == 1){
                              if($short == 'BE'){
                                $price = MonthlyBookingEarning($first_second, $last_second);
                              }
                              if($short == 'QP'){
                                $price = MonthlyQuickPayEarning($first_second, $last_second);
                              }
                              if($short == 'WI'){
                                $price = wiEarnig()['gross'];
                              }
                              $price = custom_number_format(round($price));
                              echo '
                                <h6 style="margin-bottom: .1rem;display: inline-block;"><small>'.$short.': </small> <strong>'.$price.'</strong></h6>
                              ';
                            }
                          }
                        
                        
                        ?>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                      
                        <i class="fas fa-hand-holding-usd text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card  mb-4">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Average Stay</p>
                        <h6 class="font-weight-bolder mb-0">
                          <?php echo averageStay() ?>%
                          <!-- <span class="text-success text-sm font-weight-bolder">+55%</span> -->
                        </h6>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                        <i class="fas fa-bed text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-sm-6 mt-sm-0 mt-4">
              <div class="card  mb-4">
                  <?php 
                  $style = '';
                    if(tryRoomBooking() > 0){
                        $style = 'background: #ff000026;border-radius: 15px';
                    }
                  ?>
                <div class="card-body p-3" style="<?php echo $style ?>">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Try / Failed Bookings</p>
                        <h6 class="font-weight-bolder mb-0">
                          <?php echo tryRoomBooking()." / " .tryBook() ?>
                          <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span> -->
                        </h6>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                     
                        <i class="far fa-calendar-times text-lg opacity-10"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card cardBig mb-4" style="overflow:hidden">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-8">
                      <div class="numbers">
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Website Visitor</p>
                        <h5 class="font-weight-bolder mb-0">
                          <?php echo visiter() ?>
                          <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span> -->
                        </h5>
                      </div>
                    </div>
                    <div class="col-4 text-end">
                      <div class="icon icon-shape bg-gradient-info  shadow text-center border-radius-md">
                        <i class="fas fa-users text-lg opacity-10"></i>
                      </div>
                    </div>
                    <div class="col-12" style="padding-right: 0;padding-left: 0;transform: translate(-17px,11px);">
                    <div class="chart">
                      <canvas id="chartVisiterWidgets" class="chart-canvas" width="248" height="200" style="width:248px"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>

          </div>
          
        </div>
      </div>

      <div class="row mt-4">

  
        <div class="col-lg-7 mb-4">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Weekly Check-In overview</h6>
              <!-- <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p> -->
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Today Check-In overview</h6>
              <!-- <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p> -->
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="pieChart" class="chart-canvas" height="300" width="444" style="display: block; box-sizing: border-box; height: 300px; width: 444px;"></canvas>
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-lg-12 mb-4">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Daily Revenue overview</h6>
              <!-- <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2021
              </p> -->
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="mixed-chart" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 mb-lg-0 mb-4">
          <div class="card z-index-2">
            <div class="card-body p-3">
              <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
                </div>
              </div>
              
            </div>
          </div>
        </div>

      </div>

      <div class="row" style="opacity:.1">
        <div class="col-12">
          <div id="globe" class="position-absolute end-0 top-10 mt-sm-3 mt-7 me-lg-7">
            <canvas width="700" height="600" class="w-lg-100 h-lg-100 w-75 h-75 me-lg-0 me-n10 mt-lg-5"></canvas>
          </div>
        </div>
      </div>
      <?php include(SERVER_ADMIN_SCREEN_PATH.'footer.php') ?>
    </div>

  </main>

  <div id="indexSlidBar">
      <div class="closeContent"></div>
      <div class="contatent">
          <div class="close">X</div>
          <div class="box">

          </div>
      </div>
  </div>

  <?php include(SERVER_ADMIN_SCREEN_PATH.'script.php') ?>

  
  <script>

$('.breadcrumb-item.active').html('Dashboard');


$('#todayCheckIn').on('click', function(){
        $.ajax({
            url: 'include/ajax/otherDetail.php',
            type: 'post',
            data : {type:'todayCheckIn'},
            success : function(data){
                $('#indexSlidBar').addClass('show');
                $('#indexSlidBar .box').html(data);
            }
        });
    });


    $('#todayCheckOut').on('click', function(){
        $.ajax({
            url: 'include/ajax/otherDetail.php',
            type: 'post',
            data : {type:'todayCheckOut'},
            success : function(data){
                $('#indexSlidBar').addClass('show');
                $('#indexSlidBar .box').html(data);
            }
        });
    });

    $('#qpTodayCheckIn').on('click', function(){
        $.ajax({
            url: 'include/ajax/otherDetail.php',
            type: 'post',
            data : {type:'qptodayCheckIn'},
            success : function(data){
                $('#indexSlidBar').addClass('show');
                $('#indexSlidBar .box').html(data);
            }
        });
    });

    $('#qpTodayCheckOut').on('click', function(){
        $.ajax({
            url: 'include/ajax/otherDetail.php',
            type: 'post',
            data : {type:'qptodayCheckOut'},
            success : function(data){
                $('#indexSlidBar').addClass('show');
                $('#indexSlidBar .box').html(data);
            }
        });
    });

    $(document).on('click','#todayCheckInDownloadData', function(){
        $.ajax({
            url: 'include/ajax/otherDetail.php',
            type: 'post',
            data : {type:'todayCheckInDownload'},
            success : function(data){
                
            }
        });
    })


    $('#indexSlidBar .closeContent').on('click', function(){
        $('#indexSlidBar').removeClass('show');
    });
    
    $('#indexSlidBar .close').on('click', function(){
        $('#indexSlidBar').removeClass('show');
    });


    <?php
    

      for ($i=7; $i > -1 ; $i--) { 
          $currentDate = strtotime(date('Y-m-d'));
          $months = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));
          $timestamp    = strtotime($months);
          $first_second = date('Y-m-01 ', $timestamp);
          $last_second  = date('Y-m-t ', $timestamp); 
          $booking = 0;
          $quickPay = 0;
          $booking= MonthlyBookingEarning($first_second, $last_second);
          $quickPay= MonthlyQuickPayEarning($first_second, $last_second);
          $totalBook = round($booking + $quickPay);
          
          $dateprint = date('M', strtotime($months));
          $chartBarData[]=[
            'day'=> $dateprint,
            'booking'=> $totalBook,
          ];
      }
    
    ?>


    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [<?php foreach($chartBarData as $dateList){ $date = $dateList['day']; echo '"'.$date.'",';} ?>],
        datasets: [{
          label: "Booking",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [<?php foreach($chartBarData as $priceList){ $date = $priceList['booking']; echo "$date ,";} ?>],
          maxBarThickness: 8
        },
      ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: true,
              drawTicks: true,
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    <?php
    

      for ($i=7; $i > 0 ; $i--) { 
          $currentDate = strtotime(date('Y-m-d'));
          $oneDay = strtotime('1 day 00 second', 0);
          $date = $currentDate - ($oneDay * $i) + $oneDay;
          $getDate = date('Y-m-d', $date);
          $booking= round(dailyBookingEarning($getDate));
          $quickPay= round(dailyQuickPayEarning($getDate));
          $dateprint = date('D', $date);
          $cartLineData[]=[
            'day'=> $dateprint,
            'booking'=> $booking,
            'quickpay'=> $quickPay,
          ];
      }
      
      
    ?>
    new Chart(ctx2, {
      type: "line",
      data: {
        labels: [<?php foreach($cartLineData as $dateList){ $date = $dateList['day']; echo '"'.$date.'",';} ?>],
        datasets: [{
          label: "Quick Pay",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 3,
          backgroundColor: gradientStroke1,
          fill: true,
          data: [<?php foreach($cartLineData as $priceList){ $date = $priceList['quickpay']; echo "$date ,";} ?>],
          maxBarThickness: 6

        },
        {
          label: "Booking",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#3A416F",
          borderWidth: 3,
          backgroundColor: gradientStroke2,
          fill: true,
          data: [<?php foreach($cartLineData as $priceList){ $date = $priceList['booking']; echo "$date ,";} ?>],
          maxBarThickness: 6
        },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx7 = document.getElementById("mixed-chart").getContext("2d");
    <?php
    
      $date = date('F Y');
      $date = date('F Y');
      $nOfDay = date('t', strtotime($date));
      for ($i=0; $i < $nOfDay; $i++) { 
          $oneDate = date("Y-m-d", strtotime(date('Y-m-01')) + (86400 * $i));
          $booking= dailyBookingEarningByAddOn($oneDate);
          $quickPay= dailyQuickPayEarningByAddOn($oneDate);
          
          $datePrint = date('d', strtotime($oneDate));
          $dailyBooking[] = [
            'day'=> $datePrint,
            'book'=> $booking,
            'qp'=> $quickPay,
          ];
      }

    
    ?>
    new Chart(ctx7, {
      data: {
        labels: [<?php foreach($dailyBooking as $dateList){ $date = $dateList['day']; echo '"'.$date.'",';} ?>],
        datasets: [{
            type: "bar",
            label: "Booking",
            weight: 5,
            tension: 0.4,
            borderWidth: 0,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            backgroundColor: '#3A416F',
            borderRadius: 4,
            borderSkipped: false,
            data: [<?php foreach($dailyBooking as $priceList){ $date = $priceList['book']; echo "$date ,";} ?>],
            maxBarThickness: 10,
          },
          {
            type: "line",
            label: "Quck Pay",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            pointBackgroundColor: "#cb0c9f",
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            data: [<?php foreach($dailyBooking as $priceList){ $date = $priceList['qp']; echo "$date ,";} ?>],
            fill: true,
          }
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: true,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 10,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    (function () {
      const container = document.getElementById("globe");
      const canvas = container.getElementsByTagName("canvas")[0];

      const globeRadius = 100;
      const globeWidth = 4098 / 2;
      const globeHeight = 1968 / 2;

      function convertFlatCoordsToSphereCoords(x, y) {
        let latitude = ((x - globeWidth) / globeWidth) * -180;
        let longitude = ((y - globeHeight) / globeHeight) * -90;
        latitude = (latitude * Math.PI) / 180;
        longitude = (longitude * Math.PI) / 180;
        const radius = Math.cos(longitude) * globeRadius;

        return {
          x: Math.cos(latitude) * radius,
          y: Math.sin(longitude) * globeRadius,
          z: Math.sin(latitude) * radius
        };
      }

      function makeMagic(points) {
        const {
          width,
          height
        } = container.getBoundingClientRect();

        // 1. Setup scene
        const scene = new THREE.Scene();
        // 2. Setup camera
        const camera = new THREE.PerspectiveCamera(45, width / height);
        // 3. Setup renderer
        const renderer = new THREE.WebGLRenderer({
          canvas,
          antialias: true
        });
        renderer.setSize(width, height);
        // 4. Add points to canvas
        // - Single geometry to contain all points.
        const mergedGeometry = new THREE.Geometry();
        // - Material that the dots will be made of.
        const pointGeometry = new THREE.SphereGeometry(0.5, 1, 1);
        const pointMaterial = new THREE.MeshBasicMaterial({
          color: "#989db5",
        });

        for (let point of points) {
          const {
            x,
            y,
            z
          } = convertFlatCoordsToSphereCoords(
            point.x,
            point.y,
            width,
            height
          );

          if (x && y && z) {
            pointGeometry.translate(x, y, z);
            mergedGeometry.merge(pointGeometry);
            pointGeometry.translate(-x, -y, -z);
          }
        }

        const globeShape = new THREE.Mesh(mergedGeometry, pointMaterial);
        scene.add(globeShape);

        container.classList.add("peekaboo");

        // Setup orbital controls
        camera.orbitControls = new THREE.OrbitControls(camera, canvas);
        camera.orbitControls.enableKeys = false;
        camera.orbitControls.enablePan = false;
        camera.orbitControls.enableZoom = false;
        camera.orbitControls.enableDamping = false;
        camera.orbitControls.enableRotate = true;
        camera.orbitControls.autoRotate = true;
        camera.position.z = -265;

        function animate() {
          // orbitControls.autoRotate is enabled so orbitControls.update
          // must be called inside animation loop.
          camera.orbitControls.update();
          requestAnimationFrame(animate);
          renderer.render(scene, camera);
        }
        animate();
      }

      function hasWebGL() {
        const gl =
          canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
        if (gl && gl instanceof WebGLRenderingContext) {
          return true;
        } else {
          return false;
        }
      }

      function init() {
        if (hasWebGL()) {
          window
          window.fetch("https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard-pro/assets/js/points.json")
            .then(response => response.json())
            .then(data => {
              makeMagic(data.points);
            });
        }
      }
      init();
    })();
    
    
    <?php
    
      
      for ($i=7; $i > -1 ; $i--) { 
          $currentDate = strtotime(date('Y-m-d'));
          $months = date("F Y", strtotime( date( 'Y-m-01' )." -$i months"));
          $timestamp    = strtotime($months);
          $first_second = date('Y-m-01 ', $timestamp);
          $last_second  = date('Y-m-t ', $timestamp); 
          $booking = 0;
          $quickPay = 0;
          $visiter= getvisiterCountByDate($first_second, $last_second);
          
          
          $dateprint = date('M', strtotime($months));
          $visiterData[]=[
            'day'=> $dateprint,
            'visiter'=> $visiter,
          ];
      }
      
      
    ?>


    var ctx1 = document.getElementById("chartVisiterWidgets").getContext("2d");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.02)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

    new Chart(ctx1, {
      type: "line",
      data: {
        labels: [<?php foreach($visiterData as $dateList){ $date = $dateList['day']; echo '"'.$date.'",';} ?>],
        datasets: [{
          label: "Users",
          tension: 0.5,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#252f40",
          borderWidth: 2,
          backgroundColor: gradientStroke2,
          data: [<?php foreach($visiterData as $priceList){ $date = $priceList['visiter']; echo "$date ,";} ?>],
          maxBarThickness: 6,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
        },
      },
    });


    var ctx4 = document.getElementById("pieChart").getContext("2d");

    new Chart(ctx4, {
      type: "pie",
      data: {
        labels: ['Booking', 'Quick Pay'],
        datasets: [{
          label: "Projects",
          weight: 9,
          cutout: 0,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          backgroundColor: ['#17c1e8', '#cb0c9f', '#3A416F', '#a8b8d8'],
          data: [<?php echo revenue()['0']['gross'] ?>, <?php echo dailyQuickPay() ?>],
          fill: false
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });
    
  </script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script async defer src="js/buttons.github.io-buttons.js"></script>

  <script src="js/script.js"></script>
</body>

</html>