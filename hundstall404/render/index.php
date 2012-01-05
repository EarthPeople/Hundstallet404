<!doctype html> 
<html>
<head>
	<meta charset="utf-8" />
	<title>404</title>
	<link rel="stylesheet" href="<?php echo WP_PLUGIN_URL; ?>/hundstall404/render/screen.css" type="text/css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Permanent+Marker' rel='stylesheet' type='text/css'>
</head>
<body class="fourofour">
	<div id="fourofour_wrapper">
		<h1 class="customfont"><span>404</span> <?php echo get_bloginfo('name'); ?></h1>
		<div id="dog_wrapper">
			<img src="<?php echo $hundstall404->dogs[0]->image; ?>" />
			<div id="dog_desc">
				<p>Vi kunde inte hitta sidan du sökte. Men vi hittade den här hunden.</p>
				<p><span class="dogname customfont"><?php echo $hundstall404->dogs[0]->name; ?></span> bor på Hundstallet just nu, och behöver ett hem. <a href="<?php echo $hundstall404->base_url; ?><?php echo $hundstall404->data_url; ?>" target="_blank">Hjälp den.</a></p>
				<p><a href="<?php echo $hundstall404->base_url; ?><?php echo $hundstall404->data_url; ?>" target="_blank"><?php echo $hundstall404->base_url; ?></a><br/>
				<a href="<?php echo get_bloginfo('url'); ?>" id="mainpage">Gå till startsidan för <?php echo get_bloginfo('name'); ?></a></p>
			</div>
		</div>
	</div><!-- fourofour_wrapper -->
</body>
</html>