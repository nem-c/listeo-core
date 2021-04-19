<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Listeo_Core_Admin_Packages class.
 *
 * @extends WP_List_Table
 */
class Listeo_Core_Admin_Packages_Listings extends WP_List_Table {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( array(
			'singular' => 'package',
			'plural'   => 'packages',
			'ajax'     => false,
		) );
	}


	/**
	 * Get column default
	 *
	 * @param object $item
	 * @param string $column_name
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		global $wpdb;

		switch ( $column_name ) {
			case 'listing_id' :
			
				$product = get_post( $item );

				return $product ? '<a href="' . admin_url( 'post.php?post=' . absint( $item  ) . '&action=edit' ) . '">' . esc_html( get_the_title($item ) ) . '</a>' : __( 'n/a', 'listeo_core' );
		
			case 'user_package':
				  
		    	$post_author_id = get_post_field( 'post_author', $item );
		    	$user_package = get_post_meta($item,'_user_package_id',true);
		    	//echo $user_package;
		    	//$user_packages = listeo_core_available_packages($post_author_id,$user_package);
		    	if($user_package){
		    		$package = listeo_core_get_package_by_id($user_package);	
		    		//var_dump($package);
		    		if($package && $package->product_id){
		    			return get_the_title($package->product_id);
		    		};
		    		//return $package->get_title();
		    	}
		    	
		    	
				//return get_post_meta($item,'_user_package_id',true);
				break;
			case 'listing_actions' :
				$user_package = get_post_meta($item,'_user_package_id',true);
				$edit_url = esc_url( add_query_arg( array(
					'action' => 'edit',
					'listing_id' => $item,
					'package_id' => $user_package,
				), admin_url( 'admin.php?page=listeo_core_paid_listings_package_editor' ) ) );
				return '<div class="actions">' .
					'<a class="button button-icon icon-edit" href="' . $edit_url . '">' . __( 'Change package', 'listeo_core' ) . '</a>' .
					'</div>' .
					'</div>';
		}// End switch().
	}

	/**
	 * Get a list of columns. The format is:
	 * 'internal-name' => 'Title'
	 *
	 * @return array
	 */
	public function get_columns() {
		$columns = array(
			'listing_id'      => __( 'Listing', 'listeo_core' ),
			'user_package'      => __( 'Package', 'listeo_core' ),
			'listing_actions'  => __( 'Actions', 'listeo_core' ),
		);
		return $columns;

	
	}

	/**
	 * Get a list of sortable columns. The format is:
	 * 'internal-name' => 'orderby'
	 * or
	 * 'internal-name' => array( 'orderby', true )
	 *
	 * The second format will make the initial sorting order be descending
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'listing_id'      => array( 'listing_id', true ),
		
		);
		return $sortable_columns;
	}

	/**
	 * Generate the table navigation above or below the table
	 *
	 * @param string $which
	 */
	public function display_tablenav( $which ) {
		if ( 'top' == $which ) {
			return;
		}
		parent::display_tablenav( $which );
	}

	/**
	 * Prepares the list of items for displaying.
	 *
	 * @uses WP_List_Table::set_pagination_args()
	 *
	 * @access public
	 */
	public function prepare_items() {
		global $wpdb;

		$current_page          = $this->get_pagenum();
		$per_page              = 50;
		$order                 = empty( $_REQUEST['order'] ) || $_REQUEST['order'] === 'asc' ? 'ASC' : 'DESC';
		$order_id              = ! empty( $_REQUEST['order_id'] ) ? absint( $_REQUEST['order_id'] ) : '';
		$listing_id              = ! empty( $_REQUEST['listing_id'] ) ? absint( $_REQUEST['listing_id'] ) : '';
	
		$this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );
		

		$where                 = array( 'WHERE post_type="listing"' );


		$paged = ( isset( $_REQUEST['paged'] ) ) ? intval( $_REQUEST['paged'] ) : 1;
		
		$per_page = 10;

		$args = array(
				'paged'          => $paged,
				'posts_per_page' => $per_page,
				'post_type'      => 'listing',
				'post_status'    => 'any',
				'orderby'        => 'title',
				'order'          => 'ASC',
			);


		if ( isset( $_REQUEST['orderby'] ) ) {
			switch ( $_REQUEST['orderby'] ) {
				case 'display_name':
					$args['orderby'] = 'title';
					break;
				
			}
		}
		if ( isset( $_REQUEST['order'] ) && in_array( strtoupper( $_REQUEST['order'] ), array( 'ASC', 'DESC' ) ) ) {
			$args['order'] = strtoupper( $_REQUEST['order'] );
		}
		
		$listings = new WP_Query( $args );

		$items = array();
		foreach ( $listings->get_posts() as $listing ) {
			$items[] = $listing->ID;
		}
	

		$this->items = $items;
		$max = $listings->found_posts;
		$this->set_pagination_args( array(
			'total_items' => $max,
			'per_page'    => $per_page,
			'total_pages' => ceil( $max / $per_page ),
		) );
	}
}
