<?php
/**
 * Plugin Name: SuperPluginByChatGPT2
 * Description: Shows statistics about all users to logged-in users.
 * Version: 1.0
 * Author: Your Name
 * License: GPL2
 */

class SuperPluginByChatGPT2 {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_stats_page' ) );
    }

    public function add_stats_page() {
        add_menu_page(
            'User Statistics',
            'User Stats',
            'read',
            'user-stats',
            array( $this, 'display_stats' ),
            'dashicons-chart-bar',
            3
        );
    }

    public function display_stats() {
        if ( ! current_user_can( 'read' ) ) {
            wp_die( 'You do not have sufficient permissions to access this page.' );
        }
        
        $user_count = count_users();
        $total_users = $user_count['total_users'];
        $admin_users = $user_count['avail_roles']['administrator'];
        $editor_users = $user_count['avail_roles']['editor'];
        $author_users = $user_count['avail_roles']['author'];
        $subscriber_users = $user_count['avail_roles']['subscriber'];
        
        echo '<div class="wrap">';
        echo '<h1>User Statistics</h1>';
        echo '<table>';
        echo '<tr><th>Role</th><th>Number of Users</th></tr>';
        echo '<tr><td>Administrator</td><td>'.$admin_users.'</td></tr>';
        echo '<tr><td>Editor</td><td>'.$editor_users.'</td></tr>';
        echo '<tr><td>Author</td><td>'.$author_users.'</td></tr>';
        echo '<tr><td>Subscriber</td><td>'.$subscriber_users.'</td></tr>';
        echo '<tr><th>Total</th><th>'.$total_users.'</th></tr>';
        echo '</table>';
        echo '</div>';
    }
}

new SuperPluginByChatGPT2();
