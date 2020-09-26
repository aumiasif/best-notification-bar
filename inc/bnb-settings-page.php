<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'plugins_loaded', 'bnbar_crb_load' );
function bnbar_crb_load() {
    require_once( Best_Notification_Bar_Path . 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'carbon_fields_register_fields', 'bnbar_options' );
function bnbar_options() {
    Container::make( 'theme_options', __( 'BNB Settings', 'best-notification-bar' ) )
        ->set_page_file( 'bnb-options' )
        ->set_icon( 'dashicons-carrot' )
        ->set_page_menu_title( 'BNB Settings' )
        ->add_tab( __( 'General', 'best-notification-bar' ), array(            
            Field::make( 'select', 'bnbar_hide_button', 'Hide Close Button', 'best-notification-bar' )
            ->set_help_text( 'Enable, disable, hide close button' )
            ->set_options( array(
                '1' => 'Toggle Button',
                '2' => 'Close Button Only',
                '3' => 'No Button',
            ) ),
            Field::make( 'select', 'bnbar_position', 'Notification Bar Position' )
            ->set_help_text( 'This will set Notification Bar Position' )
            ->add_options( array(
                '1' => 'Top',
                '2' => 'Bottom',
            ) ),
        ) )
        ->add_tab( __( 'Content', 'best-notification-bar' ), array(            
            Field::make( 'text', 'bnbar_text', 'Text Field', 'best-notification-bar' )
            ->set_help_text( 'Write a text to display on the Bar' ),
            Field::make( 'text', 'bnbar_button_text', 'Button Lebel', 'best-notification-bar' )
            ->set_help_text( 'To add a button beside your text, just put the button label' ),
            Field::make( 'text', 'bnbar_url_text', 'Button URL', 'best-notification-bar' )
            ->set_help_text( 'Put your button url here.' ),
            Field::make( 'checkbox', 'bnbar_open_new_page', __( 'Open in a new Tab' ) )
            ->set_help_text( 'Chceck this box if you want to open url in a new Tab.' ),
            Field::make( 'separator', 'crb_separator', __( 'Category Section' ) )
            ->set_help_text( 'Category selection section will not display in the notification bar until, you disable the Text Field section.' ),
            Field::make( 'select', 'bnbar_display_cat', 'Display Category' )
            ->set_help_text( 'This will display 3 latest post from the selected category' )
            ->add_options( bnbar_gen_cat_array() ),
            Field::make( 'checkbox', 'bnbar_scroll_text', __( 'Enable Scroll Effect' ) )
            ->set_help_text( 'Chceck this box if you the posts to scroll.' ),
        ) )
        ->add_tab( __( 'Design', 'best-notification-bar' ), array(
            Field::make( 'color', 'bnbar_background', __( 'Background Color', 'best-notification-bar' ) )
            ->set_default_value( '#ADCD5D' )
            ->set_alpha_enabled( true ),
            Field::make( 'color', 'bnbar_text_color', __( 'Text Color', 'best-notification-bar' ) )
            ->set_default_value( '#FFFFFF' )
            ->set_alpha_enabled( true ),
            Field::make( 'color', 'bnbar_close_button_icon_color', __( 'Close Button Icon Color', 'best-notification-bar' ) )
            ->set_default_value( '#B61600' )
            ->set_alpha_enabled( true ),
            Field::make( 'color', 'bnbar_show_button_icon_color', __( 'Show Button Icon Color', 'best-notification-bar' ) )
            ->set_default_value( '#FFFFFF' )
            ->set_alpha_enabled( true )
            ->set_help_text( 'This is for the toggle button which shows the notification bar, if hidden.' ),
        ) )
        // ->add_tab(__( 'Notfication Bars', 'best-notification-bar' ), array(
        //     Field::make( 'complex', 'bnb-multiple-nb', __('Multiple Notification Bar Generator', 'best-notification-bar' ) )
        //     ->set_layout( 'tabbed-vertical' )
        //     ->add_fields( 'notification_bar', array(
        //         Field::make( 'select', 'bnb-multiple_hide_button', 'Hide Close Button', 'best-notification-bar' )
        //         ->set_help_text( 'Enable, disable, hide close button' )
        //         ->set_default_value( '1' )
        //         ->set_options( array(
        //             '1' => 'Toggle Button',
        //             '2' => 'Close Button Only',
        //             '3' => 'No Button',
        //         ) ),
        //         Field::make( 'select', 'bnb-multiple_position', 'Notification Bar Position' )
        //         ->set_help_text( 'This will set Notification Bar Position' )
        //         ->set_default_value( '1' )
        //         ->add_options( array(
        //             '1' => 'Fixed',
        //             '2' => 'Scroll',
        //         ) ),
        //         Field::make( 'color', 'bnbar_background', __( 'Background Color', 'best-notification-bar' ) )
        //         ->set_default_value( '#ADCD5D' )
        //         ->set_alpha_enabled( true ),
        //         Field::make( 'color', 'bnbar_text_color', __( 'Text Color', 'best-notification-bar' ) )
        //         ->set_default_value( '#FFFFFF' )
        //         ->set_alpha_enabled( true ),
        //         ) )
        // ) )
        ->add_tab( __( 'Conditions', 'best-notification-bar' ), array(
            Field::make( 'checkbox', 'bnbar_show_on_homepage', __( 'Home Page' ) )
            ->set_help_text( 'Show bnb on Homepage only' ),
            Field::make( 'checkbox', 'bnbar_show_on_pages', __( 'Pages' ) )
            ->set_help_text( 'Show bnb on all Pages' ),
            Field::make( 'checkbox', 'bnbar_show_on_posts', __( 'Posts' ) )
            ->set_help_text( 'Show bnb on all Posts' ),
            Field::make( 'multiselect', 'bnbar_display_selected_pages', 'Show on selected pages' )
            ->set_help_text( 'This will display Best Notification Bar on selected pages. You can select multiple pages.' )
            ->add_options( bnbar_gen_pages() ),
            Field::make( 'multiselect', 'bnbar_display_selected_posts', 'Show on selected posts' )
            ->set_help_text( 'This will display Best Notification Bar on selected posts. You can select multiple posts.' )
            ->add_options( bnbar_gen_posts() ),
        ) );
        // ->add_tab(__( 'Referer Conditions', 'best-notification-bar' ), array(
        //     Field::make( 'complex', 'bnbar_referer_info', __('BNB Referer Info', 'best-notification-bar' ) )
        //     ->add_fields( 'condition', array(
        //         Field::make( 'text', 'bnbar_referer_id' )
        //         ->set_help_text( 'Referer Name' ),
        //         Field::make( 'text', 'bnbar_referer_url' )
        //         ->set_help_text( 'Referer url' ),
        //     ) )
        //     ->set_header_template( '
        //         <% if (bnbar_referer_id) { %>
        //             Passenger: <%- bnbar_referer_id %> <%- bnbar_referer_url ? "(" + bnbar_referer_url + ")" : "" %>
        //         <% } %>
        //     ' )
        // ) );
}

function bnbar_gen_cat_array(){
    $cat_initial_array = get_categories( array( 'orderby' => 'name', 'order' => 'ASC' ) );
    $get_cat[0]='None';
    foreach ($cat_initial_array as $cat){
        $get_cat[$cat->term_id] = $cat->name;
    }
    return $get_cat;
}

function bnbar_gen_pages(){
    $pages_initial_array = get_pages(array('exclude_tree'=> get_option('page_on_front')));
    $bnbar_gen_pages;
    foreach($pages_initial_array as $page){
        $bnbar_gen_pages[$page->ID] = $page->post_title;
    }
    return $bnbar_gen_pages;
}

function bnbar_gen_posts(){
    $posts_initial_array = get_posts(array('numberposts' => -1));
    $bnbar_gen_posts;
    foreach($posts_initial_array as $post){
        $bnbar_gen_posts[$post->ID] = $post->post_title;
    }
    return $bnbar_gen_posts;
}


add_action( 'carbon_fields_container_bnbar_settings_before_sidebar', 'bnbar_gen_bnbar_add' );
function bnbar_gen_bnbar_add(){
    $content = '<div id="submitdiv" class="postbox">
        <h3>Purchase Plus Version</h3>

        <div id="major-publishing-actions">

            <div id="publishing-action">
                
            </div>
            <ul>
                <li>The Pro version contains many more exciting features</li>
                <li>imagine this: you can show a different notification bar for every page.</li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>';
    echo $content;
}

function bnbar_cits($field_name){
    global $post;
    $id = get_the_ID();
    $home_id = get_option('page_on_front');
    $verify_ids = carbon_get_theme_option($field_name);
    if(in_array($id, $verify_ids)){
        return true;
    }else{
        return false;
    }
}

function bnbar_sospp_check($field_name){
    global $post;
    $check = carbon_get_theme_option($field_name);
    switch ($field_name) {
        case 'bnbar_show_on_homepage':
            # code...
            if($check){
                if(is_home()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            break;
        case 'bnbar_show_on_pages':
            # code...
            if($check){
                if(is_page()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            break;
        case 'bnbar_show_on_posts':
            # code...
            if($check){
                if( get_post_type( get_the_ID() ) == 'post' ){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            break;
        default:
            # code...
            break;
    }
}

function bnbar_show_bnb(){
    if( 
        bnbar_cits('bnbar_display_selected_pages') 
        or 
        bnbar_cits('bnbar_display_selected_posts') 
        or 
        bnbar_sospp_check('bnbar_show_on_homepage')
        or
        bnbar_sospp_check('bnbar_show_on_pages')
        or
        bnbar_sospp_check('bnbar_show_on_posts')
        ){
        return bnbar_notification_bar();
    }
}