<?php
/*
Plugin Name: Own Contact Form
Description: A plugin that collects data from users
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    header('Location: /wordpress');
    die('');
}
function own_plugin_activation()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'my_plugin';

    $q = "CREATE TABLE `$wp_emp` (`id` int NOT NULL AUTO_INCREMENT, `email` varchar(50) NOT NULL, `response` text NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";


    $wpdb->query($q);

    // $q = "INSERT INTO `$wp_emp` (`Name`, `Email`, `Stauts`) VALUES ('Basit ali', 'a@gmail.com', '1');";
    // insert code 
    $data = array(
        'Email' => 'a@gmail.com',
        'Response' => 'Yes',
    );
    $wpdb->insert($wp_emp, $data);
}

register_activation_hook(__FILE__, 'own_plugin_activation');

function own_plugin_deactivation()
{
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix . 'my_plugin';
    $q = "DROP TABLE `wordpress`.`$wp_emp`";

    $wpdb->query($q);
}

register_deactivation_hook(__FILE__, 'own_plugin_deactivation');

function display_my_form()
{
    ob_start();
    include(plugin_dir_path(__FILE__) . 'my_form.php');
    return ob_get_clean();
}
add_shortcode('my_form', 'display_my_form');


function handle_form_submission()
{
    if (!empty($_POST)) {
        global $wpdb, $table_prefix;
        $wp_emp = $table_prefix . 'my_plugin';

        $email = $_POST['email'];
        $response = $_POST['response'];

        $data = array(
            'email' => $email,
            'response' => $response
        );

        $format = array(
            '%s',
            '%s'
        );

        $success = $wpdb->insert($wp_emp, $data, $format);

        if ($success) {
            echo 'Data has been saved';
        }
    }
}
add_action('init', 'handle_form_submission');


function display_my_plugin_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'my_plugin';

    $results = $wpdb->get_results("SELECT * FROM $table_name");

    $output = '<table>';
    $output .= '<tr><th>ID</th><th>Email</th><th>Response</th></tr>';

    foreach ($results as $row) {
        $output .= '<tr>';
        $output .= '<td>' . $row->id . '</td>';
        $output .= '<td>' . $row->email . '</td>';
        $output .= '<td>' . $row->response . '</td>';
        $output .= '</tr>';
    }

    $output .= '</table>';

    return $output;
}
add_shortcode('my_plugin_data', 'display_my_plugin_data');



function my_plugin_display_page()
{
    include 'data-display.php';
}


function my_plugin_add_menu_item()
{
    add_menu_page('My Plugin Data', 'My Plugin Data', 'manage_options', 'my-plugin-data', 'my_plugin_display_page', 'dashicons-admin-generic', 6);
}
add_action('admin_menu', 'my_plugin_add_menu_item');
