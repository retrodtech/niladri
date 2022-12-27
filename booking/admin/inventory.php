<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}

$current_date = strtotime(date('Y-m-d'));
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

  <title>Inventory</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="css/icons.css" rel="stylesheet">
  <link href="css/svg.css" rel="stylesheet">
  <link id="pagestyle" href="css/getbootstrap.css" rel="stylesheet">
  <link id="pagestyle" href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <style>
    ul {
        list-style: none;
        padding: 0;
    }

    ul .inner {
        padding-left: 1em;
        overflow: hidden;
        display: none;
    }

    ul li {
        margin: 0.5em 0;
    }

    ul li a.toggle {
        width: 100%;
        display: block;
        background: rgba(0, 0, 0, 0.78);
        color: #fefefe;
        padding: 0.75em;
        border-radius: 0.15em;
        transition: background 0.3s ease;
    }

    ul li a.toggle:hover {
        background: rgba(0, 0, 0, 0.9);
    }
  </style>

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
                                Inventory
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
                                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Inventory</li>
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
                        

                        <div class="row justify-content-center">
                        <?php echo SuccessMsg(); echo ErrorMsg() ?>
                        <div class="alertBox"></div>
                        <div class="col-md-6 m_auto">
                                <form class="row" style="align-items: flex-end;" id="inventoryForm" method="post">
                                    <div style="display: flex;justify-content: space-between;align-items: center;width: 100%;border: 1px solid lightgrey;padding: 0 10px 0 0;border-radius: 10px;">
                                        
                                        <span style="position:relative">
                                            <span style="position: absolute;top: 0;left: 0;width: 40px;height: 40px;background: #e7e7e7;transform: translateX(0%);display: flex;justify-content: center;align-items: center;" ><img style="width: 33px;" src="img/icon/calendar.png"></span>
                                            <input class="form-control" style="padding-left: 50px; height: 40px;" class="form_control" type="text" autocomplete="off" id="datepicker" name="datepicker" value="<?php echo date('m/d/Y') ?>"></span>
                                        <span><input type="radio" checked id="inventory" name="inventoryAction" value="inventory"> <label for="inventory">Inventory</label></span>
                                        <span><input type="radio" id="rate" name="inventoryAction" value="rate"> <label for="rate">Rate</label></span>
                                        
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="col-12 col-lg-12 m-auto" id="inventory">
                                <div id="table_load">
                        
                                </div>
                            
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <?php include(SERVER_ADMIN_SCREEN_PATH.'footer.php') ?>
        </div>

  </main>

  <div id="popup">
    <div class="content">
        <div id="closepopup">X</div>
        <div class="box">
            <form action="" method="post" id="updateInventoryForm">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="from">From</label>
                        <input type="text" id="upfrom" autocomplete="off" name="from" class="form-control" value="<?php echo date('d/m/Y',$current_date) ?>">
                    </div>
                    <div class="form_group col-md-6">
                        <label for="to">to</label>
                        <input type="text" id="upto" autocomplete="off" name="to" class="form-control" value="<?php echo date('d/m/Y',$current_date) ?>">
                    </div>
                </div>
                <div id="load_form_input"></div>
                <div class="row">
                    <div class="col-md-12">
                    <input type="submit" value="Update" name="submit" class="form-control btn bg-gradient-info btn-sm mb-0">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

  <?php include(SERVER_ADMIN_SCREEN_PATH.'script.php') ?>

  
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

  


  <script>
       $('#navTopBar').hide();
    $('#popup').hide();
    $('.nav-link').removeClass('active'); 
      $('.inventoryLink').addClass('active');
    
        $(document).on('click','.toggle',function(e) {
        e.preventDefault();
    
        let $this = $(this);
    
        if ($this.next().hasClass('show')) {
            $this.next().removeClass('show');
            $this.next().slideUp(350);
        } else {
            $this.parent().parent().find('li .inner').removeClass('show');
            $this.parent().parent().find('li .inner').slideUp(350);
            $this.next().toggleClass('show');
            $this.next().slideToggle(350);
        }
    });

    $( function() {
    var dateFormat = "dd/mm/yy",
      from = $( "#upfrom" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat: dateFormat,
          minDate: 0
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#upto" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: dateFormat,
        minDate: 0
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

    $( function() {
        $( "#datepicker" ).datepicker();
    } );

   function loadInventory(){
       var action = $('#datepicker').val();
      
        $.ajax({
            url: 'include/ajax/inventory.php',
            type: 'post',
            data : $('#inventoryForm').serialize(),
            success : function(data){
                $('#table_load').html(data);
            }
        });
   }

   $('#datepicker').change(function(){
        loadInventory();
    });

    $("input[name='inventoryAction']").change(function(){
        loadInventory();
    });

    $(document).ready(function(){
        loadInventory()
    });

    $(document).on('click','.room_update',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#popup').show();
        $html = '<div class="row"><div class="form-group col-md-12 mb-3"><label for="">No Of Rooms *:</label><input type="number" name="room" class="form-control"></div></div>';
        $html += '<input type="hidden" value="updateRoom" id="updateType" name="type">';
        $html += '<input type="hidden" value='+id+' name="updateId">';
        $('#load_form_input').html($html);
    });

    $(document).on('click','.room_reload',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: 'include/ajax/inventoryForm.php',
            type: 'post',
            data : {type:'reloadRoom', updateRoom:id},
            success : function(data){
                window.location.href = "inventory.php";
            }
        });
    });

    $(document).on('click','.rate_update',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var rid = $(this).data('rid');
        $('#popup').show();
        $.ajax({
            url: 'include/ajax/inventoryForm.php',
            type: 'post',
            data : {type:'viewRateForm', id:id, rid:rid},
            success : function(data){
                $('#load_form_input').html(data);
            }
        });

        // $('#load_form_input').html($html);
    });

    // $(document).on('click','.reload_rate',function(e){
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     var rid = $(this).data('rid');
    //     $.ajax({
    //         url: 'include/ajax/inventoryForm.php',
    //         type: 'post',
    //         data : {type:'reloadRate', updateRoomDetail:id, updateRoom:rid},
    //         success : function(data){
    //             window.location.href = "inventory.php";                
    //         }
    //     });
    // });

    $(document).on('click','.room_block',function(e){
        e.preventDefault();
        var id = $(this).data('id');
   
        $html = '<input type="hidden" value='+id+' name="updateId">';
        $html += '<input type="hidden" value="blockId" name="type">';
        $('#load_form_input').html($html);
        $('#popup').show();
    });

    $(document).on('submit','#updateInventoryForm',function(e){
            e.preventDefault();
            $.ajax({
                url: 'include/ajax/inventoryForm.php',
                type: 'post',
                data : $('#updateInventoryForm').serialize(),
                success : function(data){
                    
                    $('#popup').hide();
                    loadInventory()
                }
            });
    });


    $(document).on('click', '.inventoryRate', function(){
        $('.inventoryRateRow').removeClass('show');
        var id = $(this).attr('id');
        $('#show'+id).addClass('show');
    });

    $(document).on('click','#closepopup',function(){
        $('#popup').hide();
    });

    $(document).on('change','.inlineRoomNo',function(){
        var roomNo = $(this).val();
        var roomId = $(this).data('rid');
        var roomDate = $(this).data('date');
        $.ajax({
            url: 'include/ajax/inventoryForm.php',
            type: 'post',
            data : {type:'inventoryUpdate', roomNo:roomNo, roomId:roomId, roomDate:roomDate},
            success : function(data){
                loadInventory();
                // $html = "<div class='alert success_box'><i class='ti-face-smile'></i>";
                // $html += "Successfull Update Inventory";
                // $html += "</div>";
                // $('.alertBox').html($html);
                alert('Successfull Update Inventory');
            }
        });
    });

    $(document).on('change','.inlineRoomPrice',function(){
        var roomPrice = $(this).val();
        var roomId = $(this).data('rid');
        var roomDId = $(this).data('rdid');
        var roomDate = $(this).data('date');
        var AdultDate = $(this).data('adult');
     
        $.ajax({
            url: 'include/ajax/inventoryForm.php',
            type: 'post',
            data : {type:'inlineRoomPrice', roomPrice:roomPrice, roomId:roomId, roomDate:roomDate,roomDId:roomDId,AdultDate:AdultDate},
            success : function(data){
                loadInventory();
                // $html = "<div class='alert success_box'><i class='ti-face-smile'></i>";
                // $html += "Successfull Update Rate";
                // $html += "</div>";
                // $('.alertBox').html($html);
                alert('Successfull Update Rate');
            }
        });
    });




</script>





</body>

</html>