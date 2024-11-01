<?php 
/**
 * Bootstrap Blocks for WP Editor Layout.
 *
 * @version 1.5.0
 *
 * @package Bootstrap Blocks for WP Editor
 * @author  Virgial Berveling
 * @updated 2021-05-15
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'GUTENBERGBOOTSTRAP_VERSION' ) ) {
	exit;
}

register_block_type( 'gtb-bootstrap/container', array(
   'editor_script'   => 'gtb-bootstrap-editor',
   'editor_style'    => 'gtb-bootstrap-editor',
   'render_callback' => 'gtb_bootstrap_render_container',
   'category' => 'bootstrap'
) );


function gtb_bootstrap_render_container( $attributes, $content = '')
{
   $cls = 'container';
   $stle = '';
   if (!empty($attributes['style']['color']))
   {
      foreach ($attributes['style']['color'] as $key=>$s) $stle .= esc_attr($key . ':' . $s . ';');
   }
   if (!empty($attributes['bgColor'])) {
      $stle .='background-color:'.$attributes['bgColor'].';';
   }
   if (!empty($attributes['style']) && !empty($attributes['style']['backgroundColor'])) { $stle .='background-color: '.$attributes['style']['backgroundColor'].';';}


   $container = '   <div class="'.$cls.'"'.(!empty($stle)?' style="'.$stle.'"':'').'>
   '.$content.'
   </div>
';

   return $container;
}
