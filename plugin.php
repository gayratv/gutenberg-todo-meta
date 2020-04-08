<?php
/* 
* Plugin Name: Todo meta
* Description: ToDO block + metafield
* Author: Gayrat 
*/

if ( ! defined( 'ABSPATH' )) {
    exit;
}


include_once('src/phpcode/plugin_const.php');
include_once('src/phpcode/meta-field-register.php');
include_once('src/phpcode/register-cust.php');

function mytheme_blocks_categories( $categories, $post ){
    return array_merge(
        $categories, 
        array(
            array(
                'slug' => VggGutenConst::SLUG_THEME_CATEGORY,
                'title'=> __(VggGutenConst::CATEGORY_BLK_NAME, VggGutenConst::NAMESPACE),
                'icon' => VggGutenConst::CATEGORY_BLK_NAME_ICON
            )
        )
            );
}
add_filter('block_categories','mytheme_blocks_categories',10,2);

function mytheme_blocks_register_block_type($block, $options = array ()) {
    register_block_type(
        VggGutenConst::NAMESPACE . $block,
        array_merge(
            array(
                'editor_script' => VggGutenConst::NAMESPACE . '-editor-script',
                'editor_style' => VggGutenConst::NAMESPACE . '-editor-style',
                'script' => VggGutenConst::NAMESPACE .'-script',
                'style' => VggGutenConst::NAMESPACE . '-style'
            ),
            $options
        )
        

    );
}


function mytheme_blocks_enqueue_assets() {
    wp_enqueue_script(
        VggGutenConst::NAMESPACE . '-editor-js',
        plugins_url('dist/editor_script.js', __FILE__),
        array('wp-data', 'wp-plugins', 'wp-edit-post', 'wp-i18n', 'wp-components', 'wp-data', 'wp-compose')
    );
}

// Позволяет добавить стили или скрипты в редактор блоков (Гутенберг) на страницу редактирования записи
add_action('enqueue_block_editor_assets', 'mytheme_blocks_enqueue_assets');

function mytheme_blocks_register() { 
    
    wp_register_script(
        VggGutenConst::NAMESPACE . '-editor-script',
        plugins_url('dist/editor.js', __FILE__),
        array('wp-blocks','wp-i18n', 'wp-element', 'wp-editor', 'wp-components','lodash','wp-blob','wp-data','wp-html-entities','wp-compose')
    );

    wp_register_script(
        VggGutenConst::NAMESPACE . '-script',
        plugins_url('dist/script.js', __FILE__),
        array('jquery')
    );

    
    // wp_register_style(
    //     VggGutenConst::NAMESPACE . '-editor-style',
    //     plugins_url('dist/editor.css', __FILE__),
    //     array('wp-edit-blocks')   
    // );

    // wp_register_style(
    //     VggGutenConst::NAMESPACE . '-style',
    //     plugins_url('dist/style.css', __FILE__)
    // );
    
    mytheme_blocks_register_block_type(vggGutenConst::BLK_NAME_TODO_LIST_META);
}

add_action('init', 'mytheme_blocks_register');

