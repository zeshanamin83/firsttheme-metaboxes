<?php 

function firstthememetaboxes_add_meta_box() {
    add_meta_box( 
        'firstthememetaboxes_post_metabox', 
        'Post Settings', 
        'firstthememetaboxes_post_metabox_html', 
        'post', 
        'normal', 
        'default');
}

add_action( 'add_meta_boxes', 'firstthememetaboxes_add_meta_box' );

function firstthememetaboxes_post_metabox_html($post) {
    $subtitle = get_post_meta($post->ID, '_firstthememetaboxes_post_subtitle', true); 
    $layout = get_post_meta($post->ID, '_firstthememetaboxes_post_layout', true);     
    wp_nonce_field( 'firstthememetaboxes_update_post_metabox', 'firstthememetaboxes_update_post_nonce' );
    ?>
    <p>
        <label for="firstthememetaboxes_post_metabox_html"><?php esc_html_e( 'Post Subtitle', 'firstthememetaboxes' ); ?></label>
        <br />
        <input class="widefat" type="text" name="firstthememetaboxes_post_subtitle_field" id="firstthememetaboxes_post_metabox_html" value="<?php echo esc_attr( $subtitle ); ?>" />
    </p>
    <p>
        <label for="firstthememetaboxes_post_layout_field"><?php esc_html_e( 'Layout', 'firstthememetaboxes' ); ?></label>
        <select name="firstthememetaboxes_post_layout_field" id="firstthememetaboxes_post_layout_field" class="widefat">
            <option <?php selected( $layout, 'full' ); ?> value="full"><?php esc_html_e( 'Full Width', 'firstthememetaboxes' ); ?></option>
            <option <?php selected( $layout, 'sidebar' ); ?> value="sidebar"><?php esc_html_e( 'Post With Sidebar', 'firstthememetaboxes' ); ?></option>
        </select>
    </p>
    <?php 
} 

function firstthememetaboxes_save_post_metabox($post_id, $post) {

    $edit_cap = get_post_type_object( $post->post_type )->cap->edit_post; 
    if( !current_user_can( $edit_cap, $post_id )) {
        return;
    }   
    if( !isset( $_POST['firstthememetaboxes_update_post_nonce']) || !wp_verify_nonce( $_POST['firstthememetaboxes_update_post_nonce'], 'firstthememetaboxes_update_post_metabox' )) {
        return;
    }    
    
    if(array_key_exists('firstthememetaboxes_post_subtitle_field', $_POST)) {
        update_post_meta( 
            $post_id, 
            '_firstthememetaboxes_post_subtitle', 
            sanitize_text_field($_POST['firstthememetaboxes_post_subtitle_field']) 
        );
    } 
    
    if(array_key_exists('firstthememetaboxes_post_layout_field', $_POST)) {
        update_post_meta( 
            $post_id, 
            '_firstthememetaboxes_post_layout', 
            sanitize_text_field($_POST['firstthememetaboxes_post_layout_field']) 
        );
    }  
}

add_action( 'save_post', 'firstthememetaboxes_save_post_metabox', 10, 2 );