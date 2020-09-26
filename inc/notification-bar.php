<?php
/*Notification bar generator*/
function bnbar_notification_bar(){
    var_dump(wp_get_referer());
    $position_class = (carbon_get_theme_option('bnbar_position') != 1) ? 'bnb-bottom':'bnb-top';
    $content = '<div class="bnb bnb-shown '.$position_class.' bnb-fixed"
    style="background-color:'.carbon_get_theme_option( 'bnbar_background' ).';color:'.carbon_get_theme_option( 'bnbar_text_color' ).';">';
    $content.= bnbar_css_gen(carbon_get_theme_option( 'bnbar_url_text' ));
    $content.='<div class="bnb-outer-container">
        <div class="bnb-container bnb-clearfix">';
        $enable_scroll = (carbon_get_theme_option('bnbar_scroll_text') && !carbon_get_theme_option('bnbar_text')) ? 'scroll':'no-scroll';
        $content.='<div class="bnb-button-type bnb-content '.$enable_scroll.'">';
        if(carbon_get_theme_option('bnbar_text')){
            $content.='<span class="bnb-text">'.carbon_get_theme_option( 'bnbar_text' ).'</span>';
        }
        if(carbon_get_theme_option('bnbar_button_text')){
            $url_open_new_tab = ( carbon_get_theme_option('bnbar_open_new_page') ) ? 'target="_blank"':'';
            $content.='<a href="'.carbon_get_theme_option( 'bnbar_url_text' ).'" '.$url_open_new_tab.' class="bnb-button"> '.carbon_get_theme_option( 'bnbar_button_text' ).' </a>';
        }       
        if(carbon_get_theme_option('bnbar_display_cat') != 0 && !carbon_get_theme_option('bnbar_text')){
            $category_posts = get_posts(
                array(
                    'category' => carbon_get_theme_option('bnbar_display_cat'),
                    'numberposts' => 3,
                ));
            
            foreach ( $category_posts as $catPosts) {
                $content.='<span class="bnb-text">'.$catPosts->post_title.'</span>';
                $content.='<a href="'.$catPosts->guid.'" class="bnb-button"> Read More >> </a>';
            }
        }
        $content.='</div>';
        $content.='</div>';
    switch (carbon_get_theme_option('bnbar_hide_button')) {
        case '1':
            $content.='<a href="#" class="bnb-show" style="background-color:'.carbon_get_theme_option( 'bnbar_background' ).';color:'.carbon_get_theme_option( 'bnbar_show_button_icon_color' ).';"><span>+</span></a>';
            $content.='<a href="#" class="bnb-hide" style="background-color:'.carbon_get_theme_option( 'bnbar_background' ).';color:'.carbon_get_theme_option( 'bnbar_close_button_icon_color' ).';"><span>+</span></a>';
            break;

        case '2':
            // $content.='<a href="#" class="bnb-show" style="background-color:'.carbon_get_theme_option( 'bnbar_background' ).';color:'.carbon_get_theme_option( 'bnbar_show_button_icon_color' ).';"><span>+</span></a>';
            $content.='<a href="#" class="bnb-hide" style="background-color:'.carbon_get_theme_option( 'bnbar_background' ).';color:'.carbon_get_theme_option( 'bnbar_close_button_icon_color' ).';"><span>+</span></a>';
        case '3':
            #show nothing
        break;
        default:
            #show nothing
            break;
    }
    $content.='</div>
    '.'
</div>';
        
    return $content;
}