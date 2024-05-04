<?php
/*
Template Name: Custom Single Post
*/

get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/css/single-post.css' ?>">

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
        endwhile; // End of the loop.
        ?>
        <div class="button-container">
            <a href="/blog" class="return_button">Take me back!</a>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>