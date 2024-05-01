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
            <h2 class="quote-title">Some group member quotes:</h2>
            <?php

            foreach($random_quote_keys as $quote_key){

                $current_info = $obtain_quotes[$quote_key];

                echo "
                <div class='quote-box'>
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
        <div class="latest_post_container">
            <h2 class="latest_post_title">Our latest blog post:</h2>
            <?php
            // Query the latest post
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $latest_post_query = new WP_Query($args);

            // Check if there are any posts
            if ($latest_post_query->have_posts()) {
                while ($latest_post_query->have_posts()) {
                    $latest_post_query->the_post();

                    echo "<div class=latest_post_box>";
                    // Display the latest post title and content
                    the_title('<h3 class="post_title">', '</h3>');
                    the_content('Continue reading ' . get_the_title(), true);
                    echo "</div>";
                }
            } else {
                // If no posts are found
                echo 'No posts found.';
            }

            // Reset post data
            wp_reset_postdata();
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>