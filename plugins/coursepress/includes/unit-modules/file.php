<?php

class file_module extends Unit_Module {

	var $order = 5;
	var $name = 'file_module';
	var $label = 'File Download';
	var $description = '';
	const FRONT_SAVE = false;
	var $response_type = '';

	function __construct() {
		$this->on_create();
	}

	function file_module() {
		$this->__construct();
	}

	public static function front_main( $data ) {
		$data->name = __CLASS__;
		?>
		<div class="<?php echo $data->name; ?> front-single-module<?php echo( file_module::FRONT_SAVE == true ? '-save' : '' ); ?>">
			<?php if ( $data->post_title != '' && parent::display_title_on_front( $data ) ) { ?>
				<h2 class="module_title"><?php echo $data->post_title; ?></h2>
			<?php } ?>

			<?php
			if ( $data->file_url != '' ) {
				global $coursepress;

				require_once( $coursepress->plugin_dir . 'includes/classes/class.encryption.php' );
				$encryption = new CP_Encryption();

				$file_size = cp_get_file_size( $data->file_url );

				if ( $file_size > 0 ) {
					$filesize = '<small>(' . esc_html( $file_size ) . ')</small>';
				} else {
					$filesize = '';
				}

				$data->file_url = $encryption->encode( $data->file_url );
				$url            = trailingslashit( home_url() ) . '?fdcpf=' . $data->file_url;
				?>
				<div class="file_holder">
					<a href="<?php echo esc_url( $url ) ?>"/><?php echo( isset( $data->link_text ) ? $data->link_text : $data->post_title ); ?> <?php echo $filesize; ?></a>
				</div>
			<?php } ?>
		</div>
	<?php
	}

	function admin_main( $data ) {
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'media-upload' );
		?>

		<div class="<?php if ( empty( $data ) ) { ?>draggable-<?php } ?>module-holder-<?php echo $this->name; ?> module-holder-title" <?php if (empty( $data )) { ?>style="display:none;"<?php } ?>>

			<h3 class="module-title sidebar-name <?php echo( ! empty( $data->active_module ) ? 'is_active_module' : '' ); ?>" data-panel="<?php echo( ! empty( $data->panel ) ? $data->panel : '' ); ?>" data-id="<?php echo( ! empty( $data->ID ) ? $data->ID : '' ); ?>">
				<span class="h3-label">
					<span class="h3-label-left"><?php echo( isset( $data->post_title ) && $data->post_title !== '' ? $data->post_title : __( 'Untitled', 'cp' ) ); ?></span>
					<span class="h3-label-right"><?php echo $this->label; ?></span>
					<?php
					parent::get_module_move_link();
					?>
				</span>
			</h3>

			<div class="module-content">
				<input type="hidden" name="<?php echo $this->name; ?>_module_page[]" class="module_page" value="<?php echo( isset( $data->module_page ) ? $data->module_page : '' ); ?>"/>
				<input type="hidden" name="<?php echo $this->name; ?>_module_order[]" class="module_order" value="<?php echo( isset( $data->module_order ) ? $data->module_order : 999 ); ?>"/>
				<input type="hidden" name="module_type[]" value="<?php echo $this->name; ?>"/>
				<input type="hidden" name="<?php echo $this->name; ?>_id[]" class="unit_element_id" value="<?php echo esc_attr( isset( $data->ID ) ? $data->ID : '' ); ?>"/>

				<input type="hidden" class="element_id" value="<?php echo esc_attr( isset( $data->ID ) ? $data->ID : '' ); ?>"/>

				<label class="bold-label"><?php _e( 'Element Title', 'cp' ); ?></label>
				<?php echo $this->element_title_description(); ?>
				<input type="text" class="element_title" name="<?php echo $this->name; ?>_title[]" value="<?php echo esc_attr( isset( $data->post_title ) ? $data->post_title : '' ); ?>"/>

				<?php echo $this->show_title_on_front_element( $data ); ?>

				<div class="editor_in_place" style="display:none;">

