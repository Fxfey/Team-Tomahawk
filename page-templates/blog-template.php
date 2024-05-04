<?php
/*
* Template Name: Blog Template
*/

get_header();

?>

<!-- Obtain Home style -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/blog.css' ?>">

<div class="blog-container">
    <h1 class="blog_overall_title">T2 Blog</h1>
    <h4 class="blog_overall_sub_title">All of our stories!</h4>
    <div class="post-list">
        <?php 
        
        $get_all_posts = get_posts();

        if(empty($get_all_posts)){

            echo "
            <div class='post-container'>
                <div class='title'>No Posts</div>
                <div class='date'></div>
                <div class='content'>Sorry, there is currently no posts.<br>Please come back later!</div>
                <div class='link-container'>
                </div>
            </div>
            ";

        } else {

            foreach ($get_all_posts as $current_post){

                echo "
                <div class='wrapper'>
                    <div class='post-container'>
                        <div class='title'>$current_post->post_title</div>
                        <div class='date'>$current_post->post_date</div>
                        <div class='content'>$current_post->post_content</div>
                    </div>
                    <div class='link-container'>
                        <a href='$current_post->guid' class='link'>Read me!</a>
                    </div>
                </div>
                ";

            }

        }

        ?>

    </div>
</div>

<?php get_footer(); ?>