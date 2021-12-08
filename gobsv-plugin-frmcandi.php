<?php
/**
* Plugin Name: Plugin Formulario Candi.
* Author: Roberto Montes.
* Description: Formulario personalizado para Candidatos.
* shortcode [gobsv_plugin_frmcandi]
*/

register_activation_hook(__FILE__,'gobsv_candi_init');

function gobsv_candi_init()
{
    global $wpdb;
    $table_candi = $wpdb->prefix . 'candidatos';
    $charset_collate =$wpdb->get_charset_collate();
    //Sql para crear tabla
    $query = "CREATE TABLE IF NOT EXISTS $table_candi (
        id int(9) NOT NULL AUTO_INCREMENT,
        nombre varchar(40) NOT NULL,
        apelli varchar(40) NOT NULL,
        correo varchar(50) NOT NULL,
        create_at datetime NOT NULL,
        UNIQUE (id)
    ) $charset_collate";
    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);

}

// definicion del shortcode que muestra el formulario
add_shortcode('gobsv_plugin_frmcandi','GOBSV_Plugin_frmcandi');

/**
 * crea el shortcode
 * @return void
 */

function GOBSV_Plugin_frmcandi()
{
    global $wpdb;
    
    if(!empty($_POST)
        AND $_POST['nombre'] !=''
        AND $_POST['apelli'] !=''
        AND is_email($_POST['correo'])
    )  {
        $table_candi = $wpdb->prefix . 'candidatos';
        $nombre = sanitize_text_field($_POST['nombre']);
        $apelli = sanitize_text_field($_POST['apelli']);
        $correo = sanitize_email($_POST['correo']);
        $create_at  = date('Y-m-d H:i:s');
        $wpdb->insert(
            $table_candi, 
            array(
                'nombre' => $nombre,
                'apelli' => $apelli,
                'correo' => $correo,
                'create_at' => $create_at,
            )
        );
    }

    ob_start();
    ?>
    <form accion="<?php get_the_permalink(); ?>" method="post" class="miclase">
    <div class="wpforms-field-row wpforms-field-medium">
        <div class="wpforms-field-row-block wpforms-first wpforms-one-half">
            <input type="text" id="nombre" class="wpforms-field-name-first wpforms-field-required" name="nombre" required>
            <label for="nombre" class="wpforms-field-sublabel after ">Nombre</label>
        </div>
        <div class="wpforms-field-row-block wpforms-one-half">
            <input type="text" id="apelli" class="wpforms-field-name-last wpforms-field-required" name="apelli" required>
            <label for="apellido" class="wpforms-field-sublabel after ">Apellidos</label>
        </div>
        <div class="wpforms-field-row-block wpforms-one-half">
            <input type="text" id="correo" class="wpforms-field-name-last wpforms-field-required" name="correo" required>
            <label for="correo" class="wpforms-field-sublabel after ">correo</label>
        </div>
        <div class="form-imput">
            <input type="submit" value="Enviar">
        </div>
    </div>
    </form> 
    <?php
    return ob_get_clean();
}
?>