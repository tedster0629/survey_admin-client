<?php 
	$userID = $_SESSION['mySurvey_userid'];
	// $first_name = $user->get_user_('first_name', $userID);
	// $last_name = $user->get_user_('last_name', $userID);
	// $fullName = $first_name.' '.$last_name;
	// if($first_name == '' && $last_name == '')
	// {
	// 	$fullName = $user->get_user_('username', $userID);
	// }
?>

    <!-- MAIN -->
    <div id="main">
    	

        
        <!-- container -->
        <div class="bg"> 
        	
            <!-- row -->
            <div class="row">
            	

                
                <div class="col-md-12 pe-0"><!-- span9 -->
					<div class = "content-header">
						<h1 style = "color : #4172a5!important">Dashboard</h1>
						<!-- <p>Welcome <a href="profile.php?id=<?php echo $userID; ?>"><?php echo $fullName; ?></a>.</p> -->
					</div>

					<!-- MAIN CONTENT -->
					<div id="main-content" style = "padding : 15px">

						<!-- Quick Buttons -->
						<div class="quick-buttons">
							<div class="row">
								<div class="col-md-3">
									<a href="<?php echo base_url(); ?>admin/create_surveys" class="btn btn-primary btn-block">
										<i class="glyphicon glyphicon-dashboard"></i>
										<span class="dasboard-icons-title">Create</span>
									</a>
								</div>
								<div class="col-md-3">
									<a href="<?php echo base_url(); ?>admin/manage_surveys" class="btn btn-primary btn-block">
										<i class="glyphicon glyphicon-list-alt"></i>
										<span class="dasboard-icons-title">Manage</span>
									</a>
								</div>
								<div class="col-md-3">
									<a href="<?php echo base_url(); ?>admin/surveys_statistics" class="btn btn-primary btn-block">
										<i class="glyphicon glyphicon-stats"></i>
										<span class="dasboard-icons-title">Statistics</span>
									</a>
								</div>
								<div class="col-md-3">
									<a href="<?php echo base_url(); ?>admin/survey_settings" class="btn btn-primary btn-block">
										<i class="glyphicon glyphicon-cog"></i>
										<span class="dasboard-icons-title">Settings</span>
									</a>
								</div>
							</div>
						</div>
						<!-- // Quick Buttons -->

						<!-- chart (box full column) -->
						<div class="box box-info" style = "margin-top: 20px">
							<div class="header" style = "padding : 10px">
								<h3 class="sec_title" >Users Took Survey</h3>
							</div>
							<div class="content pad">
								<div class="chart" id="dashboard-chart"></div>
							</div>
						</div>
						<!-- // chart -->

						<div class="clearfix"></div>

					</div>
					<!-- // MAIN CONTENT -->
				</div>
				<!-- // col-md-9 -->
 
				
            </div>
            <!-- // row -->
        </div>
        <!-- // container -->
    </div>
    <!-- // MAIN --> 
    <script type="text/javascript">
		(function($) {
	
			"use strict";
			var dashboardChart = <?php echo json_encode($chart_data); ?>;
			document.addEventListener("DOMContentLoaded", () => {
				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawLineChart);

				function drawLineChart() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Months');
					data.addColumn('number', 'Total');
					
					var parsedData = JSON.parse(dashboardChart);
					for (var i = 0; i < parsedData.length; i++) {
						var date = new Date(parsedData[i][0]);
						var monthName = date.toLocaleString('default', { month: 'short' });
						data.addRow([monthName, parsedData[i][1]]);
					}

					var options = {
						title: '',
						curveType: 'function',
						legend: { position: 'none' },
						hAxis: {
							title: '' + new Date(parsedData[0][0]).getFullYear(),
							titleTextStyle: {
								fontSize: 14,
								bold: true,
								color: '#485b79'
							}
						},
						chartArea: {
							left: 50,
							right: 20,
							top: 20,
							bottom: 50
						}
					};

					var chart = new google.visualization.LineChart(document.getElementById('dashboard-chart'));
					chart.draw(data, options);
				}
			});
		})(jQuery);
	</script>


