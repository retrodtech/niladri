<?php

function redirect($link){
    ob_start();
    header('Location: '.$link);
    ob_end_flush();
    die();
}

function pr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}

function safeData($data){
    global $conDB;
   return mysqli_real_escape_string($conDB, $data);
}

function str_openssl_dec($data,$iv){
    $key = KEY; 
    $cipher = "aes128"; 
    $option = 0; 
    return openssl_decrypt($data, $cipher, $key, $option, $iv);
}

function str_openssl_enc($data,$iv){
    $key = KEY; 
    $cipher = "aes128"; 
    $option = 0; 
    return openssl_encrypt($data, $cipher, $key, $option, $iv);
}

function ErrorMsg(){
    if(isset($_SESSION['ErrorMsg'])){
        $output = "<div class='alert error_box'><i class='ti-face-sad'></i>";
        $output .= $_SESSION['ErrorMsg'];
        $output .= "</div>";
        $_SESSION['ErrorMsg'] = null;
        return $output;
    }
}

function SuccessMsg(){
    if(isset($_SESSION['SuccessMsg'])){
        $output = "<div class='alert success_box'><i class='ti-face-smile'></i>";
        $output .= $_SESSION['SuccessMsg'];
        $output .= "</div>";
        $_SESSION['SuccessMsg'] = null;
        return $output;
    }
}

function calculateTotalBookingPrice(){
    $price = $_SESSION['gossCharge'];
    $result = $price;
    
    
    if(isset($_SESSION['pickUp']) && $_SESSION['pickUp'] != ''){
        $pickup = $_SESSION['pickUp'];
        $result += $pickup;
    }
    
    if(isset($_SESSION['partial']) && $_SESSION['partial'] == 'Yes'){
        $percentage = settingValue()['PartialPaymentPrice']; 
        $result = $result * $percentage / 100;
    }
    
    // $_SESSION['roomTotalPrice'] = $result;
    
    return $result;
}

function hotelDetail(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from profile");
    $row = mysqli_fetch_assoc($sql);
    
    return $row;
}

function getBookingIdById($bid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select bookinId from booking where id = '$bid'"));
    return $sql['bookinId'];
}

function getQuickPayBookingIdById($bid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select orderId from quickpay where id = '$bid'"));
    return $sql['orderId'];
}

function roomMaxCapacityById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from room where id = '$rid'"));
    return $sql['roomcapacity'];
}

function formatingDate($date){
    return  date("d-M-Y", strtotime($date));
}

function getBookingNumber(){
    global $conDB;
    
    $oid = BOOK_GENERATE.unique_id(6);

    return $oid;
}

function getQPBookingNumber(){
    global $conDB;
    
    $oid = QP_GENERATE.unique_id(6);

    return $oid;
}

function hotelPolicyEmail(){
    $checkInTime = hotelDetail()["checkIn"];
    $checkOutTime = hotelDetail()['checkOut'];
    $html = "
    <h4 style='background: #cce6cc;padding: 5px 10px;'>IMPORTANT INFORMATION</h4>
    <table style='width:100%; '>
    <tr style='vertical-align: top;'>
        <td>                    
            <h5>POLICY</h5>
            <ul style='list-style: circle;'>
                <li>
                    <span>Check In </span><span>$checkInTime</span>
                </li>
                <li>
                    <span>Check Out </span><span>$checkOutTime</span>
                </li>
            </ul>
            
        </td>
    </tr>
    </table>

    <table style='width:100%; '>

        <tr>
            <td>
                        
                <h5>CANCELLATION POLICY</h5>
                <ul>
                    <li>
                        <p>Visit our website <a href=''>Click Here</a>.</p>
                    </li>
                </ul>
                
            </td>
        </tr>

    </table>

    <table style='width:100%; '>
        <tr>
            <td>
                
                <h4>ID proof</h4>
                <ul style='list-style: circle;'>
                    <li>
                        <span>Voter ID, </span> <span>Aadhar card, </span> <span>DL, </span> <span>Pass Port</span> 
                    </li>
                    <li>
                        <span>Pan Card * Not Acceptable</span>
                    </li>
                </ul>
                
            </td>
        </tr>
    </table>
    ";

    return $html;
}

function roomCountById($rdid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from room_detail where id = '$rdid'"));
    return $sql['totalroom'];
}

function getRoomArr($payAdvance=''){
    global $conDB;
    $sql = mysqli_query($conDB, "select room.*,room_detail.id as rdid from room,room_detail where room.id=room_detail.room_id and room.status = '1' group by(room.id) ORDER BY `room_detail`.`price` asc");
    if($payAdvance != ''){
        $sql = mysqli_query($conDB, "select room.*,room_detail.id as rdid from room,room_detail where room.id=room_detail.room_id and room.status = '1' and room_detail.singlePrice > '$payAdvance' group by(room.id) ORDER BY `room_detail`.`price` asc");
    }
    if(mysqli_num_rows($sql)){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = [
                'id'=> $row['id'],
                'name'=> $row['header'],
            ];
        }
    }else{
        $data[] = 'No Room';
    }
    
    return $data;
}

function getRoomNameById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select header from room where id = '$rid'"));
    return $sql['header'];
}

function getRoomTypeById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select bedtype from room where id = '$rid'"));
    return $sql['bedtype'];
}

function getAdminUserNameById($aid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select username from admin where id = '$aid'"));
    return $sql['username'];
}

function getAdminLogoById($aid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select logo from admin where id = '$aid'"));
    return $sql['logo'];
}

function getAmenitieById($aid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select title from amenities where id = '$aid'"));
    return $sql['title'];
}

function getAmenitieIdByRoomId($rid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_amenities where room_id = '$rid'");
    while($row = mysqli_fetch_assoc($sql)){
        $aid[] = $row['amenitie_id'];
    }
    return $aid;
}

function getRoomHeaderById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select header from room where id = '$rid'"));
    return $sql['header'];
}

function getRoomIdBySlug($slug){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select id from room where slug = '$slug'"));
    return $sql['id'];
}

function getRoomPriceById($rid,$rdid, $nadult, $date ,$date2=''){
    global $conDB;
    
    $countAdult= getMinRoomAdultCountById($rid);
    if($countAdult < $nadult){
        $nadult = $countAdult;
    }
    if($nadult > 2){
        $nadult = 2;
    }
    
    if($nadult == 1){
        $sql = "select price as price from inventory where room_id = '$rid' and room_detail_id = '$rdid'  and add_date = '$date'  and price != 'Null' and price != '0'";
        $query = mysqli_query($conDB,$sql);
        if(mysqli_num_rows($query)>0){
            $inven_row = mysqli_fetch_assoc($query);
            $price = $inven_row['price'];
        }
    }
    if($nadult == 2){
        $sql = "select price2 as price from inventory where room_id = '$rid' and room_detail_id = '$rdid'  and add_date = '$date'  and price != 'Null' and price2 != '0'";
        $query = mysqli_query($conDB,$sql);
        if(mysqli_num_rows($query)>0){
            $inven_row = mysqli_fetch_assoc($query);
            $price = $inven_row['price'];
        }else{
            $sql = "select doublePrice as price from room_detail where room_id = '$rid' and id='$rdid' and doublePrice != 0";
            $query = mysqli_query($conDB,$sql);
            if(mysqli_num_rows($query)>0){
                $inven_row = mysqli_fetch_assoc($query);
                $price = $inven_row['price'];
            }
        }
    }
    if(!isset($price)){
        if($nadult == 1){
            $sql = "select singlePrice as price from room_detail where room_id = '$rid' and id='$rdid'";
            $query = mysqli_query($conDB,$sql);
            if(mysqli_num_rows($query)>0){
                $inven_row = mysqli_fetch_assoc($query);
                $price = $inven_row['price'];
            }
        }
        if($nadult == 2){
            $sql = "select doublePrice as price from room_detail where room_id = '$rid' and id='$rdid' and doublePrice != 0";
            $query = mysqli_query($conDB,$sql);
            if(mysqli_num_rows($query)>0){
                $inven_row = mysqli_fetch_assoc($query);
                $price = $inven_row['price'];
            }else{
                $sql = "select singlePrice as price from room_detail where room_id = '$rid' and id='$rdid'";
                $query = mysqli_query($conDB,$sql);
                if(mysqli_num_rows($query)>0){
                    $inven_row = mysqli_fetch_assoc($query);
                    $price = $inven_row['price'];
                }
            }
        }
    }

    return $price;
}

function getRoomCapacityById($rid = ''){
    global $conDB;
    if($rid == ''){
        $rid = 1;
    }
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from room where id = '$rid'"));
    return $sql['roomcapacity'];
}

function getRoomAdultCountById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select max(room.noAdult) as maxAdult from room,room_detail where room.id=room_detail.room_id and room_detail.room_id = '$rid'"));
    return $sql['maxAdult'];
}

function getMinRoomAdultCountById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from room,room_detail where room.id=room_detail.room_id and room_detail.room_id = '$rid'"));
    $data = $sql['noAdult'];
    return $data;
}

function getMinRoomAdultCountByIdRdid($rid,$rdid=''){
    global $conDB;
    $query = mysqli_query($conDB, "select room.*,room_detail.*, room_detail.id as room_detailId from room,room_detail where room.id=room_detail.room_id and room_detail.room_id = '$rid' and  room_detail.id = '$rdid'");
    $sql = mysqli_fetch_assoc($query);
    $single = getRoomPriceById($rid,$rdid, 1, date('Y-m-d'));
    $double = getRoomPriceById($rid,$rdid, 2, date('Y-m-d'));
    if($single == $double){
        $data = $sql['noAdult'];
    }elseif($double == 0){
        $data = 1;
    }elseif($single < $double){
        $data = 1;
    }
    return $data;
}

function getRoomChildCountById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select max(room.noChild) as maxChild from room,room_detail where room.id=room_detail.room_id and room_detail.room_id = '$rid'"));
    return $sql['maxChild'];
}

function getRoomExtraAdultPriceById($rdid,$date=''){
    global $conDB;
    $invenSql = mysqli_query($conDB, "select eAdult from inventory where room_detail_id = '$rdid' and add_date = '$date' and eAdult != '0'");
    if(mysqli_num_rows($invenSql) > 0){
        $row = mysqli_fetch_assoc($invenSql);
        $price = $row['eAdult'];
    }else{
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select extra_adult from room_detail where id = '$rdid'"));
        $price = $sql['extra_adult'];
    }
    
    return $price;
}

function getAdultPriceByNoAdult($n,$rid,$rdid,$date=''){
    if(getRoomAdultCountById($rid) >= $n){
        $data = 0;
    }else{
        $data = ($n - getRoomAdultCountById($rid)) * getRoomExtraAdultPriceById($rdid,$date);
    }
    return $data;
}

function getRoomExtraChildPriceById($rdid,$date=''){
    global $conDB;
    $invenSql = mysqli_query($conDB, "select eChild from inventory where room_detail_id = '$rdid' and add_date = '$date' and eChild != '0'");
    if(mysqli_num_rows($invenSql) > 0){
        $row = mysqli_fetch_assoc($invenSql);
        $price = $row['eChild'];
    }else{
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select extra_child from room_detail where id = '$rdid'"));
        $price = $sql['extra_child'];
    }
    
    return $price;
}

function getChildPriceByNoChild($n,$rid,$rdid,$date=''){
    if(getRoomChildCountById($rid) >= $n){
        $data = 0;
    }else{
        $data = ($n - getRoomChildCountById($rid) ) * getRoomExtraChildPriceById($rdid,$date);
    }
    return $data;
}

function getRoomLowPriceById($rid, $date){
    global $conDB;
    $data=array();
    if(isset($_SESSION['checkout'])){
        $date2 = $_SESSION['checkout'];
    }else{
        $oneDay = strtotime('1 day 30 second', 0);
        $date2 = date('Y-m-d',strtotime($date) + $oneDay);
    }
    $sql = "select * from inventory where room_id = '$rid' and add_date <= '$date'  and price !='' order by price desc";
    $inven_sql = mysqli_query($conDB, $sql);
    if(mysqli_num_rows($inven_sql)>0){
        while($inven_row = mysqli_fetch_assoc($inven_sql)){
            $price=$inven_row['price'];
        }
    }else{
        $sql = "select * from room_detail where room_id = '$rid'  order by price desc";
        $inven_sql = mysqli_query($conDB, $sql);
            while($inven_row = mysqli_fetch_assoc($inven_sql)){
                $price=$inven_row['singlePrice'];
                if($inven_row['singlePrice'] == ''  || $inven_row['singlePrice'] == 0){
                    $price=$inven_row['doublePrice'];
                }
            }
    }
    
    return $price;
}

function getRoomLowPriceByIdWithDate($rid, $date ,$date2=''){
    global $conDB;
    if($date2 == ''){
        $date2 = $date;
    }
    $data=array();
    $sql = "select * from inventory where room_id = '$rid' and add_date = '$date' and price !='' order by price desc";
    $inven_sql = mysqli_query($conDB, $sql);
    if(mysqli_num_rows($inven_sql)>0){
        while($inven_row = mysqli_fetch_assoc($inven_sql)){
            $price=$inven_row['price'];
        }
    }else{
        $sql = "select * from room_detail where room_id = '$rid' order by singlePrice desc";
        $inven_sql = mysqli_query($conDB, $sql);
            while($inven_row = mysqli_fetch_assoc($inven_sql)){
                $price=$inven_row['singlePrice'];
            }
    }
    
    return $price;
}

