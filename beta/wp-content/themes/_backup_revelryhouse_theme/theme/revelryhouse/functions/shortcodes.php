<?php

    function gt_format($content)
    {
        $new_content = '';
        $pattern_full = '{(\[raw\].*?\[/raw\])}is';
        $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
        $pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

        foreach ( $pieces as $piece )
        {
            if ( preg_match( $pattern_contents, $piece, $matches ) )
            {
                $new_content .= $matches[1];
            }
            else
            {
                $new_content .= wptexturize( wpautop( $piece ) );
            }
        }
        
        return $new_content;
    }

    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_content', 'wptexturize' );

    add_filter( 'the_content', 'gt_format', 99 );
    add_filter( 'widget_text', 'gt_format', 99 );

    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter('get_the_excerpt', 'custom_trim_excerpt');

    function custom_trim_excerpt($text = '')
    {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        $text = get_the_content('');
 
        //$text = strip_shortcodes( $text );
 
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]&gt;', ']]&gt;', $text);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
    }
    
    add_filter( 'widget_text', 'do_shortcode' );
    add_filter( 'get_the_excerpt', 'do_shortcode' );

    // Buttons
    function buttons( $atts, $content = null ) {
        extract( shortcode_atts( array(
        'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
        'size' => 'medium', /* small, medium, large */
        'url'  => '',
        'text' => '', 
        ), $atts ) );
        
        if($type == "default"){
            $type = "";
        }
        else{ 
            $type = "btn-" . $type;
        }
        
        if($size == "medium"){
            $size = "";
        }
        else{
            $size = "btn-" . $size;
        }
        
        $buttons = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
        $buttons .= $text;
        $buttons .= '</a>';
        
        return $buttons;
    }

    add_shortcode('button', 'buttons'); 

    // Alerts
    function alert( $atts, $content = null ) {
        extract( shortcode_atts( array(
        'alert_type' => '', 
        'closable_alert_text' => 'x', 
        'alert_title' => ''
        ), $atts ) );
        
        $alert =  '<div class="alert ' . $alert_type . ' fade in"><a class="close" data-dismiss="alert">' . $closable_alert_text . '</a><strong>' . $alert_title . '</strong> ' . do_shortcode( $content ) . '</div>';
        
        return $alert;
    }
  
    add_shortcode('alert', 'alert');

    // Blockquotes
    function blockquotes( $atts, $content = null ) {
        extract( shortcode_atts( array(
        'float' => '', /* left, right */
        'cite' => '', /* text for cite */
        ), $atts ) );
        
        $blockquotes = '<blockquote';
        if($float == 'left') {
            $blockquotes .= ' class="pull-left"';
        }
        elseif($float == 'right'){
            $blockquotes .= ' class="pull-right"';
        }
        $blockquotes .= '><p>' . $content . '</p>';
        
        if($cite){
            $blockquotes .= '<small>' . $cite . '</small>';
        }
        
        $blockquotes .= '</blockquote>';
        
        return $blockquotes;
    }

    add_shortcode('blockquote', 'blockquotes');

    // YouTube Video
    function youtube_video($atts, $content = null) {
        extract(shortcode_atts(array(
            'id' => ''
        ), $atts));
        
        $return = $content;
        if ($content)
            $return .= "<br /><br />";
        
        $youtube_video = '<iframe width="100%" height="349" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';
        
        return $youtube_video;
    }

    add_shortcode('youtube', 'youtube_video');

    // Vimeo Video
    function vimeo_video($atts, $content = null) {
        extract(shortcode_atts(array(
            'id' => ''
        ), $atts));
        
        $return = $content;
        if ($content)
            $return .= "<br /><br />";
        
        $vimeo_video = '<iframe width="100%" height="349" src="http://player.vimeo.com/video/' . $id . '" frameborder="0" allowfullscreen></iframe>';
        
        return $vimeo_video;
    }

    add_shortcode('vimeo', 'vimeo_video');

    // Obfusticate Email (Hide your Email from Spambots!!!)
    function hide_mail($atts , $content = null) {
        for ($i = 0; $i < strlen($content); $i++) $encodedmail .= "&#" . ord($content[$i]) . ';'; 
        
        $hide_mail = '<a href="mailto:' . $encodedmail . '">' . $encodedmail . '</a>';

        return $hide_mail;
    }
    
    add_shortcode('mailto', 'hide_mail');

    // Google Maps
    function google_maps($atts, $content = null) {
       extract(shortcode_atts(array(
          "width" => '770',
          "height" => '380',
          "src" => ''
       ), $atts));
       
       $google_maps = '<iframe class="gmap" width="' . $width . '" height="' . $height . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $src . '&output=embed"></iframe>';

       return $google_maps;
    }
    
    add_shortcode("googlemap", "google_maps");

    // Columns
    function row($atts, $content = null){
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="row">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('row', 'row');

    function span1($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span1">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span1', 'span1');

    function span2($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span2">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span2', 'span2');

    function span3($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span3">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span3', 'span3');

    function span4($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span4">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span4', 'span4');

    function span5($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span5">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span5', 'span5');

    function span6($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span6">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span6', 'span6');

    function span7($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span7">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span7', 'span7');

    function span8($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span8">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span8', 'span8');

    function span9($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span9">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span9', 'span9');

    function span10($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span10">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span10', 'span10');

    function span11($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span11">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span11', 'span11');

    function span12($atts, $content = null) {
        extract( shortcode_atts( array(), $atts));
        
        $code = '<div class="span12">'.do_shortcode($content).'</div>';
        
        return $code;
    }

    add_shortcode('span12', 'span12');


    // DropCap
    function A_dc_func() {$text = '<span class="dropcap">A</span>'; return $text;}
    add_shortcode( 'A', 'A_dc_func' );

    function B_dc_func() {$text = '<span class="dropcap">B</span>'; return $text;}
    add_shortcode( 'B', 'B_dc_func' );

    function C_dc_func() {$text = '<span class="dropcap">C</span>'; return $text;}
    add_shortcode( 'C', 'C_dc_func' );

    function D_dc_func() {$text = '<span class="dropcap">D</span>'; return $text;}
    add_shortcode( 'D', 'D_dc_func' );

    function E_dc_func() {$text = '<span class="dropcap">E</span>'; return $text;}
    add_shortcode( 'E', 'E_dc_func' );

    function F_dc_func() {$text = '<span class="dropcap">F</span>'; return $text;}
    add_shortcode( 'F', 'F_dc_func' );

    function G_dc_func() {$text = '<span class="dropcap">G</span>'; return $text;}
    add_shortcode( 'G', 'G_dc_func' );

    function H_dc_func() {$text = '<span class="dropcap">H</span>'; return $text;}
    add_shortcode( 'H', 'H_dc_func' );

    function I_dc_func() {$text = '<span class="dropcap">I</span>'; return $text;}
    add_shortcode( 'I', 'I_dc_func' );

    function J_dc_func() {$text = '<span class="dropcap">J</span>'; return $text;}
    add_shortcode( 'J', 'J_dc_func' );

    function K_dc_func() {$text = '<span class="dropcap">K</span>'; return $text;}
    add_shortcode( 'K', 'K_dc_func' );

    function L_dc_func() {$text = '<span class="dropcap">L</span>'; return $text;}
    add_shortcode( 'L', 'L_dc_func' );

    function M_dc_func() {$text = '<span class="dropcap">M</span>'; return $text;}
    add_shortcode( 'M', 'M_dc_func' );

    function N_dc_func() {$text = '<span class="dropcap">N</span>'; return $text;}
    add_shortcode( 'N', 'N_dc_func' );

    function O_dc_func() {$text = '<span class="dropcap">O</span>'; return $text;}
    add_shortcode( 'O', 'O_dc_func' );

    function P_dc_func() {$text = '<span class="dropcap">P</span>'; return $text;}
    add_shortcode( 'P', 'P_dc_func' );

    function Q_dc_func() {$text = '<span class="dropcap">Q</span>'; return $text;}
    add_shortcode( 'Q', 'Q_dc_func' );

    function R_dc_func() {$text = '<span class="dropcap">R</span>'; return $text;}
    add_shortcode( 'R', 'R_dc_func' );

    function S_dc_func() {$text = '<span class="dropcap">S</span>'; return $text;}
    add_shortcode( 'S', 'S_dc_func' );

    function T_dc_func() {$text = '<span class="dropcap">T</span>'; return $text;}
    add_shortcode( 'T', 'T_dc_func' );

    function U_dc_func() {$text = '<span class="dropcap">U</span>'; return $text;}
    add_shortcode( 'U', 'U_dc_func' );

    function V_dc_func() {$text = '<span class="dropcap">V</span>'; return $text;}
    add_shortcode( 'V', 'V_dc_func' );

    function W_dc_func() {$text = '<span class="dropcap">W</span>'; return $text;}
    add_shortcode( 'W', 'W_dc_func' );

    function X_dc_func() {$text = '<span class="dropcap">X</span>'; return $text;}
    add_shortcode( 'X', 'X_dc_func' );

    function Y_dc_func() {$text = '<span class="dropcap">Y</span>'; return $text;}
    add_shortcode( 'Y', 'Y_dc_func' );

    function Z_dc_func() {$text = '<span class="dropcap">Z</span>'; return $text;}
    add_shortcode( 'Z', 'Z_dc_func' );

    function quote_dc_func() {$text = '<span class="dropcap">&quot;</span>'; return $text;}
    add_shortcode( 'quote', 'quote_dc_func' );

?>