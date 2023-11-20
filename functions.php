<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'font-awesome','simple-line-icons','oceanwp-style' ) );
        wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), 
        filemtime(get_stylesheet_directory() . '/css/theme.css'));
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

function hide_menu_items_based_on_role( $items, $menu, $args ) {
    // Get the current user's role
    $current_user = wp_get_current_user();
    $role = ( array ) $current_user->roles;
  
    // If the user is not an administrator, remove the Privacy Policy page from the specified menu
    if ( !in_array( 'administrator', $role ) && $menu->name == 'Navigation' ) {
      foreach ( $items as $key => $item ) {
        if ( $item->title == 'Admin' ) {
          unset( $items[$key] );
        }
      }
    }
  
    return $items;
  }
  add_filter( 'wp_get_nav_menu_items', 'hide_menu_items_based_on_role', 10, 3 );

