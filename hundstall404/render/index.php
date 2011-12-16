<!doctype html> 
<html>
<head>
	<meta charset="utf-8" />
	<title>404</title>
	<link rel="stylesheet" href="screen.css" type="text/css" media="screen" />
</head>
<body class="404">
	<h1><?php echo get_bloginfo('name'); ?> <span class="fourofour">404</span></h1>
	<p class="description">Vi kunde inte hitta sidan du sökte. Men denna hund kunde vi hitta. Den bor på Hundstallet just nu, och behöver ett hem. <a href="<?php echo $hundstall404->base_url; ?><?php echo $hundstall404->data_url; ?>" target="_blank">Hjälp den.</a></p>
	<div id="dog">
		<img src="<?php echo $hundstall404->dogs[0]->image; ?>"/> 
		<span class="dogname"><?php echo $hundstall404->dogs[0]->name; ?></span>
		<a href="<?php echo $hundstall404->base_url; ?><?php echo $hundstall404->data_url; ?>" target="_blank"><?php echo $hundstall404->base_url; ?></a>
	</div>
	<div id="mainpage"><a href="<?php echo get_bloginfo('url'); ?>">Gå till startsidan för <?php echo get_bloginfo('name'); ?></a></div>
</body>
</html>