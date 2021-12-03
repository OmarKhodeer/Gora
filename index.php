<?php get_header(); ?>

<div class="container home-page">
  <div class="row">
    <?php 
    if (have_posts()) : // check if there's posts
      while (have_posts()) : // loop through posts
        the_post(); // set up the current post ?>
        <div class="col-sm-6">
          <div class="main-post">
            <h3 class="post-title">
              <a href="<?php the_permalink(); ?>">
                <?php the_title()?>
              </a>
            </h3>
            <span class="post-author"><i class="fas fa-user"></i> <?php the_author() ?>, </span>
            <span class="post-date"><i class="far fa-calendar-alt"></i> <?php the_time('F j, Y'); ?>, </span>
            <span class="post-comments"><i class="far fa-comments"></i> <?php comments_popup_link(); ?></span>
            <?php the_post_thumbnail( '', [
              'class' => 'img-fluid img-thumbnail d-block', 
              'title' => get_the_title()
              ] ); ?>
            <div class="post-content"><?php the_excerpt(); ?></div>
            <hr>
            <p class="post-categories">
              <i class="fas fa-tags fa-fw"></i>
              <?php the_category(', '); // echo all post categories?>
            </p>
            <p class="post-tags">
              <?php if (has_tag()) { // check if there is any tags exist
                the_tags(); // echo all post tags
              } else {
                echo 'Tags: there\'s no tags.';
              } ?>
            </p>
          </div> <!-- End main-post -->
        </div> <!-- End col-sm-6 -->
      <?php endwhile; ?>
    <?php endif; ?> 
    
  </div> <!-- End row -->
  <div class="pagination-numbers text-center">
    <?php echo gora_numbering_pagination(); ?>
  </div>
</div> <!-- End home-page container -->


<div style="margin-bottom:60px"></div>
<?php get_footer(); ?>