function getTotalRoom($rid, $date,$date2=''){
    global $conDB;
    if($date2 == ''){
        $date2 = $date;
    }
    $room = 0;
    $query = "select room from inventory where room_id  = '$rid' and add_date = '$date'";
    $sql = mysqli_query($conDB, $query );
    if(mysqli_num_rows($sql)>0){
        while($inven_row = mysqli_fetch_assoc($sql)){
            $room=$inven_row['room'];
        }
    }else{
        $query = "select totalroom from room where id  = '$rid' and status = '1'";
        $sql = mysqli_query($conDB, $query);
        while($inven_row = mysqli_fetch_assoc($sql)){
            $room=$inven_row['totalroom'];
        }
    }
    
    return $room;
}

function countTotalBooking($rid, $date=''){
    global $conDB;
    $BookSql ="SELECT booking.id,sum(bookingdetail.noRoom) as noRoom FROM bookingdetail,booking where booking.id = bookingdetail.bid and bookingdetail.roomId = '$rid' and booking.payment_status='complete' and bookingdetail.checkIn <= '$date' && bookingdetail.checkOut > '$date'";
                
    $check_sold_arr = mysqli_fetch_assoc(mysqli_query($conDB,$BookSql));

    $check_sold= $check_sold_arr['noRoom'];
    return $check_sold;
}

function countTotalQPBooking($rid, $date=''){
    global $conDB;
    $BookSql ="SELECT sum(nOfRoom) as noRoom FROM quickpay where  room = '$rid' and paymentStatus='complete' and checkIn <= '$date' && checkOut > '$date'";
                
    $check_sold_arr = mysqli_fetch_assoc(mysqli_query($conDB,$BookSql));

    $check_sold= $check_sold_arr['noRoom'];
    return $check_sold;
}

function roomExist($rid,$date='',$date2='',$rdid=''){
    global $conDB;
    $sql ="SELECT * FROM room where id = '$rid'";
    $status = mysqli_fetch_assoc(mysqli_query($conDB,$sql));
    $checkIn = $date;
    $checkOut = $date2;
    if($date == ''){
        $checkIn = $_SESSION['checkIn'];
    }
    
    if($date2 == ''){
        $checkOut = $_SESSION['checkout'];
    }
    
    if(getRoomLowPriceByIdWithDate($rid, $date) > settingValue()['advancePay']){
        $check_sold = countTotalQPBooking($rid, $checkIn);
    }else{
        $check_sold = countTotalBooking($rid, $checkIn);
    }
    
    $check_stock = getTotalRoom($rid, $checkIn);

    $result =  $check_stock - $check_sold;

    if($rdid != ''){
        if(isset($_SESSION['checkIn'])){
            $checkInTime = $_SESSION['checkIn'];
        }
    }

    
    if($result < 0){
        $result = 0;
    }

    return $result;
    
}

function loopRoomExist($rid,$date='',$date2='',$rdid=''){
    
    if(roomExist($rid,$date,$date2,$rdid) > 0){
        $oneDay = strtotime('1 day 30 second', 0);
        
        $datediff = strtotime($date2) - strtotime($date);
        $output = round($datediff / (60 * 60 * 24));
        $data = 1;
        $countTotalBooking = array();
        for($i=1; $i<= $output; $i ++){
            $predate = date('Y-m-d',strtotime($date) + ($oneDay * $i) - $oneDay);
            // $nxtDate= date('Y-m-d',strtotime($date) + ($oneDay * $i));
            $countTotalBooking[] = roomExist($rid, $predate, $predate,$rdid);  
        }
        if(in_array('0' ,$countTotalBooking))    {
            $data = 0;
        } 
    }else{
        $data = 0;
    }
    return $data;
}


function getCouponArry($cid='',$status = ''){
    global $conDB;
    

    if($status == ''){
        $sql = "select * from couponcode where id!=''";
    }else{
        $sql = "select * from couponcode where status = 1";
    }

    if($cid != ''){
        $sql .= " and id ='$cid'";
    }

    $query = mysqli_query($conDB, $sql);
    $data = array();
    while($row = mysqli_fetch_assoc($query)){
        $data[] = $row;
    }
    
    return $data;
}


function getRatePlanIdByRoonId($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select id from room_detail where room_id = '$rid'"));
    return $sql['id'];    
}

function getOrderDetailByOrderId($oid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from booking where id= '$oid'");
    $row = mysqli_fetch_assoc($sql);
    return $row;
}

function tryRoomBooking(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from booking,bookingdetail where booking.id = bookingdetail.bid and booking.payment_status= 'pending' and booking.status = '1'");
    return mysqli_num_rows($sql);
}

function tryBook(){
    global $conDB;
    $count = roomBooking();  
    if($count > 0){
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(booking.grossCharge) as grossCharge from booking,bookingdetail where booking.id = bookingdetail.bid and booking.payment_status= 'pending' and booking.status = '1'"));
        $result= custom_number_format($sql['grossCharge']);
    }else{
        $result = 0;
    }
    return $result;
    
}

function getImageById($rid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_img where room_id = '$rid'");
    
    if(mysqli_num_rows($sql)){
        while($row = mysqli_fetch_assoc($sql)){
            $img[] = $row['image'];
        }
    }else{
        $img[] = 'room1.jpg';
    }
    
    return $img;
}

function getImageByImgId($rid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_img where id = '$rid'");
    $row = mysqli_fetch_assoc($sql);    
    return $row['image'];;
}

function getRatePlanByRoomId($rid = ''){
    global $conDB;
    $data=array();
    if($rid == ''){
        $rid = 1;
    }
    $sql = mysqli_query($conDB, "select * from room_detail where room_id  = '$rid'");
    if(mysqli_num_rows($sql)){
        while($row = mysqli_fetch_assoc($sql)){
            $data[]=$row;
        }
    }
    return $data;
}

function getRatePlanByRoomDetailId($rdid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_detail where id  = '$rdid'");
    $row = mysqli_fetch_assoc($sql);
    return $row['title'];
}

function getRatePlanStatusByRoomDetailId($rdid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_detail where id  = '$rdid'");
    $row = mysqli_fetch_assoc($sql);
    return $row['status'];
}

function getRatePlanArrById($rid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_detail where room_id = '$rid'");
    $data = array();
    while($row = mysqli_fetch_assoc($sql)){
        $data[] = [
            'id'=> $row['id'],
            'rplan'=>$row['title'],
            'price'=> $row['price']
            ];
    }
    return $data;
}

function getRatePlanDetailById($rdid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_detail where id = '$rdid'");
    $data = array();
    $row = mysqli_fetch_assoc($sql);
    $data[] = [
            'rplan'=>$row['title'],
            'price'=> $row['price']
            ];
            
    return $data;
}

function checkTotalBooking($rid, $date='',$date2=''){
    global $conDB;
    $sql ="SELECT no_room FROM booking where room_id = '$rid' and payment_status='complete' and status = '1' and checkIn >= '$date' && checkOut <= '$date2'";
    $query = mysqli_query($conDB,$sql);

    $data = 0;
    if(mysqli_num_rows($query) > 0){
        $data = 1;
    }
    return $data;
}

function getDataBaseDate($date){

    $checkInArr = explode('/',$date);
    $checkIn = $checkInArr['2'].'-'.$checkInArr['0'].'-'.$checkInArr['1'];
    return $checkIn;
}

function getDataBaseDate2($date){

    $checkInArr = explode('/',$date);
    $checkIn = $checkInArr['2'].'-'.$checkInArr['1'].'-'.$checkInArr['0'];
    return $checkIn;
}

function send_email($email,$gname='',$cc='',$bcc='',$html,$subject){
    include(SERVER_BOOKING_PATH.'/admin/smtp/PHPMailerAutoload.php');
    $hotel_name = hotelDetail()['name'];

    $mail = new PHPMailer;

    $mail->SMTPDebug = 0;                               

    $mail->isSMTP();              
    $mail->Host = 'smtppro.zoho.in';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'noreply@retrod.in';                 
    $mail->Password = 'Retrod@121';  
    // $mail->authentication = 'ovfxbefwwtfxsuch';
    // $mail->enable_starttls_auto = true;
    // $mail->openssl_verify_mode = 'none';
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;    
       

    $mail->setFrom('noreply@retrod.in',$hotel_name);
    $mail->addAddress("$email", "$gname");
    $mail->addCC("$cc");
    $mail->addBCC("$bcc");

    $mail->isHTML(true);
    $mail->Subject = "$subject";
    $mail->Body    = $html;

   
    
    if($mail->send()) {
        // echo 1;
    } else {
        // echo $mail->ErrorInfo;
    }
}

function getOrderDetailArrByOrderId($oid){
    global $conDB;
    $data=array();
    $sql = "select booking.*, bookingdetail.*, bookingdetail.id as bookindetailId from booking,bookingdetail where booking.id = '$oid' and booking.id = bookingdetail.bid";
    $query = mysqli_query($conDB,$sql);
    while($row = mysqli_fetch_assoc($query)){
        $data[]= $row;
    }
    return $data;
}

