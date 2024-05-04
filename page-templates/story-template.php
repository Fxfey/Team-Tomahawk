<?php
/*
* Template Name: Story Template
*/

get_header();

?>

<!-- Obtain Story style -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/story.css' ?>">

<?php

$obtain_timeline_info = $wpdb->get_results("SELECT * FROM xx_timeline_items");

?>

<div class="story-container">
    <h1 class="story_title">The story of T2</h1>
    <h4 class="story_sub_title">(Team Tomahawk)</h4>
    <div class="intro-container">
        <div class="story-intro">
            <p>
                T2 are a group of Airsofters who were brought together by common interests, mainly Airsoft but also gaming, hobbies and other social aspects. What started as fellow hobbyists running a club turned into a social group of friends from all over the UK. 
                We pride ourselves on having a group of diverse people from different backgrounds, we all bring what is unique about ourselves to Team Tomahawk and that shows with the different play styles our members have. Below you can see our timeline of events:
            </p>
        </div>
    </div>
    <div class="timeline-container">
        <div class="outer">

            <?php

            if(empty($obtain_timeline_info)){

                echo "
                <div class='card'>
                    <div class='info'>
                        <h3 class='title'>Database Error</h3>
                        <p>Sorry, there has been some database connectivity issues, please try again later.</p>
                    </div>
                </div>
                ";

            } else {

                foreach($obtain_timeline_info as $current_timeline_piece){

                    echo "
                    <div class='card'>
                        <div class='info'>
                            <h3 class='title'>$current_timeline_piece->event_title</h3>
                            <p class='card-date'>$current_timeline_piece->date_of_event</p>
                            <p>$current_timeline_piece->event_text</p>
                        </div>
                    </div>
                    ";

                }

            }

            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>