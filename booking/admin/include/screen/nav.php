<nav>
    <div class="container">
        <div class="row jcsb">
            <div class="logo">
                    <a style="display: flex;justify-content: center;align-items: center;height: 80px;" class="logo" href="<?php echo FRONT_BOOKING_SITE.'/admin/index.php' ?>" target="blank">
                        <img style="width: 128px;height: auto;max-width: 100%;" src="<?php echo FRONT_SITE_IMG.hotelDetail()['logo'] ?>" alt="">
                    </a>
                </div>
            <?php
            
                if(isset($_SESSION['ADMIN_ID'])){ ?>
                <ul class="nav_menu">
                <li class="active">
                    <a href="<?php echo FRONT_BOOKING_SITE.'/admin/index.php' ?>">Dashboard</a>
                </li>
                <li>
                    <a href="">Room</a>
                    <div class="dropdown">
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/manage-room.php' ?>">Add Room</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/list-room.php' ?>">Manage Room</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/amenities.php' ?>">Amenities</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/coupon_code.php' ?>">Coupon</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/package.php' ?>">Package</a>
                    </div>
                </li>
                <li>
                    <a href="<?php echo FRONT_BOOKING_SITE.'/admin/booking.php' ?>">Bookings</a>
                </li>
                <li>
                    <a href="<?php echo FRONT_BOOKING_SITE.'/admin/inventory.php' ?>">Inventory / Rate</a>
                </li>
                <li>
                    <a href="javascript:void(0)">Pages</a>
                    <div class="dropdown">
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/hero-section.php' ?>">Slider</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/gallery.php' ?>">Gallery</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/offer.php' ?>">Offer</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/blog.php' ?>">blog</a>
                    </div>
                </li>
                
                <li>
                    <a href="">Profile</a>
                    <div class="dropdown">
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/profile.php' ?>">Info</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/term.php' ?>">Term & Con</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/manage-cars.php' ?>">Travel</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/report.php' ?>">Report</a>
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/setting.php' ?>">Setting</a> 
                        <a href="<?php echo FRONT_BOOKING_SITE.'/admin/logout.php' ?>">Logout</a>
                    </div>
                </li>
                    
                </ul>
               <?php }
            
            ?>
        </div>
    </div>
</nav>