function orderEmail($oid){

    $name = getOrderDetailByOrderId($oid)['name'];
    $email = getOrderDetailByOrderId($oid)['email'];
    $phone = getOrderDetailByOrderId($oid)['phone'];
    $company_name = getOrderDetailByOrderId($oid)['company_name'];
    $gst = getOrderDetailByOrderId($oid)['comGst'];
    $bid = getOrderDetailByOrderId($oid)['bookinId'];
    $userPay = getOrderDetailByOrderId($oid)['userPay'];
    
    
    $price = getOrderDetailByOrderId($oid)['userPay'];
    $grossCharge = getOrderDetailByOrderId($oid)['grossCharge'];
    $payment_status = getOrderDetailByOrderId($oid)['payment_status'];
    $payment_id = getOrderDetailByOrderId($oid)['payment_id'];
    $add_on = date('d-m-Y g:i A', strtotime(getOrderDetailByOrderId($oid)['add_on']));
    

    
    $company_name = getOrderDetailByOrderId($oid)['company_name'];
    // $gst = getOrderDetailByOrderId($oid)['gst'];

    

    $couponCode = getOrderDetailByOrderId($oid)['couponCode'];
    $pickUp = getOrderDetailByOrderId($oid)['pickUp'];
    $pickupHtml = '';

    $sitename = SITE_NAME;
    $bookingSite = FRONT_BOOKING_SITE;
    
    $img = FRONT_SITE_IMG.hotelDetail()['logo'];
    
    
    $priceHtml = '';
    $couponCodeHtml = '';
    $partial = getOrderDetailByOrderId($oid)['partial'];
    $buttomBar = '';



    if($payment_status == 'pending'){
        $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#b51d0e">
                        <p
                            style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                            <strong>₹ '. $price.'</strong>
                            amount has been failed payment on <br/>
                            '.$add_on.'
                        </p>
                    </div>';

        if($partial == 'Yes'){
            $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#b51d0e">
                        <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                            50%, <strong>₹ '. $price.'</strong>
                            amount has been Failed Payment on <br/>
                            '.$add_on.'
                        </p>
                    </div>';
            
        }
    }
    
    
    
    if($payment_status == 'complete'){
        
        $priceHtml = '<div style="background-color:#ffffff;margin-bottom:6px;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#0eb550">
                        <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                            <strong>₹ '. $price.'</strong>
                            amount has been Successful Payment <br/> with Payment ID is <b>'.$payment_id.'</b> on <br/>
                            '.$add_on.'
                        </p>
                    </div>';
        
        
        
            if($grossCharge > $price){
                $userPercentage = getPercentageValueByAmount($userPay, $grossCharge);
                $payAtHotel = number_format($grossCharge - $userPay);
                $buttomBar = '
                                <tr>
                                    <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">'.$userPercentage.'% Paid</td>
                                    <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ '.$price.'</td>
                                </tr>
                                ';
                                
                $priceHtml = '<div style="background-color:#ffffff;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto;border-top-width:medium;border-top-style:solid;border-top-color:#0eb550">
                                    <p style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;text-align:center;color:#515978">
                                        '.$userPercentage.'%, <strong>₹ '. $price.'</strong>
                                        amount has been Successful Payment <br/> with Payment ID is <b>'.$payment_id.'</b> <br/>
                                        on  '.$add_on.' and <br/> Pay at Hotel Rs <strong>'.$payAtHotel.'</strong>.
                                    </p>
                                </div>';
            }
    }



    

    $html = '
        
            <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>'.$sitename.' || Payment Invoice</title>
                </head>
                <body>
                    <div style="background-color:#f7f7f7">
                        <div style="text-align:center; max-width:588px;margin:auto;">
                            <table style="width:100%; max-width:600px; min-height:90px">
                                <tr>
                                <td align="left"><img width="80px" src="'.$img.'"></td>
                                <td align="right"><strong style="color:#000">Invoice #'.$bid.'</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div style="font-family:Trebuchet MS">
                        <div style="height:100%">

                            <div style="max-width:588px;margin:auto">

                                <div style="max-width:588px;margin:auto">
                                    <div
                                    style="background-color:#ffffff;padding:20px;max-width:550px;text-align:center;margin-left:auto;margin-right:auto">
                                    <table style="width:100%; max-width:600px;">
                                        <tr>
                                        <td align="left">
                                            <div> Hello <b>'.$name.'</b>,</div>
                                            <div> '.$email.'</div>
                                            <div> '.$company_name.'</div>
                                            <div> '.$gst.'</div>
                                        </td>

                                        <td align="right">
                                            <div><b>'.hotelDetail()['name'].'</b></div>
                                            <div>'.ucfirst(hotelDetail()['address']).'</div>
                                            <div>'.ucfirst(hotelDetail()['district']).', '.hotelDetail()['pincode'].'</div>
                                            <div>GST:- '.hotelDetail()['gst'].'</div>
                                        </td>
                                        </tr>
                                    </table>
                                    </div>
                                    '.$priceHtml.'
                                </div>

                                <div style="max-width:588px;margin:auto">
                                    <div style="background-color:#ffffff;padding:20px 20px 2px 20px;max-width:550px;margin-left:auto;margin-right:auto;font-size:15px">
                                        <table style="background-color:white;width:100%;">
                                            <tr>
                                                <td style="text-align:left;font-size:17px;padding:15px 0px;border-bottom:1px solid #ebedf2;margin-bottom:20px">Booking details</td>
                                                <td style="text-align:right;font-size:17px;padding:15px 0px;border-bottom:1px solid #ebedf2;margin-bottom:20px;color:#528ff0;">Booking guide</td>
                                            </tr>
                                        </table>';

                                    foreach(getOrderDetailArrByOrderId($oid) as $bidrow){
                                      
                                        $checkIn = $bidrow['checkIn'];
                                        $checkOut = $bidrow['checkout'];
                                        $roomId = $bidrow['roomId'];
                                        $room_detail_id = $bidrow['roomDId'];

                                        $adult = $bidrow['adult'];
                                        $child = $bidrow['child'];

                                        $room_name = getRoomNameById($roomId);
                                        $rate_plane = getRatePlanByRoomDetailId($room_detail_id);

                                        $checkDate = getDateFormatByTwoDate($checkIn,$checkOut);

                                        $html .= '<table style="background-color:white;width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <td style="color:#7b8199;text-align:left;padding:0px 0px 20px 10px">
                                                            <b>'.$room_name.'</b>
                                                            </td>
                                                            <td style="text-align:right;padding:0px 10px 20px 0px">
                                                            <small>'.$checkDate.'</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color:#7b8199;text-align:left;padding:0px 0px 20px 10px">
                                                                <table>
                                                                    <tr>
                                                                        <td><strong>Adult</strong>: '.$adult.'</td>
                                                                        <td><strong>Child</strong>: '.$child.'</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td style="text-align:right;padding:0px 10px 20px 0px">
                                                                <strong>'.$rate_plane.'</strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p style="font-size:18px;line-height:25px;text-align:center;color:#515978;border-top-style:solid;border-top-color:#ebedf2;border-top-width:2px;background-color:white">
                                                </p>' ;
                                    };

                                    

                            $html .= '

                                    </div>
                                </div>


                                <div style="max-width:588px;margin:auto">
                                    <div
                                    style="background-color:#ffffff;padding:20px 20px 2px 20px;max-width:550px;margin-left:auto;margin-right:auto;font-size:15px">
                                    <p
                                        style="font-family:Trebuchet MS;font-style:normal;font-size:18px;line-height:25px;color:#515978;text-align:center;margin-top:0px;border-bottom-style:solid;border-bottom-color:#ebedf2;border-bottom-width:2px;padding-bottom:18px">
                                        Breakup for Payout
                                    </p>
                                    <table style="background-color:white;width:100%;border-spacing:0px">
                                        <thead style="color:#7b8199">
                                        <tr>
                                            <th style="padding:0px 0px 20px 0px;text-align:start;border-bottom:1px solid #ebedf2">
                                            Room Name
                                            </th>
                                            <th style="padding:0px 0px 20px 0px;text-align:center;border-bottom:1px solid #ebedf2">
                                            Amount
                                            </th>
                                            <th style="padding:0px 0px 20px 0px;text-align:center;border-bottom:1px solid #ebedf2">
                                            Adult
                                            </th>
                                            <th style="padding:0px 10px 20px 0px;text-align:center;border-bottom:1px solid #ebedf2">
                                            Child
                                            </th>
                                            <th style="padding:0px 10px 20px 0px;text-align:center;border-bottom:1px solid #ebedf2">
                                            GST
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>';
                                        $total_price = 0;
                                        $gst_price = 0;
                                        $couponBalance =0;
                                        foreach(getOrderDetailArrByOrderId($oid) as $bidrow){
                                            // pr($bidrow);
                                            $rid = $bidrow['roomId'];
                                            $rdid = $bidrow['roomDId'];

                                            $room_name = getRoomNameById($rid);
                                            $rate_plane = getRatePlanByRoomDetailId($rdid);

                                            $adultPrice = $bidrow['adultPrice'];
                                            $childPrice = $bidrow['childPrice'];
                                            $adult = $bidrow['adult'];
                                            $child = $bidrow['child'];
                                            $night = $bidrow['night'];
                                            $roomPrice = $bidrow['roomPrice'];
                                            $noRoom = $bidrow['noRoom'];
                                            $couponCode = $bidrow['couponCode'];

                                            $singleRoomPriceCalculator = SingleRoomPriceCalculator($rid, $rdid, $adult, $child , $noRoom, $night, $roomPrice, $childPrice , $adultPrice, $couponCode);
                                            // $total_price += $night * (($roomPrice * $no_room) + $extraAdult + $extraChild);
                                            
                                            $gst_price += $singleRoomPriceCalculator[0]['gst'];
                                            $total_price += $singleRoomPriceCalculator[0]['total'];
                                            $couponValue = $singleRoomPriceCalculator[0]['couponPrice'];
                                            if($singleRoomPriceCalculator[0]['couponPrice'] == ''){
                                                $couponValue = 0;
                                            }
                                            $couponBalance += $couponValue;
                                            $html .= '<tr>
                                                        <td style="text-align:start;padding:10px 10px 20px 0px">
                                                        
                                                        <span style="color:gray;font-weight:lighter">
                                                        '.$room_name.'
                                                        </span>
                                                        </td>
                                                        <td style="text-align:center;padding:10px 10px 20px 0px">
                                                        '.$singleRoomPriceCalculator[0]['room'].'
                                                        </td>
                                                        <td style="text-align:center;padding:10px 10px 20px 0px">
                                                        '.$singleRoomPriceCalculator[0]['adultPrint'].'
                                                        </td>
                                                        <td style="text-align:center;padding:10px 10px 20px 0px">
                                                        '.$singleRoomPriceCalculator[0]['childPrint'].'
                                                        </td>
                                                        <td style="text-align:center;padding:10px 10px 20px 0px">
                                                        '.$singleRoomPriceCalculator[0]['gst'].'
                                                        </td>
                                                    </tr>';
                                        }

                                        if($pickUp > 0){
                                            $pickupHtml = '

                                                            <tr>
                                                                <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">PickUp</td>
                                                                <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ '.$pickUp.'</td>
                                                            </tr>
                                                            
                                                            ';
                                            $total_price = $total_price + $pickUp;
                                        }

                                        
                                        if($couponCode != ''){
                                           
                                            $couponCodeHtml = '
                                                            <tr>
                                                                <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">Coupon Code('.$couponCode.')</td>
                                                                <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ '.$couponBalance.'</td>
                                                            </tr>
                                                            ';
                                        }

                                    $html .=' </tbody>
                                    </table>
                                    <table style="width:100%;border-spacing: 20px">
                                        '.$pickupHtml.'
                                        <tr>
                                            <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">GST</td>
                                            <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ '.$gst_price.'</td>
                                        </tr>
                                        '.$couponCodeHtml.'
                                        <tr>
                                            <td style="width:50%;text-align:left;padding-left:8px;color:#7b8199">Total Payout amount</td>
                                            <td style="width:50%;text-align:right;padding-left:8px;color:#7b8199">₹ '.$total_price.'</td>
                                        </tr>
                                        '.$buttomBar.'
                                    </table>
                                    

                                    </div>
                                </div>

                                <div style="max-width:588px;margin:auto">
                                    <div style="text-align:center;margin-bottom:16px;margin-top:8px;max-width:588px;margin:auto">
                                    <a href="'.$bookingSite.'" style="color:white;text-decoration:unset" target="_blank">
                                        <div style="padding:15px 0px 15px 0px;background:#ec407a;border-radius:3px;margin:10px 0px;color:white">
                                        View Rooms
                                        </div>
                                    </a>
                                    </div>

                                    <p style="font-size:14px;text-align:center;color:#7b8199">
                                    If you have any issue with the service from '.$sitename.' Software Private Ltd, please raise
                                    your request
                                    <a href=" " target="_blank">here</a>
                                    </p>
                                </div>

                                '.hotelPolicyEmail().'
                            </div>
                        </div>
                    </div>
                </body>
                </html>
  
    
    ';
    return $html;
}

function custom_number_format($n, $precision = 1) {
    if ($n < 900) {
        $n_format = number_format($n);
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision). 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision). 'M';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 1000000000, $precision). 'B';
    } else {
        $n_format = number_format($n / 1000000000000, $precision). 'T';
    }
    return $n_format;
}

function checkAmenitiesById($rid,$aid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from room_amenities where room_id  = '$rid' and amenitie_id  = '$aid'");
    if(mysqli_num_rows($sql)){
        $data = 1;
    }else{
        $data = 0;
    }
    return $data;
}

function visiter_count($ip){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from counter_table where visiter_ip = '$ip'");
    if(mysqli_num_rows($sql)>0){

    }else{
        mysqli_query($conDB, "insert into counter_table(visiter_ip) values('$ip')");
    }
}

function roomBooking(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from booking,bookingdetail where booking.id = bookingdetail.bid and  booking.payment_status = 'complete'");
    $data = mysqli_num_rows($sql);
    if(mysqli_num_rows($sql) == ''){
        $data = 0;
    }
    return $data;
}

function qpRoomBooking(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from quickpay where paymentStatus = 'complete'");
    return mysqli_num_rows($sql);
}

function roomNight(){
    global $conDB;
    $count = roomBooking();
    $currennt_date = date('Y-m-d');
    if($count > 0){
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(night) from bookingdetail,booking where booking.id = bookingdetail.bid and bookingdetail.checkIn <= '$currennt_date' && bookingdetail.checkout >= '$currennt_date' and booking.payment_status = 'complete'"));
        $result = $sql['sum(night)'];
        if($sql['sum(night)'] == ''){
            $result = 0;
        }
    }else{
        $result = 0;
    }
    return $result;
    
}

function earnig(){
    global $conDB;
    $count = roomBooking();
    if($count > 0){
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge),sum(userPay) from booking where booking_type = '1' and payment_status = 'complete'"));
        $result= [
            'gross'=>$sql['sum(grossCharge)'],
            'pay'=>$sql['sum(userPay)'],
        ];
    }else{
        $result= [
            'gross'=>0,
            'pay'=>0,
        ];
    }
    return $result;
    
}

function wiEarnig(){
    global $conDB;
    $count = roomBooking();
    if($count > 0){
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge),sum(userPay) from booking where booking_type = '2' and payment_status = 'complete'"));
        $result= [
            'gross'=>$sql['sum(grossCharge)'],
            'pay'=>$sql['sum(userPay)'],
        ];
    }else{
        $result= [
            'gross'=>0,
            'pay'=>0,
        ];
    }
    return $result;
    
}

function quickPayEarnig(){
    global $conDB;
    $count = roomBooking();
    if($count > 0){
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where paymentStatus = 'complete'"));
        $result= custom_number_format($sql['sum(totalAmount)']);
    }else{
        $result = 0;
    }
    return $result;
    
}

function visiter(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from counter_table");
    return custom_number_format(mysqli_num_rows($sql));
}

function revenue(){
    global $conDB;
    $count = roomBooking();
    $currennt_date = date('Y-m-d');
    if($count > 0){
        $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge) as gross,sum(userPay) as pay from booking where add_on = '$currennt_date' and payment_status = 'complete'"));
        $qpsql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) as gross,sum(amount) as pay from quickpay where addOn = '$currennt_date' and paymentStatus = 'complete'"));
        $gross = $sql['gross'];
        if( $sql['gross'] == ''){
            $gross = 0;
        }
        $pay = $sql['pay'];
        if( $sql['pay'] == ''){
            $pay = 0;
        }

        $qpgross = $qpsql['gross'];
        if( $sql['gross'] == ''){
            $qpgross = 0;
        }
        $qppay = $qpsql['pay'];
        if( $sql['pay'] == ''){
            $qppay = 0;
        }
        $revenue[] = [
            'gross' => $gross + $qpgross,
            'pay' => $pay + $qppay
        ];
    }else{
        $revenue = 0;
    }
    return $revenue;
}

function dailyQuickPay(){
    global $conDB;
    $revenue = 0;
    $currennt_date = date('Y-m-d');
    
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $query = mysqli_query($conDB, "select sum(amount) from quickpay where  addOn >= '$currennt_date' && addOn <= '$nextDay' and paymentStatus = 'complete' ");
    if(mysqli_num_rows($query)> 0){
        $sql = mysqli_fetch_assoc($query);
        $revenue = $sql['sum(amount)'];
    }else{
        $revenue = 0;
    }
    
    return $revenue;
}

