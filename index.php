<?php

include ('booking/admin/include/constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= SITE_NAME ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php include('screen/head.php') ?>
</head>

<body>

    <?php include('screen/navbar.php') ?>

    <main>

        <section id="hero">
            <div class="hero-container">
                <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade"
                    data-bs-ride="carousel">

                    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                    <div class="carousel-inner" role="listbox">

                        <?php
                                                

                            foreach(getSlider() as $slideList){
                            
                              
                                $id = $slideList['id'];
                                $title = $slideList['title'];
                                $subtitle = $slideList['subtitle'];
                                $img = FRONT_SITE_HERO_IMG.$slideList['img'];
                                $beLink = FRONT_BOOKING_SITE;

                                echo '
                                  <div class="carousel-item active" style="background-image: url('.$img.');">
                                    <div class="carousel-container">
                                        <div class="carousel-content">
                                            <h2 class="animate__animated animate__fadeInDown">'.$title.'</h2>
                                            <p class="animate__animated animate__fadeInUp">'.$subtitle.'</p>
                                            <div>
                                                <a href="'.$beLink.'" class="btn-get-started animate__animated animate__fadeInUp scrollto">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        
                        ?>

                    </div>

                    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                    </a>

                    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                    </a>

                </div>
            </div>
        </section>


        <section id="bestFeatureSec">
            <div class="container">
                <div class="title center">
                    <h2>A Few Words</h2>
                </div>

                <div class="row">

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featureContent">
                            <div class="icon">
                                <img src="<?= FRONT_SITE_IMG ?>/service/award.gif" alt="">
                            </div>
                            <div class="textArea">
                                <h4>Luxury</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featureContent">
                            <div class="icon">
                                <img src="<?= FRONT_SITE_IMG ?>/service/star.gif" alt="">
                            </div>
                            <div class="textArea">
                                <h4>Great Services</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featureContent">
                            <div class="icon">
                                <img src="<?= FRONT_SITE_IMG ?>/service/mouse.gif" alt="">
                            </div>
                            <div class="textArea">
                                <h4>Online Reservation</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="about" class="about">
            <div class="container">

                <div class="row no-gutters">
                    <div class="col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start">
                        <img src="assets/img/aboutPic.jpg" alt="Niladri about image"> </div>
                    <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
                        <div class="content d-flex flex-column justify-content-center">
                            <div class="title">
                                <small>Welcome To Hotel Niladri Inn</small>
                                <h2>Make yourself feel like home and enjoy your unique experience.</h2>
                            </div>
                            <h6>
                                We take care of your comfort so that you can get luxury service A variety of rooms are
                                available here with all types of modern amenities.
                            </h6>
                            <p>We truly care about you and you’re well-being. Your comfort is of paramount importance to
                                us. Any special meal requirements, besides the in-house menu, can be prepared especially
                                for you during your stay, please let our F&B team know about the same. We would also
                                customize any other special requirements you might have, which would make your trip all
                                that more comfortable.</p>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="restaurantSec">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="restaurentConttent">
                            <div class="title">
                                <h2>Our Restaurant</h2>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                            <div>
                                <a href="<?= FRONT_BOOKING_SITE ?>" target="_blank" class="btn-get-started">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <img src="assets/img/restaurant.webp" alt="niladri restaurant image">
                    </div>
                </div>
            </div>
        </section>

        <section id="counts" class="counts">
            <div class="container">

                <div class="row no-gutters">

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i><img src="<?= FRONT_SITE_IMG ?>/counter/customers.gif" alt="niladri customer image"></i>
                            <span data-purecounter-start="0" data-purecounter-end="735" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Customers</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i><img src="<?= FRONT_SITE_IMG ?>/counter/celebritie.gif"
                                    alt="niladri celebrities image"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1600" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Celebrities</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i><img src="<?= FRONT_SITE_IMG ?>/counter/return.gif" alt="niladri return image"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1452" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Returns</strong></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i><img src="<?= FRONT_SITE_IMG ?>/counter/happy.gif" alt="niladri happy people image"></i>
                            <span data-purecounter-start="0" data-purecounter-end="4325" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p><strong>Happy people</strong></p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="why-us" class="why-us">
            <div class="container">


                <div class="row">

                    <div class="col-lg-4 mb-4">
                        <div class="box">
                            <span class="whyusIcon"><img src="<?= FRONT_SITE_IMG ?>/service/swimming.gif" alt=""></span>
                            <h4>In house Swimming <br/> Pool</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0 mb-4">
                        <div class="box">
                            <span class="whyusIcon"><img src="<?= FRONT_SITE_IMG ?>/service/breakfast.gif" alt=""></span>
                            <h4>Complimentary Buffet <br/> Breakfast</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0 mb-4">
                        <div class="box">
                            <span class="whyusIcon"><img src="<?= FRONT_SITE_IMG ?>/service/wifi.gif" alt=""></span>
                            <h4>WiFi and broadband <br/> internet</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0 mb-4">
                        <div class="box">
                            <span class="whyusIcon center"><img src="<?= FRONT_SITE_IMG ?>/service/laundry.gif" alt=""></span>
                            <h4>In house Laundry <br/> Facility</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0 mb-4">
                        <div class="box">
                            <span class="whyusIcon"><img src="<?= FRONT_SITE_IMG ?>/service/pick-up.gif" alt=""></span>
                            <h4>Station Pick-up and <br/> Drop</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0 mb-4">
                        <div class="box">
                            <span class="whyusIcon"><img src="<?= FRONT_SITE_IMG ?>/service/mini-bar.gif" alt=""></span>
                            <h4>In-House Mini <br/> Bar</h4>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title">
                    <h2>Interior Gallery</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <?php
                                foreach(getGalleryType() as $galleryTypeList){
                                    $slug = $galleryTypeList['slug'];
                                    $name = $galleryTypeList['name'];
                                    echo '<li data-filter=".'.$slug.'">'.$name.'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container">

                    <?php
                    
                        foreach(getGallery('','',9) as $galleryList){
                            $id = $galleryList['id'];
                            $text = $galleryList['text'];
                            $img = FRONT_SITE_IMG.'gallery/'.$galleryList['img'];
                            $type = getGalleryType($galleryList['type'])[0]['slug'];

                            echo '
                                <div class="col-lg-4 col-md-6 portfolio-item '.$type.'">
                                    <div class="portfolio-wrap">
                                        <img src="'.$img.'" class="img-fluid" alt="'.$text.' image">
                                        <div class="portfolio-info">
                                            <h4>'.$text.'</h4>
                                            
                                            <div class="portfolio-links">
                                                <a href="'.$img.'" data-gallery="portfolioGallery"
                                                    class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    
                    ?>
                    

                </div>

            </div>
        </section>

        <section id="socialSec">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <small>Experience The Luxury.</small>
                            <h2>Social Activity</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="activityBox">
                            <iframe
                                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D100083775603457&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1728412797490592"
                                width="100%" height="500" style="border:none;overflow:hidden" scrolling="no"
                                frameborder="0" allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contactSec">
            <div class="container margin_120_95">
                <div class="row justify-content-between">
                    <div class="col-xl-4">
                        <div data-cue="slideInUp">
                            <div class="title">
                                <small>Experience The Luxury.</small>
                                <h2>Address</h2>
                            </div>
                            <p><?= hotelDetail()['address'] ?></p>
                            <div class="phone_element no_borders"><a href="tel:<?= hotelDetail()['primaryphone'] ?>"><i
                                        class="bi bi-telephone"></i><span><em>Bookings</em><?= hotelDetail()['primaryphone'] ?></span></a>
                            </div>
                            <div class="phone_element no_borders">
                                <a href="mailto:<?= hotelDetail()['email'] ?>">
                                    <i
                                        class="bi bi-envelope"></i><span><em>Questions</em><?= hotelDetail()['email'] ?></span>
                                </a>
                            </div>
                            <div class="phone_element no_borders">
                                <a href="mailto:aryapalace@rediffmail.com">
                                    <i
                                        class="bi bi-envelope"></i><span><em>Questions</em>aryapalace@rediffmail.com</span>
                                </a>
                            </div>
                            <div class="social mt-1">
                                <ul>
                                    <li>
                                        <a href="<?= hotelDetail()['in-link']?>" target="_blank"><i
                                                class="bi bi-instagram"></i></a>
                                        <span></span><span></span><span></span><span></span>
                                    </li>
                                    <li>
                                        <a href="<?= hotelDetail()['fb-link']?>"><i class="bi bi-facebook"
                                                target="_blank"></i></a>
                                        <span></span><span></span><span></span><span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7" id="booking_section">
                        <div class="map_contact">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3711.8856100968683!2d86.8979532154072!3d21.512200076473075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1cf52f11bb18bd%3A0x788d0f4b749c27c4!2sHOTEL%20NILADRI%20INN!5e0!3m2!1sen!2sin!4v1672189693735!5m2!1sen!2sin"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </section>

        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="footer-info">
                                <h3>Groovin</h3>
                                <p>
                                    A108 Adam Street <br>
                                    NY 535022, USA<br><br>
                                    <strong>Phone:</strong> +1 5589 55488 55<br>
                                    <strong>Email:</strong> info@example.com<br>
                                </p>
                                <div class="social-links mt-3">
                                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-6 footer-links">
                            <h4>Useful Links</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Services</h4>
                            <ul>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                                <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-4 col-md-6 footer-newsletter">
                            <h4>Our Newsletter</h4>
                            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                            <form action="" method="post">
                                <input type="email" name="email"><input type="submit" value="Subscribe">
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>Groovin</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/groovin-free-bootstrap-theme/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </footer>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

    </main>



    <?php include('screen/script.php') ?>

    <script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    </script>
</body>

</html>