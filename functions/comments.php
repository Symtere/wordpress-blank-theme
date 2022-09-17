<?php

/**
 * For example, copy the following to "wp-content/mu-plugins/disable-comments.php"
 * to use it as a "must-use plugin" (always-on and before "normals" plugins)
 */

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
        wp_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }

    // Remove from admin bar
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page and option page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
});

// Disable specific endpoints REST API
if ( !is_admin() ) {

    add_filter( 'rest_endpoints', function( $endpoints ) {
        if ( isset( $endpoints['/wp/v2/comments'] ) ) {
            unset( $endpoints['/wp/v2/comments'] );
        }
        if ( isset( $endpoints['/wp/v2/comments/(?P<id>[\d]+)'] ) ) {
            unset( $endpoints['/wp/v2/comments/(?P<id>[\d]+)'] );
        }
        return $endpoints;
    });
}

// Disable all REST API endpoints
// add_filter('rest_enabled', '_return_false');
// add_filter('rest_jsonp_enabled', '_return_false');