function dailyQuickPayEarning($date){
    global $conDB;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where  checkIn >= '$currennt_date' && checkIn <= '$nextDay' and paymentStatus = 'complete' "));
    $revenue = $sql['sum(totalAmount)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return $revenue;
}

function dailyBookingEarning($date){
    global $conDB;
    $revenue = 0;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge) from booking,bookingdetail where booking.id=bookingdetail.bid and bookingdetail.checkIn >= '$currennt_date' && bookingdetail.checkout <= '$nextDay' and booking.payment_status = 'complete' "));
    $revenue = $sql['sum(grossCharge)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return $revenue;
}

function dailyBookingEarningByAddOn($date){
    global $conDB;
    $revenue = 0;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge) from booking where booking_type = '1' and  add_on LIKE  '$date %'  and booking.payment_status = 'complete' "));
    $revenue = $sql['sum(grossCharge)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return round($revenue);
}

function dailyBookingEarningByAddOnCount($date){
    global $conDB;
    $revenue = 0;
    $sql = mysqli_query($conDB, "select * from booking where booking_type = '1' and  add_on LIKE  '$date %'  and booking.payment_status = 'complete' ");
    $revenueCount = mysqli_num_rows($sql);
    if($revenue == ''){
        $revenueCount = 0;
    }
    return $revenueCount;
}

function dailyWalkInEarningByAddOnCount($date){
    global $conDB;
    $revenue = 0;
    $sql = mysqli_query($conDB, "select * from booking where booking_type = '2' and  add_on LIKE  '$date %'  and booking.payment_status = 'complete' ");
    $revenueCount = mysqli_num_rows($sql);
    if($revenue == ''){
        $revenueCount = 0;
    }
    return $revenueCount;
}

function dailyWalkInEarningByAddOn($date){
    global $conDB;
    $revenue = 0;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge) from booking where booking_type = '2' and  add_on LIKE  '$date %'  and booking.payment_status = 'complete' "));
    $revenue = $sql['sum(grossCharge)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return round($revenue);
}


function dailyQuickPayEarningByAddOn($date){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where  addOn LIKE  '$date %' and paymentStatus = 'complete' "));
    $revenue = $sql['sum(totalAmount)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return round($revenue);
}

function dailyQuickPayEarningByAddOnCount($date){
    global $conDB;
    $sql = mysqli_query($conDB, "select sum(totalAmount) from quickpay where  addOn LIKE  '$date %' and paymentStatus = 'complete' ");
    $revenueCount = mysqli_num_rows($sql);
    $query = mysqli_fetch_assoc($sql);
    $revenue = $query['sum(totalAmount)'];
    if($revenue == ''){
        $revenueCount = 0;
    }
    return $revenueCount;
}




function dailyUserPayQuickPayEarning($date){
    global $conDB;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(amount) from quickpay where  checkIn >= '$currennt_date' && checkIn <= '$nextDay' and paymentStatus = 'complete' "));
    $revenue = $sql['sum(amount)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return $revenue;
}

function dailyUserPayBookingEarning($date){
    global $conDB;
    $revenue = 0;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($currennt_date) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(userPay) from booking,bookingdetail where  bookingdetail.checkIn >= '$currennt_date' && bookingdetail.checkout <= '$nextDay' and booking.payment_status = 'complete' "));
    $revenue = $sql['sum(userPay)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return $revenue;
}

function dailyUserPayBookingEarningByAddOn($date){
    global $conDB;
    $revenue = 0;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(userPay) from booking where booking_type = '1' and  add_on LIKE  '$date %'  and booking.payment_status = 'complete' "));
    $revenue = $sql['sum(userPay)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return round($revenue);
}

function dailyUserPayWalkInEarningByAddOn($date){
    global $conDB;
    $revenue = 0;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(userPay) from booking where booking_type = '2' and  add_on LIKE  '$date %'  and booking.payment_status = 'complete' "));
    $revenue = $sql['sum(userPay)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return round($revenue);
}

function dailyUserPayQuickPayEarningByAddOn($date){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(amount) from quickpay where  addOn LIKE  '$date %' and paymentStatus = 'complete' "));
    $revenue = $sql['sum(amount)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return round($revenue);
}

function MonthlyBookingEarning($date, $date2){
    global $conDB;
    $revenue = 0;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($date2) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(grossCharge) from booking where  add_on >= '$currennt_date' && add_on <= '$nextDay' and payment_status = 'complete'"));
    $revenue = $sql['sum(grossCharge)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return $revenue;
}

function MonthlyQuickPayEarning($date,$date2){
    global $conDB;
    $currennt_date = $date;
    $one_day = strtotime('1 day 00 second', 0);
    $nextDay = date('Y-m-d', strtotime($date2) + $one_day);
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select sum(totalAmount) from quickpay where  addOn >= '$currennt_date' && addOn <= '$nextDay' and paymentStatus = 'complete' "));
    $revenue = $sql['sum(totalAmount)'];
    if($revenue == ''){
        $revenue = 0;
    }
    return $revenue;
}


function averageStay(){
    global $conDB;
    $total_booking = roomBooking();
    if($total_booking == 0){
        $result = 0;
    }else{
        $sql = mysqli_query($conDB, "select * from booking where payment_status = 'complete' and status = '1'");
        $count_complete_booking = mysqli_num_rows($sql);
        $result = ($count_complete_booking * 100) / $total_booking;
    }
    return ceil($result); 
}

function rate_performance(){
    global $conDB;
    $total_booking = roomBooking();
    $currennt_date = date('Y-m-d');
    if($total_booking == 0){
        $result = 0;
    }else{
        $query = "select * from booking where checkIn <= '$currennt_date' && checkOut >= '$currennt_date' GROUP BY room_detail_id and status = '1'";
        $sql = mysqli_query($conDB, $query);
        if(mysqli_num_rows($sql)>0){
            while($row = mysqli_fetch_assoc($sql)){
                $roomDId=$row['room_detail_id'];
                $query = "select * from booking where checkIn <= '$currennt_date' && checkOut >= '$currennt_date' and room_detail_id = '$roomDId' and status = '1'";
                $sqlById = mysqli_query($conDB, $query);
                $count[]=mysqli_num_rows($sqlById);
            }
            $result = getRatePlanByRoomDetailId(max($count));
        }else{
            $result = 0;
        }
       
    }
    return $result; 
}

function settingValue(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from setting where id = '1'");
    $row = mysqli_fetch_assoc($sql);
    return $row;
}

function couponPrice($code,$price){
    global $conDB;
        $sql = mysqli_query($conDB, "select * from couponcode where status = '1' and coupon_code = '$code'");
        $row = mysqli_fetch_assoc($sql);
        $coupon_type = $row['coupon_type'];
        $coupon_value = $row['coupon_value'];
        $totalPrice = 0;
        
        if($coupon_type == 'P'){
            $totalPrice = $price - ($price * ($coupon_value / 100));
        }
        if($coupon_type == 'F'){
            $totalPrice = $price - $coupon_value;
        }
        return  $totalPrice;
}

function couponActualPrice($code,$price){
    global $conDB;
        $sql = mysqli_query($conDB, "select * from couponcode where coupon_code = '$code'");
        $row = mysqli_fetch_assoc($sql);
        $coupon_type = $row['coupon_type'];
        $coupon_value = $row['coupon_value'];
        $totalPrice = 0;
        
        if($coupon_type == 'P'){
            $totalPrice = $price * ($coupon_value / 100);
        }
        if($coupon_type == 'F'){
            $totalPrice = $coupon_value;
        }
        return  $totalPrice;
}

function checkLive(){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from live where id = '1'"));
    return $sql['status'];
}

function getPolicyArr(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from term where status = '1'");
    $data = array();
    while($row = mysqli_fetch_assoc($sql)){
        $data[]=[
                'policy'=>$row['id'],
                'policy2'=>$row['policy'],
                'title'=>$row['title'],
                'termContent'=>$row['termContent']
            ];
    }
    return $data;
}


function roomMaxChildCapacityById($rid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select noChild from room where id = '$rid'"));
    return $sql['noChild'];
}

function getPackageArr(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from package where status = '1'");
    $data = array();
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = [
                'id'=> $row['id'],
                'slug'=> $row['slug'],
                'name'=> $row['name'],
                'img'=> $row['img'],
                'duration'=> $row['duration'],
                'description'=> $row['description'],
                'room'=> $row['room'],
                'discount'=> $row['discount'],
                'rdid'=> $row['rdid'],
            ];
        }
    }
    
    return $data;
}

function getPackageById($pid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from package where status = '1' and id= '$pid'");
    
    $row = mysqli_fetch_assoc($sql);

    
    
    return $row;
}

function checkPackageSlug($slug){
    $slug = trim($slug);
    global $conDB;
    $sql = mysqli_query($conDB, "select * from package where slug= '$slug'");
    if(mysqli_num_rows($sql) > 0){
        $slug = 'Yes';
    }else{
        $slug = 'No';
    }
    
    return $slug;
}

function getPackagePriceById($pid,$date){
    global $conDB;
    $roomDetail = getPackageById($pid)['rdid'];
    $roomId = getPackageById($pid)['room'];
    $car = getPackageById($pid)['car'];
    $pickup = getPackageById($pid)['pickup'];
    $night = getPackageById($pid)['duration'];
    $discount = getPackageById($pid)['discount'];
    $checkIn = $date;

    if($pickup == 'Yes'){
        $pickupPrice = settingValue()['pckupDropPrice'];
    }else{
        $pickupPrice = 0;
    }
    
    $adult = getRoomAdultCountById($roomId);
    $child = getRoomChildCountById($roomId);
    
    $adultprice = getAdultPriceByNoAdult($adult,$roomId,$roomDetail);
    $chiltprice = getAdultPriceByNoAdult($child,$roomId,$roomDetail);
    
    $roomPrice = getRoomPriceById($roomDetail, $checkIn);
    
    $carPrice = getCarPriceById($car);
    

    $totalPrice = getPackagePriceByAllData($roomPrice,$adultprice,$chiltprice,$carPrice,$pickupPrice,$night,$discount);
    
    
    return $totalPrice[0]['totalGstWithDiscount'];

}

function getPackagePriceByAllData($roomPrice,$adultprice,$chiltprice,$carPrice,$pickup,$night,$discount){
    global $conDB;
    $data = array();

    $roomPriceWithNight = ( intval($night) * intval($roomPrice) );
    $totalPrice =  $roomPriceWithNight + $carPrice + $pickup + $adultprice + $chiltprice;
    $gst = getGSTPrice($totalPrice);
    $totalwithGst = $totalPrice + intval($gst);
    $discountPrice = $totalwithGst * $discount / 100;
    $totalGstWithDiscount = $totalwithGst - $discountPrice;

    $data[] = [
        'car'=> $carPrice,
        'pickup'=> $pickup,
        'adult'=> $adultprice,
        'child'=> $chiltprice,
        'roomPrice'=> $roomPrice,
        'night'=> $night,
        'discount'=> $discount,
        'discountPrice'=> $discountPrice,
        'totalPrice'=> $totalPrice,
        'totalwithGst'=> $totalwithGst,
        'totalGstWithDiscount'=> $totalGstWithDiscount,
    ];
    
    return $data;

}

function getPackagePriceBySession(){
    global $conDB;
    $pid= $_SESSION['package']['pid'];
    $rid= $_SESSION['package']['rid'];
    $cid= $_SESSION['package']['cid'];
    $adult= $_SESSION['package']['adult'];
    $child= $_SESSION['package']['child'];
    $checkIn= $_SESSION['package']['checkIn'];
    $pickup= $_SESSION['package']['pickup'];
    $rdid= $_SESSION['package']['rdid'];



    $duration = getPackageById($pid)['duration'];

    $discount = getPackageById($pid)['discount'];

    $checkInTime = date('d-M', strtotime($checkIn));
    $checkOutTime = date('d-M', strtotime(getDateByDay($checkIn,$duration)));

    $packageData = getPackageById($pid);

    $roomPrice = getRoomPriceById($rdid, $checkIn);

    $carPrice = getCarPriceById($cid);
    
    $adultprice = getAdultPriceByNoAdult($adult,$rid,$rdid);

    $chiltprice = getChildPriceByNoChild($child,$rid,$rdid);
    
    return getPackagePriceByAllData($roomPrice,$adultprice,$chiltprice,$carPrice,$pickup,$duration,$discount);

}

function getCarArr(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from car where status = '1' ORDER BY `car`.`rate` ASC");
    
    if(mysqli_num_rows($sql)){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = [
                'id'=> $row['id'],
                'name'=> $row['name'],
                'img'=> $row['img'],
            ];
        }
    }else{
        $data[] = 'No Car';
    }
    
    return $data;
}

function getCarPriceById($cid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from car where id = '$cid'"));
    return $sql['rate'];
}

function getCarDetailById($cid){
    global $conDB;
    $data = array();
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from car where id = '$cid'"));
    $data[] = [
        'id'=> $sql['id'],
        'name'=> $sql['name'],
        'img'=> $sql['img'],
        'rate'=> $sql['rate'],
    ];
    return  $data;
}

function getGSTPercentage($price){
    if($price <= 999){
        $data = 0;
    }elseif($price <= 7499){
        $data = 12;
    }else{
        $data = 18;
    }
    return $data;
}

function getGSTPrice($price){
    if($price <= 999){
        $gstprice = 0;
    }elseif($price <= 7499){
        $gstprice = $price * 12 / 100;
    }else{
        $gstprice = $price * 18 / 100;
    }
    return $gstprice;
}

function getDateByDay($date,$nday){
    $date = strtotime($date);
    $one_day = strtotime('1 day 00 second', 0);
    return date('Y-m-d',$date + ($nday * $one_day));
}

function checkRatePlanOnPackage($pid){
    global $conDB;
    $sql = mysqli_fetch_assoc(mysqli_query($conDB, "select rdid from package where id ='$pid'"));
    return $sql['rdid'];
}

function getPackageDayActivityArr($pid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from packageactivity where pid = '$pid'");
    
    if(mysqli_num_rows($sql)){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = [
                'id'=> $row['id'],
                'description'=> $row['description'],
            ];
        }
    }
    
    return $data;
}

function getPackagePolicy(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from package_policy where id = '1'");
    $row = mysqli_fetch_assoc($sql);

    
    return $row;
}

function quickPayEmail($qpid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from quickpay where id = '$qpid'");
    $row = mysqli_fetch_assoc($sql);

    $name = $row['name'];
    $qporderId = $row['orderId'];
    $phone = $row['phone'];
    $email = $row['email'];
    $room = $row['room'];
    $room_id = $row['room_id'];
    $qickPayNote = $row['qickPayNote'];
    $amount = 0;
    $paymentStatus = $row['paymentStatus'];
    $add_on = $row['addOn'];
    $gross = $row['totalAmount'];
    
    $img = FRONT_SITE_IMG.hotelDetail()['logo'];
    
    $totalPrice = $row['amount'];
    
    $payble = $row['amount'];
    
    $userPayPercentage = '';
    $amountPrint = '<strong style="font-size: 14px;"> Total Price : </strong>'.$totalPrice.' Rs ';
                    
    if($gross >= $payble){
        $totalPrice = $gross;
        $userPayPercentage = ' ('. getPercentageValueByAmount($payble , $gross).' %)'; 
        $payAtHotelHtml = '';
        $payAtHotel = $gross - $payble;
        if($payAtHotel > 0){
            $payAtHotelHtml = '<strong style="font-size: 14px;"> Pay at hotel : </strong>'.$payAtHotel.' Rs ';
        }
        $amountPrint = ' 
                    <strong style="font-size: 14px;"> Total Price : </strong>'.$totalPrice.' Rs  <br/> 
                    <strong style="font-size: 14px;"> Pay'.$userPayPercentage.' : </strong>'.$payble.' Rs <br/>
                    '.$payAtHotelHtml.'';
    }
    
    
    
    $checkIn = $row['checkIn'];
    $checkOut = $row['checkOut'];
    $noOfNight = getNightByTwoDates($checkIn,$checkOut);
    
    $buttomBar = '';
    $gstSection = '';
    
    

    $content = '
        
            <tr>
                <td align="left"><strong>01</strong></td>
                <td align="left"><strong>Room</strong></td>
                <td align="right"><strong>'.getRoomNameById($room).'</strong></td>
            </tr>
            
            
            <tr>
                <td align="left"><strong>02</strong></td>
                <td align="left"><strong>Name</strong></td>
                <td align="right"><strong>'.$name.'</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>03</strong></td>
                <td align="left"><strong>Phone</strong></td>
                <td align="right"><strong>'.$phone.'</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>04</strong></td>
                <td align="left"><strong>Email</strong></td>
                <td align="right"><strong>'.$email.'</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>05</strong></td>
                <td align="left"><strong>Check In</strong></td>
                <td align="right"><strong>'.$checkIn.'</strong></td>
            </tr>
            <tr>
                <td align="left"><strong>06</strong></td>
                <td align="left"><strong>Check Out</strong></td>
                <td align="right"><strong>'.$checkOut.'</strong></td>
            </tr>
            
            <tr>
                <td align="left"><strong>07</strong></td>
                <td align="left"><strong>Night</strong></td>
                <td align="right"><strong>'.$noOfNight.'</strong></td>
            </tr>

            <tr>
                <td align="left"><strong>08</strong></td>
                <td align="left"><strong>Request</strong></td>
                <td align="right" style="width: 50%;"><p>'.$qickPayNote.'</p></td>
            </tr>
        
        ';
        
        
                    
        if($paymentStatus == 'complete'){
            $priceStatus = 'Successful Payment';
            $priceHtml = '<tr>
                            <td style="width: 100%;color: #0f5132;background-color: #d1e7dd;border-color: #0f5132;text-align: center;padding: 20px 10px;border-radius: 3px;border: 2px dashed;">
                                <div>
                                    <strong>'.$priceStatus.' </strong> <br/>
                                    '.$amountPrint.'
                                </div>
                            </td>
                        </tr>';
        }else{
            $priceStatus = 'Failed Payment';
            $priceHtml = '<tr><td style="width: 100%;text-align: center;padding: 20px 10px;border-radius: 3px;border: 2px dashed;color: #842029;background-color: #f8d7da;border-color: #d1898f; "><div><strong>'.$priceStatus.' </strong> <br/> <strong style="font-size: 14px;"> <strong>Total Price : '.$payble.' Rs </div></td></tr>';
        }
    
    


    

    

    $html = '
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Order Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Order confirmation </title>
        <meta name="robots" content="noindex,nofollow" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

            div,
            p,
            a,
            li,
            td {
                -webkit-text-size-adjust: none;
                word-break: break-all;
            }

            body {
                margin: 0;
                padding: 0;
                background: #e1e1e1;
            }

            body {
                width: 100%;
                height: 100%;
                background-color: #e1e1e1;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
                max-width: 600px;
                margin: 0 auto;
                font-family: "Open Sans", sans-serif;
            }

            html {
                width: 100%;
            }

            #invoice {
                background: white;
                background: white;
                border-radius: 25px 25px 0 0;
                padding: 2em;
            }

            .dish_list td {
                padding: 1em;
                border-bottom: 1px solid rgba(0, 0, 0, .1);
            }

            .dish_list td strong {
                color: rgba(0, 0, 0, .7);
            }
        </style>

    </head>

    <body>
        <div style="background-color: #e1e1e1; -webkit-font-smoothing: antialiased;padding: 1em; max-width:600px;">
            <div id="invoice">
                <table style="width:100%; max-width:600px;">
                    <tr>
                        <td align="left"><img width="80px" src="'.$img.'"></td>
                        <td align="right"><strong>Invoice #'.$qporderId.'</strong></td>
                    </tr>
                </table>
                <hr>

                <table style="width:100%; margin-bottom: 35px; max-width:600px;">
                    <tr>
                        <td align="left">
                            <div> Hello <b>'.$name.'</b>,</div>
                            <div> '.$email.'</div>
                        </td>

                        <td align="right" style="width:50%;">
                            <div><b>'.hotelDetail()['name'].'</b></div>
                            <div>'.hotelDetail()['pincode'].'</div>
                            <div>'.ucfirst(hotelDetail()['district']).'</div>
                            <div>'.ucfirst(hotelDetail()['address']).'</div>
                            <div>GST:- '.hotelDetail()['gst'].'</div>
                        </td>
                    </tr>
                </table>

                <table style="width:100%; margin-bottom: 35px; max-width:600px;">
                    <tr>
                        <td align="left">
                            <div style="margin-bottom:10px;"><small>Invoice Date: '.$add_on.'</small></div>
                        </td>
                    </tr>
                    '.$priceHtml.'
                </table>

                <table class="dish_list"
                    style="width:100%; margin-bottom: 25px;transform: translateX(0); border-collapse: collapse; max-width:600px;">
                    
                   '.$content.'
                   
                </table>
                
                <table style="width:70%; margin-bottom: 25px;margin-left: 30%;">
                   
                    
                    <tr align="right">
                        <td><strong>Total:</strong></td>
                        <td><strong>'.$totalPrice.' Rs</strong></td>
                    </tr>
                    
                </table>
                
                '.hotelPolicyEmail().'
                
            </div>
        </div>

    </body>

    </html>
  
    
    ';
    return $html;
}


function getBookingVoucher($oid){
    
    $name = getOrderDetailByOrderId($oid)['name'];
    $email = getOrderDetailByOrderId($oid)['email'];
    $phone = getOrderDetailByOrderId($oid)['phone'];
    $company_name = getOrderDetailByOrderId($oid)['company_name'];
    $payment_status = getOrderDetailByOrderId($oid)['payment_status'];
    $add_on = getOrderDetailByOrderId($oid)['add_on'];
    $oderId = getOrderDetailByOrderId($oid)['bookinId'];
    $partial = getOrderDetailByOrderId($oid)['partial'];
    $grossCharge = getOrderDetailByOrderId($oid)['grossCharge'];
    $userPay = getOrderDetailByOrderId($oid)['userPay'];
    
    $checkInTime = hotelDetail()['checkIn'];
    $checkOutTime = hotelDetail()['checkOut'];
    
    $checkInStatus = getOrderDetailByOrderId($oid)['checkInStatus'];
    
    $addOn = $add_on;

    $company_name = getOrderDetailByOrderId($oid)['company_name'];
    $gst = getOrderDetailByOrderId($oid)['comGst'];


    $couponCode = getOrderDetailByOrderId($oid)['couponCode'];
    $pickUp = getOrderDetailByOrderId($oid)['pickUp'];
    $pickupHtml = '';
    
    $img = FRONT_SITE_IMG.hotelDetail()['logo'];
    
    
    
    $couponCodeHtml = '';
    $couponPrice = 0 ;
    
    
    
    
    if($pickUp > 0){
        $pickupHtml = '
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                    <h4>Pickup Charges</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($pickUp, 2).'</td>
            </tr>
        ';
    }else{
        $pickupHtml = '';
    } 

    $guestBook = '';
    $roomBackupData = '';
    $roomBackUpRoomName = '';
    $totalRoomBrackupPrice = 0;
    $totalAdultRoomBrackupPrice = 0;
    $totslGstPrice = 0;
    
    foreach(getBookingDetailArrByBId($oid) as $bookingList){
      $noOfNight = getNightByTwoDates($bookingList['checkIn'],$bookingList['checkout']);
        $guestBook .= '
                <tr>
                    <td style="padding: 5px 10px;"> '.$bookingList['room'].' <br/>
                        <strong>'.date('M-d, y', strtotime($bookingList['checkIn'])).'</strong> <br/>
                        <small>Adult '.$bookingList['noAdult'].'</small> <br/>
                        <strong>Night</strong>
                    </td>
                    <td style="padding: 5px 10px;">'.$bookingList['ratePlan'].'<br/>
                            <strong>'.date('M-d, y', strtotime($bookingList['checkout'])).'</strong><br/>
                            <small>Child '.$bookingList['noChild'].'</small> <br/>
                            <strong> '.$noOfNight.'</strong> 
                        </td>
                </tr>
        ';

        $roomBackupData .= '<tr> <td colspan="4" style="padding:10px">'. $bookingList['room'] .'</td> </tr> ';
     
        for($i= 0; $i < getNightByTwoDates($bookingList['checkIn'],$bookingList['checkout']); $i++){
            $chilAdult = $bookingList['adultPrice'] + $bookingList['childPrice'];
            $totalRoomBrackupPrice += $bookingList['roomPrice'];
            $totalAdultRoomBrackupPrice += $chilAdult;
            $totslGstPrice += $bookingList['gst'];
            $roomBackupData .= '<tr>
                                    <td style="padding:10px">'.date('d-M-Y', strtotime(getDateByDay($bookingList['checkIn'], $i))).'</td>
                                    <td style="padding:10px; text-align:center">₹ '.$bookingList['roomPrice'].'</td>
                                    <td style="padding:10px;text-align:right">₹ '.$chilAdult.'</td>
                                    <td style="padding:10px;text-align:right">₹ '.$bookingList['gst'].' @ '.$bookingList['gstPer'].' %</td>
                                </tr>';
        }
    }

    $calculateHotelVoucher = getBookingDetailByBId($oid);
    

    if($couponCode != ''){ 
        $couponCodeHtml = '<tr>
                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                    <h4>Coupon Discount</h4>
                                    <p><small>( '.$couponCode.' )</small></p>
                                </td>
                                <td style="padding: 5px 10px;border-bottom: 1px solid #00000033;text-align: right;">₹ '.number_format($calculateHotelVoucher[0]['couponDis'], 2).'</td>
                            </tr>
                            
                            <tr>
                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                    <h4>Actual Sell Rates</h4>
                                </td>
                                <td style="padding: 5px 10px;border-bottom: 1px solid #00000033;text-align: right;">₹ '.number_format($calculateHotelVoucher[0]['actualPrice'], 2).'</td>
                            </tr>
                            
                            ';
    }
    
    
    if($checkInStatus == 4){
        
        $actualPrice = $userPay * 100 / 112;
        
    }else{
        
        $actualPrice = $calculateHotelVoucher[0]['actualPrice'];
        
    }
    
    $gstActualPrice = $calculateHotelVoucher[0]['GstPrice'];
    
    $retroCommPrice = $actualPrice * COMM_PRICE / 100 ;
    $commTax = $retroCommPrice * 18 / 100 ;
    
    $tcsPrice = $actualPrice * 1 / 100 ;
    $tdsPrice = $actualPrice * 1 / 100 ;
    
    $totalCommission = $retroCommPrice + $commTax + $tcsPrice + $tdsPrice;
    
    
    $bookingCancleHtml = '';
    
    if($checkInStatus == 4){
        
        $natAmount = $userPay - $totalCommission;
        
        $bookingCancleHtml = '
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                    <h4>Booking Status</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;background: darkred;text-align: center;color: white;font-weight: 700;">No Show</td>
            </tr>
        ';
        
    }else{
        
        $natAmount = $grossCharge - $totalCommission;
        
    }
    
    
    $hotelPayable = $userPay - $totalCommission;
    $partialStatus = '';
    
    $paymentStatusPrint = '
        <tr>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                <h4>Hotel Net payment</h4>
            </td>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ '.number_format($hotelPayable, 2).'</td>
        </tr>
    ';
    
    if($grossCharge > $userPay){
        $userPayPercentage = round(($userPay/$grossCharge) * 100);
        $userHotelPay = $grossCharge - $userPay;
        $userPayAtHotelHtml = '<tr>
                                    <td style="padding: 5px 10px;"><strong style="color:#3f51b5">Pay at hotel</strong></td>
                                    <td style="padding: 5px 10px;"><strong style="color:black">₹ '.$userHotelPay.'</strong></td>
                                </tr>';
        if($userHotelPay == 0){
            $userPayAtHotelHtml = '';
        }
        if($checkInStatus == 4){
            $userPayAtHotelHtml = '
                <tr>
                    <td style="padding: 5px 10px;"><strong style="color:#3f51b5">Pay at hotel</strong></td>
                    <td style="padding: 5px 10px;"><strong style="color:black">₹ 0</strong></td>
                </tr>
            ';
        }
        $partialStatus = '
            <tr>
                <td style="padding: 5px 10px;"><strong style="color:red">Advance Pay('.$userPayPercentage.'%)</strong></td>
                <td style="padding: 5px 10px;"><strong style="color:green">₹ '.$userPay.'</strong></td>
            </tr>

            '.$userPayAtHotelHtml.'
        ';
        
        $paymentStatusPrint = '
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Online payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darksalmon;color: black;font-weight: 700;">₹ '.number_format($hotelPayable, 2).'</td>
            </tr>
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Net payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ '.number_format($natAmount, 2).'</td>
            </tr>
        ';
    }
    
    
    if($payment_status == 'pending'){
        
        $html = '
            <table>
                <tr>
                    <th>Payment Failed!</th>
                </tr>
            </table>
        ';
        
    }else{
        
    
    
    
    $html = '
    
    
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Web Booking Voucher</title>
                </head>
                <body>
            
                    <table width="100%" style="border-top: 1px solid #00000033;border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px;">
                        <tr>
                            <td>
                                <h2>Web Booking Voucher</h2> <br/>
                                <p><small>Booking ID</small> <strong> '.$oderId.'</strong></p>
                                <p>Booking Date: '.$addOn.'</p>
                            </td>
                            <td style="text-align:right">
                                <img src="https://retrox.in/logo.png" alt="Logo" style="width: 80px;">
                                <table style="width: 100%;padding: 10px 15px;">
                                    <tr>
                                        <td>
                                            <p><strong>GST No.-</strong> '.RETROD_GST.'</p>
                                            <p><strong>PAN No.-</strong> '.RETROD_PAN.'</p>
                                            <p><strong>TAN No. -</strong> '.RETROD_TAN.'</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td >
                                <p><strong>Dear Valuable Partner,</strong></p> <br/>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td style="padding: 0 20px;">
                                <p>Congratulations, You have got a booking from your Website Please find the details below . Guest Name <strong>'.$name.'</strong></p>
                                <p>The amount payable to hotel for this booking is INR <strong style="color: green;font-size: 21px;"> '.number_format($natAmount,2).'</strong> as per the details below.</p>
                            </td>
                        </tr>
                    </table>
            
                    <table width="100%" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px;">
                        
                        
            
                        <tr>
                            <td>
                            
                                <table style="padding: 10px 20px; width: 100%; border-collapse: collapse; ">
                                    <tr>
                                        <th style="padding: 10px;border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-left: 2px solid #96D4D4;">BOOKING DETAILS</th>
                                        <th style="padding: 10px;width: 80%; border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-right: 2px solid #96D4D4;border-left: 2px solid #96D4D4;">PAYMENT BREAKUP</th>
                                    </tr>
                                    <tr>
                                    
                                        <td width="40%" style="padding: 20px 20px; vertical-align: top; width: 40%; border-left: 2px solid #96D4D4; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
            
                                            <table border="1" style="border-collapse: collapse; text-align:center; border-color: #96D4D4; width: 100%">
                                                <tr>
                                                    <td style="padding: 5px 10px;"><strong>Guest Name</strong></td>
                                                    <td style="padding: 5px 10px;">'.$name.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 10px;"><strong>Number</strong></td>
                                                    <td style="padding: 5px 10px;">'.$phone.'</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="padding: 5px 10px;"> Night</th>
                                                </tr>
                                                '.$guestBook.'
                                                '.$partialStatus.'
                                            </table>
                                        </td>
                                        
                                        <td width="60%" style="padding: 10px; width: 60%; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
                                            <table style="width: 100%;">
                                                <tr style="vertical-align: top;">
                                                   
                                                    <td >
                                                        <table style="border-collapse: collapse;padding: 10px 20px;">
                        
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Hotel Sell Price</h4>
                                                                    <p><small>(  Room x  Nights )</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;text-align: right;">₹ '.number_format($calculateHotelVoucher[0]['sellPrice'],2).'</td>
                                                            </tr>
                                                            
                                                            '.$couponCodeHtml.'
                                    
                                                            '. $pickupHtml.'
                                    
                                    
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>GST @ </h4>
                                                                    <p><small>(Including IGST or (SGST & CGST))</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($gstActualPrice, 2).'</td>
                                                            </tr>
                                    
                                                            
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Gross Charges</h4>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($grossCharge, 2).'</td>
                                                            </tr>
                                                            
                                                            '.$bookingCancleHtml.'
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; ">
                                                                    <h4><strong>Retrod</strong> <small>- Comm ( '.COMM_PRICE.'% )</small></h4>
                                                                    <p><small>(Including Tax (18%))</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; text-align: right;">
                                                                    ₹ '.number_format($retroCommPrice, 2).' + <br/> ₹ '.number_format($commTax, 2).'
                                                                    
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding: 0 0 10px 0; border-bottom: 1px solid #00000033;" colspan="2">
                                                                    
                                                                    <table border="1" style="width:100%; border-collapse: collapse; border-color: gainsboro;">
                                                                    
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TAC including Tax</td>
                                                                            <td style="padding: 5px 10px; text-align: right;">₹ '.number_format($retroCommPrice + $commTax, 2).'</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TCS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; text-align: right;">₹ '.number_format($tcsPrice, 2).'</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TDS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($tdsPrice, 2).'</td>
                                                                        </tr>
                                                                    
                                                                    
                                                                    </table>
                                                                    
                                                                </td>
                                                                
                                                            </tr>
                                                            
                                                            
                                                            '.$paymentStatusPrint.'
                                                            
                                                            
                                    
                                                        </table>
                                                        
                                                    </td>
                                                    
                                                </tr>
                                            </table>
            
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                    
                    <br/>
                    
                    <h4>Room wise Break up</h4>
                    
                    <table border="1" style="width:100%;border-collapse: collapse;">
                        <tr>
                            <th style="padding:10px;text-align:left">Payment Breakup</th>
                            <th style="padding:10px;text-align:center">Room Charges</th>
                            <th style="padding:10px;text-align:right">Extra Guest/Child</th>
                            <th style="padding:10px;text-align:right">GST</th>
                        </tr>
                        '.$roomBackupData.'
                        ';
                        
                        
                        
                 
                        
                $html .= '
                        <tr>
                            <td style="padding:10px">Total</td>
                            <td style="padding:10px;text-align:center">₹ '.$totalRoomBrackupPrice.'</td>
                            <td style="padding:10px;text-align:right">₹ '.$totalAdultRoomBrackupPrice.'</td>
                            <td style="padding:10px;text-align:right">₹ '.$totslGstPrice.'</td>
                        </tr>
                        
                    
                    </table>
            
                    
                    
                </body>
            </html>
    
    
    ';
    
    
    }
    
    
    
    
    return $html;
}

function getQPVoucher($qpid){
    
    global $conDB;
    $sql = mysqli_query($conDB, "select * from quickpay where id = '$qpid'");
    $row = mysqli_fetch_assoc($sql);

    $qporderId = $row['orderId'];
    $name = $row['name'];
    $phone = $row['phone'];
    $emailId = $row['email'];
    $room = $row['room'];
    $room_id = $row['room_id'];
    $amount = 0;
    $paymentStatus = $row['paymentStatus'];
    $add_on = $row['addOn'];
    $gross = $row['totalAmount'];
    
    $checkIn = date('d-M-y', strtotime($row['checkIn']));
    $checkOut = date('d-M-y', strtotime($row['checkOut']));
    
    $img = FRONT_SITE_IMG.hotelDetail()['logo'];
    
    $totalPrice = $row['amount'];
    
    $payble = $row['amount'];
    $userPayPercentage = '';
    $groosHtml = '';
    $payAtHotel = 0;
    
    $noOfNight = getNightByTwoDates($checkIn,$checkOut);
    
    
        
    $priceSection = '
        <tr>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                <h4>Room Price</h4>
            </td>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;text-align: right;">₹ '.number_format($amount,2).'</td>
        </tr>
    ';
    
    
    $totalRoomPrice = $gross * 100 / 112;
   
    
    $retroCommPrice = $totalRoomPrice * QPCOMM_PRICE / 100 ;
    $commTax = $retroCommPrice * 18 / 100 ;
    
    $tcsPrice = $totalRoomPrice * 1 / 100 ;
    $tdsPrice = $totalRoomPrice * 1 / 100 ;
    
    
    $natAmount = $payble - ($retroCommPrice + $commTax + $tcsPrice + $tdsPrice);
    $userPayment = '
            <tr>
                <th style="padding: 5px 10px;">Total Price</th>
                <th style="padding: 5px 10px;">₹ '.$payble.'</th>
            </tr>
        ';

    if($gross >= $payble){
        $totalPrice = $gross;
        $userPayPercentage = ' ('. round(($payble / $gross) * 100) .' %)'; 
        $payAtHotel = $gross - $payble;
        if($payAtHotel > 0){
            $groosHtml = '
                <tr>
                    <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                        <h4>Gross Amount</h4>
                    </td>
                    <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($totalPrice, 2).'</td>
                </tr>
        ';
        $displayPayment = '
        
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Net payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ '.number_format($natAmount, 2).'</td>
            </tr>
        
        ';
        $userPayment = '
            <tr>
                <th style="padding: 5px 10px;">Total Price</th>
                <th style="padding: 5px 10px;">₹ '.$totalPrice.'</th>
            </tr>
            <tr>
                <th style="padding: 5px 10px;">Pay '.$userPayPercentage.'</th>
                <th style="padding: 5px 10px;">₹ '.$payble.'</th>
            </tr>
            <tr>
                <th style="padding: 5px 10px;">Pay At Hotel</th>
                <th style="padding: 5px 10px;">₹ '.$payAtHotel.'</th>
            </tr>
        ';
        }
    }
    
    
    $displayPayment = '
        
        <tr>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                <h4>Hotel Net payment</h4>
            </td>
            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ '.number_format($natAmount, 2).'</td>
        </tr>
    
    ';


    
    if($gross >= $payble){
        if($payAtHotel > 0){
            $hotelPayble = $natAmount + $payAtHotel;
            
        $displayPayment = '
        
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Online payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darksalmon;color: black;font-weight: 700;">₹ '.number_format($natAmount, 2).'</td>
            </tr>
            
            <tr>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; border-left: 1px solid #00000033;">
                    <h4>Hotel Net payment</h4>
                </td>
                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right; background: darkseagreen;color: black;font-weight: 700;">₹ '.number_format($hotelPayble, 2).'</td>
            </tr>
        
        ';
        
        $natAmount = $hotelPayble;
        
        }
    }


    $content = '
            
        <tr>
            <td style="padding: 5px 10px;">Name</td>
            <td style="padding: 5px 10px;">'.$name.'</td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;">Phone</td>
            <td style="padding: 5px 10px;">'.$phone.'</td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;">Room</td>
            <td style="padding: 5px 10px;">'.getRoomHeaderById($room).'</td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;" >Check In <br/> <strong>'.$checkIn.'</strong></td>
            <td style="padding: 5px 10px;" >Check Out <br/> <strong>'.$checkOut.'</strong></td>
        </tr>
        
        <tr>
            <td style="padding: 5px 10px;" >Night</td>
            <td style="padding: 5px 10px;" >'.$noOfNight.'</td>
        </tr>
        
        '.$userPayment.'

    ';
    
    if($paymentStatus == 'pending'){
        
        $html = '
            <table>
                <tr>
                    <th>Payment Failed!</th>
                </tr>
            </table>
        ';
        
    }else{
        
    




 
    
    $html = '
    
    
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Web Quick Pay Voucher</title>
                </head>
                <body>
            
                    <table width="100%" style="border-top: 1px solid #00000033;border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px;">
                        <tr>
                            <td>
                                <h2>Web Quick Pay Voucher</h2> <br/>
                                <p><small>Booking ID</small> <strong> '.$qporderId.'</strong></p>
                                <p>Booking Date: '.$add_on.'</p>
                            </td>
                            <td style="text-align:right">
                                <img src="https://retrox.in/logo.png" alt="Logo" style="width: 80px;">
                                <table style="width: 100%;padding: 10px 15px;">
                                    <tr>
                                        <td>
                                            <p><strong>GST No.-</strong> '.RETROD_GST.'</p>
                                            <p><strong>PAN No.-</strong> '.RETROD_PAN.'</p>
                                            <p><strong>TAN No. -</strong> '.RETROD_TAN.'</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td >
                                <p><strong>Dear Valuable Partner,</strong></p> <br/>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;padding: 10px 20px; width:100%">
                        <tr>
                            <td style="padding: 0 20px;">
                                <p>Congratulations, You have got a Quick Pay from your Website Please find the details below . Guest Name <strong>'.$name.'</strong></p>
                                <p>The amount payable to hotel for this Quick Pay is INR <strong style="color: green;font-size: 21px;"> '.number_format($natAmount,2).'</strong> as per the details below.</p>
                            </td>
                        </tr>
                    </table>
            
                    <table width="100%" style="border-left: 1px solid #00000033;border-right: 1px solid #00000033;border-bottom: 1px solid #00000033;padding: 10px 20px;">
                        
                        
            
                        <tr>
                            <td>
                            
                                <table style="padding: 10px 20px; width: 100%; border-collapse: collapse; ">
                                    <tr>
                                        <th style="padding: 10px;border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-left: 2px solid #96D4D4;">BOOKING DETAILS</th>
                                        <th style="padding: 10px;width: 80%; border-top: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4; border-right: 2px solid #96D4D4;border-left: 2px solid #96D4D4;">PAYMENT BREAKUP</th>
                                    </tr>
                                    
                                    <tr>
                                    
                                        <td style="padding: 20px 20px; vertical-align: top; width: 40%; border-left: 2px solid #96D4D4; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
            
                                            <table border="1" style="border-collapse: collapse; text-align:center; border-color: #96D4D4; width: 100%">
                                                
                                                '.$content.'
                                                
                                            </table>
                                            
                                        </td>
                                        
                                        <td style="padding: 10px; width: 60%; border-right: 2px solid #96D4D4; border-bottom: 2px solid #96D4D4;">
                                            
                                            <table style="width: 100%;">
                                                <tr style="vertical-align: top;">
                                                   
                                                    <td >
                                                        <table style="border-collapse: collapse;padding: 10px 20px;"> 
                                                            
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Total Amount Paid '.$userPayPercentage.'</h4>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($payble, 2).'</td>
                                                            </tr>
                                                            '.$groosHtml.'
                                                            <tr>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033;">
                                                                    <h4>Actual Amount</h4>
                                                                </td>
                                                                <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($totalRoomPrice, 2).'</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding: 5px 10px; ">
                                                                    <h4><strong>Retrod</strong> <small>- Comm ( '.QPCOMM_PRICE.'% )</small></h4>
                                                                    <p><small>(Including Tax (18%))</small></p>
                                                                </td>
                                                                <td style="padding: 5px 10px; text-align: right;">
                                                                    ₹ '.number_format($retroCommPrice, 2).' + <br/> ₹ '.number_format($commTax, 2).'
                                                                    
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="padding: 0 0 10px 0; border-bottom: 1px solid #00000033;" colspan="2">
                                                                    
                                                                    <table border="1" style="width:100%; border-collapse: collapse; border-color: gainsboro;">
                                                                    
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TAC including Tax</td>
                                                                            <td style="padding: 5px 10px; text-align: right;">₹ '.number_format($retroCommPrice + $commTax, 2).'</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TCS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; text-align: right;">₹ '.number_format($tcsPrice, 2).'</td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td style="padding:5px 10px">TDS (1% on Sell Rate)</td>
                                                                            <td style="padding: 5px 10px; border-bottom: 1px solid #00000033; text-align: right;">₹ '.number_format($tdsPrice, 2).'</td>
                                                                        </tr>
                                                                    
                                                                    
                                                                    </table>
                                                                    
                                                                </td>
                                                                
                                                            </tr>
                                                            
                                                            
                                                            '.$displayPayment.'
                                                            
                                                            
                                    
                                                        </table>
                                                        
                                                    </td>
                                                    
                                                </tr>
                                            </table>
            
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <br/>
                    
                </body>
            </html>
    
    
    ';
    
    
    }
    
    
    
    
    return $html;
}


// function calculateTotalPrice($rid='',$rdid='',$adult='',$child='',$noroom='',$nonight='',$roomPrice='',$couponCode=''){
//     $couponPrice = 0;
//     if($rid == ''){
//         $noOfnight = 1;
//         if(isset($_SESSION['room'])){  
//             // $loopGst = array();
//             // $loopRoom = array();
//             foreach($_SESSION['room'] as $key=>$val){
//                 $room_detail_id = explode('-',$key)[0];
                
//                 $room_id = $_SESSION['room'][$key]['roomId'];
//                 $noAdult = $_SESSION['room'][$key]['adult'];
//                 $noChild = $_SESSION['room'][$key]['child'];
//                 $noOfRoom = $_SESSION['room'][$key]['room'];
                
//                 $singleExtraAdult = getAdultPriceByNoAdult($noAdult,$room_id,$room_detail_id);
//                 $singleExtraChild = getChildPriceByNoChild($noChild,$room_id,$room_detail_id);

//                 $singleRoom = 0;
//                 $singleRoomPrice = 0;
//                 if(isset($_SESSION['couponCode'])){
//                     $couponPrice = couponActualPrice($_SESSION['couponCode'],$singleRoom);
//                     $singleRoom = $singleRoom - $couponPrice;
//                 }

//                 $gstper = getGSTPercentage($singleRoom);
//                 $roomPrice = $noOfnight * ( $noOfRoom * $singleRoom ); 

//                 // $loopRoom += [$key => $singleRoom];
//                 // $loopGst += [$key => $key];
                
//             }
            
//         }

//     }else{
//         $noOfnight = $nonight;
    
//         $room_id = $rid;
//         $room_detail_id = $rdid; 
//         $noOfRoom = $noroom;

//         $singleExtraAdult = $adult;
//         $singleExtraChild = $child;
//         $singleRoom = $roomPrice;  
//         if($couponCode != "") {
//             $couponPrice = couponActualPrice($couponCode,$singleRoom);
//             $singleRoom = $roomPrice - $couponPrice;
//         }
      
        
//         $gstper = getGSTPercentage($singleRoom);
//         $roomPrice = $noOfnight * ( $noOfRoom * $singleRoom ); 
        
//     }
    
    
    

    
//     $extroAdult = $noOfnight * ( $noOfRoom *  $singleExtraAdult);
    
//     $extroChild = $noOfnight * ( $noOfRoom * $singleExtraChild );
    
//     if(isset($_SESSION['pickUp'])){
//         $price += $_SESSION['pickUp'];
//     }

//     if($noOfnight > 1){
//         $toalNight = ' * '. $noOfnight;
//     }else{
//         $toalNight = '';
//     }
//     $totalNoRoom = '';

//     if($noOfRoom > 1){
//         $totalNoRoom = ' * '. $noOfRoom;
//     }

//     if($singleExtraAdult == 0){
//         $printsingleExtraAdult = 0;
//     }else{
//         $printsingleExtraAdult = $singleExtraAdult.$totalNoRoom;
//     }
//     if($singleExtraChild == 0){
//         $printsingleExtraChild = 0;
//     }else{
//         $printsingleExtraChild = $singleExtraChild.$totalNoRoom;
//     }    
    
    
//     $singletotalprice = $singleRoom + $singleExtraAdult + $singleExtraChild;
//     $tprice = $roomPrice + $extroAdult + $extroChild;
   
   
    
//     $gst = $tprice * $gstper / 100;
    
//     $totalPrice = $tprice + $gst ;
    
//     $_SESSION['roomTotalPrice'] = $totalPrice;
    
    
    
//     $data = array();
    
//     $data[]= [
//         'gst' => $gst,
//         'room' => 100,
//         'child' => $printsingleExtraChild,
//         'night' => $singletotalprice.$toalNight,
//         'adult' => $printsingleExtraAdult,
//         'gstPer' => $gstper,
//         'couponPrice' => $couponPrice,
//         'total' => $totalPrice
//         ];
    
//     return $data;
// }

function SingleRoomPriceCalculator($rid, $rdid, $adult, $child , $nRoom='', $nNight, $roomPrice ='', $childPrice = '', $adultPrice='', $couponCode =''){
    global $conDB;

    $singleRoom = $roomPrice;
    $couponPrice = '';
    if($couponCode != ''){
        $couponPrice = couponActualPrice($couponCode,$roomPrice);
        $roomPrice = $roomPrice - $couponPrice;
    }
    
    $nightPrice = $roomPrice + $adultPrice + $childPrice;

    $totalRoomPrice = ($nightPrice  * $nNight) ;

    $gstper = getGSTPercentage($roomPrice);
    
    $gst = ($totalRoomPrice * $gstper) / 100;
    if($gstper == 0){
        $gst = 0;
    }

    $totalPrice = $totalRoomPrice + $gst;
    $nightPriceHtml = $nightPrice;
    if($nNight > 1){
        $nightPriceHtml = $nightPrice.' * '.$nNight;
    }


    $data = array();
    
    $data[]= [
        'room' => $singleRoom,
        'adultPrint' => $adult,
        'childPrint' => $child,
        'adult' => $adultPrice,
        'child' => $childPrice,
        'noNight' => $nNight,
        'night' => $nightPrice,
        'nightPrice' => $nightPriceHtml,
        'couponCode' => $couponCode,
        'couponPrice' => $couponPrice,
        'gstPer' => $gstper,
        'gst' => $gst,
        'total' => $totalPrice
        ];
    
    return $data;
}

function totalSessionPrice(){
    $price = 0;
    foreach($_SESSION['room'] as $key=>$val){
        $rdid = explode('-',$key)[0];
        
        $total_price = 0;
        $rid = $_SESSION['room'][$key]['roomId'];
        $child = $_SESSION['room'][$key]['child'];
        $adult = $_SESSION['room'][$key]['adult'];
        $checkInTime = $_SESSION['room'][$key]['checkIn'];
        $checkInOut = $_SESSION['room'][$key]['checkout'];
        $noAdult = $_SESSION['room'][$key]['adult'];
        $noRoom = $_SESSION['room'][$key]['room'];
        $night = $_SESSION['room'][$key]['night'];

        $percentage = settingValue()['PartialPaymentPrice'];

        if(roomExist($rid,$checkInTime) == 0){
            $obj->removeroom($key);
        }

        $roomPrice = getRoomPriceById($rid,$rdid, $adult, $checkInTime);
        $adultPrice = getAdultPriceByNoAdult($adult,$rid,$rdid, $checkInTime);
        $childPrice = getChildPriceByNoChild($child,$rid,$rdid, $checkInTime);
        

        if(isset($_SESSION['couponCode'])){
            $couponCode = $_SESSION['couponCode'];
        }else{
            $couponCode = '';
        }
        
        $nNight = getNightByTwoDates($checkInTime,$checkInOut);
        $singleRoomPriceCalculator = SingleRoomPriceCalculator($rid, $rdid, $adult, $child , $noRoom, $night, $roomPrice, $childPrice , $adultPrice, $couponCode);

        $price += $singleRoomPriceCalculator[0]['total'];
        $gst[$key]=$singleRoomPriceCalculator[0]['gst'];
        $nightPrint[$key]=$singleRoomPriceCalculator[0]['nightPrice'];
        $noNight[$key]=$singleRoomPriceCalculator[0]['noNight'];
        $shortDate[$key]=getDateFormatByTwoDate($_SESSION['room'][$key]['checkIn'],$_SESSION['room'][$key]['checkout']);
        $total[$key]=$singleRoomPriceCalculator[0]['total'];
    }


    $_SESSION['gossCharge'] = $price;
    $_SESSION['roomTotalPrice'] = $price;

    if(isset($_SESSION['pickUp']) && $_SESSION['pickUp'] != ''){
        $pickup = $_SESSION['pickUp'];
        $price += $pickup;
        $_SESSION['roomTotalPrice'] = $price;
    }
    
    if(isset($_SESSION['partial']) && $_SESSION['partial'] == 'Yes'){
        $percentage = settingValue()['PartialPaymentPrice']; 
        $price = $price * $percentage / 100;
        $_SESSION['roomTotalPrice'] = $price;
    }

    $data=[
        'gst'=>$gst,
        'night'=>$nightPrint,
        'price'=>$price,
        'noNight'=>$noNight,
        'shortDateUpdate'=>$shortDate,
        'total'=>$total,
    ];

    
    
    return $data;
}

function inventoryCheck($date, $rid='', $rdid=''){
    global $conDB;
    $data = 1;
    $rdidStatus = '';
    if($rdid !=''){
        $rdidStatus = " and room_detail_id = '$rdid' ";
    }
    $sql = mysqli_query($conDB, "select status from inventory where add_date = '$date' and room_id = '$rid' $rdidStatus");
    if(mysqli_num_rows($sql)>0){
        $row = mysqli_fetch_assoc($sql);
        $data = $row['status'];
    }
    
    return $data;
}

function inventoryRoomUpdate($updateId, $room, $date,$status){
    global $conDB;
    $oneDay = strtotime('1 day 30 second', 0);
    $nxtDate = date('Y-m-d',strtotime($date) + $oneDay);
    $countTotalBooking = countTotalBooking($updateId, $date, $nxtDate);

    if($countTotalBooking > 0){
        $Bookroom = $countTotalBooking + $room;
        
    }else{
        $Bookroom = $room;
    }

    foreach (getRatePlanArrById($updateId) as $roomDetail) {
        $rdid = $roomDetail['id'];
        foreach(buildRatePlanView($updateId) as $roomList){

            $roomId = $roomList['id'];
            $rdid = $roomList['rdid'];
            
            $reExistQuery = mysqli_query($conDB, "select * from inventory where room_id='$roomId' and room_detail_id='$rdid' and add_date = '$date' ");
            if(mysqli_num_rows($reExistQuery) > 0){
                mysqli_query($conDB, "update inventory set room='$Bookroom',status='$status' where room_id='$updateId' and room_detail_id='$rdid' and add_date = '$date' ");
            }else{
                mysqli_query($conDB, "insert into inventory(room_id,room_detail_id,add_date,room,status) values('$roomId','$rdid','$date','$Bookroom','$status')");
            }

        }

    }

}

function inventoryRateUpdate($updateId, $updateDId, $price='',$price2='',$date, $child,$adult){
    global $conDB;
    $oneDay = strtotime('1 day 30 second', 0);

    if($price != ''){
        $priceUpade = "price='$price'";
    }

    if($price2 != ''){
        $priceUpade = "price2='$price2'";
    }
  
    $existQuery = mysqli_query($conDB, "select * from inventory where  room_id='$updateId' and room_detail_id='$updateDId'  and add_date = '$date'");
        if(mysqli_num_rows($existQuery) > 0){
            $sql= "update inventory set $priceUpade, eAdult='$adult', eChild='$child' where  room_id='$updateId' and room_detail_id='$updateDId' and add_date = '$date'";
            mysqli_query($conDB,$sql);
        }else{
            $sql= "insert into inventory(room_id,room_detail_id,add_date,price,price2,eAdult,eChild) values('$updateId','$updateDId','$date','$price','$price2','$adult','$child')";
            mysqli_query($conDB,$sql);
        }
    
    

}

function buildRatePlanView($rid){
    global $conDB;
    $sql = "SELECT room.*,room_detail.id as roomDetailID,room_detail.room_id FROM room, room_detail where room_detail.room_id = '$rid' and room.id = room_detail.room_id";
    $query = mysqli_query($conDB, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $data[]=[
                'id'=>$row['id'],
                'pId'=>$row['pId'],
                'adult'=>$row['noAdult'],
                'rdid'=>$row['roomDetailID'],
            ];
        }
    }

    return $data;
}

function buildSGLView($rid,$rdid){
    global $conDB;
    $sql = "select room.*,room_detail.*, room_detail.id as roomDetailID from room,room_detail where room.id = '$rid'  and room_detail.room_id = room.id and room_detail.id='$rdid'";
    $query = mysqli_query($conDB, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $data[]=[
                'id'=>$row['id'],
                'singlePrice'=>$row['singlePrice'],
                'doublePrice'=>$row['doublePrice'],
            ];
        }
    }

    return $data;
}

function checkRoomParent($rid){
    global $conDB;
    $sql = "SELECT room.*,room_detail.id as roomDetailID,room_detail.room_id FROM `room` LEFT JOIN room_detail ON room.id=room_detail.room_id where room.id = '$rid' or room.pId = '$rid' and room.status = '1' GROUP by room_detail.room_id";
    $query = mysqli_query($conDB, $sql);
    $count = mysqli_num_rows($query);
    $data = array();
    if($count > 0){
        if($count == 1){
            $row = mysqli_fetch_assoc($query);
            $data[]=[
                'id'=> $row['id'],
                'adult'=> $row['noAdult'],
                'child'=> $row['noChild'],
                'pid'=> $row['pId'],
                'rdid'=> $row['roomDetailID'],
            ];
        }else{
            while($row = mysqli_fetch_assoc($query)){
                $data[]=[ 
                    'id'=> $row['id'],
                    'adult'=> $row['noAdult'],
                    'child'=> $row['noChild'],
                    'pid'=> $row['pId'],
                    'rdid'=> $row['roomDetailID'],
                ];
            }
        }
    }

    return $data;
}

function getParentIdByAdult($rdid,$adult){
    global $conDB;
    $sql = "select room_detail.*,room.pId,room.noAdult from room,room_detail where room.id=room_detail.room_id and room_detail.id='$rdid' ";
    $query = mysqli_query($conDB, $sql);
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $data = $row['pId'];
    }

    return $data;
}

