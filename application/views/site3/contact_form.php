<?php
$name = $email = $phone = $mobile = $message_text = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $mobile = $_POST["mobile"];
    $message_text = $_POST["message"];

    $recipient_email = $contact[0]['email'];
    $subject = "Contact Enquiry from $name";

    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Phone No: $phone\n";
    $email_body .= "Mobile No: $mobile\n";
    $email_body .= "Message:\n$message_text";

    $headers = "From: $email\r\n";
    if (mail($recipient_email, $subject, $email_body, $headers)) {
        $message = "Thank you! Your message has been sent.";
    } else {
        $message = "Error: Unable to send the email. Please try again later.";
    }
}
?>

<section class="slide_part">
      <div class="container">
        <div class="row">
          <div class='col-md-12'>
            <div class='homeslider'>
                <img class='img-fluid maxheight' title='' alt='' src='<?php echo base_url(); ?>/assets/site3/images/ibaner1.jpg'> 
            </div>
          </div>
        </div>  
      </div>

</section>

<div class="clearfix"></div>
<section class="site_inner">
    <div class="container">
        <div class="home_welcome">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home_main_block mb-4 text-center">
                        <?php if (!empty($message)): ?>
                            <h2 class="inner-title m-4"><?php echo $message; ?></h2>
                        <?php endif; ?>
                        <div class='inner_pak'>
                            <div class='row'>
                                <div class='col-md-12 events'>

                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
