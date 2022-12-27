<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');
include (SERVER_INCLUDE_PATH.'add_to_package.php');
$obj = new add_to_package();

$type = $_POST['type'];

if($type == 'priceTag'){

    $pid= $_SESSION['package']['pid'];
    $rid= $_SESSION['package']['rid'];
    $cid= $_SESSION['package']['cid'];
    $adult= $_SESSION['package']['adult'];
    $child= $_SESSION['package']['child'];
    $checkIn= $_SESSION['package']['checkIn'];
    $pickup= $_SESSION['package']['pickup'];
    $rdid= $_SESSION['package']['rdid'];
    if($pickup == 'Yes'){
        $pickup = settingValue()['pckupDropPrice'];
    }else{
        $pickup = 0;
    }

    $duration = getPackageById($pid)['duration'];

    $checkInTime = date('d-M', strtotime($checkIn));
    $checkOutTime = date('d-M', strtotime(getDateByDay($checkIn,$duration)));

    $packageData = getPackageById($pid);
    $dbCarId = $packageData['car'];
    $dbRoomId = $packageData['room'];
    $dbRdidId = $packageData['rdid'];
    $dbDiscount = $packageData['discount'];
    $dbPickup = $packageData['pickup'];
    $pickup = settingValue()['pckupDropPrice'];
    $discount = getPackageById($pid)['discount'];

    $roomPrice = getRoomPriceById($dbRdidId, $checkIn);
    $carPrice = getCarPriceById($cid);
    $adultprice = getAdultPriceByNoAdult($adult,$rid,$rdid);

    $chiltprice = getAdultPriceByNoAdult($child,$rid,$rdid);



    $getPakageDetal= getPackagePriceByAllData($roomPrice,$adultprice,$chiltprice,$carPrice,$pickup,$duration,$discount);

    $totalPrice = ($roomPrice * $duration) + $carPrice + $adultprice + $chiltprice + $pickup;
    $gst = getGSTPrice($totalPrice);
    $gstPercentage = getGSTPercentage($totalPrice);
    $totalwithGst = $getPakageDetal[0]['totalwithGst'];

    $discountPrice = $totalwithGst * $discount / 100;

    $totalGstWithDiscount = $getPakageDetal[0]['totalGstWithDiscount'];

    if($pickup == 0){
        $pickupPrint = '';
    }else{
        $pickupPrint = "<li><span>Pick Up</span> <span>₹ $pickup</span></li>";
    }

    if($adultprice == 0){
        $adultPricePrint = '';
    }else{
        $adultPricePrint = "<li><span>Adult</span> <span>₹ $adultprice</span></li>";
    }

    if($chiltprice == 0){
        $adultPricePrint = '';
    }else{
        $adultPricePrint = "<li><span>Child</span> <span>₹ $chiltprice</span></li>";
    }

    $_SESSION['packageTotalPrice'] = $totalGstWithDiscount;


    $html = "

        <div class='priceBox'>
            <div>
                <span class='subTotal'>₹ $totalwithGst</span>
                <span class='totalPrice'>₹ $totalGstWithDiscount</span>
            </div>

            <span class='discount'>$discount %</span>
        </div>

        <div class='dateBox'>
            <i class='fas fa-calendar'></i>
            <b> $checkInTime to  $checkOutTime </b>
        </div>
        
        </div>

    ";

    echo $html;
}

if($type == 'updateRoom'){
    $id = $_POST['id'];
    $obj->updateRoom($id);
} 

if($type == 'updateCar'){
    $id = $_POST['id'];
    $obj->updateCar($id);
} 

if($type == 'updatePickUp'){
    $price = $_POST['price'];
    $obj->updatePickUp($price);
}

if($type == 'removePickUp'){
    $price = '';
    $obj->updatePickUp($price);
}