function getDateFormatByTwoDate($date,$date2){
    $dateString = date('M-d', strtotime($date));
    $date2String = date('M-d', strtotime($date2));

    $dateArr = explode('-',$dateString);
    $date2Arr = explode('-',$date2String);
    $noOfnight = getNightByTwoDates($date,$date2);

    return $dateArr[0].' '.$dateArr[1].' - '. $date2Arr['1'].' / N:- '.$noOfnight;
}


function getSlider($sid=''){
    global $conDB;
    $sidStatus = '';
    if($sid != ''){
        $sidStatus = " where id = '$sid'";
    }
    $sql = mysqli_query($conDB, "select * from herosection $sidStatus");
    $data = array();
    
    if(mysqli_num_rows($sql)>0){
        while($row = mysqli_fetch_assoc($sql)){
            $data[] = [
                    
                    'id'=>$row['id'],
                    'title'=>$row['title'],
                    'subtitle'=>$row['subTitle'],
                    'img'=>$row['img'],
                    'status'=>$row['status']
                ];
        }
    }else{
        $data = array();
    }
    return $data;
}

function unique_id($l = 8){
    $better_token = md5(uniqid(rand(), true));
    $rem = strlen($better_token)-$l;
    $unique_code = substr($better_token, 0, -$rem);
    $uniqueid = $unique_code;
    return $uniqueid;

}

