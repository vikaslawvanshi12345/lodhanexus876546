<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__.'/Exception.php';
require __DIR__.'/PHPMailer.php';
require __DIR__.'/SMTP.php';

function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'contact-usform1')
{
   $mailto = 'vikaslawvanshi26@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   ini_set('sendmail_from', $mailfrom);
   $subject = 'Membership Registration';
   $message = 'Values submitted from web site form:';
   $success_url = '#';
   $error_url = '#';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response", "h-captcha-response");

   $mail = new PHPMailer(true);
   try
   {
      $mail->Subject = stripslashes($subject);
      $mail->From = $mailfrom;
      $mail->FromName = $mailfrom;
      $mailto_array = explode(",", $mailto);
      for ($i = 0; $i < count($mailto_array); $i++)
      {
         if(trim($mailto_array[$i]) != "")
         {
            $mail->AddAddress($mailto_array[$i], "");
         }
      }
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      $mail->AddReplyTo($mailfrom);
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
         }
      }
      $mail->CharSet = 'UTF-8';
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
            if (is_array($_FILES[$key]['name']))
            {
               $count = count($_FILES[$key]['name']);
               for ($file = 0; $file < $count; $file++)
               {
                  if ($_FILES[$key]['error'][$file] == 0)
                  {
                     $mail->AddAttachment($_FILES[$key]['tmp_name'][$file], $_FILES[$key]['name'][$file]);
                  }
               }
            }
            else
            {
               if ($_FILES[$key]['error'] == 0)
               {
                  $mail->AddAttachment($_FILES[$key]['tmp_name'], $_FILES[$key]['name']);
               }
            }
         }
      }
      $mail->WordWrap = 80;
      $mail->Body = $message;
      $mail->Send();
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Page</title>
<meta name="description" content="लोधा समाज शिक्षा फाउंडेशन
।। एक कल्पवृक्ष, जो  संभावनाओ को साकार करे ।।  

We are dedicated to empower people with the tools and knowledge they need to reach their full potential. 
लोधा समाज शिक्षा फाउंडेशन
।। एक कल्पवृक्ष, जो  संभावनाओ को साकार करे ।।  

