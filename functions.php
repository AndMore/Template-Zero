<?php
/**
 * Questo file ci permettera' di personalizzare il nostro tema
 */

 //Carico il file esterno per le Impostazioni del tema
 require_once( TEMPLATEPATH . '/inc/impostazioni_tema.php');
 
 // Rendo il tema disponibile alle traduzioni
 // Le traduzioni potranno essere trovate dentro la cartella /languages/
 load_theme_textdomain( 'templatezero', TEMPLATEPATH . '/languages' );
 
 $locale = get_locale();
 $locale_file = TEMPLATEPATH . "/languages/$locale.php";
 if ( is_readable($locale_file) )
     require_once($locale_file);
 
 // Creo il mio primo menu
 if( function_exists( 'register_nav_menu' ) ){
 	register_nav_menu( 'principale', 'Header Menu' );
 }
 
 // Registro le aree per le widget
 function template_zero_widget_area(){
 	register_sidebar( array(
 			'name' => 'Widget Area Principale',
 			'id' => 'widget-area-principale',
 			'description' => __( 'The primary widget area', 'templatezero' ),
 			'before_widget' => '<div id="principale" class="contenitore-widget">',
 			'after_widget' => '</div>',
 			'before_title' => '<h3 class="titolo-widget">',
 			'after_title' => '</h3>',
	)  );
	
	register_sidebar(
 		array(
 			'name' => 'Widget Area Secondaria',
 			'id' => 'widget-area-secondaria',
 			'before_widget' => '<div id="%1$s" class="contenitore-widget %2$s">',
 			'after_widget' => '</div>',
 			'before_title' => '<h3 class="titolo-widget">',
 			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'name' => 'Pagina Singolo Articolo',
 			'id' => 'pagina-singolo-articolo',
 			'before_widget' => '<div id="%1$s" class="contenitore-widget %2$s">',
 			'after_widget' => '</div>',
 			'before_title' => '<h3 class="titolo-widget">',
 			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'name' => 'Footer Singolo Sinistra',
 			'id' => 'footer-singolo-sinistra',
 			'before_widget' => '<div id="%1$s" class="contenitore-widget %2$s">',
 			'after_widget' => '</div>',
 			'before_title' => '<h3 class="titolo-widget">',
 			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'name' => 'Footer Singolo Destra',
 			'id' => 'footer-singolo-destra',
 			'before_widget' => '<div id="%1$s" class="contenitore-widget %2$s">',
 			'after_widget' => '</div>',
 			'before_title' => '<h3 class="titolo-widget">',
 			'after_title' => '</h3>'
		)
	);
 }

 add_action( 'widgets_init', 'template_zero_widget_area');
 
?>