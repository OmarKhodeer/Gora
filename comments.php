<?php
if (comments_open()) { ?>
  <h3 class="comments-count text-center"><?php comments_number(); ?></h3>
  
  <?php 
  echo '<ul class="list-unstyled comments-list">';
  $comments_args = array(
    'max_depth'         => 3,
    'type'              => 'comment',
    'per_page'          => 5,
    'avatar_size'       => '64',
    'reverse_top_level'  => true
    );

  wp_list_comments($comments_args);
  echo '</ul>';
  echo '<hr class="comments-separator">';
  
  $comment_form_args = array(
    'comment_notes_before' => '',
    'class_submit' => 'btn btn-primary btn-md',
    'title_reply_to' => 'Leave a Reply to [%s]'
  );

  comment_form($comment_form_args);
} else {
  echo 'Sorry Comments are disabled for this article';
}?>