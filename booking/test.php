<?php

include ('admin/include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include (SERVER_INCLUDE_PATH.'add_to_room.php');
$obj = new add_to_room();



// $sender = 'avinabgiri9439@gmail.com';
// $recipient = 'avinabgiri9439@gmail.com';
// $result = sendmail($sender, 'test', 'test', $sender);
// function sendmail($to, $subject, $message, $from) {
//     $headers = "MIME-Version: 1.0" . "\r\n";
//     $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
//     $headers .= 'From ' . $from . "\r\n";
//     $headers .= 'Reply-To ' .$from . "\r\n";
//     $headers .= 'X-Mailer: PHP/' . phpversion();
//     if(mail($to, $subject, $message, $headers)){
//         return 1;
//     } 
//     return 0;
// }


// $to = "avinabgiri9439@gmail.com";
//  $subject = "This is subject";
 
//  $message = "<b>This is HTML message.</b>";
//  $message .= "<h1>This is headline.</h1>";
 
//  $header = "From:<abc@somedomain.com>";
//  $header .= "MIME-Version: 1.0\r\n";
//  $header .= "Content-type: text/html\r\n";
 
//  $retval = mail ($to,$subject,$message,$header);
 
//  if( $retval == true ) {
//     echo "Message sent successfully...";
//  }else {
//     echo "Message could not be sent...";
// }

// pr(roomNight())


// echo quickPayEmail(24);
// pr(getAmenitieIdByRoomId(1));
// $criminals = [3,4];
// echo calculateTotalPrice()[0]['room'];
// echo hotelDetail()['name'];
// echo "<pre>";
// echo calculateTotalBookingPrice();
// pr($_SESSION);
// pr(getRoomPriceById('2','4', '2', '2022-05-07'))
// print_r(getTotalRoomBookingByDate('1','2022-04-27','2022-04-28'));

// pr(getRoomPriceById(1,2,2,'2022-05-06'))

// pr(getRoomLowPriceByIdWithDate(1,'2022-05-07'));

// pr(MonthlyBookingEarning('2022-05-01','2022-05-11'));

// $start = $month = strtotime('2009-02-01');
// $end = strtotime('2011-01-01');
// while($month < $end)
// {
//      echo date('F Y', $month), PHP_EOL;
//      $month = strtotime("+1 month", $month);
// }

// pr(getRoomPriceById('3','5',2,'2022-05-23'))


// echo date("Y-m-d", strtotime($date) );


// print_r(getRoomChildCountById(1))
// unset($_SESSION['room']);


// $room_array = $_SESSION['room'];
// print_r(getImageById(2));Razorpay

// unset($_SESSION['checkIn']);
// unset($_SESSION['checkout']);
// unset($_SESSION['no_room']);
// unset($_SESSION['no_guest']);
// unset($_SESSION['night_stay']);
// echo $_SESSION['room_total_price'];

// $current_date = strtotime(date('Y-m-d'));
// $one_day = strtotime('1 day 00 second', 0);
// echo date('Y-m-d',$current_date + (1 * $one_day));

// send_email('avinabgiri9439@gmail.com',orderEmail(1),'$subject')

// pr(getBookingVoucher(5));

// $html = '<table>
// <tr>
//     <th>01</th>
//     <th>Name</th>
// </tr>
// <tr>
//     <td>01</td>
//     <td>Avinab</td>
// </tr>
// </table>';




// pr(getTotalRoom(3, '2022-01-12'))
// pr(getRoomPriceById(14, '2022-01-12'))

// echo roomExist(3)
// echo orderEmail(4)
// send_email('avinabgiri9439@gmail.com',orderEmail(4),'subject');
// send_email('avinabgiri9439@gmail.com','','','',orderEmail(4),subject)
// pr(roomBooking())

// echo averageStay();



?>