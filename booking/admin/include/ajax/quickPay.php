<?php

    include ('../constant.php');
    include (SERVER_INCLUDE_PATH.'db.php');
    include (SERVER_INCLUDE_PATH.'function.php');
    
    // pr($_POST);
    
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $room = $_POST['room']; 
        $rtp = $_POST['rtp'];
        $qickPayNote = $_POST['qickPayNote'];
        $amount = $_POST['amount'];
        
        $checkInDate = $_POST['checkInDate'];
        $checkOutDate = $_POST['checkOutDate'];
        
        $percentage = 0;
        $roomPrice = 0;
        $roomPrice = getRatePlanDetailById($rtp)[0]['price'];
        
        mysqli_query($conDB, "insert into quickpay(name,phone,email,room,room_id,qickPayNote,amount,paymentStatus,roomPrice,checkIn,checkOut) values('$name','$phone','$email','$room','$rtp','$qickPayNote','$amount','pending','$roomPrice','$checkInDate','$checkOutDate') ");
        $_SESSION['QPOID']=mysqli_insert_id($conDB);
        
        // $orderId = getQPBookingNumberById($_SESSION['QPOID']);

        
        
        $site = SERVER_INCLUDE_PATH;

        include($site."/razorpay-php/Razorpay.php");
        include($site."/config.php");
        use Razorpay\Api\Api;
        
        $api = new Api($keyId, $keySecret);
        $orderData = [
            'receipt'         => 3456,
            'amount'          => $amount * 100,
            'currency'        => 'INR',
            'payment_capture' => 1
        ];
        
        
        
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        $_SESSION['razorpay_order_id'] = $razorpayOrderId;
        $displayAmount = $amount = $orderData['amount'];
        if ($displayCurrency !== 'INR') {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
        }
        
        
        
        $data = [
            "key"               => $keyId,
            "amount"            => $amount,
            "name"              => 'Quick Pay',
            "description"       => '',
            "image"             => "https://jamindars.retrox.in/admin/img/logo.png",
            "prefill"           => [
            "name"              => $name,
            "email"             => $email,
            "contact"           => $phone,
            ],
            "order_id"          => $razorpayOrderId,
        ];

        if ($displayCurrency !== 'INR')
        {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
        }
        
        echo json_encode($data);
        die();


?>