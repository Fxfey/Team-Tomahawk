<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/master.css' ?>">

    <!-- Title Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">

    <!-- Page Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0790eb3732.js" crossorigin="anonymous"></script>

    <!-- Link JS -->
    <script src="<?php echo get_stylesheet_directory_uri(). '/js/master.js' ?>"></script>

    <title>T2</title>
</head>
<body>
    <div class="header-container">
        <img class="header-img" src="<?php echo esc_url( get_template_directory_uri() . '/img/T2-logo-simple.png' ); ?>" alt="" >
        <h1 class="cinzel"><a class="blank-link" href="/">Team Tomahawk</a></h1>
        <div class="nav-links">
            <a class="nav-item" href="/">Home</a>
            <a class="nav-item" href="/story">Story</a>
            <a class="nav-item" href="/blog">Blog</a>
            <a class="nav-item" href="/recs">Reccomendations</a>
            <a class="nav-join nav-item" href="/join">Want to join?</a>
            <?php
                if ( is_user_logged_in() ) {
                    
                    $user_info = wp_get_current_user();

                    if ($user_info->roles[0] === 'administrator'){

                        echo '<a class="nav-join nav-item" href="/tomahawk-admin">Admin Panel</a>';

                    }

                }
            ?>
        </div>
        <div class="ham-container">
            <svg class="ham hamRotate ham1" viewBox="0 0 100 100" width="80" onclick="toggleHamburger(this);">
                <path class="line top" d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
                <path class="line middle" d="m 30,50 h 40" />
                <path class="line bottom" d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
            </svg>
        </div>
        <div class="ham-links" id="ham-links">
            <a class="ham-item" href="/">Home</a>
            <a class="ham-item" href="/story">Story</a>
            <a class="ham-item" href="/blog">Blog</a>
            <a class="ham-item" href="/recs">Reccomendations</a>
            <a class="ham-join ham-item" href="/join">Want to join?</a>
        </div>
    </div>