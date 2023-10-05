<?php


global $wpdb;
$table_name = $wpdb->prefix . 'my_plugin';

$results = $wpdb->get_results("SELECT * FROM $table_name");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Bootstrap Table</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Response</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    foreach ($results as $row) {
                    ?>
                        <td><?php echo $row->id ?> </td>
                        <td><?php echo $row->email ?></td>
                        <td><?php echo $row->response ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

<!-- <div class="wp-list-table widefat fixed striped table-view-list posts">
    <h1 class="wp-heading-inline">My Plugin Data</h1>
    <hr class="wp-header-end">
    <table>
    <tr><th>ID</th><th>Email</th><th>Response</th></tr>
<?php
foreach ($results as $row) {
?>
        <tr>
        <td> <?php echo $row->id ?> </td>
        <td><?php echo $row->email ?></td>
        <td><?php echo $row->response ?></td>
        </tr>
    <?php } ?>
    </table>
    </div> -->

<?php echo ob_get_clean();
//    return $results;
