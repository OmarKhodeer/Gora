<?php 
get_header(); 
include_once(get_template_directory() . '/includes/breadcrumb.php');
?>

<div class="container post-page">
  <?php 
  if (have_posts()) : // check if there's posts
    while (have_posts()) : // loop through posts
      the_post(); // set up the current post ?>
      <div class="main-post">
        <?php edit_post_link('Edit <i class="fa fa-edit fa-fw"></i>'); ?>
        <h3 class="post-title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title()?>
          </a>
        </h3>
        <span class="post-date"><i class="far fa-calendar-alt"></i> <?php the_time('F j, Y'); ?>, </span>
        <span class="post-comments"><i class="far fa-comments"></i> <?php comments_popup_link(); ?></span>
        <?php the_post_thumbnail( '', [
          'class' => 'img-fluid img-thumbnail d-block', 
          'title' => get_the_title()
          ] ); ?>
        <div class="post-content"><?php the_content(); ?></div>
        <hr>
        <p class="post-categories">
          <i class="fas fa-tags fa-fw"></i>
          <?php the_category(', '); ?>
        </p>
        <p class="post-tags">
          <?php if (has_tag()) {
            the_tags();
          } else {
            echo 'Tags: there\'s no tags.';
          } ?>
        </p>
      </div> <!-- End main-post -->
    <?php endwhile; ?>
  <?php endif; ?> 
  
  <div class="clearfix"></div>

  <div class="row author-meta">
    <div class="col-md-2">
      <?php 
        $avatar_ars = array(
          'class' => 'img-responsive img-thumbnail'
        );
        echo get_avatar(get_the_author_meta('ID'), 128, '', 'User Avatar', $avatar_ars); 
      ?>
    </div>
    
    <div class="col-md-10 author-info">
      <h4>
        <?php the_author_meta('first_name'); ?>
        <?php the_author_meta('last_name'); ?>
        <span class="nickname">
          ( <?php the_author_meta('nickname'); ?> )
        </span>
      </h4>
      <?php if (get_the_author_meta('description')) { ?>
        <p>
          <?php the_author_meta('description');?>
        </p>
      <?php } else { 
        echo '<p>There\'s no biography</p>';
      } ?>
    </div> <!-- End author-info -->

    <hr>
    
    <div class="author-stats">
      <p>
        <i class="fas fa-tags fa-fw"></i> User posts count: <span class="posts-count"><?php echo count_user_posts(get_the_author_meta('ID')); ?></span> ,
      </p>
      <p>
        <i class="fas fa-user fa-fw"></i> User profile link: <span><?php the_author_posts_link(); ?></span>
      </p>
    </div>
  </div> <!-- End author-meta row -->

  <div class="post-pagination text-center">
    <?php
    if (get_previous_post_link()) { // check if previous post exists
      previous_post_link('%link', '<i class="fa fa-chevron-left"></i> %title'); // provide a link to previous post
    } else {
      echo '<span class="previous-span">Previous Article</span>';
    }

    if (get_next_post_link()) { // check if next post exists
      next_post_link('%link', '%title <i class="fa fa-chevron-right"></i>'); // provide a link to next post
    } else {
      echo '<span class="next-span">Next Article</span>';
    }
    ?>
  </div> <!-- End post-pagination -->

  <div class="clearfix"></div>

  <?php
    /*
    $terms = get_the_terms( $post->ID, 'category' );
    if ($terms) {
      foreach ($terms as $term) {
        $categories_ids[] = $term->term_id;
      }
    }
    var_dump($categories_ids);
    */
    $categories_ids = wp_get_post_categories($post->ID); // retrieve an array of categories id
    $random_posts_per_page = 5;
    $random_posts_args = array(
      'posts_per_page'  => $random_posts_per_page,
      'category__in'    => $categories_ids,
      'post__not_in'     => array($post->ID),
      'post_status'     => 'publish',
      'orderby'         => 'rand'
    );
    $random_posts = new WP_Query($random_posts_args);
  ?>

  <?php if ($random_posts->have_posts()) : // check if there's posts ?>
    <h3 class="text-center random-posts-title">Related Articles</h3>
    <div class="random-posts">
      <?php while ($random_posts->have_posts()) : // loop through posts
        $random_posts->the_post(); // set up the current post ?> 
        <h4 class="post-title">
          <a href="<?php the_permalink(); ?>">
            <?php the_title()?>
          </a>
        </h4>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <p class="no-related-articles">There is no related Articles</p>
  <?php endif; ?> 
  
  <?php wp_reset_postdata(); // restores the $post global to the current post in the main query. ?>
  
  <hr class="comments-separator">

  <?php comments_template(); ?>

</div> <!-- End post-page container -->


<div style="margin-bottom:60px"></div>
<?php get_footer(); ?>