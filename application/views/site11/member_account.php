
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Lookup</title>
    <!-- Add any CSS styles here -->
</head>
<body>
    <h1>Enter Mobile Number and Membership ID</h1>
	<form action="<?php echo site_url('membership_controller/memberAccount'); ?>" method="post">
        <label for="mobile_number">Mobile Number:</label>
        <input type="text" name="mobile_number" id="mobile_number" required><br><br>

        <label for="membership_id">Membership ID:</label>
        <input type="text" name="membership_id" id="membership_id" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
