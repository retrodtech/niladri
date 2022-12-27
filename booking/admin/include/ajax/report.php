<?php
    
    include ('../constant.php');
    include (SERVER_INCLUDE_PATH.'db.php');
    include (SERVER_INCLUDE_PATH.'function.php');

    $dataType = $_POST['dataType'];

    if($dataType == 'get'){
        $from = date('Y-m-d', strtotime($_POST['from']));
        $to = date('Y-m-d', strtotime($_POST['to']));
        $type = $_POST['type'];
        $Booking = $_POST['Booking'];

        $html = '<div id="downloadReport"><i class="fa fa-download" aria-hidden="true"></i></div>';

        if($Booking == 'bookingEngine'){

            $sql = "select booking.*,bookingdetail.checkIn,bookingdetail.checkout from booking,bookingdetail where booking.id = bookingdetail.bid and payment_status='complete'";
            if($type == 'bookingDate'){
                $sql .= " and booking.add_on >= '$from' && booking.add_on <= '$to' " ;
            }
            if($type == 'checkInDate'){
                $sql .= " and bookingdetail.checkIn >= '$from' && bookingdetail.checkIn <= '$to' " ;
            }
            if($type == 'checkOutDate'){
                $sql .= " and bookingdetail.checkout >= '$from' && bookingdetail.checkout <= '$to' " ;
            }

            $sql .= ' GROUP by booking.id';

            $html .= '<table border="1" id="tblCustomers"> 
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
            $query = mysqli_query($conDB, $sql);
            while($row = mysqli_fetch_assoc($query)){
                $sl ++;
                $bid = $row['id'];
                $addDate = strtotime($row['add_on']);

                if($type == 'bookingDate'){
                    $bookingDetail = getBookingDetailById($bid);
                }
                if($type == 'checkInDate'){
                    $bookingDetail = getBookingDetailById($bid,$from,'',$to);
                }
                if($type == 'checkOutDate'){
                    $bookingDetail = getBookingDetailById($bid,'',$from,'',$to);
                }
                // pr($bookingDetail);
                foreach($bookingDetail as $key=>$bookingList){
                    $count = count($bookingDetail);
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

        if($Booking == 'quickPay'){
            $sql = "select * from quickpay where paymentStatus = 'complete'";
            if($type == 'bookingDate'){
                $sql .= " and addOn >= '$from' &&  addOn <= '$to'" ;
            }
            if($type == 'checkInDate'){
                $sql .= " and checkIn >= '$from' &&  checkIn <= '$to'" ;
            }
            if($type == 'checkOutDate'){
                $sql .= " and checkOut >= '$from' &&  checkOut <= '$to'" ;
            }

            $html .= '<table border="1" id="tblCustomers"> 
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
            
            $query = mysqli_query($conDB, $sql);

            while($row = mysqli_fetch_assoc($query)){
     
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

        


        echo $html;
    }

    

?>