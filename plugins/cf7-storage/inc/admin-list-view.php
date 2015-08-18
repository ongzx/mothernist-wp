<?php

// Make sure that storage class exists
if ( ! class_exists( 'cf7_storage' ) )
	return;

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class cf7_storage_list_table extends WP_List_Table {

	private static $storage_post_type;
	public $is_trash = false;

	function __construct( $post_type ) {

		parent::__construct( 
			array(
				'singular' => 'post',
				'plural' => 'posts',
				'ajax' => false 
			) 
		);

		self::$storage_post_type = $post_type;

	}

	function prepare_items() {

		$cf7_storage = cf7_storage::instance();

		$per_page = $this->get_items_per_page( 'cf7_entries_per_page' );
		$this->is_trash = isset( $_REQUEST['post_status'] ) && $_REQUEST['post_status'] == 'trash';

		$this->_column_headers = array( 
				$this->get_columns(), 
				array(), 
				$this->get_sortable_columns() 
			);

		$query_args = $cf7_storage->get_query_args();

		$query_args[ 'posts_per_page' ] = $per_page;
		$query_args[ 'offset' ] = ( $this->get_pagenum() - 1 ) * $per_page;

		$query = new WP_Query( $query_args );
		
		$this->items = $query->posts;

		$this->set_pagination_args( array(
				'total_items' => $query->found_posts,
				'total_pages' => ceil( $query->found_posts / $per_page ),
				'per_page' => $per_page 
			) );

	}

	function get_columns() {

		return array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Entry', 'cf7-storage' ),
			'contact_form' => __( 'Contact Form', 'cf7-storage' ),
			'date' => __( 'Date', 'cf7-storage' ) 
		);

	}

	function get_views() {

		$status_links = array();

		$num_posts = wp_count_posts( self::$storage_post_type, 'readable' );
		$entries_stati = get_post_stati( array( 'show_in_admin_status_list' => true ), 'objects' );

		$view_link = add_query_arg( 
				array( 
					'page' => 'cf7_storage',
				),
				admin_url( 'admin.php' )
			);

		$status_links[ 'all' ] = sprintf(
				'<a href="%s">%s <span class="count">(%d)</span></a>',
				$view_link,
				esc_html__( 'All', 'cf7-storage' ),
				$num_posts->publish
			);

		$status_links[ 'trash' ] = sprintf(
						'<a href="%s" %s>%s</a>',
						add_query_arg( 'post_status', 'trash', $view_link ),
						$this->is_trash ? 'class="current"' : null,
						sprintf( 
							translate_nooped_plural( $entries_stati['trash']->label_count, $num_posts->trash ), 
							number_format_i18n( $num_posts->trash ) 
						)
					);

		return $status_links;

	}

	function get_sortable_columns() {

		return array(
			'date' => array( 'date', true ) 
		);

	}

	function get_bulk_actions() {

		$actions = array();

		if ( $this->is_trash )
			$actions['untrash'] = __( 'Restore', 'cf7-storage' );

		if ( $this->is_trash || ! EMPTY_TRASH_DAYS )
			$actions['delete'] = __( 'Delete Permanently', 'cf7-storage' );
		else
			$actions['trash'] = __( 'Move to Trash', 'cf7-storage' );

		$actions['export'] = __( 'Export as CSV', 'cf7-storage' );

		return $actions;

	}

	function column_default( $item, $column_name ) {

		return null;

    }

	function column_cb( $item ) {

		return sprintf(
				'<input type="checkbox" name="%s[]" value="%s" />',
				$this->_args['singular'],
				$item->ID
			);

	}

	function column_title( $item ) {

		$actions = array();

		$view_link = add_query_arg( 
				array( 
					'page' => 'cf7_storage',
					'action' => 'view',
					'post_id' => absint( $item->ID )
				),
				wp_nonce_url( 'admin.php', 'bulk-posts' )
			);

		$actions[ 'quick-preview' ] = sprintf(
					'<a href="#entry-preview-%d">%s</a>',
					$item->ID,
					__( 'Preview', 'cf7-storage' )
				);

		if ( $this->is_trash ) {

			$actions[ 'untrash' ] = sprintf(
					'<a href="%s">%s</a>',
					add_query_arg( 'action', 'untrash', $view_link ),
					__( 'Restore', 'cf7-storage' )
				);

			$actions[ 'export' ] = sprintf(
					'<a href="%s">%s</a>',
					add_query_arg( 'action', 'export', $view_link ),
					__( 'Export as CSV', 'cf7-storage' )
				);

			$actions[ 'delete' ] = sprintf(
					'<a href="%s">%s</a>',
					add_query_arg( 'action', 'delete', $view_link ),
					__( 'Delete Permanently', 'cf7-storage' )
				);

		} else {

			$actions[ 'view' ] = sprintf(
					'<a href="%s">%s</a>',
					$view_link,
					__( 'View', 'cf7-storage' )
				);

			$actions[ 'export' ] = sprintf(
					'<a href="%s">%s</a>',
					add_query_arg( 'action', 'export', $view_link ),
					__( 'Export as CSV', 'cf7-storage' )
				);

			$actions[ 'trash' ] = sprintf(
					'<a href="%s">%s</a>',
					add_query_arg( 'action', 'trash', $view_link ),
					__( 'Trash', 'cf7-storage' )
				);

		}

		$cf7_edit_url = add_query_arg( 
				array( 
					'page' => 'wpcf7',
					'action' => 'view',
					'post' => absint( $item->post_parent )
				),
				admin_url( 'admin.php' )
			);

		return sprintf(
				'<a class="row-entry-title" href="%s" title="%s">
					<h3 class="entry-from">%s</h3>
					<h4 class="entry-subject">%s</h4>
				</a>
				%s
				<div id="entry-preview-%d" class="row-entry-preview">
					<div class="entry-preview-wrap">
						%s
					</div>
				</div>',
				$view_link,
				esc_attr( sprintf( __( 'View this submission from %s', 'cf7-storage' ), $item->post_title ) ),
				esc_html( $item->post_title ),
				esc_html( get_post_meta( $item->ID, 'mail_subject', true ) ),
				$this->row_actions( $actions ),
				esc_attr( $item->ID ),
				apply_filters( 'the_content', get_post_meta( $item->ID, 'mail_body', true ) )
			);

    }

	function column_date( $item ) {

		$t_time = mysql2date( 'r', $item->post_date, true );
		$time = mysql2date( 'G', $item->post_date ) - get_option( 'gmt_offset' ) * 3600;

		$time_diff = time() - $time;

		if ( $time_diff > 0 && $time_diff < 24 * 60 * 60 )
			$h_time = sprintf( __( '%s ago', 'cf7-storage' ), human_time_diff( $time ) );
		else
			$h_time = mysql2date( get_option( 'date_format' ), $item->post_date );

		return sprintf( 
				'<abbr title="%s">%s</abbr>',
				esc_attr( $t_time ),
				esc_html( $h_time )
			);

    }

    function column_contact_form( $item ) {

    	$cf7_edit_url = add_query_arg( 
				array( 
					'page' => 'wpcf7',
					'action' => 'view',
					'post' => absint( $item->post_parent )
				),
				admin_url( 'admin.php' )
			);

		return sprintf(
				'<a href="%s">%s</a>',
				$cf7_edit_url,
				esc_html( get_the_title( $item->post_parent ) )
			);

    }

    function extra_tablenav( $which ) {
	
		?>
		<div class="alignleft actions">
		<?php
			if ( 'top' == $which ) {

				$this->months_dropdown( self::$storage_post_type );

				$forms = get_posts( array( 
						'posts_per_page' => -1, 
						'post_type' => 'wpcf7_contact_form',
						'orderby' => 'title',
						'order' => 'ASC'
					) );

				$dropdown_items = array(
						sprintf(
							'<option value="">%s</option>',
							__( 'All Contact Forms', 'cf7-storage' )
						)
					);

				$form_id = isset( $_REQUEST['form_id'] ) ? $_REQUEST['form_id'] : null;

				foreach ( $forms as $form )
					$dropdown_items[] = sprintf(
							'<option value="%s" %s>%s</option>',
							esc_attr( $form->ID ), 
							selected( $form_id, $form->ID, false ),
							esc_html( $form->post_title )
						);

				printf(
					'<select name="form_id">%s</select>', 
					implode( '', $dropdown_items ) 
				);
				
				submit_button( 
					__( 'Filter', 'cf7-storage' ), 
					'button', 
					'filter-entries', 
					false, 
					array( 'id' => 'entries-query-submit' ) 
				);

				printf(
					' %s ',
					get_submit_button( 
						__( 'Export as CSV', 'cf7-storage' ), 
						'button', 
						'export-entries', 
						false, 
						array( 'id' => 'entries-export-all' ) 
					)
				);

			}

			if ( $this->is_trash && current_user_can( get_post_type_object( self::$storage_post_type )->cap->edit_others_posts ) ) {
				
				submit_button( 
					__( 'Empty Trash', 'cf7-storage' ), 
					'apply', 
					'delete_all', 
					false 
				);

			}

		?>
		</div>
		<?php

	}

}