					<?php
					$editor_name    = $this->name . "_content[]";
					$editor_id      = ( esc_attr( isset( $data->ID ) ? 'editor_' . $data->ID : rand( 1, 9999 ) ) );
					$editor_content = htmlspecialchars_decode( ( isset( $data->post_content ) ? $data->post_content : '' ) );

					$args = array(
						"textarea_name" => $editor_name,
						"textarea_rows" => 5,
						"quicktags"     => true,
						"teeny"         => false,
						"editor_class"  => 'cp-editor cp-unit-element',
					);

					$args = apply_filters( 'coursepress_element_editor_args', $args, $editor_name, $editor_id );

					wp_editor( $editor_content, $editor_id, $args );
					?>
				</div>


				<div class="file_url_holder">
					<label><?php _e( 'Link Text', 'cp' ); ?>
						<input type="text" name="<?php echo $this->name; ?>_link_text[]" value="<?php echo esc_attr( isset( $data->link_text ) ? $data->link_text : __( 'Download', 'cp' ) ); ?>"/>
					</label>

					<label><?php _e( 'Enter a URL or Browse for a file.', 'cp' ); ?>
						<input class="file_url" type="text" size="36" name="<?php echo $this->name; ?>_file_url[]" value="<?php echo esc_attr( ( isset( $data->file_url ) ? $data->file_url : '' ) ); ?>"/>
						<input class="file_url_button" type="button" value="<?php _e( 'Browse', 'cp' ); ?>"/>
					</label>
				</div>

				<?php
				parent::get_module_delete_link();
				?>
			</div>

		</div>

	<?php
	}

	function on_create() {
		$this->order       = apply_filters( 'coursepress_' . $this->name . '_order', $this->order );
		$this->description = __( 'Ask students to upload a file. Useful if students need to send you various files like essays, homework etc.', 'cp' );
		$this->label       = __( 'File Download', 'cp' );
		$this->save_module_data();
		parent::additional_module_actions();
	}

	function save_module_data() {
		global $wpdb, $last_inserted_unit_id, $save_elements;

		if ( isset( $_POST['module_type'] ) && ( $save_elements == true ) ) {

			foreach ( array_keys( $_POST['module_type'] ) as $module_type => $module_value ) {

				if ( $module_value == $this->name ) {
					$data                       = new stdClass();
					$data->ID                   = '';
					$data->unit_id              = '';
					$data->title                = '';
					$data->excerpt              = '';
					$data->content              = '';
					$data->metas                = array();
					$data->metas['module_type'] = $this->name;
					$data->post_type            = 'module';

					if ( isset( $_POST[ $this->name . '_id' ] ) ) {
						foreach ( $_POST[ $this->name . '_id' ] as $key => $value ) {
							$data->ID                       = $_POST[ $this->name . '_id' ][ $key ];
							$data->unit_id                  = ( ( isset( $_POST['unit_id'] ) and ( isset( $_POST['unit'] ) && $_POST['unit'] != '' ) ) ? $_POST['unit_id'] : $last_inserted_unit_id );
							$data->title                    = $_POST[ $this->name . '_title' ][ $key ];
							$data->metas['module_order']    = $_POST[ $this->name . '_module_order' ][ $key ];
							$data->metas['module_page']     = $_POST[ $this->name . '_module_page' ][ $key ];
							$data->metas['link_text']       = $_POST[ $this->name . '_link_text' ][ $key ];
							$data->metas['file_url']        = $_POST[ $this->name . '_file_url' ][ $key ];
							$data->metas['time_estimation'] = $_POST[ $this->name . '_time_estimation' ][ $key ];
							// if ( isset($_POST[$this->name . '_show_title_on_front'][$key]) ) {
							//     $data->metas['show_title_on_front'] = $_POST[$this->name . '_show_title_on_front'][$key];
							// } else {
							//     $data->metas['show_title_on_front'] = 'no';
							// }
							$data->metas['show_title_on_front'] = $_POST[ $this->name . '_show_title_field' ][ $key ];

							parent::update_module( $data );
						}
					}
				}
			}
		}
	}

}

cp_register_module( 'file_module', 'file_module', 'output' );
?>