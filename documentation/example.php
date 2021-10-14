<?php
session_start();
// this page should work as a template once you put your set path to where you have downloaded SimpleForm.php
// and put in your Private and Public key from google reCAPTCHA v3
require("/path/to/SimpleForm.php")

$form = new SimpleForm('/where/this/form/will/submit.php#msg',"(Get|Post)");

$form->setFieldset("License Number");
  $form->setInput("License Number:","licnum",'licnum',True);
$form->setEndFieldset();

$form->setFieldset("Previous Name");
  $form->setInput("First Name:","fName",'fname',True);
  $form->setInput("Middle Initial:","mInitial",'minitial');
  $form->setInput("Last Name:","lName",'lname',True);
  $form->setInput("Suffix:","suffix",'suffix');
$form->setEndFieldset();

$form->setFieldset("New Name: <br /><sub>How it will appear on your license</sub>");
  $form->setInput("First Name:","fNameNew",'fnameNew',True);
  $form->setInput("Middle Initial:","mInitialNew",'minitialNew');
  $form->setInput("Last Name:","lNameNew",'lnameNew',True);
  $form->setInput("Suffix:","suffixNew",'suffixNew');
$form->setEndFieldset();

$form->setFieldset("Additional information");
  $form->setInput("Phone Number:","phone",'phone',True);
  $form->setInput("Email:","email",'email',True);
  $form->setInput("Number of Duplicate Copies of License: <br /> <sub>(Duplicate copies are $10 each.)",'count','count',False,'form-control','number');
$form->setEndFieldset();

$form->setSubmitBtn('Submit','btn btn-primary g-recaptcha');
$form->setResetBtn('Reset','btn btn-default');
$form->setRecaptchaInfo('<Your Private Key>','<Your Public Key>');

if(isset($_POST['csfrToken'])){
  $clean_data = $form->validate($_POST);
}elseif(isset($_GET['success'])){
  $clean_data = $form->validate($_GET);
}

if(isset($clean_data) && !empty($clean_data)){
  print_r($clean_data);
  $msg = "<div class='alert alert-success'>You have successfuly useded SimpleForm.php!</div>";
  session_destroy();
  session_unset();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SimpleForm Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Below is need to connect to ... you guessed it google reCAPTCHA js -->
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script>
       function onSubmit(token){
          // This is used to find your form for google(you can change it but it will need to be changed in both SimpleForm.php and here.)
         document.getElementById("wills-form").submit();
       }
   </script>
</head>
<body>
  <div class="container">
    <div id="content">
  <section id="main-content" role="main" class="col-md-8">
    <div class="page-header">
  	 <h1>Example Form</h1>
  	</div>
    <h2>Individual Name Change</h2>

      <hr>

      <!-- The below php code is used to show msg whether it be an error or on success -->
        <?php if(!empty($form->getErrorMsg())):?>
          <?php echo $form->getErrorMsg();?>
        <?php endif;?>
        <?php if(isset($msg) && $msg !== ""):?>
          <div id="msg">
            <?php echo $msg?>
          </div>
        <?php endif;?>

        <!-- This is where the magic happens .... builds the form based off the elements listed at the top of this page -->
          <?php echo $form->build();?>

      </section>
    </div>
    <!-- #content -->
  </div>

</body>
</html>
