<?php
/*------------------------------------*\
	Security Functions
\*------------------------------------*/

//Remove Authors
function remove_author_pages_page() {
	if ( is_author() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
	}
}

function remove_author_pages_link( $content ) {
	return home_url();
}

add_action( 'template_redirect', 'remove_author_pages_page' );
add_filter( 'author_link', 'remove_author_pages_link' );

//remove wp version from meta
remove_action('wp_head', 'wp_generator');
//disable xmlrpc
add_filter('xmlrpc_enabled', '__return_false');
//login error message
add_filter( 'login_errors', create_function( '$a', "return 'Incorrect username/password.' ;" ) );
