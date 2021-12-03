<?php 
get_header(); 
$author_id = get_the_author_meta('ID');
?>

<div class="container author-page">
  <h1 class="profile-header text-center"><?php the_author_meta('nickname'); ?> Page</h1>
  
  <div class="author-main-info">
    <div class="row">
      <div class="col-md-3">
        <?php 
          $avatar_ars = array(
            'class' => 'img-responsive img-thumbnail'
          );
          echo get_avatar($author_id, 196, '', 'User Avatar', $avatar_ars); 
        ?>
      </div>
      <div class="col-md-9">
        <ul class="list-unstyled author-names">
          <li><span>First Name:</span> <?php the_author_meta('first_name');?></li>
          <li><span>Last Name:</span> <?php the_author_meta('last_name');?></li>
          <li><span>Nickname:</span> <?php the_author_meta('nickname');?></li>
        </ul>
        <hr>
        <?php if (get_the_author_meta('description')) { ?>
          <p>
            <?php the_author_meta('description');?>
          </p>
        <?php } else { 
          echo '<p>There\'s no biography</p>';
        } ?>
      </div>
    </div> <!-- End row -->
  </div> <!-- End author-main-info -->

  <div class="row author-stats">
    <div class="col-md-3">
      <div class="stats">
        Posts Count
        <span><?php echo count_user_posts( $author_id ) ?></span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stats">
        Comments Count
        <span>
          <?php 
            $comments_count_args = array(
              'user_id' => $author_id,
              'count'   => true
            );
            echo get_comments($comments_count_args);
          ?>
        </span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stats">
        Total Posts View
        <span>0</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stats">
        Testing
        <span>0</span>
      </div>
    </div>
  </div> <!-- End row -->

  <?php 
    $author_posts_per_page = 5;
    $author_posts_args = array(
      'author'          => $author_id,
      'posts_per_page'  => $author_posts_per_page
    );
    $posts_query = new WP_Query($author_posts_args);
  ?>

  <?php if ($posts_query->have_posts()) : // check if there's posts ?>
    <h3 class="text-center author-posts-title">
      <?php
      // check if author posts count >= author posts per page count
      if (count_user_posts($author_id) >= $author_posts_per_page) { ?>
        Latest <?php echo $author_posts_per_page; ?> Posts
      <?php } else ?>
      Latest Posts
    </h3> <!-- End author-posts-title -->
    <?php while ($posts_query->have_posts()) : // loop through posts
      $posts_query->the_post(); // set up the current post ?> 
      <div class="row author-posts">
        <div class="col-sm-3">
          <?php the_post_thumbnail( '', [
            'class' => 'img-fluid img-thumbnail d-block', 
            'title' => get_the_title()
          ]); ?>
        </div>  <!-- End col-sm-3 -->
        <div class="col-sm-9">
          <h3 class="post-title">
            <a href="<?php the_permalink(); ?>">
              <?php the_title()?>
            </a>
          </h3>
          <span class="post-date"><i class="far fa-calendar-alt"></i> <?php the_time('F j, Y'); ?>, </span>
          <span class="post-comments"><i class="far fa-comments"></i> <?php comments_popup_link(); ?></span>
          <div class="post-content"><?php the_excerpt(); ?></div>
        </div> <!-- End col-sm-9 -->
      </div> <!-- End author-posts -->
    <?php endwhile; ?>
  <?php endif; ?> 
  
  <?php wp_reset_postdata(); // restores the $post global to the current post in the main query. ?>

  <?php 
    $comments_per_page = 5;
    $comments_args = array(
      'user_id'     => $author_id,
      'status'      => 'approve',
      'number'      => $comments_per_page,
      'post_status' => 'publish',
      'post_type'   => 'post'
    );
    $comments = get_comments($comments_args);
    $comments_count_args = array(
      'user_id' => $author_id,
      'count'   => true
    );
    if ($comments) : // check if there is any comments ?>
      <h3 class="text-center author-comments-title">
        <?php 
        if (get_comments($comments_count_args) >= $comments_per_page) { ?>
          Latest <?php echo $comments_per_page; ?> Comments
        <?php } else { ?>
          Latest Comments
        <?php } ?>
      </h3> <!-- End author-comments-title -->
        <?php foreach ($comments as $comment) : ?>
          <div class="author-comments">
            <h3 class="post-title">
              <a href="<?php echo get_permalink($comment->comment_post_ID) ?>">
                <?php echo get_the_title($comment->comment_post_ID) ?>
              </a>
            </h3>
            <span class="comment-date">
            <i class="far fa-calendar-alt"></i> Added On <?php echo mysql2date( 'D, F j, Y', $comment->comment_date ); ?>
            </span>
            <div class="comment-content">
              <?php echo $comment->comment_content; ?>
            </div>
          </div> <!-- End author-comments -->
        <?php endforeach; ?>
    <?php 
    else :
      echo 'This author don\'t have any comments';
    endif; ?> 
</div> <!-- End author-page container -->

<div style="margin-bottom:60px"></div>

<?php get_footer(); ?>