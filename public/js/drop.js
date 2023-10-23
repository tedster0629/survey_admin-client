(function($) {
	
	"use strict"; 
	
	$("#questions-items li").draggable({
		appendTo: "body",
		helper: "clone"
	});

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// DropZones
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$(".droppable ol").droppable({
		activeClass: "ui-state-default",
		hoverClass: "ui-state-hover",
		accept: ":not(.ui-sortable-helper)",
		drop: handleDropEvent,
	});
	
	// Handle drop-zones
	function handleDropEvent(event, ui) 
	{
		$( this ).find( ".placeholder" ).remove();
		$( '<li id="item_'+ui.draggable.attr("id")+'" data-zone="'+this.id+'"><\/li>' ).text( ui.draggable.text() ).appendTo( this );
		
		var items = [];
		$("ol li").each(function(n)
		{
		  items[n] = '('+$(this).html()+'|'+$(this).data('zone')+'|'+$(this).attr("id")+')';
	   });
		
		object.arrays = items;
		
		// remove elements by double click
		$(".ui-droppable li").on('dblclick', function(){
			$(this).remove();	
		});
	} 
	
	// from here can do a save to database couse its array
	$("#save-drop-zones").on('click', function()
	{
		var items = 'items='+object.arrays+'&names='+$('#dropzones-names').val()+'&master='+$('#post-master').val();
		 $.post("includes/publish.php", items, function(response)
		 {
			if(response == true) 
			{
				window.location.href = 'launch_survey.php';
				success_notices('Successfully published');
			} else if(response == 'TRIGGER_INFO') {
				info_notices('No questions in the drop zones');
				toTop();
			} else {
				window.location.href = 'launch_survey.php';
				failure_notices('Failed publish survey. Probably you are duplicating');
			}
		 });	
	})

	var object = {}
	
})(jQuery);