<?php
function bnbar_css_gen(){
    $css='<style type="text/css">';
    $css.='    .bnb {';
    $css.='        position: fixed;';
        switch (carbon_get_theme_option('bnbar_position')) {
            case '1':
                $css.='        position: fixed;';
                break;
            case '2':
                $css.='        position: fixed;';
                $css.='        top: unset !important;';
                $css.='        bottom: 0;';
                break;
            default:
                $css.='        position: fixed;';
                break;
        }
    $css.='        -webkit-box-shadow: 0 3px 4px rgba(0, 0, 0, 0.05);';
    $css.='        box-shadow: 0 3px 4px rgba(0, 0, 0, 0.05);';
    $css.='    }';
    $css.='    .bnb .bnb-container {';
    $css.='        width: 1080px;';
    $css.='        font-size: 15px;';
    $css.='    }';
    $css.='    .bnb a {';
    $css.='        color: #f4a700;';
    $css.='    }';
    $css.='    .bnb .bnb-button {';
    $css.='        background-color: #f4a700;';
    $css.='    }';
    $css.='</style>';
    return $css;
}