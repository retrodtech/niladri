<?php
 if(isset($_SESSION['ADMIN_ID']) ){ ?>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="<?= FRONT_BOOKING_SITE.'/admin' ?>" target="_blank">
        <img src="<?= FRONT_SITE_IMG.hotelDetail()['favicon'] ?>" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"><?php echo SITE_NAME ?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">

          <a  href="<?php echo FRONT_ADMIN_SITE.'/index.php' ?>" class="nav-link active" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <svg width="12px" height="12px" viewbox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>shop </title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(0.000000, 148.000000)">
                        <path class="color-background"
                          d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                          opacity="0.598981585"></path>
                        <path class="color-background"
                          d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                        </path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">ROOMS</h6>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link roomLink" aria-controls="pagesExamples"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <svg width="12px" height="12px" viewbox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>office</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g id="office" transform="translate(153.000000, 2.000000)">
                        <path class="color-background"
                          d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"
                          opacity="0.6"></path>
                        <path class="color-background"
                          d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                        </path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Rooms</span>
          </a>
          <div class="collapse" id="pagesExamples">
            <ul class="nav ms-4 ps-3">

              <li class="nav-item addRoomLink">
                <a class="nav-link addRoomLink" href="<?php echo FRONT_ADMIN_SITE ?>manage-room.php">
                  <span class="sidenav-mini-icon"> A </span>
                  <span class="sidenav-normal"> Add Room </span>
                </a>
              </li>

              <li class="nav-item manageRoomLink">
                <a class="nav-link manageRoomLink" href="<?php echo FRONT_ADMIN_SITE ?>list-room.php">
                  <span class="sidenav-mini-icon"> M </span>
                  <span class="sidenav-normal"> Manage Room </span>
                </a>
              </li>

              <li class="nav-item amenitiesLink">
                <a class="nav-link amenitiesLink" href="<?php echo FRONT_ADMIN_SITE ?>amenities.php">
                  <span class="sidenav-mini-icon"> A </span>
                  <span class="sidenav-normal"> Amenities </span>
                </a>
              </li>

              <li class="nav-item couponLink">
                <a class="nav-link couponLink" href="<?php echo FRONT_ADMIN_SITE ?>coupon_code.php">
                  <span class="sidenav-mini-icon"> C </span>
                  <span class="sidenav-normal"> Coupon </span>
                </a>
              </li>

              <li class="nav-item packageLink">
                <a class="nav-link packageLink" href="<?php echo FRONT_ADMIN_SITE ?>package.php">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal"> Package </span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        

        <li class="nav-item">

          <a  href="<?php echo FRONT_ADMIN_SITE ?>booking.php" class="nav-link bookingLink" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
            <svg class="fill" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 127.3 123.3" style="enable-background:new 0 0 127.3 123.3;fill:#535981;width:20px" xml:space="preserve">
            <g id="XMLID_64_">
              <path id="XMLID_73_" d="M56.2,89.2c0-20.9,17-37.9,37.9-37.9c7.2,0,13.9,2,19.6,5.5c1.8,1.1,3.4,2.3,5,3.6V32.9
                c0-11.4-9.3-20.6-20.6-20.6h-7.3V6.3c0-1.4-1.1-2.5-2.5-2.5S85.8,5,85.8,6.3v5.9H40.6V6.3c0-1.4-1.1-2.5-2.5-2.5
                c-1.4,0-2.5,1.1-2.5,2.5v5.9h-7.2C17,12.3,7.7,21.5,7.7,32.9v60.7c0,11.4,9.2,20.6,20.6,20.6h37.4c-1.4-1.5-2.6-3.2-3.8-5
                C58.3,103.4,56.2,96.5,56.2,89.2z M32,51.3h28.8c1.4,0,2.5,1.1,2.5,2.5c0,1.4-1.1,2.5-2.5,2.5H32c-1.4,0-2.5-1.1-2.5-2.5
                C29.5,52.4,30.6,51.3,32,51.3z M44.2,79H32c-1.4,0-2.5-1.1-2.5-2.5c0-1.4,1.1-2.5,2.5-2.5h12.3c1.4,0,2.5,1.1,2.5,2.5
                C46.7,77.9,45.6,79,44.2,79z"/>
              <path id="XMLID_90_" style="opacity:0.5" class="st0" d="M118.7,71.5c-1.4-2-3.1-3.8-5-5.4c-5.3-4.5-12.1-7.2-19.6-7.2c-16.7,0-30.3,13.6-30.3,30.3
                c0,7.7,2.9,14.7,7.6,20.1c1.7,1.9,3.6,3.6,5.7,5c4.8,3.3,10.7,5.3,17,5.3c16.7,0,30.3-13.6,30.3-30.3
                C124.5,82.5,122.3,76.4,118.7,71.5z M92,91.6c0-0.1-0.1-0.1-0.1-0.2c0-0.1-0.1-0.2-0.1-0.2c0-0.1,0-0.2-0.1-0.3
                c0-0.1,0-0.1-0.1-0.2c0-0.2-0.1-0.3-0.1-0.5v-12c0-1.4,1.1-2.5,2.5-2.5s2.5,1.1,2.5,2.5v11l5.8,5.8c1,1,1,2.5,0,3.5
                c-0.5,0.5-1.1,0.7-1.8,0.7c-0.6,0-1.3-0.2-1.8-0.7L92.4,92C92.2,91.9,92.1,91.8,92,91.6z"/>
            </g>
          </svg>

            </div>
            <span class="nav-link-text ms-1">Booking</span>
          </a>
        </li>

        <li class="nav-item">

          <a  href="<?php echo FRONT_ADMIN_SITE ?>inventory.php" class="nav-link inventoryLink" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
            <svg class="fill" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;fill:#535981;width:20px" xml:space="preserve">
            <g>
              <path d="M153.7,129.1c-6.8,0-13.3,0-19.8,0c-7.6,0.1-11,3.5-11,11c0,12.3,0,24.7,0,37c0,8.6,0,8.6,5.2,14.6c-1.6,0-2.9,0-4.1,0
                c-29.5,0-59,0-88.5,0c-1.8,0-3.7-0.1-5.4-0.5c-4.2-1-6.8-4.1-7.1-8.5c-0.1-1.2,0-2.3,0-3.5c0-52,0-104,0-156c0-1.3-0.1-2.7,0.1-4
                c0.4-4.6,3.1-7.7,7.7-8.6c1.5-0.3,3-0.3,4.5-0.3c25.5,0,51,0,76.5,0c1.5,0,2.9,0.2,4.8,0.3c0.1,1.9,0.3,3.5,0.3,5.1c0,9,0,18,0,27
                c0,4.6,0.7,5.2,5.2,5.2c10.5,0.1,21,0,31.8,0C153.7,75,153.7,101.7,153.7,129.1z M88.8,60.3c-11.3,0-22.7,0-34,0
                c-1.5,0-3.1-0.2-4.4,0.4c-1,0.4-2.2,1.8-2.2,2.8c0,1,1.2,2.4,2.2,2.8c1.3,0.5,2.9,0.4,4.4,0.4c22.5,0,45,0,67.5,0
                c1.2,0,2.5,0.3,3.4-0.2c1.3-0.7,2.2-2,3.3-3c-1.1-1-2-2.4-3.3-3c-1.1-0.5-2.6-0.2-3.9-0.2C110.8,60.3,99.8,60.3,88.8,60.3z
                M89,97.9c-11.7,0-23.3,0-35,0c-4.6,0-6.3,0.9-6,3.3c0.6,3.7,3.6,2.8,6,2.8c23,0,46,0,69,0c1.2,0,2.6,0.3,3.4-0.2
                c1.1-0.7,2.2-2,2.4-3.1c0.1-0.8-1.3-2.2-2.4-2.6c-1.2-0.5-2.6-0.2-4-0.2C111.3,97.9,100.2,97.9,89,97.9z M88.9,79.1
                c-11.5,0-23,0-34.5,0c-1.3,0-2.9-0.3-3.9,0.3c-1.1,0.6-2.1,2.1-2.3,3.3c-0.1,0.8,1.5,1.9,2.5,2.5c0.8,0.4,2,0.2,3,0.2
                c23.3,0,46.6,0,70,0c0.8,0,1.9,0.2,2.5-0.1c1.1-0.7,2.7-1.8,2.7-2.8c0-1-1.4-2.5-2.5-3c-1.1-0.5-2.6-0.2-3.9-0.2
                C111.2,79.1,100,79.1,88.9,79.1z M69.8,135.3C69.8,135.3,69.8,135.3,69.8,135.3c-6,0-12,0-18,0.1c-2,0-3.7,0.8-3.7,3.1
                c0,2.3,1.7,3,3.7,3.2c0.8,0.1,1.7,0,2.5,0c10.3,0,20.7,0,31,0c1.5,0,3.1,0,4.4-0.6c0.9-0.4,1.8-1.7,1.8-2.6c0-0.9-0.9-2.2-1.8-2.6
                c-1.1-0.6-2.6-0.5-3.9-0.5C80.4,135.3,75.1,135.3,69.8,135.3z M70.3,116.7c-6,0-12,0-18,0c-2.1,0-4.2,0.3-4.2,3
                c0,2.6,2,3.2,4.2,3.2c11.7,0,23.3,0,35,0c2.2,0,4.2-0.6,4.2-3.1c0.1-2.7-2-3.1-4.2-3.1C81.6,116.7,75.9,116.7,70.3,116.7z"/>
              <path d="M141.7,135.3c0,5-0.1,9.3,0,13.5c0.1,4.7,0.6,5.2,5.2,5.2c5,0.1,10,0.1,15,0c3.9-0.1,4.7-0.8,4.8-4.7c0.1-4.5,0-8.9,0-13.1
                c0.8-0.5,1-0.8,1.3-0.8c11-0.9,11.1-0.8,11.1,10.3c0,11.2,0,22.3,0,33.5c0,5.7-0.4,6.1-5.8,6.1c-12.8,0-25.6,0-38.4,0
                c-5.2,0-5.7-0.5-5.7-5.7c0-12.6,0-25.3,0-37.9c0-5.7,0.5-6.2,6.3-6.3C137.2,135.3,139,135.3,141.7,135.3z"/>
              <path d="M123.3,13.7c9.3,9.3,18.4,18.4,27.6,27.6c-9,0-18.1,0-27.6,0C123.3,32,123.3,22.8,123.3,13.7z"/>
              <path d="M160,135.6c0,4.3,0,8.1,0,12.1c-4,0-7.7,0-11.8,0c0-4,0-7.9,0-12.1C152.2,135.6,155.9,135.6,160,135.6z"/>
            </g>
            </svg>
            </div>
            <span class="nav-link-text ms-1">Inventory / Rate</span>
          </a>
        </li>

        
        <li class="nav-item">
          <hr class="horizontal dark">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Website</h6>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#componentsExamples" class="nav-link pageLink" aria-controls="componentsExamples"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <svg width="12px" height="12px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>document</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(154.000000, 300.000000)">
                <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"></path>
                </g>
                </g>
                </g>
                </g>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Pages</span>
          </a>
          <div class="collapse " id="componentsExamples">
            <ul class="nav ms-4 ps-3">
              <li class="nav-item sliderLink">
                <a class="nav-link sliderLink" href="<?php echo FRONT_ADMIN_SITE ?>hero-section.php">
                  <span class="sidenav-mini-icon"> S </span>
                  <span class="sidenav-normal"> Slider </span>
                </a>
              </li>
              <li class="nav-item galleryLink">
                <a class="nav-link galleryLink" href="<?php echo FRONT_ADMIN_SITE ?>gallery.php">
                  <span class="sidenav-mini-icon"> G </span>
                  <span class="sidenav-normal"> Gallery </span>
                </a>
              </li>
              <li class="nav-item offerLink">
                <a class="nav-link offerLink" href="<?php echo FRONT_ADMIN_SITE ?>offer.php" >
                  <span class="sidenav-mini-icon"> O </span>
                  <span class="sidenav-normal"> Offer </span>
                </a>
              </li>
              <li class="nav-item blogLink">
                <a class="nav-link blogLink" href="<?php echo FRONT_ADMIN_SITE ?>blog.php">
                  <span class="sidenav-mini-icon"> B </span>
                  <span class="sidenav-normal"> Blog </span>
                </a>
              </li>
              
              
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#basicExamples" class="nav-link basicLink" aria-controls="basicExamples"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
              <svg width="12px" height="20px" viewbox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>spaceship</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(4.000000, 301.000000)">
                        <path class="color-background"
                          d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                        </path>
                        <path class="color-background"
                          d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                        </path>
                        <path class="color-background"
                          d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z"
                          opacity="0.598539807"></path>
                        <path class="color-background"
                          d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z"
                          opacity="0.598539807"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Basic</span>
          </a>
          <div class="collapse " id="basicExamples">
            
          <ul class="nav ms-4 ps-3">

              <li class="nav-item termLink">
                <a class="nav-link termLink" href="<?php echo FRONT_ADMIN_SITE ?>term.php">
                  <span class="sidenav-mini-icon"> T </span>
                  <span class="sidenav-normal"> Term & Con </span>
                </a>
              </li>

              <li class="nav-item reportLink">
                <a class="nav-link reportLink" href="<?php echo FRONT_ADMIN_SITE ?>report.php">
                  <span class="sidenav-mini-icon"> R </span>
                  <span class="sidenav-normal"> Report </span>
                </a>
              </li>
              
              
              
            </ul>

          </div>
        </li>

      </ul>
    </div>
    
</aside>

<?php } ?>