<?php

//Custom Settings
add_action('admin_menu', 'italiawp_add_custom_interface');
function italiawp_add_custom_interface() {
	add_menu_page('Dettagli', 'Dettagli', '0', 'functions', 'italiawp_edit_custom_settings');
}

function italiawp_edit_custom_settings() { ?>
    <div>
        <h2>Informazioni sull'Ente</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options') ?>
            
            <h3>Altro</h3>
            
            <p><strong>Numero ultimi articoli in Home (consigliati multipli di 3):</strong><br />
                <input type="text" name="dettagli-num-articoli" size="10" value="<?php echo get_option('dettagli-num-articoli'); ?>" /></p>
            
            <h3>Informazioni</h3>
            
            <p><strong>Nome amministrazione afferente:</strong><br />
                <input type="text" name="dettagli-nome-ammin-afferente" size="100" value="<?php echo get_option('dettagli-nome-ammin-afferente'); ?>" /></p>
            
            <p><strong>URL amministrazione afferente (con HTTP o HTTPS):</strong><br />
                <input type="text" name="dettagli-url-ammin-afferente" size="100" value="<?php echo get_option('dettagli-url-ammin-afferente'); ?>" /></p>
            
            <h3>ID pagine</h3>
            
            <p><strong>ID pagina Privacy:</strong><br />
                <input type="text" name="dettagli-id-privacy" size="10" value="<?php echo get_option('dettagli-id-privacy'); ?>" /></p>
            
            <p><strong>ID pagina Note legali:</strong><br />
                <input type="text" name="dettagli-id-notelegali" size="10" value="<?php echo get_option('dettagli-id-notelegali'); ?>" /></p>
            
            <p><strong>ID pagina Contatti:</strong><br />
                <input type="text" name="dettagli-id-contatti" size="10" value="<?php echo get_option('dettagli-id-contatti'); ?>" /></p>
            
            <h3>Link "Accedi" in Header</h3>
            
            <p><strong>URL per il bottone "Accedi": (con HTTP o HTTPS)</strong><br />
                <input type="text" name="dettagli-url-accedi" size="100" value="<?php echo get_option('dettagli-url-accedi'); ?>" /></p>
            
            <h3>Contatti</h3>

            <p><strong>Indirizzo:</strong><br />
                <input type="text" name="dettagli-indirizzo" size="100" value="<?php echo get_option('dettagli-indirizzo'); ?>" /></p>

            <p><strong>CAP:</strong><br />
                <input type="text" name="dettagli-cap" size="100" value="<?php echo get_option('dettagli-cap'); ?>" /></p>

            <p><strong>Città:</strong><br />
                <input type="text" name="dettagli-citta" size="100" value="<?php echo get_option('dettagli-citta'); ?>" /></p>
            
            <p><strong>Telefono (senza prefisso nazionale [es. +39] e punteggiatura):</strong><br />
                <input type="text" name="dettagli-telefono" size="100" value="<?php echo get_option('dettagli-telefono'); ?>" /></p>
            
            <p><strong>Fax (senza prefisso nazionale [es. +39] e punteggiatura):</strong><br />
                <input type="text" name="dettagli-fax" size="100" value="<?php echo get_option('dettagli-fax'); ?>" /></p>
            
            <p><strong>Email:</strong><br />
                <input type="text" name="dettagli-email" size="100" value="<?php echo get_option('dettagli-email'); ?>" /></p>
            
            <p><strong>Email 2 (opzionale):</strong><br />
                <input type="text" name="dettagli-email2" size="100" value="<?php echo get_option('dettagli-email2'); ?>" /></p>
            
            <p><strong>PEC:</strong><br />
                <input type="text" name="dettagli-pec" size="100" value="<?php echo get_option('dettagli-pec'); ?>" /></p>
            
            <p><strong>C.F. / P.IVA:</strong><br />
                <input type="text" name="dettagli-cfpiva" size="100" value="<?php echo get_option('dettagli-cfpiva'); ?>" /></p>
            
            <p><strong>Cod. Univoco:</strong><br />
                <input type="text" name="dettagli-codunivoco" size="100" value="<?php echo get_option('dettagli-codunivoco'); ?>" /></p>

            <h3>Link Social</h3>
            
            <p><strong>Facebook (URL intero con HTTP o HTTPS):</strong><br />
                <input type="text" name="dettagli-facebook" size="100" value="<?php echo get_option('dettagli-facebook'); ?>" /></p>
            
            <p><strong>Twitter (URL intero con HTTP o HTTPS):</strong><br />
                <input type="text" name="dettagli-twitter" size="100" value="<?php echo get_option('dettagli-twitter'); ?>" /></p>
            
            <p><strong>YouTube (URL intero con HTTP o HTTPS):</strong><br />
                <input type="text" name="dettagli-youtube" size="100" value="<?php echo get_option('dettagli-youtube'); ?>" /></p>
            
            <p><strong>Instagram (URL intero con HTTP o HTTPS):</strong><br />
                <input type="text" name="dettagli-instagram" size="100" value="<?php echo get_option('dettagli-instagram'); ?>" /></p>
            
            <p><strong>Google Maps iframe SRC (URL intero con HTTP o HTTPS):</strong><br />
                <input type="text" name="dettagli-map" size="100" value="<?php echo get_option('dettagli-map'); ?>" /></p>

            <p><input type="submit" class="button button-primary" name="Submit" value="SALVA" /></p>

            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="dettagli-num-articoli,
                                                            dettagli-nome-ammin-afferente,dettagli-url-ammin-afferente,
                                                            dettagli-id-privacy,dettagli-id-notelegali,dettagli-id-contatti,
                                                            dettagli-indirizzo,dettagli-cap,dettagli-citta,dettagli-telefono,dettagli-fax,
                                                            dettagli-email,dettagli-pec,dettagli-cfpiva,dettagli-facebook,
                                                            dettagli-twitter,dettagli-youtube,dettagli-instagram,dettagli-map,
                                                            dettagli-email2,dettagli-url-accedi,dettagli-codunivoco" />

        </form>
    </div>
<?php }