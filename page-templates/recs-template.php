<?php
/*
* Template Name: Recs Template
*/

get_header();

?>

<!-- Obtain Home style -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/recs.css' ?>">

<div class="recs-container">
    <h1 class="recs_overall_title">Recommendations</h1>
    <h4 class="recs_overall_sub_title">Places / Stuff we recommend!</h4>
    <div class="recs-list">
        <div class='post-container'>
            <div class="title">Splatoon Paintball & Airsoft</div>
            <div class="photo">
                <img class="rec-img" src="<?php echo esc_url( get_template_directory_uri() . '/img/rec-logos/splatoon.png' ); ?>" alt="" >
            </div>
            <div class="text">If you like fast paced game modes with outdoor CQB you won't find much better than Splatoon!<br><br>With Container Town and Kill-House you will be having plenty of close range engagements making any RIF's viable to use! <br><br>This also where we currently host our T2 Private Games each month!</div>
            <div class='link-container'>
                <a target="_blank" href='https://www.splatoon.co.uk/' class='link'>Visit them!</a>
            </div>
        </div>
        <div class='post-container'>
            <div class="title">Camo Raids</div>
            <div class="photo">
                <img class="rec-img flip-colour" src="<?php echo esc_url( get_template_directory_uri() . '/img/rec-logos/camo-logo.png' ); ?>" alt="" >
            </div>
            <div class="text"> Indoor CQB Site with lots of twists and turns!<br><br>site is complete with the CamoRaids shop, with a very helpful and knowledgeable team on standby to help with any RIF trouble.<br><br>This Site has some really good engagement rules (which I am all for) to encourage a lot more tactical and skill based plays, rather than mag dumping and prefiring the same angles.</div>
            <div class='link-container'>
                <a target="_blank" href='https://camoraids.com/' class='link'>Visit them!</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>