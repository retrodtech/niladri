<?php

include ('include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(!isset($_SESSION['ADMIN_ID'])){
    $_SESSION['ErrorMsg'] = "Please login";
    redirect('login.php');
}

if($_GET['id'] == 'todayCheckInDownload'){
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    
    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking.id = bookingdetail.bid and bookingdetail.checkIn = '$today' GROUP by booking.id");
    $html = '<table border="1"> 
                <tr>
                    <th>Sl</th>
                    <th>Booking Date</th>
                    <th>Voucher  No</th>
                    <th>Guest Name</th>
                    <th>Contact Details</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Room Details</th>
                    <th>No Of Adult</th>
                    <th>No Of Child</th>
                    <th>Total Booking Amount</th>
                    <th>Paid</th>
                </tr>
        ';
    $sl = 0;
    while($row = mysqli_fetch_assoc($sql)){
        $sl ++;
        $bid = $row['id'];
        $addDate = strtotime($row['add_on']);
  
        foreach(getBookingDetailById($bid,$today) as $key=>$bookingList){
            $count = count(getBookingDetailById($bid,$today));
            if($key == 0){
                $sn ='<td rowspan="'.$count.'">'.$sl.'</td>';
                $addOn = '<td rowspan="'.$count.'">'.date('d-m-Y',$addDate).'</td>';
                $bookingId = '<td rowspan="'.$count.'">'.$row['bookinId'].'</td>';
                $name = '<td rowspan="'.$count.'">'.$row['name'].'</td>';
                $phone = '<td rowspan="'.$count.'">'.$row['phone'].'</td>';
                $grossCharge = '<td rowspan="'.$count.'">'.$row['grossCharge'].'</td>';
                $userPay = '<td rowspan="'.$count.'">'.$row['userPay'].'</td>';
            }else{
                $sn = '';
                $addOn = '';
                $bookingId = '';
                $name = '';
                $phone = '';
                $grossCharge = '';
                $userPay = '';
            }
            $html .= '
                <tr>
                    '.$sn.$addOn.$bookingId.$name.$phone.'
                    
                    <td>'.$bookingList['checkIn'].'</td>
                    <td>'.$bookingList['checkout'].'</td>
                    <td>'.getRoomHeaderById($bookingList['roomId']).'</td>
                    <td>'.$bookingList['adult'].'</td>
                    <td>'.$bookingList['child'].'</td>

                    
                    '.$grossCharge.$userPay.'

                </tr>
                
            ';
        }
        
    }
    $html .= '</table>';

    
}

if($_GET['id'] == 'todayCheckOutDownload'){
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    
    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking.id = bookingdetail.bid and bookingdetail.checkOut = '$today' GROUP by booking.id");
    
    $html = '<table border="1"> 
                <tr>
                    <th>Sl</th>
                    <th>Booking Date</th>
                    <th>Voucher  No</th>
                    <th>Guest Name</th>
                    <th>Contact Details</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Room Details</th>
                    <th>No Of Adult</th>
                    <th>No Of Child</th>
                    <th>Total Booking Amount</th>
                    <th>Paid</th>
                </tr>
        ';
    $sl = 0;
    while($row = mysqli_fetch_assoc($sql)){
        $sl ++;
        $bid = $row['id'];
        $addDate = strtotime($row['add_on']);
  
        foreach(getBookingDetailById($bid,'',$today) as $key=>$bookingList){
            $count = count(getBookingDetailById($bid,'',$today));
            if($key == 0){
                $sn ='<td rowspan="'.$count.'">'.$sl.'</td>';
                $addOn = '<td rowspan="'.$count.'">'.date('d-m-Y',$addDate).'</td>';
                $bookingId = '<td rowspan="'.$count.'">'.$row['bookinId'].'</td>';
                $name = '<td rowspan="'.$count.'">'.$row['name'].'</td>';
                $phone = '<td rowspan="'.$count.'">'.$row['phone'].'</td>';
                $grossCharge = '<td rowspan="'.$count.'">'.$row['grossCharge'].'</td>';
                $userPay = '<td rowspan="'.$count.'">'.$row['userPay'].'</td>';
            }else{
                $sn = '';
                $addOn = '';
                $bookingId = '';
                $name = '';
                $phone = '';
                $grossCharge = '';
                $userPay = '';
            }
            $html .= '
                <tr>
                    '.$sn.$addOn.$bookingId.$name.$phone.'
                    
                    <td>'.$bookingList['checkIn'].'</td>
                    <td>'.$bookingList['checkout'].'</td>
                    <td>'.getRoomHeaderById($bookingList['roomId']).'</td>
                    <td>'.$bookingList['adult'].'</td>
                    <td>'.$bookingList['child'].'</td>

                    
                    '.$grossCharge.$userPay.'

                </tr>
                
            ';
        }
        
    }
    $html .= '</table>';

    
}


if($_GET['id'] == 'todayQpCheckInDownload'){
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    
    $sql = mysqli_query($conDB, "select * from quickpay where checkIn = '$today' ");
    $html = '<table border="1"> 
                <tr>
                    <th>Sl</th>
                    <th>Booking Date</th>
                    <th>Voucher  No</th>
                    <th>Guest Name</th>
                    <th>Contact Details</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Room Details</th>
                    
                    <th>Total Booking Amount</th>
                    <th>Paid</th>
                </tr>
        ';
    $sl = 0;
    while($row = mysqli_fetch_assoc($sql)){
     
        $sl ++;
        $bid = $row['id'];
        $addDate = strtotime($row['addOn']);
  
        $html .= '
                <tr>
                    <td>'.$sl.'</td>
                    <td>'.date('d-m-Y',$addDate).'</td>
                    <td>'.$row['orderId'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['phone'].'</td>
                    
                    <td>'.$row['checkIn'].'</td>
                    <td>'.$row['checkOut'].'</td>
                    <td>'.getRoomHeaderById($row['room']).'</td>
            

                    
                    <td>'.$row['totalAmount'].'</td>
                    <td>'.$row['amount'].'</td>

                </tr>
                
            ';
        
    }
    $html .= '</table>';

    
}

if($_GET['id'] == 'todayQpCheckOutDownload'){
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    
    $sql = mysqli_query($conDB, "select * from quickpay where checkOut = '$today' ");
    $html = '<table border="1"> 
                <tr>
                    <th>Sl</th>
                    <th>Booking Date</th>
                    <th>Voucher  No</th>
                    <th>Guest Name</th>
                    <th>Contact Details</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Room Details</th>
                    
                    <th>Total Booking Amount</th>
                    <th>Paid</th>
                </tr>
        ';
    $sl = 0;
    while($row = mysqli_fetch_assoc($sql)){
     
        $sl ++;
        $bid = $row['id'];
        $addDate = strtotime($row['addOn']);
  
        $html .= '
                <tr>
                    <td>'.$sl.'</td>
                    <td>'.date('d-m-Y',$addDate).'</td>
                    <td>'.$row['orderId'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['phone'].'</td>
                    
                    <td>'.$row['checkIn'].'</td>
                    <td>'.$row['checkOut'].'</td>
                    <td>'.getRoomHeaderById($row['room']).'</td>
            

                    
                    <td>'.$row['totalAmount'].'</td>
                    <td>'.$row['amount'].'</td>

                </tr>
                
            ';
        
    }
    $html .= '</table>';

    
}

if(isset($_POST['dataType'])){
    if($_POST['dataType'] == 'download'){
        $html = $_POST['data'];
    }
}


    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=report.xls');
    echo $html;
?>