function getBookingDetailById($bid,$checkIn = '',$checkOut = '',$endCheckIn = '',$endCheckOut = ''){
    global $conDB;
    $sql = "select * from bookingdetail where bid = '$bid'";
    
    

    if($endCheckIn != ''){
        $sql .= " and checkIn >= '$checkIn' && checkIn <= '$endCheckIn'";
    }else{
        if($checkIn != ''){
            $sql .= " and checkIn = '$checkIn'";
        }
    }

    if($endCheckOut != ''){
        $sql .= " and checkout >= '$checkOut' && checkout <= '$endCheckOut'";
    }else{
        if($checkOut != ''){
            $sql .= " and checkout = '$checkOut'";
        }
    }
    
    $query = mysqli_query($conDB, $sql);
    $data = array();
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $data[]=$row;
        }
    }
    return $data;
}


function todayCheckIn(){
    global $conDB;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking_type = '1' and booking.id = bookingdetail.bid and bookingdetail.checkIn = '$today' and booking.payment_status = 'complete' GROUP by booking.id");
    return mysqli_num_rows($sql);
}

function wiTodayCheckIn(){
    global $conDB;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking_type = '2' and booking.id = bookingdetail.bid and bookingdetail.checkIn = '$today' and booking.payment_status = 'complete' GROUP by booking.id");
    return mysqli_num_rows($sql);
}

