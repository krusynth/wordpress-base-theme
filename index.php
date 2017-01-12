<!-- index.php -->
<?php
  // Get the title if this is a category page.
  $archive_category = false;
  $queried_object = get_queried_object();
  if($queried_object) {
    if(get_class($queried_object) == 'WP_Term') {
      $archive_category = $queried_object->name;
    }
  }
?>
<?php get_header(); ?>

<div id="content" class="content">
  <main id="main" class="main" role="main">

    <?php if ( have_posts() ) : ?>

      <header>
        <?php if(get_search_query()) : ?>
          <h1><?php echo sprintf( __( '%s Search Results for ', 'kru' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

        <?php elseif(single_tag_title('', false)) : ?>
          <h1><?php _e( 'Tag Archive: ', 'kru' ); echo single_tag_title('', false); ?></h1>

        <?php elseif($archive_category) : ?>
          <h1><?php print $archive_category ?></h1>

        <?php elseif( is_home() && ! is_front_page() ) : ?>
          <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>

        <?php elseif( is_page() ) : ?>
          <h1><?php the_title() ?></h1>

        <?php else : ?>
          <h1><?php _e( 'Latest Posts', 'kru' ); ?></h1>

        <?php endif ?>
      </header>

      <?php while ( have_posts() ) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('hentry blog-post'); ?>>

          <header>

            <?php if( !is_page() && !is_single() && !is_404() ): ?>
              <!-- post title -->
              <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
              </h2>
              <!-- /post title -->
            <?php endif ?>

            <div class="meta">
              <!--span class="author tip">
                  by <?php
                      if ( function_exists( 'coauthors_posts_links' ) ) {
                          coauthors_posts_links();
                      } else {
                          the_author_posts_link();
                      }
                   ?>
              </span-->

              <?php if(!is_page() && !is_404()): ?>
                <time datetime="<?php the_time('c'); ?> " class="published" pubdate="">
                    <?php the_time('M j, Y g:i a'); ?>
                </time>
              <?php endif ?>
            </div>
          </header>

          <div class="postContent">
            <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="feature-photo">
                <?php the_post_thumbnail('thumbnail'); ?>
              </a>
            <?php endif; ?>

            <?php if( !is_page() && !is_single() && !is_404() ): ?>
              <div class="entry-summary">
                <?php the_excerpt() ?>

                <a class="more" href="<?php the_permalink(); ?>">Continue reading</a>
              </div>
            <?php else: ?>
              <div class="entry">
                <?php the_content() ?>
              </div>
            <?php endif ?>

            <div class="clear">
          </div>

          <footer class="summary-footer clear">

          </footer>

        </article>
        <!-- /article -->

      <?php endwhile ?>
      <?php
        // Previous/next page navigation.
        the_posts_pagination( array(
          'prev_text'          => __( 'Previous page', 'kru' ),
          'next_text'          => __( 'Next page', 'kru' ),
          'before_page_number' => '<span class="meta-nav">' . __( 'Page', 'kru' ) . ' </span>',
        ) );
      ?>
    <?php elseif(is_404): ?>
      <header>
        <h1>Page Not Found</h1>
      </header>

      <article <?php post_class('hentry blog-post'); ?>>
        The page you're looking for isn't here.
      </article>
    <?php else: ?>
      <header>
        <h1>No results.</h1>
      </header>

      <article <?php post_class('hentry blog-post'); ?>>
        No posts were found matching your criteria.
    <?php endif ?>

  </main><!-- .site-main -->

  <?php get_sidebar(); ?>
</div><!-- .content-area -->

<?php get_footer(); ?>
