<?php echo Html::doctype('html5'); ?>
<html>

<head>
	<meta charset="utf-8">
	<title>Shrink your huge URL | MJS.ME</title>
	<?php echo Asset::js('//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'); ?>
	<script type="text/javascript">
		var base_url = "<?php echo Config::get("base_url"); ?>"
	</script>
	<?php echo Asset::css('reset.css'); ?>
	<?php echo Asset::css('main.css'); ?>
	<?php echo Asset::css('http://fonts.googleapis.com/css?family=Bowlby+One+SC&v2'); ?>
</head>

<div id="wrapper">

	<div id="header_container">
		<h1 id="logo"><?php echo Html::anchor(Config::get("base_url"), "MJS.ME")?></h1>
		<div id="title_header"><h3><?php echo $title; ?></h3></div>
	</div>

	<div id="content">
		<?php echo $content; ?>
	</div>

	<div id="footer">
		<p>&copy;&nbsp;<?php echo Date::factory()->format("%Y");?> Manuel Joao Silva - Powered by <?php echo Html::anchor("http://fuelphp.com", "FuelPHP")?> - Page Rendered in {exec_time}s using {mem_usage} MB of memory.</p>
	</div>
</div>
</body>
</html>