if($type == 'loadPrice'){
    // pr($_POST);
    $roomDetailPrint = '';
    $carPrint = '';
    $discountPrint = '';
    $pickupPrint = '';
    $roomPrice = 0;
    $carPrice = 0;
    $discount = 0;
    $pickupPrice = 0;
    $time = 1;

    if(isset($_POST['time'])){
        $time = $_POST['time'];
    }
    if(isset($_POST['rooms'])){
        $roomId = $_POST['rooms'];
    }
    if(isset($_POST['roomDetail']) && $_POST['roomDetail'] != ''){
        $roomDetail = $_POST['roomDetail'];
        $checkIn = date('Y-m-d');
        $roomPrice = getRoomPriceById($roomDetail, $checkIn);
        $roomPricePrint = $roomPrice;
        if($time > 1){
            $roomPricePrint = $roomPrice . ' * ' . $time;
        }
        $roomDetailPrint = "<li>
                                <span>Room Price</span> <span>₹ $roomPricePrint</span>
                            </li>";
    }

    if(isset($_POST['carBox']) && $_POST['carBox'] != ''){
        $car = $_POST['carBox'];
        $carPrice = getCarPriceById($car);
        $carPrint = "<li>
                        <span>Car Price</span> <span>₹ $carPrice</span>
                    </li>";
    }

    if(isset($_POST['pickup']) ){
        $pickupPrice = settingValue()['pckupDropPrice'];
        $pickupPrint = "<li>
                        <span>PickUp Price</span> <span>₹ $pickupPrice</span>
                    </li>";
    }
    $discountPrice = 0;
    if(isset($_POST['discount']) && $_POST['discount'] != ''){
        $discount = $_POST['discount'];
    }

    $getPakageDetal = getPackagePriceByAllData($roomPrice,0,0,$carPrice,$pickupPrice,$time,$discount);


    $totalPrice = $getPakageDetal[0]['totalwithGst'];
    $gst = getGSTPrice($totalPrice);
    $gstPercentage = getGSTPercentage($totalPrice);
    $totalwithGst = $getPakageDetal[0]['totalwithGst'];

    if(isset($_POST['discount']) && $_POST['discount'] != ''){
        $discountPrice = $totalPrice * $discount / 100;
        $discountPrint = "<li>
                                <span>Discount ($discount %)</span> <span> - ₹ $discountPrice</span>
                            </li>";
    }
    
    $totalGstWithDiscount = $getPakageDetal[0]['totalGstWithDiscount'];

    if($totalPrice == 0){
        $html = '';
    }else{
        $html ="
            $roomDetailPrint
            $carPrint
            $pickupPrint
            <li>
            <span>GST ($gstPercentage %)</span> <span>₹ $gst</span>
            </li>
            $discountPrint
            <li>
                <span>Total</span> <span>₹ $totalGstWithDiscount</span>
            </li>
        ";
    }
    

    echo $html;
}

if($type == 'updateRatePlan'){
    $rid = $_POST['rid'];
    $packageId = $_POST['packageId'];
    $html = '';
    foreach(getRatePlanByRoomId($rid) as $list){
        $rdid = $list['id'];
        $name = $list['title'];
        if(checkRatePlanOnPackage($packageId) == $rdid){
            $html .= "<option selected value='$rdid'>$name</option>";
        }else{
            $html .= "<option value='$rdid'>$name</option>";
        }
       
    }

    echo $html;
}


