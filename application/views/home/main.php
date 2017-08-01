<!DOCTYPE html>
<html lang="en" ng-app="subcompro">
	<head>
		<meta charset="utf-8">
		<title>SUPCOMPRO S.A</title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url(); ?>assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/plugins/xcharts/xcharts.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/plugins/select2/select2.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/style_v2.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/plugins/chartist/chartist.min.css" rel="stylesheet">


		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
				<a href="index.html">SUPCOMPRO S.A</a>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<div id="search">
							<input type="text" placeholder="search"/>
							<i class="fa fa-search"></i>
						</div>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<!--<a href="#" class="about">about</a>
						<a href="index_v1.html" class="style1"></a>-->
						<ul class="nav navbar-nav pull-right panel-menu">
							<!--<li class="hidden-xs">
								<a href="index.html" class="modal-link">
									<i class="fa fa-bell"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="hidden-xs">
								<a class="ajax-link" href="ajax/calendar.html">
									<i class="fa fa-calendar"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="hidden-xs">
								<a href="ajax/page_messages.html" class="ajax-link">
									<i class="fa fa-envelope"></i>
									<span class="badge">7</span>
								</a>
							</li>-->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<img src="<?php echo base_url(); ?>assets/img/avatar_anonymous.png" class="img-circle" alt="avatar" />
									</div>
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<?php echo $_SESSION['user_name']; ?>
									</div>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">
											<i class="fa fa-user"></i>
											<span>Profile</span>
										</a>
									</li>
									<!--<li>
										<a href="ajax/page_messages.html" class="ajax-link">
											<i class="fa fa-envelope"></i>
											<span>Messages</span>
										</a>
									</li>
									<li>
										<a href="ajax/gallery_simple.html" class="ajax-link">
											<i class="fa fa-picture-o"></i>
											<span>Albums</span>
										</a>
									</li>
									<li>
										<a href="ajax/calendar.html" class="ajax-link">
											<i class="fa fa-tasks"></i>
											<span>Tasks</span>
										</a>
									</li>-->
									<li>
										<a href="#">
											<i class="fa fa-cog"></i>
											<span>Settings</span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url().'end_session'; ?>">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">


		<?php
			$aux_menu="";
			$aux_menu.=" <ul class='nav main-menu'>";
			foreach ($permisos as $menu) {
				$aux_menu.=" <li> ";
				$aux_menu.=" <a href='#".$menu->Id_menu."'> ";
				$aux_menu.=" <span class='hidden-xs'> ".$menu->Descipcion."</span>";
				$aux_menu.=" </a> ";
				$aux_menu.=" </li> ";
			}
			$aux_menu.=" </ul>";

			echo $aux_menu;
		?>

		</div>
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<div id="about">
				<div class="about-inner">
					<h4 class="page-header">Open-source admin theme for you</h4>
					<p>DevOOPS team</p>
					<p>Homepage - <a href="http://devoops.me" target="_blank">http://devoops.me</a></p>
					<p>Email - <a href="mailto:devoopsme@gmail.com">devoopsme@gmail.com</a></p>
					<p>Twitter - <a href="http://twitter.com/devoopsme" target="_blank">http://twitter.com/devoopsme</a></p>
					<p>Donate - BTC 123Ci1ZFK5V7gyLsyVU36yPNWSB5TDqKn3</p>
				</div>
			</div>
			<div class="preloader">
				

				<div class="Container">

					<div class="row" >
						<div class="col-xs-12" style="padding: 2%;" ng-view>
						</div>
					</div>
				</div>


			</div>
			<div id="ajax-content"></div>
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/justified-gallery/jquery.justifiedGallery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tinymce/jquery.tinymce.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="<?php echo base_url(); ?>assets/js/devoops.js"></script>

<script src="<?php echo base_url(); ?>app/angular/angular.min.js"></script>
<script src="<?php echo base_url(); ?>app/angular/angular-route.min.js"></script>
<script src="<?php echo base_url(); ?>app/angular/angular-resource.min.js"></script>

<script src="<?php echo base_url(); ?>app/app/app.js"></script>
<script src="<?php echo base_url(); ?>app/app/logicaproveedor.js"></script>
<script src="<?php echo base_url(); ?>app/app/logicausuario.js"></script>
<script src="<?php echo base_url(); ?>app/app/logicaempleado.js"></script>
<script src="<?php echo base_url(); ?>app/app/logicamarca.js"></script>
<script src="<?php echo base_url(); ?>app/app/logicaproducto.js"></script>
<script src="<?php echo base_url(); ?>app/app/logicabodega.js"></script>

</body>
</html>
