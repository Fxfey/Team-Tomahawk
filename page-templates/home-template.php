<?php
/*
* Template Name: Home Template
*/

?>
<?php

get_header();

// Perform DB logic for random quotes

$obtain_quotes = $wpdb->get_results("SELECT * FROM xx_member_quotes");

$random_quote_keys = array_rand($obtain_quotes,3);


?>

<!-- Obtain Home style -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/home.css' ?>">

<div class="home">
    <h2 class="home-title">Team Tomahawk</h2>
    <h3 class="home-sub-title">Airsoft Group from the United Kingdom</h3>
    <div class="home-explainer">
        <img class="home-explainer-img" src="<?php echo esc_url( get_template_directory_uri() . '/img/T2-group.jpg' ); ?>" alt="" >
        <p class="home-explainer-text">Team Tomahawk are a group of Airsofters who have diverse backgrounds and experiences. We often attend regular skirmishes together and have started doing "Recons" to other sites that are a bit further away from where we are used to. We have also started to do "Expeditions" where long distances are travelled to find some of the best Airsoft sites around (but not limited to....) the UK!</p>
    </div>
    <div class="secdonary-container">
        <div class="quote-container">
            <h3 class="quote-title">Some group member quotes:</h3>
            <?php

            foreach($random_quote_keys as $quote_key){

                $current_info = $obtain_quotes[$quote_key];

                echo "
                <div class='quote-box right'>
                    <img class='quote-img' src='".esc_url( get_template_directory_uri() . '/img/quote-logos/'.$current_info->user.'.png')."' alt='' >
                    <div class='quote-text'>
                        <div class='quote-script'>".$current_info->quote."</div>
                        <div class='quote-user'><i>- ".$current_info->user."</i></div>
                    </div>
                </div>
                ";

            }

            ?>

        </div>
        <div class="discord-container">
            <iframe src="https://discord.com/widget?id=1145761190946029578&theme=dark" width="350" height="300" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        </div>
    </div>
</div>

<?php get_footer(); ?>