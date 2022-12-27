<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');




$site = SERVER_INCLUDE_PATH;

        include($site."/razorpay-php/Razorpay.php");
        include($site."/config.php");
        use Razorpay\Api\Api;
        $api = new Api($keyId, $keySecret);
        $orderData = [
            'receipt'         => 3456,
            'amount'          => 10 * 100,
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
            "name"              => 'test',
            "description"       => 'test',
            "image"             => "",
            "prefill"           => [
            "name"              => 'test',
            "email"             => 'test@gmail.com',
            "contact"           => '1234567890',
            ],
            "notes"             => [
            "address"           => 'test',
            "merchant_order_id" => "12312321",
            ],
            "theme"             => [
            "color"             => "#F37254"
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