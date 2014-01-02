<?php
include_once '../common.php';
include_once '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $lang['PAGE_TITLE'];?></title>
<meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="../css/app.v1.css">
<link rel="stylesheet" href="../css/font.css" cache="false">
<!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
</head>
<body class="">
<section id="content" class="m-t-lg wrapper-md"> <a class="nav-brand" href="index.php"><?php echo $lang['SITE_NAME']; ?></a>
  <div class="row m-n">
    <div class="col-md-4 col-md-offset-4 m-t-lg">
      <section class="panel">
        <header class="panel-heading text-center bg-black animated fadeInDown">Administer Sign in </header>
		 
		<?php

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo '<header class="panel-heading text-center bg-danger"> '.$error.'</header>';
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo '<header class="panel-heading text-center bg-info"> '.$message.'</header>';
    }
}

?>
		
        <form action="index.php" name="loginform" class="panel-body" method="POST" data-validate="parsley">
          <div class="form-group animated rollIn">
            <label class="control-label animated "><?php echo $phplogin_lang['Username']; ?></label>
			<input id="user_name" type="text" name="user_name" class="form-control" data-required="true" />
          
          </div>
          <div class="form-group animated rollIn">
            <label class="control-label "><?php echo $phplogin_lang['Password']; ?></label>
			<input id="user_password" class="form-control" type="password" name="user_password" autocomplete="off" data-required="true" />
			
       
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" /> <?php echo $phplogin_lang['Remember me']; ?></label>
          </div>
          <a href="password_reset.php" class="pull-right m-t-xs"><small><?php echo $phplogin_lang['I forgot my password']; ?></small></a>
          <button type="submit" class="btn btn-danger" name="login"  ><?php echo $phplogin_lang['Log in']; ?></button>
          </form>
      </section>
    </div>
  </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder clearfix">
    <p> <small>Group No. 7 , University of Jaffna
      &copy; 2013</small> </p>
  </div>
</footer>
<!-- / footer --><script src="../css/app.v1.js">
   </script> 
<!-- Bootstrap --> <!-- app -->
</body>
</html>

