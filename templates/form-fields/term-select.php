<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$field = $data->field;
$key = $data->key;
$multi = false;
$css_class = 'select2-single';
if(isset($field['multi']) && $field['multi']) {
	$multi = true;
	$css_class = 'select2-multiple';
}

$selected = '';
// Get selected value
if ( isset( $field['value'] ) ) {
	$selected = $field['value'];
} elseif ( isset( $field['default']) && is_int( $field['default'] ) ) {
	$selected = $field['default'];
} elseif ( ! empty( $field['default'] ) && ( $term = get_term_by( 'slug', $field['default'], $field['taxonomy'] ) ) ) {

	$selected = $term->term_id;
} 

// Select only supports 1 value
if ( is_array( $selected ) && $multi == false ) {
	$selected = current( $selected );
}
$taxonomy = get_taxonomy($field['taxonomy']);

$dropdown_args = array(
	'taxonomy'         => $field['taxonomy'],
	'hierarchical'     => 1,
	'multiple'   	   => $multi,
	'show_option_all'  => false,
	'echo'			   => false,
	'name'             => (isset( $field['name'] ) ? $field['name'] : $key),
	'orderby'          => 'name',
	'selected'         => $selected,
	'class'			   => $css_class,
	'hide_empty'       => false,
	 'walker'  => new Willy_Walker_CategoryDropdown()
);
if($multi){

} else {
	$dropdown_args['show_option_none'] = (isset($field['required']) && $field['required'] == true) ? '' : __('Choose ','listeo_core'). $taxonomy->labels->singular_name;
	
}
$placeholder_data = __('Choose ','listeo_core'). $taxonomy->labels->singular_name;
$dropdown_output = wp_dropdown_categories( apply_filters( 'listeo_core_term_select_field_wp_dropdown_categories_args', $dropdown_args , $key, $field ) );

$dropdown_output = str_replace('<select', '<select data-placeholder="'.$placeholder_data.'" ', $dropdown_output);
echo $dropdown_output;