<?php

/*
Plugin Name: Custom Agent
Description: A plugin to manage and display agents with custom fields and modals.
Version: 1.0
Author: Your Name
*/

// Register Custom Post Type
function custom_agent_post_type() {
    $labels = array(
        'name'                  => _x( 'Agents', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Agent', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Agents', 'text_domain' ),
        'name_admin_bar'        => __( 'Agent', 'text_domain' ),
        'archives'              => __( 'Agent Archives', 'text_domain' ),
        'attributes'            => __( 'Agent Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Agent:', 'text_domain' ),
        'all_items'             => __( 'All Agents', 'text_domain' ),
        'add_new_item'          => __( 'Add New Agent', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Agent', 'text_domain' ),
        'edit_item'             => __( 'Edit Agent', 'text_domain' ),
        'update_item'           => __( 'Update Agent', 'text_domain' ),
        'view_item'             => __( 'View Agent', 'text_domain' ),
        'view_items'            => __( 'View Agents', 'text_domain' ),
        'search_items'          => __( 'Search Agent', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into agent', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this agent', 'text_domain' ),
        'items_list'            => __( 'Agents list', 'text_domain' ),
        'items_list_navigation' => __( 'Agents list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter agents list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Agent', 'text_domain' ),
        'description'           => __( 'Custom Post Type for agents', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title','editor'),
        'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
		'menu_icon'             => 'dashicons-businessman', 
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'agent', $args );
}
add_action( 'init', 'custom_agent_post_type', 0 );

// Add Meta Boxes
function custom_agent_meta_boxes() {
    add_meta_box(
        'agent_meta_box',
        'Agent Details',
        'custom_agent_meta_box_callback',
        'agent',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'custom_agent_meta_boxes' );

function custom_agent_meta_box_callback( $post ) {
    wp_nonce_field( 'save_agent_details', 'agent_meta_box_nonce' );

    $name = get_post_meta( $post->ID, '_agent_name', true );
    $id = get_post_meta( $post->ID, '_agent_id', true );
    $rating = get_post_meta( $post->ID, '_agent_rating', true );
    $whatsapp = get_post_meta( $post->ID, '_agent_whatsapp', true );
    $phone = get_post_meta( $post->ID, '_agent_phone', true );
    $admin_id = get_post_meta( $post->ID, '_agent_admin_id', true );
    $admin_whatsapp = get_post_meta( $post->ID, '_agent_admin_whatsapp', true );
    $subadmin_id = get_post_meta( $post->ID, '_agent_subadmin_id', true );
    $subadmin_whatsapp = get_post_meta( $post->ID, '_agent_subadmin_whatsapp', true );
    $superadmin_id = get_post_meta( $post->ID, '_agent_superadmin_id', true );
    $superadmin_whatsapp = get_post_meta( $post->ID, '_agent_superadmin_whatsapp', true );

    echo '<div class="my-3">';
    echo '<label for="agent_name" class="form-label">Name: </label>';
    echo '<input type="text" id="agent_name" name="agent_name" class="form-control" value="' . esc_attr( $name ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_id" class="form-label">ID: </label>';
    echo '<input type="text" id="agent_id" name="agent_id" class="form-control" value="' . esc_attr( $id ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_rating" class="form-label">Rating: </label>';
    echo '<input type="number" id="agent_rating" name="agent_rating" class="form-control" value="' . esc_attr( $rating ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_whatsapp" class="form-label">WhatsApp Number: </label>';
    echo '<input type="text" id="agent_whatsapp" name="agent_whatsapp" class="form-control" value="' . esc_attr( $whatsapp ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_phone" class="form-label">Phone Number: </label>';
    echo '<input type="text" id="agent_phone" name="agent_phone" class="form-control" value="' . esc_attr( $phone ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_admin_id" class="form-label">Admin ID: </label>';
    echo '<input type="text" id="agent_admin_id" name="agent_admin_id" class="form-control" value="' . esc_attr( $admin_id ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_admin_whatsapp" class="form-label">Admin WhatsApp Number: </label>';
    echo '<input type="text" id="agent_admin_whatsapp" name="agent_admin_whatsapp" class="form-control" value="' . esc_attr( $admin_whatsapp ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_subadmin_id" class="form-label">Subadmin ID: </label>';
    echo '<input type="text" id="agent_subadmin_id" name="agent_subadmin_id" class="form-control" value="' . esc_attr( $subadmin_id ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_subadmin_whatsapp" class="form-label">Subadmin WhatsApp Number: </label>';
    echo '<input type="text" id="agent_subadmin_whatsapp" name="agent_subadmin_whatsapp" class="form-control" value="' . esc_attr( $subadmin_whatsapp ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_superadmin_id" class="form-label">Super Admin ID: </label>';
    echo '<input type="text" id="agent_superadmin_id" name="agent_superadmin_id" class="form-control" value="' . esc_attr( $superadmin_id ) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="my-3">';
    echo '<label for="agent_superadmin_whatsapp" class="form-label">Super Admin WhatsApp Number: </label>';
    echo '<input type="text" id="agent_superadmin_whatsapp" name="agent_superadmin_whatsapp" class="form-control" value="' . esc_attr( $superadmin_whatsapp ) . '" size="25" />';
    echo '</div>';
}

function save_agent_details( $post_id ) {
    if ( ! isset( $_POST['agent_meta_box_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['agent_meta_box_nonce'], 'save_agent_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( ! isset( $_POST['agent_name'] ) || ! isset( $_POST['agent_id'] ) || ! isset( $_POST['agent_rating'] ) || ! isset( $_POST['agent_whatsapp'] ) || ! isset( $_POST['agent_phone'] ) || ! isset( $_POST['agent_admin_id'] ) || ! isset( $_POST['agent_admin_whatsapp'] ) || ! isset( $_POST['agent_subadmin_id'] ) || ! isset( $_POST['agent_subadmin_whatsapp'] ) || ! isset( $_POST['agent_superadmin_id'] ) || ! isset( $_POST['agent_superadmin_whatsapp'] ) ) {
        return;
    }

    $name = sanitize_text_field( $_POST['agent_name'] );
    $id = sanitize_text_field( $_POST['agent_id'] );
    $rating = sanitize_text_field( $_POST['agent_rating'] );
    $whatsapp = sanitize_text_field( $_POST['agent_whatsapp'] );
    $phone = sanitize_text_field( $_POST['agent_phone'] );
    $admin_id = sanitize_text_field( $_POST['agent_admin_id'] );
    $admin_whatsapp = sanitize_text_field( $_POST['agent_admin_whatsapp'] );
    $subadmin_id = sanitize_text_field( $_POST['agent_subadmin_id'] );
    $subadmin_whatsapp = sanitize_text_field( $_POST['agent_subadmin_whatsapp'] );
    $superadmin_id = sanitize_text_field( $_POST['agent_superadmin_id'] );
    $superadmin_whatsapp = sanitize_text_field( $_POST['agent_superadmin_whatsapp'] );

    update_post_meta( $post_id, '_agent_name', $name );
    update_post_meta( $post_id, '_agent_id', $id );
    update_post_meta( $post_id, '_agent_rating', $rating );
    update_post_meta( $post_id, '_agent_whatsapp', $whatsapp );
    update_post_meta( $post_id, '_agent_phone', $phone );
    update_post_meta( $post_id, '_agent_admin_id', $admin_id );
    update_post_meta( $post_id, '_agent_admin_whatsapp', $admin_whatsapp );
    update_post_meta( $post_id, '_agent_subadmin_id', $subadmin_id );
    update_post_meta( $post_id, '_agent_subadmin_whatsapp', $subadmin_whatsapp );
    update_post_meta( $post_id, '_agent_superadmin_id', $superadmin_id );
    update_post_meta( $post_id, '_agent_superadmin_whatsapp', $superadmin_whatsapp );
}
add_action( 'save_post', 'save_agent_details' );




// Disable custom fields for all post types
function disable_custom_fields_meta_box() {
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('postcustom', 'agent', 'normal');
    // Add more post types if necessary
    $post_types = get_post_types(array('public' => true), 'names');
    foreach ($post_types as $post_type) {
        remove_meta_box('postcustom', $post_type, 'normal');
    }
}
add_action('admin_menu', 'disable_custom_fields_meta_box');



// Shortcode for the Search Form
function custom_search_form_shortcode() {
    ob_start();
    ?>
    <form method="GET" id="search_form_id" action="<?php echo home_url('/search-results'); ?>">
		
        <label for="category">Type</label>
        <?php
        wp_dropdown_categories(array(
            'show_option_all' => 'All',
            'name' => 'category',
            'taxonomy' => 'category'
        ));
        ?>
        
		<label for="id">Search By Agent ID</label>
        <input type="text" name="id" id="id" placeholder="Agent ID Number">
		
		
        <label for="whatsapp_number">Search by Whatsappr</label>
        <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Phone Number">
        
        
        <div class="mt-3 text-end">
        <input type="submit" value="Search">
		</div>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_search_form', 'custom_search_form_shortcode');

// Shortcode for Displaying Search Results
function custom_search_results_shortcode() {
    if (isset($_GET['category']) || isset($_GET['whatsapp_number']) || isset($_GET['id'])) {
        $category = sanitize_text_field($_GET['category']);
        $whatsapp_number = sanitize_text_field($_GET['whatsapp_number']);
        $id = sanitize_text_field($_GET['id']);
        
        $args = array(
            'post_type' => 'agent',
            'meta_query' => array(
                'relation' => 'AND',
            ),
        );
        
        if ($category && $category != '0') {
            $args['cat'] = $category;
        }
        
        if ($whatsapp_number) {
            $args['meta_query'][] = array(
                'key' => '_agent_whatsapp',
                'value' => $whatsapp_number,
                'compare' => 'LIKE',
            );
        }
        
        if ($id) {
            $args['meta_query'][] = array(
                'key' => '_agent_id',
                'value' => $id,
                'compare' => 'LIKE',
            );
        }
        
        $query = new WP_Query($args);
        
        ob_start();
      if ( $query->have_posts() ) {
    echo '<div class="table-responsive"> <table class="table  table-striped agent_table">';
    echo '<thead><tr><th>Name</th><th>ID</th><th>Rating</th><th>WhatsApp</th><th>Phone</th><th>View</th><th>Report</th></tr></thead>';
    echo '<tbody>';

    while ( $query->have_posts() ) {
        $query->the_post();

        $name = get_post_meta( get_the_ID(), '_agent_name', true );
        $id = get_post_meta( get_the_ID(), '_agent_id', true );
        $rating = get_post_meta( get_the_ID(), '_agent_rating', true );
        $whatsapp = get_post_meta( get_the_ID(), '_agent_whatsapp', true );
        $phone = get_post_meta( get_the_ID(), '_agent_phone', true );

        echo '<tr>';
        echo '<td>  <div class="d-flex justify-content-start">
        <div class="agent d-flex align-items-center gap-2">
          
          <p class="agent_name">'
            . esc_html( $name ) . ' <br>
            <span>'. get_the_category($post->ID)[0]->name .'</span>
          </p>
        </div>

      </div> </td>';
        echo '<td> <div class="agent-id"> <p> ID </p> <p>' . esc_html( $id ) . '</p> </div></td>';
        echo '<td> <div class="d-flex justify-content-center stars-box">';
$rating = intval($rating); // Ensure rating is converted to integer
for ($i = 0; $i < 5; $i++) {
    if ($i < $rating) {
        echo '<i class="fa-solid fa-star"></i>';
    } else {
        echo '<i class="fa-regular fa-star"></i>';
    }
}
echo '</div> </td>';
        echo '<td><a href="https://wa.me/' . esc_html( $whatsapp ) . '" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></td>';
        echo '<td> <div class="d-flex justify-content-center">
        <div class="number-box d-flex align-items-start flex-column"> <p>' . esc_html( $phone ) . '</p> <span class="my-badge">Whatsapp</span> </div> </div> </td>';
        echo '<td>
                <div class="d-flex justify-content-center">
                    <i class="fa-solid fa-eye view-agent" role="button" data-bs-toggle="modal" data-bs-target="#agentInfo"  data-id="' . get_the_ID() . '"></i>
                </div>
            </td>';

          

        echo '<td>
                <div class="d-flex justify-content-center">
                    <button class="tiny-buttons red report-agent" data-bs-toggle="modal" data-bs-target="#AgentReport"  data-id="' . get_the_ID() . '">Report</button>
                </div>
            </td>';
        
        echo '</tr>';
    }
    echo '</tbody></table> </div>';
} else {
    echo '<p>No agents found.</p>';
}

        return ob_get_clean();
    }
}
add_shortcode('custom_search_results', 'custom_search_results_shortcode');





// Display Agents List Shortcode
function display_agents_list( $atts ) {
$atts = shortcode_atts(
array(
'category' => '',
),
$atts,'agent_list'
);
$query_args = array(
    'post_type' => 'agent',
    'posts_per_page' => -1,
);

if ( ! empty( $atts['category'] ) ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $atts['category'],
        ),
    );
}

$query = new WP_Query( $query_args );

ob_start();

global $post;
setup_postdata($post);

if ( $query->have_posts() ) {
    echo '<div class="table-responsive"> <table class="table  table-striped agent_table">';
    echo '<thead><tr><th>Name</th><th>ID</th><th>Rating</th><th>WhatsApp</th><th>Phone</th><th>View</th><th>Report</th></tr></thead>';
    echo '<tbody>';

    while ( $query->have_posts() ) {
        $query->the_post();

        $name = get_post_meta( get_the_ID(), '_agent_name', true );
        $id = get_post_meta( get_the_ID(), '_agent_id', true );
        $rating = get_post_meta( get_the_ID(), '_agent_rating', true );
        $whatsapp = get_post_meta( get_the_ID(), '_agent_whatsapp', true );
        $phone = get_post_meta( get_the_ID(), '_agent_phone', true );

        echo '<tr>';
        echo '<td>  <div class="d-flex justify-content-start">
        <div class="agent d-flex align-items-center gap-2">
          
          <p class="agent_name">'
            . esc_html( $name ) . ' <br>
            <span>'. get_the_category($post->ID)[0]->name .'</span>
          </p>
        </div>

      </div> </td>';
        echo '<td> <div class="agent-id"> <p> ID </p> <p>' . esc_html( $id ) . '</p> </div></td>';
        echo '<td> <div class="d-flex justify-content-center stars-box">';
$rating = intval($rating); // Ensure rating is converted to integer
for ($i = 0; $i < 5; $i++) {
    if ($i < $rating) {
        echo '<i class="fa-solid fa-star"></i>';
    } else {
        echo '<i class="fa-regular fa-star"></i>';
    }
}
echo '</div> </td>';
        echo '<td><a href="https://wa.me/' . esc_html( $whatsapp ) . '" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></td>';
        echo '<td> <div class="d-flex justify-content-center">
        <div class="number-box d-flex align-items-start flex-column"> <p>' . esc_html( $phone ) . '</p> <span class="my-badge">Whatsapp</span> </div> </div> </td>';
        echo '<td>
                <div class="d-flex justify-content-center">
                    <i class="fa-solid fa-eye view-agent" role="button" data-bs-toggle="modal" data-bs-target="#agentInfo"  data-id="' . get_the_ID() . '"></i>
                </div>
            </td>';

          

        echo '<td>
                <div class="d-flex justify-content-center">
                    <button class="tiny-buttons red report-agent" data-bs-toggle="modal" data-bs-target="#AgentReport"  data-id="' . get_the_ID() . '">Report</button>
                </div>
            </td>';
        
        echo '</tr>';
    }
    echo '</tbody></table> </div>';
} else {
    echo '<p>No agents found.</p>';
}

wp_reset_postdata();

return ob_get_clean();
}
add_shortcode( 'agent_list', 'display_agents_list' );



// Enqueue Scripts and Styles
function custom_agent_list_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_script('agent-js', plugin_dir_url(__FILE__) . 'js/agent.js', array('jquery'), null, true);

    // Localize the AJAX URL
    wp_localize_script('agent-js', 'agent_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('agent-ajax-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'custom_agent_list_scripts');
// AJAX handler for viewing agent details
add_action('wp_ajax_view_agent_details', 'view_agent_details');
add_action('wp_ajax_nopriv_view_agent_details', 'view_agent_details');

// Displaying Agent Details in the Modal
function view_agent_details() {
    check_ajax_referer('agent-ajax-nonce', 'security');

    $post_id = intval($_POST['post_id']);

    $details = array(
        'name'                => get_post_meta($post_id, '_agent_name', true),
        'category'            => get_the_category($post_id)[0]->name,
        'number'              => get_post_meta($post_id, '_agent_phone', true),
        'id'                  => get_post_meta($post_id, '_agent_id', true),
        'whatsapp_link'       => 'https://wa.me/' . get_post_meta($post_id, '_agent_whatsapp', true),
        'rating'              => get_post_meta($post_id, '_agent_rating', true),
        'admin_id'            => get_post_meta($post_id, '_agent_admin_id', true),
        'admin_whatsapp'      => get_post_meta($post_id, '_agent_admin_whatsapp', true),
        'subadmin_id'         => get_post_meta($post_id, '_agent_subadmin_id', true),
        'subadmin_whatsapp'   => get_post_meta($post_id, '_agent_subadmin_whatsapp', true),
        'superadmin_id'       => get_post_meta($post_id, '_agent_superadmin_id', true),
        'superadmin_whatsapp' => get_post_meta($post_id, '_agent_superadmin_whatsapp', true),
    );

    wp_send_json_success($details);
    wp_die();
}

// Reporting Agent via AJAX
function report_agent() {
    check_ajax_referer('agent-ajax-nonce', 'security');

    $post_id = intval($_POST['post_id']);
    $report_type = sanitize_text_field($_POST['report_type']);

    // Logic for reporting the agent (e.g., sending an email, saving to database)
    // For demonstration, we'll return a success message
    $response = array(
        'success' => true,
        'data'    => array('message' => 'Agent reported successfully.')
    );

    wp_send_json($response);
    wp_die();
}

// Modifying the Agent Modals
add_action( 'wp_footer', 'custom_agent_modals' );
function custom_agent_modals() {
?>


<!-- Modal -->
<div class="modal fade" id="agentInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-user-circle" aria-hidden="true"></i></h1>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
       <div class="row">

        <div class="col-md-6">
                        <div class="d-flex d-flex flex-column">
                            <p class="fake-label">Name</p>
                            <p class="fake-input detail-name"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex d-flex flex-column">
                            <p class="fake-label">Type</p>
                            <p class="fake-input detail-type"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex d-flex flex-column">
                            <p class="fake-label">Number</p>
                            <p class="fake-input detail-number"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex d-flex flex-column">
                            <p class="fake-label">Id Number</p>
                            <p class="fake-input detail-id"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex d-flex flex-column">
                            <p class="fake-label">Message</p>
                            <div class="d-flex flex-row">
                                <a class="modal-links detail-wa" href="#" target="_blank"><i class="fa-brands fa-whatsapp"></i> Whatsapp</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex d-flex flex-column">
                            <p class="fake-label">Rating</p>
                            <p class="fake-input detail-rating d-flex justify-content-center flex-row"></p>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="d-flex flex-row detail-subs">
                            <button class="tiny-buttons yellow">Admin ID: <span class="detail-admin detail-admin-id"></span></button>
                            <button class="tiny-buttons yellow">Sub Admin ID: <span class="detail-subadmin detail-subadmin-id"></span></button>
                            <button class="tiny-buttons yellow">Super Admin ID: <span class="detail-superadmin detail-superadmin-id"></span></button>
                        </div>
                    </div>
           
       </div>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="AgentReport" tabindex="-1" aria-labelledby="ReportAgentLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header position-relative">
        <div class="modal-icon">
         <i class="fa fa-user-circle-o" aria-hidden="true"></i>
        </div>
        <button class="tiny-buttons red modal-report-heading">Report This Person</button>
        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row position-relative">
        <div class="col-md-6">
          <div class="d-flex d-flex flex-column">
            <p class="fake-label">Name</p>
            <p class="fake-input detail-name"></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex d-flex flex-column">
            <p class="fake-label">Type</p>
            <p class="fake-input detail-type"></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex d-flex flex-column">
            <p class="fake-label">Number</p>
            <p class="fake-input detail-number"></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="d-flex d-flex flex-column">
            <p class="fake-label">Id Number</p>
            <p class="fake-input detail-id"></p>
          </div>
        </div>
        <div class="col-md-12 d-flex flex-row justify-content-center" id="ReportTo">
          <div class="d-flex flex-column mt-2 me-2 report-to-button-box admin-button-box">
            <p class="text-center">ADMIN ID : <span class="detail-admin detail-admin-id"></span></p>
            <a href="#" class="report-to-buttons detail-admin-whatsapp">Report To Admin</a>
          </div>
          <div class="d-flex flex-column mt-2 me-2 report-to-button-box subadmin-button-box">
            <p class="text-center">SUB ADMIN ID : <span class="detail-subadmin detail-subadmin-id"></span></p>
            <a href="#" class="report-to-buttons detail-subadmin-whatsapp">Report To Sub admin</a>
          </div>
          <div class="d-flex flex-column mt-2  report-to-button-box superadmin-button-box">
            <p class="text-center">SUPER ID : <span class="detail-superadmin detail-superadmin-id"></span></p>
            <a href="#" class="report-to-buttons detail-superadmin-whatsapp">Report To Super</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
}
