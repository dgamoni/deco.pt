<?php

function cptuisupport_override_ceventfeature( $args, $tax_slug, $orig_args ) {
    // We only want to affect these for one taxonomy, so return early if its not that one
    if ( 'noticias' !== $tax_slug ) {
        return $args;
    }

    // Add in our capabilities setting
    $args['capabilities'] = [
        'manage_terms' => 'manage_' . $tax_slug,
        'edit_terms'   => 'edit_' . $tax_slug,
        'delete_terms' => 'delete' . $tax_slug,
        'assign_terms' => 'assign_' . $tax_slug,
    ];
    
    return $args;
}
add_action( 'cptui_pre_register_taxonomy', 'cptuisupport_override_ceventfeature', 10, 3 );

function cptuisupport_override_explorars( $args, $tax_slug, $orig_args ) {
    // We only want to affect these for one taxonomy, so return early if its not that one
    if ( 'explorars' !== $tax_slug ) {
        return $args;
    }

    // Add in our capabilities setting
    $args['capabilities'] = [
        'manage_terms' => 'manage_' . $tax_slug,
        'edit_terms'   => 'edit_' . $tax_slug,
        'delete_terms' => 'delete' . $tax_slug,
        'assign_terms' => 'assign_' . $tax_slug,
    ];
    
    return $args;
}
add_action( 'cptui_pre_register_taxonomy', 'cptuisupport_override_explorars', 10, 3 );


function add_noticias_manager_role(){
    add_role(
        'noticias_manager',
        'Noticias Manager',
        array(           
            'read_noticia' => true,
            'edit_noticia' => true,
            'delete_noticia' => true,
            'publish_noticia' => true,
            'read_private_noticia' => true,
            'read_explorar' => true,
            'edit_explorar' => true,
            'delete_explorar' => true,
            'publish_explorar' => true,
            'read_private_explorar' => true,
            'upload_files' => true,
            'manage_categories' => true,
            'manage_noticias' => true,
            'manage_explorars' => true,
        )
    );
}
//add_action( 'admin_init', 'add_noticias_manager_role', 4 );

function add_noticias_role_caps() {
    $roles = array('noticias_manager');
    foreach($roles as $the_role) {
        $role = get_role($the_role); 

        $role->add_cap( 'read_noticia' );
        $role->add_cap( 'read_noticias' );
        $role->add_cap( 'read_private_noticia' );
        $role->add_cap( 'read_private_noticias' );


        $role->add_cap( 'edit_noticia');
        $role->add_cap( 'edit_noticias');
        $role->add_cap( 'edit_private_noticia');
        $role->add_cap( 'edit_private_noticias');
        $role->add_cap( 'edit_published_noticias');
        $role->add_cap( 'edit_noticia_terms');
        $role->add_cap( 'edit_others_noticias');

        $role->add_cap( 'delete_noticia' );
        $role->add_cap( 'publish_noticia' );
        $role->add_cap( 'read_private_noticia' ); // assign_explorar_terms assign_explorars create_explorars delete_explorar_terms delete_explorars delete_private_explorars delete_published_explorars deleteexplorars edit_explorar_terms edit_explorars edit_others_explorars edit_private_explorars edit_published_explorars manage_explorar_terms publish_explorars read_private_explorars

        $role->add_cap( 'read_explorar' );
        $role->add_cap( 'edit_explorar' );
        $role->add_cap( 'delete_explorar' );
        $role->add_cap( 'publish_explorar' );
        $role->add_cap( 'read_private_explorar' );

        $role->add_cap( 'manage_categories' );
        $role->add_cap( 'manage_noticias' );
        $role->add_cap( 'manage_explorars' );

    }
}
//add_action('admin_init', 'add_noticias_role_caps', 5 );



// Remove Categories and Tags
add_action('init', 'myprefix_remove_tax');
function myprefix_remove_tax() {
    if ( current_user_can('noticias_manager') ) { 
        register_taxonomy('category', array());
        register_taxonomy('post_tag', array());
    }
}

//Hide Categories and Tags
if ( current_user_can('noticias_manager') ) {
    function hide_post_page_options() {
        global $post;
        $hide_post_options = "<style type=\"text/css\"> .post-type-post.taxonomy-post_tag, .post-type-post.taxonomy-category { display: none; }</style>";
        print($hide_post_options);
    }
    //add_action( 'admin_head', 'hide_post_page_options'  );
}





