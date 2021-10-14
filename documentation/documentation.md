<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#constructor">Constructor</a></li>
    <li><a href="#setinput">setInput()</a></li>
    <li><a href="#settextarea">setTextArea()</a></li>
    <li><a href="#setclickableinput">setClickableInput()</a></li>
    <li><a href="#setfieldset">setFieldset()</a></li>
    <li><a href="#setendfieldset">setEndFieldset()</a></li>
    <li><a href="#setextralabel">setExtraLabel()</a></li>
    <li><a href="#setsubmitbtn">setSubmitBtn()</a></li>
    <li><a href="#setresetbtn">setResetBtn()</a></li>
    <li><a href="#setrecaptchainfo">setRecaptchaInfo()</a></li>
    <li><a href="#validate">validate()</a></li>
    <li><a href="#build">build()</a></li>
    <li><a href="https://github.com/willmichel81/SimpleForm/blob/main/documentation/example.php">Implementation</a></li>
  </ol>
</details>


<!-- ABOUT THE CONSTRUCTOR -->
## Constructor
When you call the SimpleForm Class you will need to pass it two params:<br />
<ul>
  <li>Param 1 (Required) : Action (where you want the form to be summited to)</li>
  <li>Param 2 (Required) : Method ("GET" OR "POST")</li>
</ul>

When you call the SimpleForm Class it will do the following:<br />

Check to see if it needs to be a "GET" or "POST". <br />
If it is a "GET" sets a session to 1 if not already set.<br />
If it is a "POST" sets a session that contains a csfrToken. <br />
It then adds the values of the above to a required array so that it can not be deleted from the form <br />

<!-- ABOUT THE setInput -->
## setInput()
When you call the setInput() you will need to pass it the following params:<br />
<ul>
  <li>Param 1 (Required) : Label Text</li>
  <li>Param 2 (Required) : Name of input(Used for form submission)</li>
  <li>Param 3 (Required) : ID of input(Used for form submission)</li>
  <li>Param 4 (Optional) : Required ("True"|"False")(default:"False")</li>
  <li>Param 5 (Optional) : Class of input(default:"form-control")("form-control is added along with any other class you put here")</li>
  <li>Param 6 (Optional) : Input Type (text, number, phone, etc.)(default:"text")</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setInput("First Name:","fName","fName_id", True, "", "text");
</code>

<!-- ABOUT THE setTextArea -->
## setTextArea()
When you call the setTextArea() you will need to pass it the following params:<br />
<ul>
  <li>Param 1 (Required) : Label Text</li>
  <li>Param 2 (Required) : Name of input(Used for form submission)</li>
  <li>Param 3 (Required) : ID of input(Used for form submission)</li>
  <li>Param 4 (Optional) : Rows that textarea span (default:1)</li>
  <li>Param 5 (Optional) : Required ("True"|"False")(default:"False")</li>
  <li>Param 6 (Optional) : Class of input(default:"form-control")("form-control is added along with any other class you put here")</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setTextArea("Comment:","usercom","usercom_id", 3, False, "");
</code>

<!-- ABOUT THE setClickableInput -->
## setClickableInput()
When you call the setClickableInput() you will need to pass it the following params:<br />
This will be used for (checkbox|radio)<br />
<ul>
  <li>Param 1 (Required) : Label Text(Array)</li>
  <li>Param 2 (Required) : Name of input(Used for form submission)(Array)</li>
  <li>Param 3 (Required) : ID of input(Used for form submission)</li>
  <li>Param 4 (Required) : Type (checkbox|radio)</li>
  <li>Param 5 (Required) : Format ("inline"|"stacked")(default:"inline")</li>
  <li>Param 6 (Required) : Value(s)(Array)</li>
  <li>Param 7 (Optional) : Required ("True"|"False")(default:"False")</li>
</ul>

### Example:
<strong>Radio (stacked)</strong>
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setClickableInput(array("Option 1", "Option 2", "Option 3"), array("selectedOptionName"), "selectedOptionId", "radio", "stacked", array("Value_1","Value_2","Value_3"),True);
</code><br />

<strong>Radio (inline)</strong>
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setClickableInput(array("Option 1", "Option 2", "Option 3"), array("selectedOptionName"), "selectedOptionId", "radio", "inline", array("Value_1","Value_2","Value_3"), True);
</code><br />

