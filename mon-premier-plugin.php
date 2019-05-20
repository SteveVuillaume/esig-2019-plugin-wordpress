<?php
/*
Plugin Name: Mon Premier Plugin
 */

//Fonction qui affiche la balise meta
function mon_plugin_meta_keywords() {
    echo '<meta name="keywords" content="HTML,CSS,XML,JavaScript">';
}
//Ajout d'une action sur 'wp_head' qui appellera mon_plugin_meta_keywords()
add_action('wp_head', 'mon_plugin_meta_keywords' );

//Fonction qui envoie par email les infos d'un email supprimé
function mon_plugin_post_delete_mail($post_id) {
    //Récupére les informations de l'article supprimé
    $post = get_post($post_id);
    //Création du sujet de l'email
    $sujet = "Article supprimé :" . $post->post_title;
    //Création du contenu de l'email
    $message = "Contenu de l'article : " . $post->post_content;
    //Envoi de l'email à l'administrateur du site
    wp_mail(get_bloginfo('admin_email'), $sujet, $message);
}
//Ajout d'une action sur 'delete_post' qui appellera mon_plugin_post_delete_mail()
add_action('delete_post', 'mon_plugin_post_delete_mail');

//Fonction qui remplace la chaine 'et' par '&amp;'
function mon_plugin_the_title( $title ) {
    //Remplace 'et' dans le titre
    $title = str_replace( 'et', '&amp;', $title );
    //Retourne le titre modifié
    return $title;
}
//Ajout d'un filtre sur 'the_title' qui appellera mon_plugin_the_title()
add_filter( 'the_title', 'mon_plugin_the_title' );

/**
* Shortcode qui retourne le célèbre "Luke, Je sui ton père !" dans un élément blockquote.
 * Le contenu du shortcode sera utilisé pour remplacer 'Luke'
*
 * Exemples :
 * [vador] => <blockquote>Luke, Je sui ton père !</blockquote>
 * [vador]Serge[/vador] => <blockquote>Serge, Je sui ton père !</blockquote>
 */

function mon_plugin_vador_shortcode($atts, $content = "") {
    // Tag par défaut
    $tag = 'blockquote';

    // Si $tag valide on le récupère
    if(isset($atts['tag']) AND in_array($atts['tag'], ['p','h1','h2','div'])) {
        $tag = $atts['tag'];
    }

    // Si contenu vide
    if (empty( $content )) {
        $content = 'Luke';
    }

    return '<' . $tag . '>' . $content . ', Je suis ton père !' . '';
}

//Fonction de rappel qui retourne la célèbre citation de maître Yoda
function mon_plugin_yoda_shortcode() {
    return "<blockquote>Que la force soit avec toi jeune padawan !</blockquote>";
}



function mon_plugin_ico_shortcode($atts, $content = "") {
    if (empty($content)){
        $content = 'Pas image';
    }
    else{
        $content = '<img style="background-color:red;padding:20px;border-radius:20px" alt="wordpress" src="https://esig-ju.ch/b73/svu/voyages/wp-content/plugins/esig-plugin/ico-plugin/img/wordpress.png">';
    }


    //img = 'https://esig-ju.ch/b73/svu/voyages/wp-content/plugins/ico-plugin/img/wordpress.png';

    return "<p>Test icone ! $content</p>";
}

//Enregistre les shortcodes du plugin
function mon_plugin_register_shortcode() {
    add_shortcode( 'yoda', 'mon_plugin_yoda_shortcode' );
    add_shortcode( 'vador', 'mon_plugin_vador_shortcode' );
    add_shortcode( 'ico', 'mon_plugin_ico_shortcode' );
}
add_action( 'init', 'mon_plugin_register_shortcode' );


