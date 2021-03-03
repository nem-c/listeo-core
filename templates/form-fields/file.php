<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$field = $data->field;
$key = $data->key;
$value = (isset($field['value'])) ? $field['value'] : '' ;
$allowed_mime_types = array_keys( ! empty( $field['allowed_mime_types'] ) ? $field['allowed_mime_types'] : get_allowed_mime_types() );



if ( ! empty( $field['value'] ) ) : ?>
<div class="listeo-uploaded-file">

		<?php
		if ( is_numeric( $value ) ) {
			$image_src = wp_get_attachment_url( absint( $value ) );
 			$filetype = wp_check_filetype( $image_src );
 			$extension = $filetype['ext'];
		} else {
			$image_src = $value;
			$extension = ! empty( $extension ) ? $extension : substr( strrchr( $image_src, '.' ), 1 );
		}

		
		if ( 'image' === wp_ext2type( $extension ) ) : ?>
			<span class="listeo-uploaded-file-preview"><img src="<?php echo esc_url( $image_src ); ?>" /> 
			<a class="remove-uploaded-file" href="#"><?php _e( 'Remove file', 'listeo_core' ); ?></a></span>
		<?php else : ?>
			<span class="listeo-uploaded-file-name"><?php echo esc_html( basename( $image_src ) ); ?> 
			<a class="remove-uploaded-file" href="#"><?php _e( 'Remove file', 'listeo_core' ); ?></a></span>
		<?php endif; ?>

		<input type="hidden" class="input-text" name="current_<?php echo esc_attr( $field['name'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
		
	</div>

<?php endif; ?>

<input type="file"  name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>" id="<?php echo esc_attr( $key ); ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
