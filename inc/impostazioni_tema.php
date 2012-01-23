<?php
/*
 * Questo file mi permettera' di creare le opzioni necessarie per creare il pannello di impostazioni del tema
 */
add_action('admin_menu', 'pagina_impostazioni_tema_cp');

function pagina_impostazioni_tema_cp(){
	$pagina_impostazioni= add_theme_page( 
		__('Pagina Impostazioni Tema', 'templatezero'), // Nome della Pagina
		__('Impostazioni Tema', 'templatezero'), //Voce menu
		'administrator', //Capacità richiesta
		__FILE__, // Slug della pagina, utilizziamo __FILE__ per dare uno slug unico 
		'impostazioni_tema_cp' // Funzione incaricata di creare il layout della pagina 
	);
	
	$aiuto = '<p>' . __('Qui andremo ad inserire del testo che descriva le nostre opzioni') . '</p>';
	
	add_contextual_help( $pagina_impostazioni, $aiuto );
}

function impostazioni_tema_cp(){
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br /></div>
		<h2>La Pagina Impostazioni per il Mio Tema</h2>
		<p>Un p&ograve; di testo descrittivo per le nostre opzioni.</p>
		<form action="options.php" method="post" enctype="multipart/form-data">
			<?php settings_fields( 'opt_impostazioni_tema' ); ?>
			<?php do_settings_sections( __FILE__ ); ?>
			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Salva Cambiamenti' ); ?>" />
			</p>
		</form>
	</div>
<?php
}

//Registro le nostre impostazioni, la sezione e i suoi campi
function impostazioni_tema_init_cp(){
	register_setting( 'opt_impostazioni_tema', 'opt_impostazioni_tema', 'validazione_impostazioni_tema' );
	add_settings_section( 'main_section', 'Sezione Principale', 'testo_sezione_cp', __FILE__ );
	add_settings_field( 'logo', 'Logo', 'carico_logo_cb', __FILE__, 'main_section' );
}

add_action( 'admin_init', 'impostazioni_tema_init_cp' );

function testo_sezione_cp(){
	echo "<p>Da qui puoi caricare il tuo logo.</p>";
	$options = get_option('opt_impostazioni_tema');
	//echo "<pre>"; print_r( $options ); echo "</pre>";
    echo '<p>Carica qui il tuo file:</p>';
    if ($file = $options['logo']) {
        // var_dump($file);
        echo "<img src='{$file}' />";
    }
}

function carico_logo_cb(){
	echo '<input type="file" name="logo" />';
}

function validazione_impostazioni_tema( $input ){
	//echo "<pre>"; print_r( $_FILES ); echo "</pre>";
	foreach( $_FILES as $image ){
		// Controllo che sia stato effettivamente inviato un file
		if( $image['size'] ){
			if ( preg_match('/(jpg|jpeg|png|gif)$/i', $image['type'] ) ){
				$sovrascrivi = array('test_form' => false );
				$file = wp_handle_upload( $image, $sovrascrivi );
				
				$input['logo'] = $file['url'];
			} else {
				wp_die( 'Nessuna immagine e&grave; stata caricata' );
			}
		} else {
			// Questo codice viene lanciato se non viene caricata nessuna immagine
			$opzioni = get_option('opt_impostazioni_tema');
			$input['logo'] = $opzioni['logo'];
		}
	}
	return $input;
}
