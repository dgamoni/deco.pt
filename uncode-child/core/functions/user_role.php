<?php

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
            'upload_files' => true
        )
    );
}
add_action( 'admin_init', 'add_noticias_manager_role', 4 );

function add_noticias_role_caps() {
    $roles = array('noticias_manager');
    foreach($roles as $the_role) {
        $role = get_role($the_role);
        $role->add_cap( 'read_noticia' );
        $role->add_cap( 'edit_noticia');
        $role->add_cap( 'delete_noticia' );
        $role->add_cap( 'publish_noticia' );
        $role->add_cap( 'read_private_noticia' );
        $role->add_cap( 'read_explorar' );
        $role->add_cap( 'edit_explorar' );
        $role->add_cap( 'delete_explorar' );
        $role->add_cap( 'publish_explorar' );
        $role->add_cap( 'read_private_explorar' );

    }
}
add_action('admin_init', 'add_noticias_role_caps', 5 );


