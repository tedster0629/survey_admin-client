<?php 
	$id = intval($_GET['id']);
	if(!isset($id) || $id == 0)
	{
		header('Location: survey_statistics.php');
		exit();
	}
	$raw = $this->Model_statistic->chart_data($id, $this->Model_statistic->find_question_type($id));
	$total = array_sum($this->Model_statistic->array_values_recursive($raw));
?>
<!-- MAIN -->
<div id="main">      
    <!-- container -->
    <div class="bg">
        <!-- row -->
        <div class="row">
            <div class="col-md-12"><!-- col-md-9 -->  
				<div class="content-header">
					<?php if($this->Model_statistic->get_questions_info($id, 'questions') == true) { ?>    
					<h1 style="color: #4172a5!important;"><?php echo $_SESSION['survey_name']; ?></h1>
					<p>Question: <?php echo $this->Model_statistic->get_questions_info($id, 'questions'); ?></p>
					<?php } else {
						// not valid survey id and not valid id 
						header('Location: survey_statistics.php');
						exit();
					} ?>
				</div>
				<!-- MAIN CONTENT -->      
				<div id="main-content" style="padding: 15px;">
					<div class="notice_messages"></div>
					<?php if($this->Model_statistic->chart_data($id, $this->Model_statistic->find_question_type($id)) == true) { ?>
					<div class="box box-info" >
						<div style = "padding : 10px">
					<table  id="example1" class="table table-bordered bt-dataTable" id="dataTable">
						<thead>
							<tr>
								<th>Count</th>
								<th>Answer</th>
								<th>Percentage</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->Model_statistic->chart_data($id, $this->Model_statistic->find_question_type($id)) as $v) { ?>
							<tr>
								<td class="w-60"><?php echo $v['qtd']; ?></td>
								<td><?php echo $v['answer']; ?></td>
								<td class="w-80"><?php echo round($v['qtd']/$total, 2)*100 ?>%</td>
							</tr>	
							<?php } ?>
						</tbody>
					</table> 
					<?php $have_data = 'OK'; ?> 
					<?php } else { ?>
					<?php $have_data = 'NO'; ?>
					<p>No answers found for this question.</p>
					<?php } ?>   
					<div class="mb-20"></div>
					<div class="row grid-set">
						<!-- Answers -->
						<div class="col-md-6 col-sm-6">
							<div class="box box-info">
								<div  class="header" style="padding: 10px;"><h3 class="sec_title">Answer Fact</h3></div>
								<div class="content pad" id="answers-table">
									<?php if($have_data == 'OK') { ?>
									<ul class="unordered">
										<?php if($this->Model_statistic->find_question_type($id) !== 'matrix_multi_select' && $this->Model_statistic->find_question_type($id) !== 'matrix_single' && $this->Model_statistic->find_question_type($id) !== 'multiple_choice') { ?>
										<li><?php echo $this->Model_statistic->get_number_of_answers($id); ?> answered this question</li>
										<?php } else { ?>
										<li>This question has: <?php echo $this->Model_statistic->get_number_of_answers($id); ?> answers</li>
										<?php } ?>
										<li>Most of the users are from: <?php echo 'US'  ?></li>
										<li>The answer rate to this question is: <?php echo $this->Model_statistic->get_answer_rate($id); ?></li>
									</ul>
									<?php } else { ?>
									<p>No data found to render facts</p>
									<?php } ?>
								</div>  
							</div>  
						</div>
						<!-- // Answers -->
						<!-- Pie -->
						<div class="col-md-6 col-sm-6">
							<div class="box box-info">
								<div class="header"  style="padding: 10px;"><h3 class="sec_title">Pie Chart</h3></div>
								<div class="content pad">
									<?php if($have_data == 'OK') { ?>
									<?php if($this->Model_statistic->find_question_type($id) !== 'single_text' && $this->Model_statistic->find_question_type($id) !== 'comment_box' && $this->Model_statistic->find_question_type($id) !== 'matrix_multi_select' && $this->Model_statistic->find_question_type($id) !== 'matrix_single') { ?>
									<div id="google-pie" class="google-pie"></div>
									<?php } else { ?>   
									<p>This question type does not support pie charts.</p>
									<?php } ?>
									<?php } else { ?>
									<p>No data found to render pie chart</p>
									<?php } ?>
								</div> 
							</div>
						</div>
						<!-- // Pie -->
					</div><!-- // .row .grid-set -->
					<?php if($have_data == 'OK') { ?>
					<button id="export-csv" onclick="csv();" data-qid="<?php echo $id; ?>" data-qtype="comment_box" class="btn btn-primary d-block mb-3 float-right">Export to CSV</button>
					<?php } ?>
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