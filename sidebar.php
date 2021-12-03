<?php 
// get category comments count
$comments_args = array(
  'status' => 'approve'
);
$comments_count = 0;
$all_comments = get_comments($comments_args); // get all comments
foreach ($all_comments as $comment) {
  $post_id = $comment->comment_post_ID; // get comment post ID
  if (in_category( 'programming', $post_id )) { // check if post not in programming category
    $comments_count++;
  }
}

$cat = get_queried_object();
$posts_count = $cat->count;
?>

<div class="sidebar-programming">
  <div class="widget">
    <h3 class="widget-title"><?php single_tag_title() ?> Statistics</h3>
    <div class="widget-content">
      <ul>
        <li>
          <span>Comments Count</span>: <?php echo $comments_count ?>
        </li>
        <li>
          <span>Articles Count</span>: <?php echo $posts_count ?>
        </li>
      </ul>
    </div>
  </div>
  <div class="widget">
    <h3 class="widget-title">Latest Learning Posts</h3>
    <div class="widget-content">
      <ul>
        <?php
        $posts_args = array(
          'posts_per_page'  => 5,
          'cat'             => 8
        );
        $query = new WP_Query($posts_args);
        if ($query->have_posts()) :
          while ($query->have_posts()) : 
            $query->the_post(); ?>
            <li>
              <a target="_blank" href="<?php the_permalink() ?>">
                <?php the_title(); ?>
              </a>
            </li>
        <?php  endwhile;
        wp_reset_postdata();
        endif; ?>
      </ul>
    </div>
  </div>
  <div class="widget">
    <h3 class="widget-title">Most Active Posts</h3>
    <div class="widget-content">
    <ul>
      <?php
      $hot_posts_args = array(
        'posts_per_page'  => 2,
        'orderby'         => 'comment_count'
      );
      $hot_query = new WP_Query($hot_posts_args);
      if ($hot_query->have_posts()) :
        while ($hot_query->have_posts()) : 
          $hot_query->the_post(); ?>
          <li>
            <a target="_blank" href="<?php the_permalink() ?>">
              <?php the_title(); ?>
            </a>
          </li>
        <?php  endwhile;
        wp_reset_postdata();
        endif; ?>
      </ul>
    </div>
  </div>
</div>