if($type == 'packageSubmit'){

    $name = $_POST['personName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adult = $_SESSION['package']['adult'];
    $child = $_SESSION['package']['child'];
    $checkIn = $_SESSION['package']['checkIn'];
    $pickup = $_SESSION['package']['pickup'];
    $rdid = $_SESSION['package']['rdid'];
    $rid = $_SESSION['package']['rid'];
    $night = $_SESSION['package']['night'];
    $package = $_SESSION['package']['pid'];
    $discount = getPackageById($package)['discount'];
    $nday = getPackageById($package)['duration'];

    $add_on=date('Y-m-d h:i:s');

    $extra_Adult = getAdultPriceByNoAdult($adult,$rid,$rdid);
    $extra_Child = getChildPriceByNoChild($child,$rid,$rdid);

    $checkout = getDateByDay($checkIn,$nday);

    $partial = '';
    $couponCode = '';

    $roomPrice = getRoomPriceById($rdid,$checkIn);

    $price = 100;

    if($pickup == 'Yes'){
        $pickUp =  settingValue()['pckupDropPrice'];
    }else{
        $pickUp = 0;
    }

    $sql = "insert into booking(name,email,phone,company_name,gst,room_id,room_detail_id,no_room,adult,child,night,roomPrice,price,extraAdult,extraChild,payment_status,add_on,checkIn,checkOut,partial,couponCode,pickUp,package,discount) values('$name','$email','$phone','','','$rid','$rdid','1','$adult','$child','$night','$roomPrice','$price','$extra_Adult','$extra_Child','pending','$add_on','$checkIn','$checkout','$partial','$couponCode','$pickUp','$package','$discount')";
        
    if(mysqli_query($conDB, $sql)){
        $_SESSION['OID']=mysqli_insert_id($conDB);
        echo '1';
    }

}

if($type == 'loadPaymentData'){
    $total = $_SESSION['packageTotalPrice'];
    $title = getPackageById($_SESSION['package']['pid'])['name'];
    $desc = "$title Booking";
    
    $html = [
        'price'=> $total,
        'desc'=>$desc
    ];
    echo json_encode($html);
}

if($type == 'updateNight'){
    $night = $_POST['night'];
    $obj->updateNight($night);
}

if($type == 'personInput'){ ?>
    <div class="col-md-6 form-group">
        <label for="adult">Adult</label>
        <select name="adult" id="adult" class="form-control">
        <?php
        
            $AdultCount= getRoomAdultCountById($_SESSION['package']['rid']);
            $maxAdult = roomMaxCapacityById($_SESSION['package']['rid']);

            for($i=1; $i<=$maxAdult; $i++){
                if($i == $noAdult){
                    echo "<option selected value='$i'>$i</option>";
                }else{
                    echo "<option value='$i'>$i</option>";
                }
            }
        
        ?>
        </select>
    </div>
    <div class="col-md-6 form-group">
        <label for="child">Child</label>
        <select name="child" id="child" class="form-control">
            <?php 
            
                $maxChild = roomMaxChildCapacityById($_SESSION['package']['rid']);
                $child = [0,1];
                foreach($child as $list){
                    if($list == $noChild){
                        echo "<option selected value='$list'>$list</option>";
                    }else{
                        echo "<option value='$list'>$list</option>";
                    }
                    
                }
            
            ?>
            
        </select>
    </div>
<?php }


if($type == 'loadDaysActivity'){
    $night = $_SESSION['package']['night'];
    $html = '';
    for ($i=1; $i <= $night ; $i++) { 
       $html .= "<div class='form_group'> 
                    <label for='day$i'>Day $i</label>
                    <textarea name='dayActivity[]' class='form_control' id='day$i'></textarea>
                </div>";
    }

    echo $html;
}

if($type == 'loadPaymentTable'){
    $packageDetail = getPackagePriceBySession()[0];
    $roomPrice = $packageDetail['roomPrice'];
    $night = $packageDetail['night'];
    if($night == 1){
        $roomPricePrint = $roomPrice;
    }else{
        $roomPricePrint = $roomPrice.' * '.$night;
    }
    $pickup = $packageDetail['pickup'];
    $adult = $packageDetail['adult'];
    $child = $packageDetail['child'];
    $car = $packageDetail['car'];
    $price = $packageDetail['totalPrice'];
    $gst = getGSTPrice($price);
    $gstPercentage = getGSTPercentage($price);
    $subtotal = $packageDetail['totalwithGst'];
    $discount = $packageDetail['discount'];
    $totalPrice = $packageDetail['totalGstWithDiscount'];
    $html ="
    <div style='margin-top: 25px;'>
        <h6>Price Backup</h6>
        <table class='table' style='margin-top: 10px;'>
            <tr>
                <td>Room</td>
                <td>$roomPricePrint</td>
                <td>Pickup</td>
                <td>$pickup</td>
            </tr>
            <tr>
                <td>Adult</td>
                <td>$adult</td>
                <td>Child</td>
                <td>$child</td>
            </tr>
            <tr>
                <td>Car</td>
                <td>$car</td>
                <td>Gst($gstPercentage%)</td>
                <td>$gst</td>
            </tr>
            <tr>
                <td>Subtotal</td>
                <td>$subtotal</td>
                <td>Discount</td>
                <td>$discount%</td>
            </tr>
            <tr>
                <td colspan='2'><b>Total</b></td>
                <td colspan='2'><b>$totalPrice</b></td>
            </tr>
        </table>
    </div>
    ";

    echo $html;
}

if($type == 'updateadult'){
    $n = $_POST['adult'];
    $obj->updateAdult($n);
} 

if($type == 'updatechild'){
    $n = $_POST['child'];
    $obj->updateChild($n);
}

if($type == 'updateDate'){
    $n = $_POST['dateLoadPick'];
    $obj->updateDate($n);
}

?>