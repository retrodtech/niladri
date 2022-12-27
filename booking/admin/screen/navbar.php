<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
        <?php
        
            if(isset($_SESSION['ADMIN_ID']) ){
                echo '
                    <ol id="navTopBar" class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
                    </ol>
                ';
            }

        ?>
        

    </nav>
    <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
        <a href="javascript:;.html" class="nav-link text-body p-0">
        <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
        </div>
        </a>
    </div>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="topNavBar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <ul class="navbar-nav  justify-content-end quickLink">
                <li class="nav-item d-flex align-items-center px-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Booking">
                    <a href="<?php echo FRONT_ADMIN_SITE ?>booking.php" class="nav-link text-body font-weight-bold px-0">
                    <i class="far fa-calendar-check"></i>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center px-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Inventory / Rate">
                    <a href="<?php echo FRONT_ADMIN_SITE ?>inventory.php" class="nav-link text-body font-weight-bold px-0">
                    <i class="far fa-calendar-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav  justify-content-end" >
        <li class="nav-item d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile">
            <a href="profile.php" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none">Profile</span>
            </a>
        </li>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center toggleNav">
            <a href="javascript:;.html" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
            </div>
            </a>
        </li>
        
        <li class="nav-item px-3 d-flex align-items-center settingNav" data-bs-toggle="tooltip" data-bs-placement="left" title="Setting">
            <a href="setting.php" class="nav-link text-body p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
        </li>
        
        <li class="nav-item dropdown pe-2 d-flex align-items-center mr-2" style="margin-right: 5px;" data-bs-toggle="tooltip" data-bs-placement="left" title="Support">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <svg width="17px" height="17px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>customer-support</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-1717.000000, -291.000000)" fill="#344767" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(1.000000, 0.000000)">
                                    <path class="color-background"
                                        d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"
                                        opacity="0.59858631"></path>
                                    <path class="color-foreground"
                                        d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                    </path>
                                    <path class="color-foreground"
                                        d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                    </path>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="tel:8118031833">
                        <div class="d-flex py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Support</span> Bijayadeepa
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                    <i class="fa fa-phone me-1" aria-hidden="true"></i>
                                    8118-031-833
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="tel:7504917992">
                        <div class="d-flex py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <span class="font-weight-bold">Support</span> Sandhya
                                </h6>
                                <p class="text-xs text-secondary mb-0">
                                    <i class="fa fa-phone me-1" aria-hidden="true"></i>
                                    7504-917-992
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                
            </ul>
        </li>

        <li class="nav-item  pe-2 d-flex align-items-center" data-bs-toggle="tooltip" data-bs-placement="left" title="Logout">
            <a href="logout.php" class="nav-link text-body p-0" id="dropdownMenuButton">
            <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
        
        </ul>
    </div>
    </div>
</nav>