We are dedicated to empower people with the tools and knowledge they need to reach their full potential. 
">
<meta name="keywords" content="Lodha Samaj Shiksha Foundation लोधा समाज शिक्षा फाउंडेशन
Lodha Samaj Shiksha Foundation लोधा समाज शिक्षा फाउंडेशन
">
<meta name="author" content="Vikas Lawvanshi">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="wb_LayoutGrid1">
<div id="LayoutGrid1">
<div class="row">
<div class="col-1">
</div>
<div class="col-2">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid2">
<div id="LayoutGrid2">
<div class="row">
<div class="col-1">
<div id="wb_Image1" style="display:inline-block;width:203px;height:201px;z-index:0;">
<a href="./index.html"><img src="images/Asset 2@1.5x.png" id="Image1" alt="" width="203" height="202"></a>
</div>
<div id="wb_Text3">
<p>।। एक कल्पवृक्ष, जो&nbsp; संभावनाओ को साकार करे ।।</p>
<br>
</div>
<div id="wb_Heading1" style="display:inline-block;width:100%;z-index:2;">
<h1 id="Heading1">Lodha Samaj Shiksha Foundation</h1>
</div>
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid3">
<div id="LayoutGrid3">
<div class="row">
<div class="col-1">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid4">
<div id="LayoutGrid4">
<div class="row">
<div class="col-1">
</div>
<div class="col-2">
</div>
<div class="col-3">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid5">
<div id="LayoutGrid5">
<div class="row">
<div class="col-1">
<div id="wb_DropdownMenu1" style="display:inline-block;width:100%;z-index:3;">
<div id="DropdownMenu1" class="DropdownMenu1" style ="width:100%;height:auto !important;">
<div class="container">
<div class="navbar-header">
<button title="Dropdown Menu" type="button" class="navbar-toggle" data-bs-toggle="collapse" data-bs-target=".DropdownMenu1-navbar-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="DropdownMenu1-navbar-collapse collapse">
<ul class="nav navbar-nav">
<li class="nav-item">
<a href="" class="nav-link">Home</a>
</li>
<li class="nav-item dropdown">
<a href="#" class="dropdown-toggle" data-bs-placement="bottom-start" data-bs-toggle="dropdown">About Us<b class="caret"></b></a>
<ul class="dropdown-menu">
<li class="nav-item dropdown-item">
<a href="" class="nav-link"><i class="fa fa-question-circle-o"></i>Who we are</a>
</li>
<li class="nav-item dropdown-item">
<a href="./vision&mission.html" class="nav-link"><i class="fa fa-hand-peace-o"></i>Vision & Mission</a>
</li>
<li class="nav-item dropdown-item">
<a href="./pdf/LSSF niyamavali.pdf" class="nav-link"><i class="fa fa-book"></i>Rulebook</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link"><i class="fa fa-users"></i>Our members</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Journey of LSSF</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Annual reports/Briefing of Meetings</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Media</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Our partners</a>
</li>
</ul>
</li>
<li class="nav-item dropdown">
<a href="#" class="dropdown-toggle" data-bs-placement="bottom-start" data-bs-toggle="dropdown">Career/Job<b class="caret"></b></a>
<ul class="dropdown-menu">
<li class="nav-item dropdown-item">
<a href="./career-exploration.html" class="nav-link">Career Exploration</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">School/College/Coaching/Hostel Directory</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Career Timelines(pathways)</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Scholarship & Talent search Exams</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Apprenticeship Training</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Career Saathi</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Events & Workshop schedules</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">Parental guidance</a>
</li>
</ul>
</li>
<li class="nav-item dropdown">
<a href="#" class="dropdown-toggle" data-bs-placement="bottom-start" data-bs-toggle="dropdown">Toolkit<b class="caret"></b></a>
<ul class="dropdown-menu">
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/edutools.html" target="_blank" class="nav-link">Edu</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/webtools.html" target="_blank" class="nav-link">Web</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/privacytools.html" class="nav-link">Privacy</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/devtools.html" class="nav-link">Dev</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/tglimits.html" class="nav-link">Telegram</a>
</li>
<li class="nav-item dropdown-item">
<a href="" class="nav-link">OS (Windows, Linux, iOS, Android)</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/torrents.html" class="nav-link">Torrent</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://nexustoolkit789.netlify.app/productivity.html" class="nav-link">Productivity</a>
</li>
<li class="nav-item dropdown-item">
<a href="https://osintframework.com/" target="_blank" class="nav-link">OSINT framework</a>
</li>
</ul>
</li>
<li class="nav-item">
<a href="./contact-us.html" class="nav-link">Contact Us</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="contact-section" style="position:absolute;text-align:center;left:65px;top:393px;width:82.9897%;height:819px;z-index:75;">
<div id="wb_contact-heading-text">
<h1>Membership Registration</h1>
</div>
<div id="wb_Custom-template-details">
<h6>If you are interested in becoming a member of our Shiksha Foundation, please use the form below to register. You will be contacted by our team.</h6>
</div>
<div id="wb_contact-usForm1" style="display:inline-block;position:relative;width:640px;height:603px;z-index:42;">
<form name="contact_usForm1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="contact-usForm1" style="display:inline;">
<input type="hidden" name="formid" value="contact-usform1">
<input type="text" id="first-name" style="position:absolute;left:17px;top:39px;width:288px;height:33px;z-index:9;" name="First Name" value="" tabindex="1" spellcheck="false" required pattern="[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f]*$" accesskey="1" placeholder="*First Name">
<input type="text" id="last-name" style="position:absolute;left:326px;top:39px;width:288px;height:33px;z-index:10;" name="Last Name" value="" tabindex="2" spellcheck="false" required pattern="[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f]*$" accesskey="2" placeholder="*Last Name">
<input type="email" id="email" style="position:absolute;left:17px;top:81px;width:597px;height:33px;z-index:11;" name="Email" value="" tabindex="3" spellcheck="false" accesskey="3" placeholder="Email">
<input type="text" id="ContactNumber" style="position:absolute;left:17px;top:123px;width:597px;height:33px;z-index:12;" name="Contact Number" value="" tabindex="4" spellcheck="false" required pattern="[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-]*$" accesskey="4" placeholder="*Contact Number">
<input type="date" id="form-date" style="position:absolute;left:17px;top:207px;width:215px;height:27px;z-index:13;" name="Date of Birth" value="" tabindex="5" spellcheck="false" required pattern="(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)[0-9]{2}" accesskey="5" placeholder="(dd/mm/yyyy) *">
<input type="checkbox" id="male-check" name="Male" value="on" style="position:absolute;left:270px;top:214px;z-index:14;" tabindex="6" accesskey="6">
<label for="email" id="male-lable" style="position:absolute;left:293px;top:207px;width:34px;height:26px;line-height:26px;z-index:15;">Male</label>
<input type="checkbox" id="female-check" name="Female" value="on" style="position:absolute;left:340px;top:214px;z-index:16;" tabindex="7" accesskey="7">
<label for="ContactNumber" id="female-lable" style="position:absolute;left:363px;top:207px;width:58px;height:26px;line-height:26px;z-index:17;">Female</label>
<input type="text" id="form-address" style="position:absolute;left:18px;top:292px;width:594px;height:27px;z-index:18;" name="Address" value="" tabindex="8" spellcheck="false" required pattern="[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-,-.():;]*$" accesskey="8" placeholder="Address *">
<input type="text" id="form-street" style="position:absolute;left:17px;top:336px;width:403px;height:27px;z-index:19;" name="Street" value="" tabindex="9" spellcheck="false" required pattern="[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f0-9-,-.():;]*$" accesskey="9" placeholder="Street *">
<input type="text" id="form-city" style="position:absolute;left:444px;top:336px;width:168px;height:27px;z-index:20;" name="City" value="" tabindex="10" spellcheck="false" required pattern="[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ \t\r\n\f]*$" accesskey="10" placeholder="City *">
<input type="checkbox" id="singing-check" name="Singing Ministry" value="on" style="position:absolute;left:18px;top:431px;z-index:21;" tabindex="11" accesskey="11">
<label for="form-date" id="singing-lable" style="position:absolute;left:38px;top:424px;width:62px;height:26px;line-height:26px;z-index:22;">ट्रस्टी सदस्य</label>
<input type="checkbox" id="prayer-check" name="Prayer Team" value="on" style="position:absolute;left:122px;top:431px;z-index:23;" tabindex="12" accesskey="12">
<label for="" id="prayer-lable" style="position:absolute;left:142px;top:424px;width:79px;height:26px;line-height:26px;z-index:24;">संरक्षक सदस्य</label>
<input type="checkbox" id="protocol-check" name="Protocol Team" value="on" style="position:absolute;left:246px;top:431px;z-index:25;" tabindex="13" accesskey="13">
<label for="" id="protocol-lable" style="position:absolute;left:266px;top:424px;width:90px;height:26px;line-height:26px;z-index:26;">फाउन्डेशन सदस्य</label>
<input type="checkbox" id="media-check" name="Membership" value="on" style="position:absolute;left:376px;top:431px;z-index:27;" tabindex="14" accesskey="14">
<label for="Custom-template-details" id="media" style="position:absolute;left:396px;top:424px;width:83px;height:26px;line-height:26px;z-index:28;">आजीवन सदस्य</label>
<div id="wb_name-text" style="position:absolute;left:17px;top:482px;width:253px;height:21px;z-index:29;">
<h5>Photo Image Attachment</h5></div>
<input type="file" accept=".bmp,.gif,.jpeg,.jpg,.png" name="registrationFileUpload" accesskey="15" id="attached" style="position:absolute;left:17px;top:508px;width:608px;height:30px;line-height:30px;z-index:30;" tabindex="15" required>
<input type="submit" id="MainContactSubmit" name="send" value="submit" style="position:absolute;left:17px;top:548px;width:100px;height:35px;z-index:31;" tabindex="17" accesskey="17">
<input type="reset" id="MainContactClear" name="clear" value="clear" style="position:absolute;left:122px;top:548px;width:100px;height:35px;z-index:32;" tabindex="18" accesskey="18">
<div id="wb_required-text" style="position:absolute;left:17px;top:17px;width:250px;height:16px;z-index:33;">
<span style="color:#808080;font-family:Arial;font-size:15px;"><strong><u>* Required fields</u></strong></span></div>
<div id="wb_dateOfBirth-text" style="position:absolute;left:17px;top:182px;width:167px;height:21px;z-index:34;">
<h5>Date of Birth*</h5></div>
<div id="wb_address-text" style="position:absolute;left:17px;top:265px;width:167px;height:21px;z-index:35;">
<h5>Address*</h5></div>
<div id="wb_ministry-text" style="position:absolute;left:17px;top:392px;width:210px;height:21px;z-index:36;">
<h5>Type of Membership</h5></div>
<div id="wb_gender-text" style="position:absolute;left:267px;top:182px;width:167px;height:21px;z-index:37;">
<h5>Gender *</h5></div>
<input type="checkbox" id="Checkbox1" name="Membership" value="on" style="position:absolute;left:498px;top:431px;z-index:38;" tabindex="14" accesskey="14">
<label for="Custom-template-details" id="Label1" style="position:absolute;left:518px;top:424px;width:86px;height:26px;line-height:26px;z-index:39;">सामान्य सदस्य</label>
</form>
</div>
</div>
<div id="wb_LayoutGrid6">
<div id="LayoutGrid6">
<div class="row">
<div class="col-1">
</div>
</div>
</div>
</div>
<link href="16x16.png" rel="icon" sizes="16x16" type="image/png">
<link href="32x32.png" rel="icon" sizes="32x32" type="image/png">
<link href="64x64.png" rel="icon" sizes="64x64" type="image/png">
<link href="120x120.png" rel="apple-touch-icon" sizes="120x120">
<link href="320x320.png" rel="apple-touch-icon" sizes="320x320">
<link href="Artboard 1@0.75x.png" rel="apple-touch-icon" sizes="643x654">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Yatra+One:400&subset=devanagari,latin-ext&display=swap" rel="stylesheet">
<link href="css/LN_phase7.css" rel="stylesheet">
<link href="css/membership-registration.css" rel="stylesheet">
<div id="preloader"></div>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.6.4.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/membership-registration.js"></script>
</body>
</html>