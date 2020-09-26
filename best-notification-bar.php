<?php
/**
 * Plugin Name:       Best Notification Bar
 * Plugin URI:        https://staged.fun/plugins/best-notification-bar
 * Description:       Adds a static but hidable Notification bar at the top or bottom of the page. Where you can show stuffs. 
 * Version:           1.0
 * Requires at least: 2.9.0
 * Requires PHP:      4.3 or higher
 * Author:            Asif Chowdhury
 * Author URI:        https://staged.fun/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       best-notification-bar
 * Domain Path:       /languages
 */
 
 define ('Best_Notification_Bar_Path' , plugin_dir_path( __FILE__ ));
 include __DIR__.'/inc/notification-bar.php'; /*notification bar generator*/
 include __DIR__.'/inc/bnb-settings-page.php'; /*notification bar settings*/
 include __DIR__.'/inc/bnb-settings-style-gen.php'; /*notification bar style sheet genaretor*/

 if(function_exists('wp_footer')){
     add_action( 'wp_footer', 'bnbar_inject', /*priority*/ 9999999 );
 }elseif(function_exists('wp_head')){
    add_action( 'wp_head', 'bnbar_inject', /*priority*/ 9999999 );
 }

 function bnbar_inject(){
     echo '<!-bnb-start->';
     echo bnbar_show_bnb();
     echo '<!-bnb-end->';
 }

 //  registering and Enqueue css stylesheet
function best_notification_bar_scripts()
{
    wp_enqueue_style('best-notification-bar-style', plugin_dir_url( __FILE__ ) . '/inc/css/best-notification-bar.css');
    wp_enqueue_script( 'best-notification-bar-javascript', plugin_dir_url( __FILE__ ) . 'inc/js/best-notification-bar.js',  array( 'jquery' ) , 1.0, true );
}
add_action('wp_enqueue_scripts', 'best_notification_bar_scripts');