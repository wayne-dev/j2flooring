<?php
class patternpriceMetabox {
	private $screen = array(
		'rug-builder',
	);
	private $meta_fields = array(
		array(
			'label' => 'Price',
			'id' => '_price',
			'type' => 'price',
		),
		array(
			'label' => 'Pattern',
			'id' => '_pattern_id',
			'type' => 'media',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'patternprice',
				__( 'Pattern price', 'sadecweb' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'high'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'patternprice_data', 'patternprice_nonce' );
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			/*jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.patternprice-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.url);
								$('img#img_'+id).attr('src',attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});*/
			jQuery(function($){
				//var id = button.attr('id').replace('_button', '');

			  // Set all variables to be used in scope
			  var imgIdInput,id,imgContainer,frame,
				  metaBox = $('#patternprice.postbox'), // Your meta box id here
				  addImgLink = metaBox.find('.upload-custom-img'),
				  delImgLink = metaBox.find( '.delete-custom-img');
			  
			  // ADD IMAGE LINK
			  addImgLink.on( 'click', function( event ){
				
				event.preventDefault();
				id = $(this).attr('id').replace('_button', '');
				imgContainer = metaBox.find( '.custom-img-container-' + id);
				imgIdInput = metaBox.find( '.custom-img-id-' + id );
				
				// If the media frame already exists, reopen it.
				if ( frame ) {
				  frame.open();
				  return;
				}
				
				// Create a new media frame
				frame = wp.media({
				  title: 'Select or Upload Media Of Your Chosen Persuasion',
				  button: {
					text: 'Use this media'
				  },
				  multiple: false  // Set to true to allow multiple files to be selected
				});

				
				// When an image is selected in the media frame...
				frame.on( 'select', function() {
				  
				  // Get media attachment details from the frame state
				  var attachment = frame.state().get('selection').first().toJSON();

				  // Send the attachment URL to our custom image input field.
				  imgContainer.append( '<img src="'+attachment.url+'" alt="" width = 70/>' );

				  // Send the attachment id to our hidden input
				  imgIdInput.val( attachment.id );

				  // Hide the add image link
				  addImgLink.addClass( 'hidden' );

				  // Unhide the remove image link
				  delImgLink.removeClass( 'hidden' );
				});

				// Finally, open the modal on click
				frame.open();
			  });
			  
			  
			  // DELETE IMAGE LINK
			  delImgLink.on( 'click', function( event ){
				id = $(this).attr('id').replace('_delete', '');
				imgContainer = metaBox.find( '.custom-img-container-' + id);
				imgIdInput = metaBox.find( '.custom-img-id-' + id );
				  
				event.preventDefault();

				// Clear out the preview image
				imgContainer.html( '' );

				// Un-hide the add image link
				addImgLink.removeClass( 'hidden' );

				// Hide the delete image link
				delImgLink.addClass( 'hidden' );

				// Delete the image id from the hidden input
				imgIdInput.val( '' );

			  });

			});
		</script><?php
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'media':
				$upload_link = wp_get_attachment_image_src( $meta_value, 'full' );
				ob_start();
				?>
				<!-- Your image container, which can be manipulated with js -->
				<div class="custom-img-container-<?php echo $meta_field['id'];?>">
					<?php if ( $meta_value ) : ?>
						<img src="<?php echo $upload_link[0] ?>" alt="" width = 70  />
					<?php endif; ?>
				</div>

				<!-- Your add & remove image links -->
				<p class="hide-if-no-js">
					<a id = '<?php echo $meta_field['id'];?>_button' class="upload-custom-img <?php if ( $meta_value  ) { echo 'hidden'; } ?>" 
					   href="<?php echo $upload_link ?>">
						<?php _e('Set custom image') ?>
					</a>
					<a id = '<?php echo $meta_field['id'];?>_delete'class="delete-custom-img <?php if ( ! $meta_value  ) { echo 'hidden'; } ?>" 
					  href="#">
						<?php _e('Remove this image') ?>
					</a>
				</p>
				<input class="custom-img-id-<?php echo $meta_field['id'];?>" name="<?php echo $meta_field['id'];?>" type="hidden" value="<?php echo esc_attr( $meta_value ); ?>" />
				<?php
				$input = ob_get_contents();
				ob_end_clean();
					/*$input = "";
					if($meta_value)
						$input .= "<img id = 'img_".$meta_field['id']."' width = 70 src = '".$meta_value."' />";
					$input .= sprintf(
						'<input type = "hidden" style="width: 80%%" id="%1$s" name="%2$s" type="text" value="%3$s"> 
						<input style="width: 19%%" class="button patternprice-media" id="%4$s_button" name="%5$s_button" type="button" value="Upload" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['id'],
						$meta_field['id']
					);*/
					break;
				case 'price':
					$input = sprintf(
						'%s<input id="%s" name="%s" type="number" value="%s" min="0" step="any">',
						get_woocommerce_currency_symbol(),
						$meta_field['id'],
						$meta_field['id'],
						$meta_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['patternprice_nonce'] ) )
			return $post_id;
		$nonce = $_POST['patternprice_nonce'];
		if ( !wp_verify_nonce( $nonce, 'patternprice_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('patternpriceMetabox')) {
	new patternpriceMetabox;
};
?>