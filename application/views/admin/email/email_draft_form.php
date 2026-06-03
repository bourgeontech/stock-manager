    <style>
        .card {
/*             background-color: #fff; */
            border-radius: 10px;
/*             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
/*             padding: 30px; */
/*             width: 800px; */
/*             margin: 0 auto; */
            margin-top: 50px;
        }
        .card h1 {
            text-align: center;
            color: #333;
        }
        .card label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        .card input[type="text"],
        .card textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .card textarea {
            height: 150px;
        }
        .card input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
            width: 100%;
        }
        .card input[type="submit"]:hover {
            background-color: #45a049;
        }

        .email-item {
            display: none;
        }
    	#emailList {
    		max-height: 200px;
        	overflow: scroll;
    	}
    </style>
<body>
    <div class="card w-50 mx-auto p-5">
        <h1>Draft Email</h1>
        <?php echo form_open(base_url('index.php/admin/email/send_bulk_email')); ?>
            <label for="email_subject">Subject:</label>
            <input type="text" id="email_subject" name="email_subject" required>

            <label for="email_content">Content:</label>
            <textarea id="email_content" name="email_content" rows="5" required></textarea>
    		<label for="sender_name">Sender Name:</label>
            <input type="text" id="sender_name" name="sender_name" class="mb-0" required>

    		<div id="accordion" class=" w-100">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0 w-100">
                    <button class="btn btn-link w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    	
                    	<div class="d-flex flex-row justify-content-between">
                        	<p class="m-0 p-0">Email Addresses</p> <i class="fa fa-plus mt-2"></i>
                    	</div>
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <input type="text" id="search" class="form-control mb-3" placeholder="Search Email">
                	<div>
                        <label><input type="checkbox" id="selectAll" checked> Select All</label><br>
                    </div>
                    <div id="emailList">
                    	<?php foreach($email_addresses as $email): ?>
                        <label><input type="checkbox" name="email[]" class="email-checkbox" value="<?php echo $email['email']; ?>" checked> <?php echo $email['email']; ?></label><br>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <input type="submit" value="Send Bulk Email">
        <?php echo form_close(); ?>
    </div>

	<script>
    $(document).ready(function() {
    	$('#accordion').
        // Function to filter and show matching emails first
        function filterEmails(value) {
            var $emailList = $('#emailList');
            $emailList.find('label').each(function() {
                var $label = $(this);
                var text = $label.text().toLowerCase();
                var match = text.indexOf(value) > -1;
                $label.toggle(match);
            });
            // Move matched emails to the top
            $emailList.find('label:visible').prependTo($emailList);
        }

        // Search functionality
        $('#search').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            filterEmails(value);
        });	
    
    	// Select all functionality
        $('#selectAll').on('change', function() {
            var checked = $(this).prop('checked');
            $('.email-checkbox').prop('checked', checked);
        });

        // Deselect "Select All" if any checkbox is unchecked
        $('#emailList').on('change', '.email-checkbox', function() {
            if (!$(this).prop('checked')) {
                $('#selectAll').prop('checked', false);
            } else {
                // Check if all checkboxes are checked
                if ($('.email-checkbox:checked').length === $('.email-checkbox').length) {
                    $('#selectAll').prop('checked', true);
                }
            }
        });
    });
</script>
</body>

