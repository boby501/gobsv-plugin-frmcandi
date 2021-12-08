<?php
/**
* Plugin Name: Plugin Formulario Candi.
* Author: Roberto Montes.
* Description: Formulario personalizado para Candidatos.
* shortcode [gobsv_plugin_frmcandi]
*/

// definicion
add_shortcode('gobsv_plugin_frmcandi','GOBSV_Plugin_frmcandi');

function GOBSV_Plugin_frmcandi()
{
    ob_start();
    ?>
    <form accion="<?php get_the_permalink(); ?>" method="post" class="miclase">
    <div class="wpforms-field-row wpforms-field-medium">
        <div class="wpforms-field-row-block wpforms-first wpforms-one-half">
            <input type="text" id="wpforms-1602-field_1a" class="wpforms-field-name-first wpforms-field-required" name="a" required="">
            <label for="wpforms-1602-field_1a" class="wpforms-field-sublabel after ">Nombre</label>
        </div>
        <div class="wpforms-field-row-block wpforms-one-half">
            <input type="text" id="wpforms-1602-field_1-lasta" class="wpforms-field-name-last wpforms-field-required" name="b" required="">
            <label for="wpforms-1602-field_1-lasta" class="wpforms-field-sublabel after ">Apellidos</label>
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