<!DOCTYPE html>
<html>
<head>
	<title>.:: SUPCOMPRO::.</title>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.js" ></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

<style type="text/css">
	body {
	  padding-top: 40px;
	  padding-bottom: 40px;
	  background-color: #eee;
	}

	.form-signin {
	  max-width: 330px;
	  padding: 15px;
	  margin: 0 auto;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	  margin-bottom: 10px;
	}
	.form-signin .checkbox {
	  font-weight: normal;
	}
	.form-signin .form-control {
	  position: relative;
	  height: auto;
	  -webkit-box-sizing: border-box;
	     -moz-box-sizing: border-box;
	          box-sizing: border-box;
	  padding: 10px;
	  font-size: 16px;
	}
	.form-signin .form-control:focus {
	  z-index: 2;
	}
	.form-signin input[type="email"] {
	  margin-bottom: -1px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	}
	.form-signin input[type="password"] {
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}	
</style>

</head>
<body>

    <div class="container">

      <form class="form-signin" action="<?php echo base_url().'init_session'; ?>"  method="post" >
        <h2 class="form-signin-heading text-center"><strong>Login</strong></h2>
        <label for="txt_user" class="sr-only">Usuario</label>
        <input type="text" name="txt_user" id="txt_user" class="form-control" placeholder="Usuario O Correo" required autofocus>
        <label for="txt_password" class="sr-only">Contraseña</label>
        <input type="password" name="txt_password" id="txt_password" class="form-control" placeholder="Contraseña" required>
        <?php
        	if(isset($Error)){
        		echo $Error;
        	}
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>

</body>
</html>