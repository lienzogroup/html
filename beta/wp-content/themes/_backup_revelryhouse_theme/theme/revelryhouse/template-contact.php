<?php
/**
 *
 * Template Name: Contact
 * Description: Template for the contact page, with custom contact form.
 *
 */

get_header(); ?>

<?php
if(isset($_POST['submitted'])) {
  if(trim($_POST['contactName']) === '') {
    $nameError = 'Please enter your name.';
    $hasError = true;
  } else {
    $name = trim($_POST['contactName']);
  }

  if(trim($_POST['email']) === '')  {
    $emailError = 'Please enter your email address.';
    $hasError = true;
  } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
    $emailError = 'You entered an invalid email address.';
    $hasError = true;
  } else {
    $email = trim($_POST['email']);
  }

  if(trim($_POST['comments']) === '') {
    $commentError = 'Please enter a message.';
    $hasError = true;
  } else {
    if(function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['comments']));
    } else {
      $comments = trim($_POST['comments']);
    }
  }

  if(!isset($hasError)) {
    $emailTo = $data['text_contact_email'];
    
    $name = esc_sql($_POST["contactName"]);
    $email = esc_sql($_POST["email"]);
    $comments = esc_html($_POST["comments"]);
    
    $subject = 'Contact Form Message';
    $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
    $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

    mail($data["text_contact_email"], $subject, $body, $headers);
    $emailSent = true;
  }

} ?>

  <section class="middle">
    
    <div class="row">
      
      <header id="page-title" class="span12">
        <div class="ribbon">
          <h1><span><?php the_title();?></span></h1>
        </div><!-- end .ribbon -->
      </header>
            
    </div><!-- end .row -->
            
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
    <div class="row">
              	
      <div class="span12">
      
        <?php the_content(); ?>
      
      </div>
              	
    </div><!-- end .row -->
              	
              	
    <section id="contact-details" class="row">
    
    	<div class="span6">

      <?php if(isset($emailSent) && $emailSent == true) { ?>
      <div class="thanks">
        <p>Thank You, your enquiry was sent successfully.</p>
      </div>
      <?php } else { ?>
      

      <form action="<?php the_permalink(); ?>" id="custom-contact-form" method="post">
        
          <label for="contactName"><?php echo __( 'Your Name:', 'reboot' ); ?></label>
          <input type="text" name="contactName" id="contactName" tabindex="1" placeholder="<?php echo __( 'Please enter your full name...', 'reboot' ); ?>" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField span6" />
          <?php if(isset($nameError) && $nameError != '') { ?>
            <span class="error"><?php echo $nameError; ?></span>
          <?php } ?>

          <label for="email"><?php echo __( 'Your Email:', 'reboot' ); ?></label>
          <input type="text" name="email" id="email" tabindex="2" placeholder="<?php echo __( 'Please enter a contact email...', 'reboot' ); ?>" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email span6" />
          <?php if(isset($emailError) && $emailError != '') { ?>
            <span class="error"><?php echo $emailError; ?></span>
          <?php } ?>
          
          <label for="commentsText"><?php echo __( 'Enquiry:', 'reboot' ); ?></label>
          <textarea name="comments" id="commentsText" tabindex="3" placeholder="<?php echo __( 'Please enter your enquiry...', 'reboot' ); ?>" rows="10" cols="100%" class="required requiredField span6"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
          <?php if(isset($commentError) && $commentError != '') { ?>
            <span class="error"><?php echo $commentError; ?></span>
          <?php } ?>

          <input name="submit" type="submit" id="submit" class="btn btn-inverse" tabindex="4" value="Submit Enquiry" />

          <input type="hidden" name="submitted" id="submitted" value="true" />
    
      </form>
            
          <?php } ?>
            
      </div><!-- end .span6 -->

      <div class="span6">

        <div class="well">

        <?php global $data; if($data["text_contact_address"]){ ?>
          <p><i class="icon-map-marker"></i> <?php echo $data['text_contact_address']; ?></p>
        <?php } ?>
        <?php if($data["text_contact_telephone"]){ ?>
          <p><i class="icon-phone"></i> <?php echo $data['text_contact_telephone']; ?></p>
        <?php } ?>
        <?php if($data["text_contact_fax"]){ ?>
          <p><i class="icon-print"></i> <?php echo $data['text_contact_fax']; ?></p>
        <?php } ?>
        <?php if($data["text_contact_email"]){ ?>
          <p><i class="icon-envelope"></i> <?php echo $data['text_contact_email']; ?></p>
        <?php } ?>

        </div><!-- end .well -->

      </div><!-- end .span6 -->
            
        
    </section><!-- #contact-details -->
                
    <?php endwhile;  ?> 
    <?php endif; ?>

  </section><!-- .middle -->
    
</div><!-- end .container -->

<?php get_footer() ?>