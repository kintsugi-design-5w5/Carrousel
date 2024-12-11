<?php
/*
 * Plugin Name: Carrousel
 * Description: Affiche un carrousel d'images contrôlé par des boutons radios
 * Author: Kintsugi
 * Version: 1.0.0
 */

// Enqueue des styles et scripts du carrousel
function eddym_enqueue() {
    // Récupère le timestamp de la dernière modification des fichiers pour gérer la version (cache busting)
    $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/carrousel.js");

    // Ajoute le fichier CSS du carrousel
    wp_enqueue_style('em_plugin_carrousel_css',
        plugin_dir_url(__FILE__) . "style.css",
        array(), // Pas de dépendances
        $version_css); // Version basée sur la dernière modification du fichier CSS
    
    // Ajoute le script JS du carrousel
    wp_enqueue_script('em_plugin_carrousel_js',
        plugin_dir_url(__FILE__) . "js/carrousel.js",
        array(), // Pas de dépendances
        $version_js, // Version basée sur la dernière modification du fichier JS
        true); // Charge le script à la fin du document (avant la fermeture du body)
}

// Action pour ajouter les styles et scripts dans le frontend de WordPress
add_action('wp_enqueue_scripts', 'eddym_enqueue');

/*
 * IMPORTANT : Ajouter les fonctions wp_header() et wp_footer() dans les fichiers de thème.
 * Dans header.php : wp_header() juste avant la balise de fermeture </head>
 * Dans footer.php : wp_footer() juste avant la balise de fermeture </body>
 */

// Fonction pour générer le HTML du carrousel
function genere_html() {
    /////////////////////////////////////// HTML
    // Conteneur principal du carrousel
    $contenu = '
    <div class="carrousel">
        <div class="fond"></div>
        <figure class="carrousel__figure">
            <!-- Boutons pour naviguer dans le carrousel -->
            <div class="bouton-demi avant cliquable" data-icone="west">
                <div class="fleche-mobile"><span class="material-symbols-outlined">west</span></div>
            </div>
            <div class="bouton-demi apres cliquable" data-icone="east">
                <div class="fleche-mobile"><span class="material-symbols-outlined">east</span></div> 
            </div>
            <div class="centreur"></div>

            <!-- Bouton pour fermer le carrousel -->
            <button class="carrousel__x">
                <svg class="burger burgerTourne cliquable active" data-icone="close" viewBox="0 0 100 100" width="80">
                    <path class="ligne top" d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
                    <path class="ligne middle" d="m 70,50 h -40" />
                    <path class="ligne bottom" d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
                </svg>
            </button>
        </figure>
    </div>';
    return $contenu;
}

// Enregistre un shortcode WordPress pour afficher le carrousel
add_shortcode('carrousel', 'genere_html');
