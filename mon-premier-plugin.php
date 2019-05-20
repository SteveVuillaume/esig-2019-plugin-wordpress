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

//Fonction de rappel qui retourne la célèbre citation de maître Yoda
function mon_plugin_yoda_shortcode() {
    return "<blockquote>Que la force soit avec toi jeune padawan !</blockquote>";
}

//Enregistre les shortcodes du plugin
function mon_plugin_register_shortcode() {
    add_shortcode( 'yoda', 'mon_plugin_yoda_shortcode' );
}
add_action( 'init', 'mon_plugin_register_shortcode' );