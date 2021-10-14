<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
    </li>
    <li><a href="#usage">Usage</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About the Project
This class was created to quickly and dynamically create forms with good coding structure. This will also take out the accessibility issues out of creating form by hand. Such as being able to click the label and it puts focus on the associated input. This includes inputs, checkbox, radio buttons, textarea. It also has bootstrap 3 as the css framework.

<!-- GETTING STARTED -->
## Getting Started
To get started using this class download from git repo:<br />
<code>git clone https://github.com/willmichel81/SimpleForm.git</code>

<!-- Dependencies -->
## Dependencies
The below dependencies are all that is needed at this time:
<ul>
  <li><a href="https://getbootstrap.com/docs/3.3/">Bootstrap  3 </a>
  <li><a href="https://github.com/guzzle/guzzle">GuzzleHttp</a></li>
  <li><a href="https://www.google.com/recaptcha/about/">Register for Google reCAPTCHA </a></li>
</ul>

Bootstrap 3 is the frame worked used to style the form elements.<br />
GuzzleHttp is used to retrieve the json data that is returned form google reCAPTCHA upon form submission<br />
This is using google reCAPTCHA v3.

<!-- USAGE EXAMPLES -->
## Usage
Basic usage of SimpleForm.php <br />

  Start Session at the top of the page, this is used to preserve the original reCAPTCHA key. <br />
  <code>session_start();</code> <br />

  Require the SimpleForm.php file <br />
  <code>require("/path/to/SimpleForm.php")</code><br />

  Create new SimpleForm object <br />
  <code>$form = new SimpleForm('/where/this/form/will/submit.php#msg',"(Get|Post)");</code>

  Start creating form elements<br />
    <code>
   $form->setFieldset("Name you want to appear above this particular section");<br />
    $form->setInput("label text", "name of element", "id of element", "required(True | False)", "class of element", "Input Type(ex. text,number..)");<br />
  $form->setEndFieldset();
  </code><br />

   when calling setFieldset() method only has 1 param
   when calling setInput() method, params 1-3 are required the rest are optional.
   when calling setEndFieldset() method accepts no params and just closes the fieldset

  ### EXAMPLES
  <a href="https://github.com/willmichel81/SimpleForm/blob/main/documentation/documentation.md">Please click here for more documentation.</a>
