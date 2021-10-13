<?php
namespace SimpleForm;
require($_SERVER['DOCUMENT_ROOT']."/pr-forms/vendor/autoload.php");

use Respect\Validation\Validator as v;
use GuzzleHttp\Client;

class SimpleForm{

  function __construct($action,$method){
    $this->action = $action;
    $this->method = $method;
    $this->element_array = [];
    $this->requiredName_array = [];
    $this->requiredLabel_array = [];
    $this->error_msg = "";
    if(strtoupper($this->method) !== 'GET'){
      $_SESSION['csfrToken'] = empty($_SESSION['csfrToken']) ? md5(random_int(1,100))  : $_SESSION['csfrToken'] ;
      $this->csfrToken = $_SESSION['csfrToken'];
      array_push($this->requiredName_array,"csfrToken");
      array_push($this->requiredLabel_array,"csfrToken");
    }else{
      $_SESSION['submission'] = empty($_SESSION['submission']) ? 1  : $_SESSION['submission'] ;
      $this->submission = $_SESSION['submission'];
      array_push($this->requiredName_array,"success");
      array_push($this->requiredLabel_array,"success");
    }
  }
  // Start of Setters
  function setInput($label_text,$name,$id,$required = False,$class = "form-control",$input_type = "text"){
    $this->class = $class !=='' && $class !=='form-control' ? $class." form-control" : "form-control";
    $this->input_type = $input_type;
    $this->name = $name;
    $this->id = $id;
    $this->requiredName = $required;
    $this->label_text = $label_text;
    $this->addFormInputElement("input");
  }

  function setTextArea($label_text,$name,$id,$row=1,$required = False,$class = "form-control"){
    $this->class = $class !=='' && $class !=='form-control' ? $class." form-control" : "form-control";
    $this->row = $row;
    $this->name = $name;
    $this->id = $id;
    $this->requiredName = $required;
    $this->label_text = $label_text;
    $this->addFormInputElement("textarea");
  }

  function setClickableInput($label_text_array,$names_array,$id,$type,$format,$value_array,$required = False){
    $this->clickable_labels = $label_text_array;
    $this->clickable_names = $names_array;
    $this->clickable_id = $id;
    $this->clickable_type = strtolower($type);
    $this->clickable_format = strtolower($format);
    $this->clickable_values = $value_array;
    $this->requiredName = $required;
    $this->addFormInputElement('clickable');
  }

  function setFieldset($label){
    $this->fieldset_label = $label;
    $this->addFormInputElement('start_fieldset');
  }

  function setEndFieldset(){
    $this->addFormInputElement('end_fieldset');
  }

  function setExtraLabel($label){
    $this->extra_label = $label;
    $this->addFormInputElement('extra_label');
  }

  function setSubmitBtn($btn_text,$btn_class = 'btn'){
    $this->submit_button_text = $btn_text;
    $this->submit_button_class = $btn_class;
  }

  function setResetBtn($btn_text,$btn_class = 'btn'){
    $this->reset_button_text = $btn_text;
    $this->reset_button_class = $btn_class;
  }

  function setRecaptchaInfo($secret_key,$public_key,$action='submit'){
    $this->recap_private = $secret_key;
    $this->recap_public = $public_key;
    $this->recap_action = $action;
   }

