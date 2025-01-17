<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<link rel="icon" type="image/ico" href="<?php echo base_url(); ?>public/images/favicon.ico" />
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--  Stylesheets -->
<!-- vendor css files -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/animate.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/vendor/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/vendor/magnific-popup/magnific-popup.css">

<!-- project main css files -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css">
<!--/ stylesheets -->
<!-- Modernizr  -->
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<!--/ modernizr -->
</head>

<body id="yatriv1" class="appWrapper">
<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
 <![endif]--> 

<!-- Application Content -->
<div id="wrap" class="animsition">
  <div class="page page-core page-login">
    <div class="container w-360 p-20 bg-white mt-40 text-center br-5">
      <h4>Thank you for registering with us!!!!</h4>
      <p>Do check your email for complete details.</p>
    </div>
</div>
<!--/ Application Content -->

<!-- Modal -->
<div id="forgotpasswordmodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title"><strong>Forgot Password</strong></h4>
  </div>
  
  <div class="modal-body">
    <form action="<?php echo site_url(); ?>login/forgot_password" enctype="multipart/form-data" method="post">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="loginEmailId">Email</label>
            <input type="email" class="form-control" name="loginEmailId" placeholder="Enter email">
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-sm-2">
      <button class="btn btn-lg btn-primary" type="submit">Submit</button>
      </div>
      </div>
    </form>
  </div>
</div>

</div>
</div> 

<!--JavaScripts -->


<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script type="text/javascript">window.jQuery || document.write('<script src="<?php echo base_url(); ?>public/js/jquery.min.js"><\/script>')</script> 
<script src="<?php echo base_url(); ?>public/js/vendor/bootstrap/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/jRespond/jRespond.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/sparkline/jquery.sparkline.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/animsition/js/jquery.animsition.min.js"></script> 
<script src="<?php echo base_url(); ?>public/js/vendor/screenfull/screenfull.min.js"></script> 
<!--/ javascripts --> 

<!--Custom JavaScripts --> 
<script src="<?php echo base_url(); ?>public/js/main.js"></script> 
<!--/ custom javascripts --> 

<!-- Page Specific Scripts  --> 
<script type="text/javascript">
  $(window).load(function(){
  });
</script> 
<!--/ Page Specific Scripts --> 

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. --> 
<script type="text/javascript">
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
  function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
  e=o.createElement(i);r=o.getElementsByTagName(i)[0];
  e.src='https://www.google-analytics.com/analytics.js';
  r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
  ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
