<section id="room-booking">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Room Images</h5>
                        <div class="image-gallery">
                            <div class="card mb-3">
                                <img src="<?php echo base_url(); ?>/assets/singlepage/img/room1.jpg" class="card-img-top" alt="Room Image 1">
                            </div>
                            <div class="card mb-3">
                                <img src="<?php echo base_url(); ?>/assets/singlepage/img/room2.jpg" class="card-img-top" alt="Room Image 2">
                            </div>
                            <div class="card mb-3">
                                <img src="<?php echo base_url(); ?>/assets/singlepage/img/room3.jpg" class="card-img-top" alt="Room Image 3">
                            </div>
                         	<div class="card mb-3">
                                <img src="<?php echo base_url(); ?>/assets/singlepage/img/room4.jpg" class="card-img-top" alt="Room Image 4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Request For Room</h2>
                        <?php echo form_open('welcome/book_room'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?php echo form_label('Your Name', 'name', ['class' => 'form-label']); ?>
                                        <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'required' => 'required']); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?php echo form_label('Email Address', 'email', ['class' => 'form-label']); ?>
                                        <?php echo form_input(['type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control', 'required' => 'required']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?php echo form_label('Check-in Date', 'checkin-date', ['class' => 'form-label']); ?>
                                        <?php echo form_input(['type' => 'date', 'name' => 'checkin_date', 'id' => 'checkin-date', 'class' => 'form-control', 'required' => 'required']); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?php echo form_label('Check-out Date', 'checkout-date', ['class' => 'form-label']); ?>
                                        <?php echo form_input(['type' => 'date', 'name' => 'checkout_date', 'id' => 'checkout-date', 'class' => 'form-control', 'required' => 'required']); ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // Get references to check-in and check-out date inputs
                                const checkinDateInput = document.getElementById('checkin-date');
                                const checkoutDateInput = document.getElementById('checkout-date');

                                // Add event listener to check-out date input
                                checkoutDateInput.addEventListener('change', function() {
                                    const checkinDate = new Date(checkinDateInput.value);
                                    const checkoutDate = new Date(checkoutDateInput.value);

                                    // Check if check-out date is before check-in date
                                    if (checkoutDate < checkinDate) {
                                        alert('Checkout date cannot be before check-in date');
                                        checkoutDateInput.value = ''; // Clear check-out date input
                                    }
                                });
                            </script>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <?php echo form_label('Number of Adults', 'num-adults', ['class' => 'form-label']); ?>
                                        <?php echo form_input(['type' => 'number', 'name' => 'num_adults', 'id' => 'num-adults', 'class' => 'form-control', 'required' => 'required', 'min' => '1']); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <?php echo form_label('Number of Children', 'num-children', ['class' => 'form-label']); ?>
                                        <?php echo form_input(['type' => 'number', 'name' => 'num_children', 'id' => 'num-children', 'class' => 'form-control', 'required' => 'required', 'min' => '0']); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <?php echo form_label('Room Type', 'room-type', ['class' => 'form-label']); ?>
                                        <?php 
                                            $options = array(
                                                '' => 'Select Room Type',
                                                'A/C – Dormitory' => 'A/C – Dormitory',
                                                'Non A/C – Dormitory' => 'Non A/C – Dormitory',
                                            );
                                            echo form_dropdown('room_type', $options, '', ['id' => 'room-type', 'class' => 'form-control', 'required' => 'required']);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <?php echo form_label('Special Requests', 'special-requests', ['class' => 'form-label']); ?>
                                <?php echo form_textarea(['name' => 'special_requests', 'id' => 'special-requests', 'class' => 'form-control', 'rows' => '3']); ?>
                            </div>
                            <?php echo form_submit('submit', 'Submit Enquiry', ['class' => 'btn btn-primary']); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
