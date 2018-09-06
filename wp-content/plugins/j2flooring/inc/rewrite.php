<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function prefix_movie_rewrite_rule() {
    add_rewrite_rule( 'rugbuilder/?$', 'index.php?rugbuilder=yes', 'top' );
}
 
add_action( 'init', 'prefix_movie_rewrite_rule' );
function prefix_register_query_var( $vars ) {
    $vars[] = 'rugbuilder';
    return $vars;
}
 
add_filter( 'query_vars', 'prefix_register_query_var' );

function prefix_url_rewrite_templates() {
    if ( get_query_var( 'rugbuilder' ) ) {
        add_filter( 'template_include', function() {
            return SD_PLUGIN_PATH . '/template/rugbuilder.php';
        });
    }
}
 
add_action( 'template_redirect', 'prefix_url_rewrite_templates' );
?>