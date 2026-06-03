
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Details</title>
    <!-- Add any CSS styles here -->
</head>
<body>
    <h1>Membership Details</h1>
    <?php if ($membership): ?>
        <p><strong>Membership ID:</strong> <?php echo $membership->membership_id; ?></p>
        <p><strong>Name:</strong> <?php echo $membership->name; ?></p>
        <p><strong>Email:</strong> <?php echo $membership->email; ?></p>
        <p><strong>Mobile Number:</strong> <?php echo $membership->mobile_number; ?></p>
        <!-- Add more details here as needed -->
    <?php else: ?>
        <p>No membership found for the provided mobile number and membership ID.</p>
    <?php endif; ?>
</body>
</html>
