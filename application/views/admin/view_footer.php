		</div>

	</div>


	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/select2.full.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jscolor.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.extensions.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/icheck.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/fastclick.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.fancybox.pack.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/app.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/demo.js"></script>
	<?php
	$currentUrl = $this->input->server('REQUEST_URI');
	$isInUrl = strpos($currentUrl, 'admin/statistic?') !== false;
	if ($isInUrl) {
	?>
	<?php $data = $this->Model_statistic->render_pie_chart(intval($_GET['id']), $this->Model_statistic->find_question_type(intval($_GET['id']))); ?>
	<?php if($data): ?>
	<script type="text/javascript">

		var data = [<?php echo $data; ?>];
		
		google.charts.load('current', { packages: ['corechart'] });
		google.charts.setOnLoadCallback(drawPieChart);

		function drawPieChart() 
		{
			var chartData = new google.visualization.DataTable();
			chartData.addColumn('string', 'Label');
			chartData.addColumn('number', 'Value');

			data.forEach(function(item) {
				chartData.addRow([item.label, item.data]);
			});

			var options = {
				width: 370,
				height: 300,
				pieSliceText: 'percentage',
				pieSliceTextStyle: {
					fontSize: 12,
					color: 'white',
					bold: true
				},
				pieSliceTextGap: 2,
				legend: {
					position: 'none'
				}
			};

			var chart = new google.visualization.PieChart(document.getElementById('google-pie'));
			chart.draw(chartData, options);
		}

	</script>
	<?php endif; ?>
	<?php } ?>
    
	<script>

	(function($) {
		
		$(document).ready(function() {
			
	        // $('#editor1').summernote({
	        // 	height: 300
	        // });
	        // $('#editor2').summernote({
	        // 	height: 300
	        // });
	        // $('#editor3').summernote({
	        // 	height: 300
	        // });
	        // $('#editor4').summernote({
	        // 	height: 300
	        // });
	        // $('#editor5').summernote({
	        // 	height: 300
	        // });
	        // $('#editor6').summernote({
	        // 	height: 300
	        // });
	        // $('.editor').summernote({
	        // 	height: 300
	        // });
	        // $('.editor_short').summernote({
	        // 	height: 150
	        // });


	    });

	    //Initialize Select2 Elements
	    $(".select2").select2();

	    //Datemask dd/mm/yyyy
	    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	    //Datemask2 mm/dd/yyyy
	    $("#datemask2").inputmask("mm-dd-yyyy", {"placeholder": "mm-dd-yyyy"});
	    //Money Euro
	    $("[data-mask]").inputmask();

	    //Date picker
	    $('.datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });
	    $('#datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('#datepicker1').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('#datepicker2').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass: 'iradio_minimal-blue'
	    });
	    //Red color scheme for iCheck
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass: 'iradio_minimal-red'
	    });
	    //Flat red color scheme for iCheck
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass: 'iradio_flat-green'
	    });


	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });

	    $('#confirm-delete').on('show.bs.modal', function(e) {
	      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	    });

	    $(document).ready(function () {
	    	CKEDITOR.replaceAll( 'editor' );
	  	}); 
		
		// CSV
		window.csv = function()
		{
			document.location.href = 'statistic/download_csv?id='+$("#export-csv").data('qid')+'&qtype='+$("#export-csv").data('qtype');
		}
 
	})(jQuery);

	</script>

	<script type="text/javascript">

        $(document).ready(function () {

		    $("#btnAddNew").click(function () {

		        var rowNumber = $("#PhotosTable tbody tr").length;

		        var trNew = "";              

		        var addLink = "<div class=\"upload-btn" + rowNumber + "\"><input type=\"file\" name=\"photos[]\"></div>";
		           
		        var deleteRow = "<a href=\"javascript:void()\" class=\"Delete btn btn-danger btn-xs\">X</a>";

		        trNew = trNew + "<tr> ";

		        trNew += "<td>" + addLink + "</td>";
		        trNew += "<td style=\"width:28px;\">" + deleteRow + "</td>";

		        trNew = trNew + " </tr>";

		        $("#PhotosTable tbody").append(trNew);

		    });

		    $('#PhotosTable').delegate('a.Delete', 'click', function () {
		        $(this).parent().parent().fadeOut('slow').remove();
		        return false;
		    });

		});

		selectEmailMethod = $('#selectEmailMethod').val();
        $('#selectEmailMethod').on('change',function() {
            selectEmailMethod = $('#selectEmailMethod').val();
            if ( selectEmailMethod == 'Normal' ) {
               	$('#smtpContainer').hide();
            } else if ( selectEmailMethod == 'SMTP' ) {
               	$('#smtpContainer').show();
            }
        });

		$("#order-questions").delegate('[data-option="order-questions-confirm"]', 'click', function(e) 
		{
			e.preventDefault();
			document.location.reload();
		});

		$( function() {
			$( "#sortList" ).sortable({
				opacity: 0.6,
				cursor: 'pointer',
				// placeholder: "placeholder",
				update: function( event, ui ) {
					var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
					$.post("questions/updateRecordsListings", order, function(theResponse){});
				}
			});
			$( "#sortList" ).disableSelection();
		} );
        

			// Answers add
	$(".form-actions").delegate('[data-option="add-answers"]', 'click', function(e) 
	{
		var serialize = $('form#answers').serialize();

		$.post('answers/add_answer', serialize, function(response) 
		{	
			alert('Successfully added answer');
			console.log('-----------' + response);
			if(response == true) 
			{
				success_notices('Successfully added answer');
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to add answer the fields cannot be empty');	
			} else {
				failure_notices('Failed to add answer. Probably the answer already exists');	
			}
		});
		e.preventDefault();

	});
	
	// Answers Update
	$(".form-actions").delegate('[data-option="update-answers"]', 'click', function(e) 
	{
		var serialize = $('form#answers').serialize();

		$.post('answers/update_answer', serialize, function(response) 
		{	
			alert('Successfully updated answer');
			if(response == true) 
			{
				success_notices('Successfully updated answer');
			} else if(response == 'TRIGGER_INFO') {
				info_notices('In order to update answer the fields cannot be empty');	
			} else {
				failure_notices('Failed to update answer. Probably the answer is already updated');	
			}
		});
		e.preventDefault();

	});

	// Define object at the end to fix ie bug
	var answers = {};

    </script>
	
</body>
</html>