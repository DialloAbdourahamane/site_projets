<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h2 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php the_post_thumbnail('thumbnail'); ?>


<?php the_content(__('(more...)', 'northern')); ?>



</article>

<?php endwhile; endif; ?>

<section class="pagenav">
<?php northern_pagenavi() ?>
</section>

<?php comments_template( '', true ); ?>

</section>

<?php get_sidebar(''); ?>

<?php get_footer(); ?>