<?php 
add_filter('woocommerce_cart_item_thumbnail','create_thumbnail_rugbuilder', 10, 3);
function create_thumbnail_rugbuilder($_product_image, $cart_item, $cart_item_key){
    if(isset($cart_item['rugbuilder'])){
        echo '<div class="canvas" data-bg="'.$cart_item['rugbuilder']['bg_url'][0].'" data-border="'.$cart_item['rugbuilder']['border_url'][0].'" data-height="'.$cart_item['rugbuilder']['height'].'" data-width="'.$cart_item['rugbuilder']['width'].'"></div>';
        $product_get_image = '';
    }
    return $product_get_image; 
}
add_action('woocommerce_before_order_itemmeta', 'create_thumbnail_rugbuilder_admin', 10, 3);
function create_thumbnail_rugbuilder_admin($item_id, $item, $product){
    if($bg_url = $item->get_meta('rugbuilder_background', true)){
        $border_url = $item->get_meta('rugbuilder_border', true);
        $height = $item->get_meta('rugbuilder_height', true);
        $width = $item->get_meta('rugbuilder_width', true);
        echo '<div class="canvas-data" data-bg="'.$bg_url.'" data-border="'.$border_url.'" data-height="'.$height.'" data-width="'.$width.'"></div>';
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'rugbuilder_checkout_create_order_line_item', 20, 4 );
function rugbuilder_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    if(isset($values['rugbuilder'])){
        $item->update_meta_data( 'rugbuilder_background', $values['rugbuilder']['bg_url'][0] );
        $item->update_meta_data( 'rugbuilder_border', $values['rugbuilder']['border_url'][0] );
        $item->update_meta_data( 'rugbuilder_height', $values['rugbuilder']['height'] );
        $item->update_meta_data( 'rugbuilder_width', $values['rugbuilder']['width'] );
    }
}
?>