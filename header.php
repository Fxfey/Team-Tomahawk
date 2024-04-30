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

    <title>T2</title>
</head>
<body>
    <div class="header-container">
        <img class="header-img" src="<?php echo esc_url( get_template_directory_uri() . '/img/T2-logo-simple.png' ); ?>" alt="" >
        <h1 class="cinzel"><a class="blank-link" href="<?php echo wp_safe_redirect(''); ?>">Team Tomahawk</a></h1>
        <div class="nav-links">
            <a class="nav-item" href="">Home</a>
            <a class="nav-item" href="">Story</a>
            <a class="nav-item" href="">Blog</a>
            <a class="nav-item" href="">Reccomendations</a>
            <a class="nav-join nav-item" href="">Want to join?</a>
        </div>
    </div>
</body>
</html>