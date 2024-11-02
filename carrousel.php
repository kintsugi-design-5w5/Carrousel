<?php
/*
 * Plugin Name: Carrousel
 * Description: Affiche un carrousel d'images contrôlé par des boutons radios
 * Author: Vincent Genest
 * Author URI: https://github.com/vincent-genest
 * Version: 1.0.0
 */

function eddym_enqueue(){
    
    $version_css = filemtime(plugin_dir_path( __FILE__ ) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/carrousel.js");

    wp_enqueue_style('em_plugin_carrousel_css',
    plugin_dir_url(__FILE__) . "style.css",
    array(),
    $version_css);
    
    wp_enqueue_script('em_plugin_carrousel_js',
    plugin_dir_url(__FILE__) ."js/carrousel.js",
    array(),
    $version_js,
    true); //Permet d'ajouter le script à la fin du document
}

add_action('wp_enqueue_scripts', 'eddym_enqueue');



/* IMPORTANT
Dans header.php
wp_header() juste avant la balise fermeture </head>
Dans footer.php
wp_footer() juste avant la balise fermeture </body>
*/

function genere_html(){
  /////////////////////////////////////// HTML
  // Le conteneur d'une boîte
  
  $contenu = '
  <div class="carrousel">
  <div class="fond"></div>
          <figure class="carrousel__figure"></figure>
          <form class="carrousel__form">
              <div class="conteneur__boutons"></div>
          </form>
          <button class="carrousel__x">
              <svg class="burger burgerTourne cliquable active" data-icone="' . esc_url(get_template_directory_uri()) . '/images/LogoTim.png" viewBox="0 0 100 100" width="80"">
                  <path class="ligne top" d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
                  <path class="ligne middle" d="m 70,50 h -40" />
                  <path class="ligne bottom" d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
              </svg>
          </button>
      </div>';
  return $contenu;
}

add_shortcode('carrousel', 'genere_html');

