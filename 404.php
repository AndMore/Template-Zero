<?php get_header( ); ?>
<div id="main" role="main">
	<div id="post-0" class="post error404 not-found">
    		<h1 class="entry-title"><?php _e( 'Articolo Mancante', 'templatezero' ); ?></h1>
        <div class="entry-content">
        		<p><?php _e( 'Spiacenti, Ma non siamo stati in grado di trovare quello che state cercando. Magari vi potr&agrave; essere utile eseguire una ricerca.', 'templatezero' ); ?></p>
			<?php get_search_form(); ?>
        </div><!-- .entry-content -->
        
        <div class="lista-articoli">
        		<?php 
        			$posts = query_posts( 'orderby=rand&posts_per_page=3' );
				
				while( have_posts() ) : the_post(); 
			?>
				<article <?php post_class(); ?> >
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php 
				endwhile;
				wp_reset_query(); 
			?>
        </div>
    </div><!-- #post-0 -->
</div><!-- fine #main -->

<?php get_footer( ); ?>
