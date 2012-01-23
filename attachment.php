<?php get_header( 'attachment' ); ?>
<div id="main" role="main">
<?php if ( have_posts() ) : ?>
	
	<?php while( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?> >
			<h2><a href="<?php the_permalink()  ; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="meta">
				<p>Pubblicato il <?php the_time('F j, Y'); ?></p>
				<p>Scritto da <?php the_author(); ?></p>
			</div>
			<div class="post-content">
            		<div class="entry-attachment">
					<?php if ( wp_attachment_is_image( $post->ID ) ) : $att_image = wp_get_attachment_image_src( $post->ID, "medium"); ?>
                    		<p class="attachment">
                        		<a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
                        	</p>
					<?php else : ?>
                    		<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
					<?php endif; ?>
                </div>
                
                <div class="entry-caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt() ?></div>
 
				<?php the_content( __( 'Continua a Leggere <span class="meta-nav">&raquo;</span>', 'templatezero' )  ); ?>
				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pagine:', 'templatezero' ) . '&after=</div>') ?>
 
            </div><!-- fine .post-content -->
		</article> 
	<?php endwhile; ?>
	
<?php endif; ?>
</div><!-- fine #main -->

<!-- Richiamo la sidebar -->
<?php get_sidebar( 'single' ); ?>

<!-- Richiamo il footer -->
<?php get_footer( 'single' ); ?>
