<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> style = 'margin:0!important;' class="<?php  ?>"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/builder/lib/jquery.buildermenu_brown.css">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/builder/events.css">
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/builder/lib/modernizr.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div id="pushobj">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Events log</h3>
              </div>
              <div class="panel-body">
                  <div id="eventpanel" class="panel-content">
                      Start using menu on the left...
                  </div>
              </div>
            </div>
        </div>
        <div id="menu">
            <nav>
                <h2><i class="fa fa-reorder"></i>All Categories</h2>
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-laptop"></i>Devices</a>
                        <h2><i class="fa fa-laptop"></i>Devices</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-phone"></i>Mobile Phones</a>
                                <h2><i class="fa fa-phone"></i>Mobile Phones</h2>
                                <ul>
                                    <li>
                                        <a href="#">Super Smart Phone</a>
                                    </li>
                                    <li>
                                        <a href="#">Thin Magic Mobile</a>
                                    </li>
                                    <li>
                                        <a href="#">Performance Crusher</a>
                                    </li>
                                    <li>
                                        <a href="#">Futuristic Experience</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-desktop"></i>Televisions</a>
                                <h2><i class="fa fa-desktop"></i>Televisions</h2>
                                <ul>
                                    <li>
                                        <a href="#">Flat Super Screen</a>
                                    </li>
                                    <li>
                                        <a href="#">Gigantic LED</a>
                                    </li>
                                    <li>
                                        <a href="#">Power Eater</a>
                                    </li>
                                    <li>
                                        <a href="#">3D Experience</a>
                                    </li>
                                    <li>
                                        <a href="#">Classic Comfort</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-camera-retro"></i>Cameras</a>
                                <h2><i class="fa fa-camera-retro"></i>Cameras</h2>
                                <ul>
                                    <li>
                                        <a href="#">Smart Shot</a>
                                    </li>
                                    <li>
                                        <a href="#">Power Shooter</a>
                                    </li>
                                    <li>
                                        <a href="#">Easy Photo Maker</a>
                                    </li>
                                    <li>
                                        <a href="#">Super Pixel</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book"></i>Magazines</a>
                        <h2><i class="fa fa-book"></i>Magazines</h2>
                        <ul>
                            <li>
                                <a href="#">National Geographics</a>
                            </li>
                            <li>
                                <a href="#">The Spectator</a>
                            </li>
                            <li>
                                <a href="#">Rambler</a>
                            </li>
                            <li>
                                <a href="#">Physics World</a>
                            </li>
                            <li>
                                <a href="#">The New Scientist</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-shopping-cart"></i>Store</a>
                        <h2><i class="fa fa-shopping-cart"></i>Store</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-tags"></i>Clothes</a>
                                <h2><i class="fa fa-tags"></i>Clothes</h2>
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa fa-female"></i>Women's Clothing</a>
                                        <h2><i class="fa fa-female"></i>Women's Clothing</h2>
                                        <ul>
                                            <li>
                                                <a href="#">Tops</a>
                                            </li>
                                            <li>
                                                <a href="#">Dresses</a>
                                            </li>
                                            <li>
                                                <a href="#">Trousers</a>
                                            </li>
                                            <li>
                                                <a href="#">Shoes</a>
                                            </li>
                                            <li>
                                                <a href="#">Sale</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-male"></i>Men's Clothing</a>
                                        <h2><i class="fa fa-male"></i>Men's Clothing</h2>
                                        <ul>
                                            <li>
                                                <a href="#">Shirts</a>
                                            </li>
                                            <li>
                                                <a href="#">Trousers</a>
                                            </li>
                                            <li>
                                                <a href="#">Shoes</a>
                                            </li>
                                            <li>
                                                <a href="#">Sale</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Jewelry</a>
                            </li>
                            <li>
                                <a href="#">Music</a>
                            </li>
                            <li>
                                <a href="#">Grocery</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Collections</a>
                    </li>
                    <li>
                        <a href="#">Credits</a>
                    </li>
                </ul>
            </nav>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri();?>/builder/lib/jquery.buildermenu.min.js"></script>
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/builder/events.js"></script>
    </body>
</html>
