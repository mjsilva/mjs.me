<?php echo Asset::js('highcharts.js'); ?>
<script type="text/javascript">

	$(function()
	{

		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				defaultSeriesType: 'line',
				marginRight: 130,
				marginBottom: 25
			},
			title: {
				text: 'Monthly URL Hits',
				x: -20 //center
			},
			subtitle: {
				text: '<?php echo $short_url?>',
				x: -20
			},
			xAxis: {
				categories: <?php echo json_encode(array_keys($chart_data)) ?>
			},
			yAxis: {
				title: {
					text: 'Hits'
				},
				plotLines: [
					{
						value: 0,
						width: 1,
						color: '#808080'
					}
				]
			},
			tooltip: {
				formatter: function()
				{
					return this.x + ': ' + this.y + ' hits';
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -10,
				y: 100,
				borderWidth: 0
			},
			series: [
				{
					name: 'Hits',
					data: <?php echo json_encode(array_values($chart_data)) ?>
				}
			]
		});

	});

</script>

<div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>

<div style="text-align:center;"><?php echo Html::anchor($real_url, $real_url) ?></div>