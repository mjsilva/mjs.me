<?php echo Html::doctype('html5'); ?>
<html>

<head>
	<meta charset="utf-8">
	<title>Rackspot URL Shortener | RSK.BZ</title>

	<!--CSS LOAD-->
	<?php echo Asset::css('reset.css'); ?>
	<?php echo Asset::css('jquery.jgrowl.css'); ?>
	<?php echo Asset::css('main.css'); ?>
	<?php echo Asset::css('http://fonts.googleapis.com/css?family=Bowlby+One+SC&v2'); ?>

	<!--JS LOAD-->
	<?php echo Asset::js('//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'); ?>
	<?php echo Asset::js('jquery.jgrowl_minimized.js'); ?>


	<script type="text/javascript">

		var base_url = "<?php echo Config::get("base_url"); ?>"
		var flashMessage = "<?php echo Session::get_flash("message", null)?>";

		$(function() {
			if (flashMessage) {
				$.jGrowl(flashMessage, { header: 'Info', theme: 'jGrowl_info_1'});
			}
		});

	</script>

</head>

<div id="wrapper">

	<div id="header_container">
		<h1 id="logo"><?php echo Html::anchor(Config::get("base_url"), Model_Options::get("site_name"))?></h1>

		<div id="title_header"><h3><?php echo isset($title) ? $title : Model_Options::get("site_title"); ?></h3></div>
	</div>

	<div id="content">
		<?php echo isset($content) ? $content : ""; ?>
	</div>

	<div id="footer">
		<p>&copy;&nbsp;<?php echo Date::factory()->format("%Y");?> Manuel Joao Silva - Powered
		         by <?php echo Html::anchor("http://fuelphp.com", "FuelPHP")?> - Page Rendered in {exec_time}s using
		         {mem_usage} MB of memory.</p>
	</div>
</div>
</body>
</html>