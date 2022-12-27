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
        <section id="sliderSec">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <?php
                                            

                        foreach(getSlider() as $slideList){
                        
                          
                            $id = $slideList['id'];
                            $title = $slideList['title'];
                            $subtitle = $slideList['subtitle'];
                            $img = FRONT_SITE_HERO_IMG.$slideList['img'];

                            echo '
                              <div class="swiper-slide">
                                <div class="sliderContent">
                                  <div class="imgCon">
                                    <img src="'.$img.'" alt="'.$title.' Image">
                                  </div>
                                </div>
                              </div>
                            ';
                        }
                    
                ?>



                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
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
                        
                      </div>
                      <div class="textArea"></div>
                    </div>
              </div>
            </div>
          </div>
        </section>
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