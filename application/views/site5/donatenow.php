<style>
#room-booking {
    background-color: #f9f9f9;
    padding: 50px 0;
}

#room-booking .container {
    max-width: 600px;
}

#room-booking form {
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

#room-booking .form-group {
    margin-bottom: 20px;
}

#room-booking label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

#room-booking input[type="text"] {
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    border: 1px solid #ccc;
}
#room-booking input[type="number"] {
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    border: 1px solid #ccc;
}

#room-booking input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

#room-booking input[type="submit"]:hover {
    background-color: #45a049;
}

</style>
<section id="room-booking">
    <div class="container">
        <div class="row justify-content-center">
            <form action="<?php echo site_url('welcome/submit_donation'); ?>" method="post">
            <div class="form-group">
                <label for="beneficiary-name">Beneficiary Name:</label>
                <input type="text" id="beneficiary-name" name="beneficiary-name" required>
            </div>
            <div class="form-group">
                <label for="mobile-number">Mobile Number:</label>
                <input type="text" id="mobile-number" name="mobile-number" required>
            </div>
            <div class="form-group">
                <label for="birth-star">Birth Star (Panchangam):</label>
                <input type="text" id="birth-star" name="birth-star">
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" min="1" name="amount" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
        </div>
    </div>
</section>