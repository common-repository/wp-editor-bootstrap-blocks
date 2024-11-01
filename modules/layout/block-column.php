<?php 
/**
 * Bootstrap Blocks for WP Editor Layout.
 *
 * @version 1.6.0
 *
 * @package Bootstrap Blocks for WP Editor
 * @author  Virgial Berveling
 * @updated 2023-05-26
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'GUTENBERGBOOTSTRAP_VERSION' ) ) {
	exit;
}



register_block_type( 'gtb-bootstrap/column', array(
   'editor_script'   => 'gtb-bootstrap-editor',
   'editor_style'    => 'gtb-bootstrap-editor',

   'render_callback' => 'gtb_bootstrap_render_column',
   'category' => 'bootstrap'
) );


function gtb_bootstrap_render_column( $attributes, $content = '')
{
   $cls = [];
   $has_xs = false;
   $has_col = false;
   $has_hidden = false;
   foreach(array( 'sm', 'md', 'lg') as $s):
      if (!empty($attributes['size_'.$s]))
      {
         $has_col = true;
         if ($s == 'xs')
         {
            $has_xs = $s;
         }else{
            $cls[] = 'col-'.$s.'-'.$attributes['size_'.$s];
         }
      }

      if (!empty($attributes['hidden_'.$s]))
      {
         $cls[] = ($s==='xs'?'d-none':'d-'.$s.'-none');
         $has_hidden = true;
      }else if ($has_hidden)
      {
         $cls[] = ($s==='xs'?'d-block':'d-'.$s.'-block');
      }

      if (!empty($attributes['order_'.$s]))
      {
         $cls[] = ($s==='xs'? 'order-'.$attributes['order_'.$s] : 'order-'.$s.'-'.$attributes['order_'.$s]);
      }


   endforeach;

   if (!empty($attributes['className'])) $cls [] = $attributes['className'];

   if($has_xs) array_unshift($cls, 'col-'.$attributes['size_'.$has_xs]);

   if ($has_col):
        array_unshift($cls, '%%|');
   else:
        array_unshift($cls, '|%%');
   endif;


   if (!empty($attributes['backgroundColor'])) $cls[] = str_replace('gtb_color', 'has-gtb-color-', $attributes['backgroundColor']) .'-background-color';
   if (!empty($attributes['textColor'])) $cls[] = str_replace('gtb_color', 'has-gtb-color-', $attributes['textColor']) .'-color';
   

   $stle = '';
   if (!empty($attributes['style']['color']))
   {
      foreach ($attributes['style']['color'] as $key=>$s) $stle .= esc_attr($key . ':' . $s . ';');
   }
   if (!empty($attributes['bgColor'])) {
      $stle .='background-color:'.$attributes['bgColor'].';';
   }
   if (!empty($attributes['style']) && !empty($attributes['style']['backgroundColor'])) { $stle .='background-color: '.$attributes['style']['backgroundColor'].';';}


   return '<div'. (!empty($cls) ? ' class="'.implode(' ', $cls).'"':'') . (!empty($stle)?' style="'.$stle.'"':'').'>
      '.$content.'
   </div>';
}

