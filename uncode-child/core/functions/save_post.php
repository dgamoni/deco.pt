<?php

add_action('acf/save_post', function( $post_id ) {

    if ( get_post_type($post_id) !== 'post' ) {
        return;
    }

    $tag_name = 'home slider';

    $acf_field = get_field('homepage_hero_slider', $post_id);

    $post_tags = wp_get_post_terms($post_id, 'post_tag', ['fields' => 'names']);

    if ( $acf_field ) {
        if ( ! in_array($tag_name, $post_tags) ) {
            wp_set_post_terms($post_id, array_merge($post_tags, [$tag_name]), 'post_tag');
        }
    } else {
        if ( in_array($tag_name, $post_tags) ) {
            $new_tags = array_diff($post_tags, [$tag_name]);
            wp_set_post_terms($post_id, $new_tags, 'post_tag');
        }
    }
}, 20);
