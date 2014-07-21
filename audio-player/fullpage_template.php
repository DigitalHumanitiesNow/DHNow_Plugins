<?php
/*
Template Name: FullPage Template
*/
?>

<?php get_header(); ?>

<div id="content">

<?php include (TEMPLATEPATH .'/sidebar-wiki.php'); ?>

<div id="fullpage">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php if ( has_post_thumbnail() ) { ?>
	
	<div class="with-image">
	
		<?php the_post_thumbnail(); ?>
	
		<p><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></p>
	
	</div>
	
	<?php } else { ?>
	
		<h2><?php the_title(); ?></h2>

	<?php } ?>
	
	<?php the_content(__('Read more'));?><div style="clear:both;"></div>
 			
	<!--
	<?php trackback_rdf(); ?>
	-->
	
	<?php endwhile; else: ?>
	
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
	

	
	</div>
	

</div>

<!-- The main column ends  -->

<?php get_footer(); ?>