<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email"><br>
    <input type="radio" id="yes" name="response" value="yes">
    <label for="yes">Yes</label><br>
    <input type="radio" id="no" name="response" value="no">
    <label for="no">No</label><br>
    <input type="submit" value="Submit">
</form>
