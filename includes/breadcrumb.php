<?php 
$all_cats = get_the_category();
$post_ID = $all_cats[0]->term_id;
$cat_name = $all_cats[0]->name;
?>

<div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?php echo get_home_url() ?>">
        <?php echo get_bloginfo('name') ?>
      </a>
    </li>
    <li class="breadcrumb-item">
      <a href="<?php echo esc_url(get_category_link($post_ID)) ?>">
        <?php echo esc_html($cat_name); ?>
      </a>
    </li>
    <li class="breadcrumb-item active">
      <?php echo get_the_title(); ?>
    </li>
  </ol>
</div>