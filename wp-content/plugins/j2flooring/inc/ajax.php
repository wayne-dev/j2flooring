<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'wp_ajax_load_product', 'load_product' );
add_action( 'wp_ajax_nopriv_load_product', 'load_product' );
function load_product() {
	$cat_id = $_POST['cat_id'];
	$patterns = get_posts(array(
		'post_type' => 'rug-builder',
		'tax_query' => array(
			array(
			'taxonomy' => 'rugcat-tax',
			'field' => 'term_id',
			'terms' => $cat_id)
		))
	);
	ob_start();
	?>
	<?php
		
		?>
	<div class = 'menu_rug_style' id = 'parent_product_<?php echo $cat_id ; ?>'>
		<ul class = ''>
			<?php foreach($patterns as $pattern){ 
				$id = $pattern->ID ;
				$img_id = get_post_meta( $id,"_pattern_id", true );
				$src = wp_get_attachment_image_src( $img_id, 'full' );
			?>
				<li>
				<a  data-pattern_id = '<?php echo $id ; ?>' href = ''>
					<img src = "<?php echo $src[0]; ?>" />
					<span><?php echo $pattern->post_title ; ?></span>
				</a>
				</li>
			<?php }  ?>
		</ul>
	</div>
	<span class = 'close'>✕</span>
	<?php
	$page = ob_get_contents();
	ob_clean();
	wp_send_json($page);
	wp_die();
}
add_action( 'wp_ajax_load_subcat', 'load_subcat' );
add_action( 'wp_ajax_nopriv_load_subcat', 'load_subcat' );
function load_subcat() {
	$parent_id = $_POST['cat_id'];
	global $img_taxes;
	ob_start();
	?>
	<?php
			$children = get_terms( array(
				'taxonomy' => 'rugcat-tax',
				'hide_empty' => false,
				'parent' => $parent_id,
			) );
		
		?>
	<div class = 'subsub_menu_rug menu_rug_style' id = 'parent_<?php echo $parent_id ; ?>'>
		<ul class = ''>
			<?php foreach($children as $child){ 
				$term_id = $child->term_id ;
			?>
				<li>
				<a data-cat_id = '<?php echo $term_id ; ?>' href = ''>
					<img src = "<?php echo $img_taxes[$term_id]; ?>" />
					<span><?php echo $child->name ; ?></span>
				</a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<?php
	$page = ob_get_contents();
	ob_clean();
	wp_send_json($page);
	wp_die();
}
?>