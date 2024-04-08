<?php

function mihdan_debug_wp_mail( $wp_error ) {
    return error_log( print_r( $wp_error, true ) );
}
add_action( 'wp_mail_failed', 'mihdan_debug_wp_mail', 10, 1 ); 

// add_action('wp_mail_failed', function ($error) {
//     wp_die("<pre>".print_r($error, true)."</pre>");
// });