<strong>Checkbox (stacked)</strong>
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setClickableInput(array("Option 1", "Option 2", "Option 3"), array("selectedOptionName1","selectedOptionName2", "selectedOptionName3"),"selectedOptionId", "checkbox", "stacked",array("Value_1","Value_2","Value_3"),True);
</code><br />

<strong>Checkbox (inline)</strong>
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setClickableInput(array("Option 1", "Option 2", "Option 3"), array("selectedOptionName1","selectedOptionName2", selectedOptionName3), "selectedOptionId", "checkbox", "inline", array("Value_1","Value_2","Value_3"), True);
</code>


<!-- ABOUT THE setFieldset -->
## setFieldset()
When you call the setFieldset() you will need to pass it the following params:<br />
<ul>
  <li>Param 1 (Required) : Heading Text</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setFieldset("Part 1 of Form");<br />
$form->setInput("Name of Business:","oldBusName",'oldBusName',True);<br />
$form->setEndFieldset();
</code>

<!-- ABOUT THE setEndFieldset -->
## setEndFieldset()
When you call the setEndFieldset() you will not need to pass it any params:<br />

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setFieldset("Part 1 of Form");<br />
$form->setInput("Name of Business:","oldBusName",'oldBusName',True);<br />
$form->setEndFieldset();
</code>

<!-- ABOUT THE setExtraLabel -->
## setExtraLabel()
When you call the setExtraLabel() you will need to pass it the following params:<br />
<ul>
  <li>Param 1 (Required) : Extra Label Text</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setExtraLabel("Please indicate whether you want information sent to your home or business address.");
$form->setClickableInput(array("Home","Business"),array("sendInfo"),'sendInfo','radio','inline',array('Home','Business'),True);
</code>


<!-- ABOUT THE setSubmitBtn -->
## setSubmitBtn()
When you call the setSubmitBtn() you will need to pass it the following params:<br />
<ul>
<li>Param 1 (Required) : Button Text</li>
<li>Param 2 (Optional) : Class (default:btn g-recaptcha)(If you add a class, you will need to make sure "g-recaptcha" is added)</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setSubmitBtn('Submit','btn btn-primary g-recaptcha');
</code>

<!-- ABOUT THE setResetBtn -->
## setResetBtn()
When you call the setResetBtn() you will need to pass it the following params:<br />
<ul>
<li>Param 1 (Required) : Button Text</li>
<li>Param 2 (Optional) : Class (default:btn)</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setResetBtn('Submit','btn btn-default');
</code>

<!-- ABOUT THE setRecaptchaInfo -->
## setRecaptchaInfo()
When you call the setRecaptchaInfo() you will need to pass it the following params:<br />
<ul>
  <li>Param 1 (Required) : Private Key (get this from google reCAPTCHA v3 admin)</li>
  <li>Param 2 (Required) : Public Key (get this from google reCAPTCHA v3 admin)</li>
  <li>Param 3 (Optional) : Action (default:'submit')</li>
</ul>

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setRecaptchaInfo('<Your Private Key>','<Your Public Key>');
</code>

<!-- ABOUT THE validate -->
## validate()
When you call the validate() you will need to pass it params:<br />
You will need to send the $_GET | $_POST request array.
When validate() is called this will return an associative array with the form data that has been cleaned.
<ul>
  <li>Param 1 (Required) : Method ("$_GET" | "$_POST")</li>
</ul>

### Example:
<code>
if(isset($_POST['csfrToken'])){<br />
    $clean_data = $form->validate($_POST);<br />
  }elseif(isset($_GET['success'])){<br />
    $clean_data = $form->validate($_GET);<br />
  }
</code>

<!-- ABOUT THE setEndFieldset -->
## build()
When you call the build() you will not need to pass it any params:<br />

### Example:
<code>
$form = new SimpleForm('/where/page/is/submitted.php#msg','POST');<br />
$form->setFieldset("Part 1 of Form");<br />
$form->setInput("Name of Business:","oldBusName",'oldBusName',True);<br />
$form->setEndFieldset();</br>
//some HTML<br />
//where you want form to display<br />
$form->build();<br />
//end HTML
</code>
