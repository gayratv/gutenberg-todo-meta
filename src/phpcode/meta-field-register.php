<?php

include_once('plugin_const.php');

function mytheme_blocks_register_meta() {

    register_meta('post', VggGutenConst::META_POST_FLD1, array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback' => function() {
            return current_user_can('edit_posts');
        }
    ));     

    
    register_meta(
        'todo',  
        VggGutenConst::META_TODO_FLD1 , 
        array(
            'show_in_rest' => true,
            'type' => 'string',
            'single' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => function() {
                return current_user_can('edit_posts');
            }
        )
    );     

    // register_post_type
    cptui_register_my_cpts();

}



function cptui_register_my_cpts() {

    /**
     * Post Type: Todo's.
     */
    
    $labels = [
        "name" => __( "Todo's", "guten-vgg" ),
        "singular_name" => __( "Todo", "guten-vgg" ),
    ];
    

    // add custom-fields to support for view meta fields in rest API

    $args = [
        "label" => __( "Todo's", "guten-vgg" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail","author","custom-fields" ],
        "menu_icon" => "dashicons-editor-customchar"
    ];
    
    register_post_type( "todo", $args );
}
    
   

add_action('init', 'mytheme_blocks_register_meta');