function todayCheckOut(){
    global $conDB;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking_type = '1' and booking.id = bookingdetail.bid and bookingdetail.checkout = '$today' and booking.payment_status = 'complete' GROUP by booking.id");
    return mysqli_num_rows($sql);
}

function wiTodayCheckOut(){
    global $conDB;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking_type = '2' and booking.id = bookingdetail.bid and bookingdetail.checkout = '$today' and booking.payment_status = 'complete' GROUP by booking.id");
    return mysqli_num_rows($sql);
}

function qpTodayCheckIn(){
    global $conDB;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select * from quickpay where checkIn = '$today' and paymentStatus = 'complete'");
    return mysqli_num_rows($sql);
}

function qpTodayCheckOut(){
    global $conDB;
    $current_date = strtotime(date('Y-m-d'));
    $today = date('Y-m-d', $current_date);
    $sql = mysqli_query($conDB, "select * from quickpay where checkOut = '$today' and paymentStatus = 'complete'");
    return mysqli_num_rows($sql);
}

function getPercentageValueByAmount($actualAmout, $totalAmount){
    $data = 0;
    if($actualAmout != 0 && $totalAmount != 0){
        $data = ($actualAmout / $totalAmount) * 100;
    }
    
    return round($data);
}



function getBookingDetailArrByBId($bid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from bookingdetail where bid = '$bid'");
    $bookingsql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from booking where id = '$bid'"));
    $data = array();
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $detail = SingleRoomPriceCalculator($row['roomId'], $row['roomDId'], $row['adult'], $row['child'] , '', $row['night'], $row['roomPrice'], $row['childPrice'], $row['adultPrice'], $bookingsql['couponCode']);
            $data[] = [
                'room'=>getRoomHeaderById($row['roomId']),
                'ratePlan'=>getRatePlanByRoomDetailId($row['roomDId']),
                'noAdult'=>$row['adult'],
                'noChild'=>$row['child'],
                'adultPrice'=>$row['adultPrice'],
                'childPrice'=>$row['childPrice'],
                'checkIn'=>$row['checkIn'],
                'checkout'=>$row['checkout'],
                'gstPer'=>$detail[0]['gstPer'],
                'gst'=>$detail[0]['gst'],
                'roomPrice'=>$detail[0]['room'],
                'totalPrice'=>$detail[0]['total'],
            ];
        }
    }
    return $data;
}

