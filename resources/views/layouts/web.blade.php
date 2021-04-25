<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7COpen+Sans:700,400%7CRaleway:400,800,900" rel="stylesheet" />
        <link rel="icon" href="<?Php echo env('APP_URL').':8000/'; ?>favicon.ico" type="image/x-icon">
        <link href="<?Php echo env('APP_URL').':8000/'; ?>css/library/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?Php echo env('APP_URL').':8000/'; ?>dev-assets/preloader-default.css" rel="stylesheet" type="text/css" />
        <link href="<?Php echo env('APP_URL').':8000/'; ?>dev-assets/demo-switcher.css" rel="stylesheet" type="text/css" />
        <link href="<?Php echo env('APP_URL').':8000/'; ?>css-min/soccer.min.css" rel="stylesheet" type="text/css" />
        @section('head')
        @show 

        
        <style type="text/css">
            .standing-full td img.own{
                width: 150px;
                height: 150px;
            }
            .carousel-item{
                min-height: 540px;
                background-color: rgba(0,0,0,.5);
            }
            .carousel-item *{
                padding-bottom: 2px;
                font-family: Montserrat,sans-serif;
                color: #fff;
            }
            .main-menu {
                text-align: right;
                
            }
            nav.navbar{
                margin: 0px;
                padding: 0px;

                float: right;
            }
            .main-menu li a span i {
                color: #fff;
            }
            body.body-color{
                background-color: #E6E6E8;
            }
            .main-menu > li > a {
                text-decoration: none;

            }
            .row .col-md-3 a{
                text-decoration: none;
            }
        </style>
        
        <!-- 
        
        Enable one styles which the you want
        
        <link href="css-min/soccer.min.css" rel="stylesheet" type="text/css" />
        <link href="css-min/hockey.min.css" rel="stylesheet" type="text/css" />
        <link href="css-min/basketball.min.css" rel="stylesheet" type="text/css" />
        <link href="css-min/football.min.css" rel="stylesheet" type="text/css" />
        <link href="css-min/baseball.min.css" rel="stylesheet" type="text/css" />
        <link href="css-min/dota.min.css" rel="stylesheet" type="text/css" />
        <link href="css-min/csgo.min.css" rel="stylesheet" type="text/css" />
        
        All libraries included in this css, concating rules in /grunt/cssmin.js
        Use grunt default task for creating this files
        
        -->
    </head>

    <body class="body-color">
        @section('navbar')
        @show        

        @section('body')
        @show

<!--FOOTER BEGIN-->
<footer class="footer">
    <div class="wrapper-overfllow">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="footer-left">
                        <div class="wrap">
                            <a href="index-2.html" class="foot-logo">
                                <img src="<?Php echo env('APP_URL').':8000/'; ?>img/com.png" width="180px">
                            </a>
                            <p>Conoce las herramientas con las que fue elaborado este proyecto. Sin misterios, solo debes saber donde buscar</p>
                            <ul class="foot-left-menu">
                                <li><a href="https://laravel.com/" target="_blank">Laravel</a></li>
                                <li><a href="https://laravelcollective.com/" target="_blank">Laravel Collective</a></li>
                                <li><a href="https://getbootstrap.com/" target="_blank">Bootstraps</a></li>
                                <li><a href="https://www.mysql.com/" target="_blank">MySQL</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-lg-offset-1">
                    <div class="foot-news">
                        <h4>Más ideas</h4>
                        <div class="item">
                            <p class="content-center">
                            <a href="news.html" class="image"><img class="img-responsive" src="<?Php echo env('APP_URL').':8000/'; ?>images/common/github.png" alt="news-image"></a>
                            </p>
                            <a href="https://github.com/eramirez17?tab=repositories" class="name" target="_blank">Conoce las herramientas con las que fue elaborado este proyecto. Sin misterios, solo debes saber dónde buscar</a>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-3 col-md-4 col-sm-12">
                    <div class="foot-contact">
                        <h4>Contacto</h4>
                        <ul class="contact-list">
                            <li><i class="fa fa-flag" aria-hidden="true"></i><span>Puedes contactarme siempre en RRSS o email</span></li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:evelio.ramirezg@gmail.com">evelio.ramirezg@gmail.com</a></li>
                            <li><i class="fa fa-skype" aria-hidden="true"></i><span>evelio.ramirezg@hotmail.com</span></li>
                        </ul>
                        <ul class="socials">
                            <li>
                                <a href="https://www.linkedin.com/in/evelio-ramirez-488b7153/" target="_blank">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>
                            
                            <li>
                                <a href="https://twitter.com/eramirezg17" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.instagram.com/e.ramirez17/" target="_blank">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.facebook.com/eramirezg/" target="_blank">
                                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--FOOTER END-->





<!--scripts-->
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/jquery.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/jquery-ui.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/bootstrap.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/jquery.sticky.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/jquery.jcarousel.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/jcarousel.connected-carousels.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/owl.carousel.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/progressbar.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/jquery.bracket.min.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/chartist.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/Chart.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/fancySelect.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/isotope.pkgd.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/imagesloaded.pkgd.js"></script>

<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/jquery.team-coundown.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/matches-slider.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/header.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/matches_broadcast_listing.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/news-line.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/match_galery.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/main-club-gallery.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/product-slider.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/circle-bar.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/standings.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/shop-price-filter.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/timeseries.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/radar.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/slider.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/preloader.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/diagram.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/bi-polar-diagram.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/label-placement-diagram.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/donut-chart.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/animate-donut.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/advanced-smil.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/svg-path.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/pick-circle.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/horizontal-bar.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/gauge-chart.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/stacked-bar.js"></script>

<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/chartist-plugin-legend.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/chartist-plugin-threshold.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/library/chartist-plugin-pointlabels.js"></script>

<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/treshold.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/visible.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/anchor.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/landing_carousel.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/landing_sport_standings.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/twitterslider.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/champions.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/landing_mainnews_slider.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/carousel.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/video_slider.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/footer_slides.js"></script>
<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/player_test.js"></script>

<script type="text/javascript" src = "<?Php echo env('APP_URL').':8000/'; ?>js/main.js"></script>
<script type="text/javascript" src="<?Php echo env('APP_URL').':8000/'; ?>dev-assets/demo-switcher.js"></script>

    </body>

</html>