<?php

// Remove Authors Listing Page
function wsm_remove_author_page() 
{
	if ( is_author() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
	}
}
add_action( 'template_redirect', 'wsm_remove_author_page' ); // https://developer.wordpress.org/reference/hooks/template_redirect/

// Rewrite Author URL to use home_url() instead
function wsm_remove_author_pages_link( $content ) 
{
	return home_url();
}
add_filter( 'author_link', 'wsm_remove_author_pages_link' ); // https://developer.wordpress.org/reference/hooks/author_link/

// Remove wp version from meta
remove_action('wp_head', 'wp_generator'); // https://developer.wordpress.org/reference/hooks/wp_head/

// Disable xmlrpc
add_filter('xmlrpc_enabled', '__return_false'); // https://developer.wordpress.org/reference/hooks/xmlrpc_enabled/

// Login error message
function wsm_update_login_text( $error ) 
{
    global $errors;
    $err_codes = $errors->get_error_codes();
 
    // Invalid username.
    // Default: '<strong>ERROR</strong>: Invalid username. <a href="%s">Lost your password</a>?'
    if ( in_array( 'invalid_username', $err_codes ) ) {
        $error = '<strong>ERROR</strong>: Incorrect username/password.';
    }
 
    // Incorrect password.
    // Default: '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s">Lost your password</a>?'
    if ( in_array( 'incorrect_password', $err_codes ) ) {
       $error = '<strong>ERROR</strong>: Incorrect username/password.';
    }
 
    return $error;
};

add_filter( 'login_errors', 'wsm_update_login_text'); // https://developer.wordpress.org/reference/hooks/login_errors/