function getBookingDetailByBId($bid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from bookingdetail where bid = '$bid'");
    $bookingsql = mysqli_fetch_assoc(mysqli_query($conDB, "select * from booking where id = '$bid'"));
    $coupon = $bookingsql['couponCode'];
    if($coupon == ''){
        $coupon = '';
    }
    $data = array();
    $sellPrice = 0;
    $couponDis = 0;
    $actualPrice = 0;
    $GstPrice = 0;
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            
            $detail = SingleRoomPriceCalculator($row['roomId'], $row['roomDId'], $row['adult'], $row['child'] , '', $row['night'], $row['roomPrice'], $row['childPrice'], $row['adultPrice'], $coupon);
            $sellPrice += ($detail[0]['room'] + $detail[0]['adult'] + $detail[0]['child'] ) * $detail[0]['noNight'];
            $couponValue = $detail[0]['couponPrice'];
            if($detail[0]['couponPrice'] == ''){
                $couponValue = 0;
            }
            $couponDis += $couponValue * $detail[0]['noNight']; 
            $GstPrice += $detail[0]['gst'];
            
        }
        $data[] = [
            'sellPrice' => $sellPrice,
            'couponDis' => $couponDis,
            'actualPrice' => $sellPrice - $couponDis,
            'GstPrice' => $GstPrice,
        ];
    }
    return $data;
}

function getNightByTwoDates($date1,$date2){
    $earlier = new DateTime($date1);
    $later = new DateTime($date2);

    $abs_diff = $later->diff($earlier)->format("%a");
    return $abs_diff;
}

function getNightCountByDay($date1,$date2){
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%a');
}

function getFacingDetailById($fid){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from facing where id = '$fid'");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $data = $row;
    }

    return $data;
}


function getvisiterCountByDate($data1,$date2){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from counter_table where visiter_date >= '$data1' && visiter_date <= '$date2' ");
    $result = mysqli_num_rows($sql);
    
    return $result;
}

function getCounterData(){
    global $conDB;
    $sql = mysqli_query($conDB, "select * from counter where id= '1'");
    $row = mysqli_fetch_assoc($sql);
    return $row;
}


function getGalleryType(){
    global $conDB;
    $data = array();
    $sql = mysqli_query($conDB, "select * from gallerytype");
    while($row = mysqli_fetch_assoc($sql)){
        $data[]= ['id'=>$row['id'],'name'=>$row['name']];
    }
    return $data;
}

function getGalleryTypeById($tid){
    global $conDB;
    
    $sql = mysqli_query($conDB, "select * from gallerytype where id = '$tid'");
    if(mysqli_num_rows($sql)>0){
        $row = mysqli_fetch_assoc($sql);
        $data = $row['name'];
    }else{
        $data = 'N/A';
    }
    

    return $data;
}


function getHotelService(){
    global $conDB;
    $sql = "select * from hotelservice";
    $query = mysqli_query($conDB, $sql);
    $data = array();
    while($row  = mysqli_fetch_assoc($query)){
        $data[]= $row;
    }

    return $data;
}


$testimonialArr = [
    [
        'img'=> '01.png',
        'name'=> "Upinder Pal Singh",
        'des'=> 'Best Location, Most of the rooms are now renovated. Good courteous staff.',
        'addOn'=>'2022-07-30'
    ],
    [
        'img'=> '02.png',
        'name'=> "Sumit Bhattacharjee",
        'des'=> 'After 2 year I stay here again room is clean but station/ airport pickup was a good service from this property.Food is good service is better then before Wish to stay here again',
        'addOn'=>'2022-04-25'
    ],
    [
        'img'=> '03.png',
        'name'=> "Raj",
        'des'=> 'Nice place to stay in. Breakfast is complimentary & good service.. recommended',
        'addOn'=>'2022-04-30'
    ],

];





function slugGenerate($text)
{ 
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
}


?>