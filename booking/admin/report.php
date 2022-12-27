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

  <title>Report</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="css/icons.css" rel="stylesheet">
  <link href="css/svg.css" rel="stylesheet">
  <link id="pagestyle" href="css/getbootstrap.css" rel="stylesheet">
  <link id="pagestyle" href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

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
                                Report
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
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Report</li>
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
                                <div class="card p-3">
                                    <form id="reportForm" method="post">
                                        <div class="row" style="align-items: end;">
                                            <div class="col-md-6 mb-3">
                                                <label for="from">From</label>
                                                <input class="form-control" type="text" id="from" name="from" placeholder="Stating Date">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="to">to</label>
                                                <input class="form-control" type="text" id="to" name="to" placeholder="End Date">
                                                <input type="hidden" name="dataType" value="get">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="type">Type:</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="bookingDate">Booking Date</option>
                                                    <option value="checkInDate">Check In Date</option>
                                                    <option value="checkOutDate">Check Out Date</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="Booking">Booking:</label>
                                                <select name="Booking" id="Booking" class="form-control">
                                                    <option value="bookingEngine">Booking Engine</option>
                                                    <option value="quickPay">Quick Pay</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control btn bg-gradient-primary btn-sm mb-0" type="submit" name="submit" >
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section id="reportData">
                <div class="container">
                    <div class="row">
                    <div class="col_12">
                        <div class="card">
                            <div class="card-body">
                                <div id="loadReportData"></div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>

            
            <?php include(SERVER_ADMIN_SCREEN_PATH.'footer.php') ?>
        </div>

  </main>

  

  <?php include(SERVER_ADMIN_SCREEN_PATH.'script.php') ?>

  
  

  




<script>
$('#navTopBar').hide();
$('.nav-link').removeClass('active'); 
      $('.reportLink').addClass('active');
      $('.basicLink').addClass('active');


  
  </script>


<script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );


  $(document).on('submit', '#reportForm', function(e){
      e.preventDefault();
      $.ajax({
        url : 'include/ajax/report.php',
        type: 'post',
        data : $('#reportForm').serialize(),
        success: function(data){
            $('#loadReportData').html(data);
        }
      });
  });

  $(document).on('click','#downloadReport', function(){
    var data= $('#loadReportData').html();
    $("#tblCustomers").table2excel({
          filename: "Table.xls"
      });
  });
  </script>



</body>

</html>