   function testRecaptcha(){
     $recap_response = isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] !=="" ? $_POST['g-recaptcha-response'] : "";
     $recap_url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$this->recap_private.'&response='.$recap_response;
     $failed_datamogov_connection = false;
     $client = new \GuzzleHttp\Client(['verify' => false]);
     $response = $client->get($recap_url);
     $recap_data = json_decode($response->getBody()->getContents());
    return $recap_data;
   }

  // End of Setters
  // Start of Getters
  function getAction(){
    return $this->action;
  }

  function getMethod(){
    return $this->method;
  }
  function getErrorMsg(){
    return $this->error_msg;
  }

  function getSubmitBtn(){
    return $this->submit_button_text;
  }

  function getResetBtn(){
    return $this->reset_button_text;
  }

  function getFormElements(){
    return $this->element_array;
  }

  function getRequiredElements(){
    return $this->requiredName_array;
  }

  // End of Getters

  function addFormInputElement($element){
    $form = "";
    $i = 0;
    if($element == 'clickable'){
      $form .= "<div class='form-group col-md-6'>";
        foreach($this->clickable_values as $value){
          if($this->clickable_type == 'checkbox'){
            if($this->clickable_format == 'inline'){
              $form .= "<label class='checkbox-inline'><input type='checkbox' name='".$this->clickable_names[$i]."' ";
              $form .= "id='".$this->clickable_id."' ";
              $form .= "value='".$value;
              $form .= $this->requiredName == True ? "' required>":"'>";
              $form .= $this->clickable_labels[$i];
              $form .= "</label>";
            }else{
              $form .= "<div class='checkbox'>";
              $form .= "<label><input type='checkbox' name='".$this->clickable_names[$i]."' ";
              $form .= "id='".$this->clickable_id."' ";
              $form .= "value='".$value;
              $form .= $this->requiredName == True ? "' required>":"'>";
              $form .= $this->clickable_labels[$i];
              $form .= "</label>";
            }
          }else{
            if($this->clickable_format == 'inline'){
              $form .= "<label class='radio-inline'><input type='radio' name='".$this->clickable_names[0]."' ";
              $form .= "id='".$this->clickable_id."' ";
              $form .= "value='".$value;
              $form .= $this->requiredName == True ? "' required>":"'>";
              $form .= $this->clickable_labels[$i];
              $form .= "</label>";
            }else{
              $form .= "<div class='radio'>";
              $form .= "<label><input type='radio' name='".$this->clickable_names[0]."' ";
              $form .= "id='".$this->clickable_id."' ";
              $form .= "value='".$value;
              $form .= $this->requiredName == True ? "' required>":"'>";
              $form .= $this->clickable_labels[$i];
              $form .= "</label>";
            }
            if($i==0){
              $this->requiredName == True ? array_push($this->requiredName_array,$this->clickable_names[0]):"";
              $this->requiredName == True ? array_push($this->requiredLabel_array,'You must select an option out of the radio buttons, this '):"";
            }
          }
          $i++;
        }
        $form .="</div>";

    }elseif($element == "start_fieldset"){
      $form .= "<fieldset>";
      $form .= $this->fieldset_label !== "" ? "<legend>$this->fieldset_label</legend>":"";
    }elseif($element == "end_fieldset"){
      $form .="<hr class='col-md-12' /></fieldset>";
    }elseif($element == "extra_label"){
      $form .= $this->extra_label !== "" ? "<label>$this->extra_label</label>" : "";
    }else{
      $form .= "<div class='form-group col-md-6'>";
      $form .= "<label ";
      $form .= $this->id !=='' ? "for='$this->id'>" : ">";
      $form .= $this->label_text !=='' ? $this->label_text : "";
      $form .= "</label>";
      if($element === "input"){
        $form .= $this->input_type !== '' ? "<input type='$this->input_type'":"";
      }else if($element === "textarea"){
        $form .= $this->input_type !== '' ? "<textarea rows='$this->row'":"";
      }
      $form .= $this->name !== '' ? " name='$this->name'":"";
      $form .= $this->class !=='' ? " class='$this->class'":"";
      $form .= $this->id !== '' ? " id='$this->id'":"";
      $form .= $this->requiredName !== '' && $this->requiredName !== False ? " required>":">";
      if($element === "textarea"){
        $form .= "</textarea>";
      }
      $form .="</div>";
    }
    array_push($this->element_array,$form);
    $this->requiredName == True ? array_push($this->requiredName_array,$this->name):"";
    $this->requiredName == True ? array_push($this->requiredLabel_array,$this->label_text):"";
    return $form;
  }

  function build(){
    $html = "<form id='wills-form'";
    $html .= $this->action !== '' && $this->method !== '' ? " action = $this->action method = $this->method >":">";
    $html .= isset($this->csfrToken) ? "<input type='hidden' name='csfrToken' value = $this->csfrToken>":"<input type='hidden' name='success' value ='1'>";
           foreach($this->getFormElements() as $element){
         $html .= "$element";
       }
     $html .= !empty($this->getSubmitBtn()) ? "<button id='sub' class='$this->submit_button_class' data-sitekey='$this->recap_public' data-callback='onSubmit' data-action=$this->recap_action>":"";
     $html .= !empty($this->getSubmitBtn()) ? $this->getSubmitBtn() : "";
     $html .= !empty($this->getSubmitBtn()) ? "</button>" : "";

     $html .= !empty($this->getResetBtn()) ? "<button class=$this->reset_button_class type='reset'>":"";
     $html .= !empty($this->getResetBtn()) ? $this->getResetBtn() : "";
     $html .= !empty($this->getResetBtn()) ? "</button>" : "";

     $html .= "</form>";
     return $html;
  }

  function validate($data=[]){
    $error_details = [];
    $clean_dataKey = [];
    $clean_dataVal = [];
    $data = !empty($data) ? $data : "";
    if(!empty($data)){
      $recap_result = $this->testRecaptcha();
      if(strtoupper($this->method) == 'POST'){
        if(!empty($recap_result)){
          if($recap_result->success !== 1 && $recap_result->score < .5 && $recap_result->action !== $this->recap_action){
            array_push($error_details,"<li>Looks like something went wrong. Please try again.</li>");
          }
        }else{
          array_push($error_details,"<li>Looks like something went wrong. Please try again.</li>");
        }
      }
      $required_assoc = array_combine($this->requiredName_array,$this->requiredLabel_array);
      foreach($this->requiredName_array as $required){
        if($required == 'csfrToken'){
          if(isset($data['csfrToken']) && $this->csfrToken !== $data['csfrToken']){
            array_push($error_details,"<li>CSFR token mismatch</li>");
          }
        }
        if($required == 'success'){
          if(isset($data['success']) && $this->submission !== $data['success']){
            array_push($error_details,"<li>CSFR token mismatch</li>");
          }
        }
        if(!isset($data[$required]) || $data[$required] == ''){
          if(!in_array("<li>".str_replace(":","",$required_assoc[$required])." is required.</li>",$error_details)){
            array_push($error_details,"<li>".str_replace(":","",$required_assoc[$required])." is required.</li>");
          }
        }
      }
      if(empty($error_details)){
        foreach($data as $key=>$value){
          if($key !=="csfrToken" && $key !=="g-recaptcha-response"){
              $value = isset($value) && $value!="" ? trim($value) : "";
              $value = isset($value) && $value!="" ? stripslashes($value) : "";
              $value = isset($value) && $value!="" ? htmlspecialchars($value) : "";
              array_push($clean_dataKey,$key);
              array_push($clean_dataVal,$value);
              // $phone =  preg_match("^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$",$value);
              // $email =  filter_var($email, FILTER_VALIDATE_EMAIL);
              // $name  =  preg_match("/^[a-z ,.'-]+$/i",$value);
          }
        }
          $clean_data=array_combine($clean_dataKey,$clean_dataVal);
          return $clean_data;
      }else{
        $this->error_msg .= "<div class='alert alert-danger' style='color:black'>";
        $this->error_msg .= "<ul>";
        if(count($error_details) >= 5){
          $this->error_msg .= "Please make sure all required field(s) are filled out, and try again.";
        }else{
            foreach($error_details as $error){
            $this->error_msg .= "$error";
          }
        }
        $this->error_msg .= "</ul>";
        $this->error_msg .="</div>";
      }
    }
  }
}
?>
