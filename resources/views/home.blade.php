@extends('layouts.app')
@section('title', 'Início')
@section('content')
<header class="page-header">
<h2>Dashboard</h2>

<div class="right-wrapper pull-right">
<ol class="breadcrumbs">
	<li>
		<a href="index.html">
			<i class="fa fa-home"></i>
		</a>
	</li>
	<li><span>Dashboard</span></li>
</ol>

<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
</div>
</header>

<div class="row">
<div class="col-md-6">
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="fa fa-caret-down"></a>
								<a href="#" class="fa fa-times"></a>
							</div>

							<h2 class="panel-title">Best Seller</h2>
							<p class="panel-subtitle">Customize the graphs as much as you want, there are so many options and features to display information using JSOFT Admin Template.</p>
						</header>
						<div class="panel-body">

							<!-- Flot: Basic -->
							<div class="chart chart-md" id="flotDashBasic" style="padding: 0px; position: relative;"><canvas class="flot-base" width="690" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 690px; height: 350px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 32px; text-align: center;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 97px; text-align: center;">1</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 161px; text-align: center;">2</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 226px; text-align: center;">3</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 291px; text-align: center;">4</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 356px; text-align: center;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 420px; text-align: center;">6</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 485px; text-align: center;">7</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 550px; text-align: center;">8</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 614px; text-align: center;">9</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 327px; left: 676px; text-align: center;">10</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 301px; left: 14px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 226px; left: 8px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 151px; left: 1px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 75px; left: 1px; text-align: right;">150</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">200</div></div></div><canvas class="flot-overlay" width="690" height="350" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 690px; height: 350px;"></canvas><div class="legend"><div style="position: absolute; width: 54px; height: 66px; top: 16px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:16px;right:13px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #0088cc;overflow:hidden"></div></div></td><td class="legendLabel">Series 1</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #2baab1;overflow:hidden"></div></div></td><td class="legendLabel">Series 2</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #734ba9;overflow:hidden"></div></div></td><td class="legendLabel">Series 3</td></tr></tbody></table></div></div>
							<script>

								var flotDashBasicData = [{
									data: [
										[0, 170],
										[1, 169],
										[2, 173],
										[3, 188],
										[4, 147],
										[5, 113],
										[6, 128],
										[7, 169],
										[8, 173],
										[9, 128],
										[10, 128]
									],
									label: "Series 1",
									color: "#0088cc"
								}, {
									data: [
										[0, 115],
										[1, 124],
										[2, 114],
										[3, 121],
										[4, 115],
										[5, 83],
										[6, 102],
										[7, 148],
										[8, 147],
										[9, 103],
										[10, 113]
									],
									label: "Series 2",
									color: "#2baab1"
								}, {
									data: [
										[0, 70],
										[1, 69],
										[2, 73],
										[3, 88],
										[4, 47],
										[5, 13],
										[6, 28],
										[7, 69],
										[8, 73],
										[9, 28],
										[10, 28]
									],
									label: "Series 3",
									color: "#734ba9"
								}];

								// See: assets/javascripts/dashboard/examples.dashboard.js for more settings.

							</script>

						</div>
					</section>
				</div>

</div>
@endsection

@section('scripts')
<script>

/*
Sales Selector
*/
$('#salesSelector').themePluginMultiSelect().on('change', function() {
var rel = $(this).val();
$('#salesSelectorItems .chart').removeClass('chart-active').addClass('chart-hidden');
$('#salesSelectorItems .chart[data-sales-rel="' + rel + '"]').addClass('chart-active').removeClass('chart-hidden');
});

$('#salesSelector').trigger('change');

$('#salesSelectorWrapper').addClass('ready');

/*
Flot: Basic
*/
var flotDashBasic = $.plot('#flotDashBasic', flotDashBasicData, {
series: {
	lines: {
		show: true,
		fill: true,
		lineWidth: 1,
		fillColor: {
			colors: [{
				opacity: 0.45
			}, {
				opacity: 0.45
			}]
		}
	},
	points: {
		show: true
	},
	shadowSize: 0
},
grid: {
	hoverable: true,
	clickable: true,
	borderColor: 'rgba(0,0,0,0.1)',
	borderWidth: 1,
	labelMargin: 15,
	backgroundColor: 'transparent'
},
yaxis: {
	min: 0,
	max: 200,
	color: 'rgba(0,0,0,0.1)'
},
xaxis: {
	color: 'rgba(0,0,0,0)'
},
tooltip: true,
tooltipOpts: {
	content: '%s: Value of %x is %y',
	shifts: {
		x: -60,
		y: 25
	},
	defaultTheme: false
}
});


</script>
@endsection
