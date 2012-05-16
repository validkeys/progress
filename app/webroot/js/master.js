function update_progress_bar(){

	$('div.milestone').each(function(){
		
		var checkboxes = $(this).find('input[type=checkbox]');
		var class_name = $(this).attr('class').split(' ')[1];
		
		var num_items = checkboxes.length;
		var num_items_checked = $(this).find('input[type=checkbox]:checked').length;
		// console.log(class_name);
		// console.log(num_items_checked);
		
		var progress = 0;
		
		if(num_items_checked > 0){
			progress = num_items_checked / num_items * 100;
		}
		
		$("div.progressbar."+class_name).progressbar({ value: progress });
		
	});
	
	// $("table#"+table_id+"tr.progress td.progressbar."+row_class).progressbar({ value: progress });
}

function flash(){
	// <div class="flash-message">
	// 	<h1>FUCKING RIGHTS!</h1>
	// </div>
	
	var messages = ["Shipped, Bitch!","Fucking Rights!","You guys are amazing!","Holy Shit! Amazing work guys","Unbelievable!","FINGER CLAP!!!","I JUST !@#$'d in my @#$$","AMAZING!!!!","You are reaching god-like excellence","Backrubs on Jeff","We're Really Doing It, Harry"];
	msg = messages[Math.floor(Math.random()*messages.length)];

	var flash_element = $("<div>").addClass("flash-message");
	$(flash_element).append($("<h1>").text(msg));
	$('body').prepend(flash_element);
	$(flash_element).delay(3000).fadeOut(1000,function(){
		$('.flash-message').remove();
	});
	
}

function make_steps_sortable(){
	$('div.milestone').sortable({
		items: 'div.step',
		axis: 'y',
		scroll: true,
		tolerance: 'pointer',
		update: function(event, ui){
			$.ajax({
			  type: 'POST',
			  url: 'steps/sort.json',
			  data: $(this).sortable('serialize'),
			  success: function(data){
				if(data.response.status == 'failure'){
					alert('Sorry. Kyle sucks at programming. That wasnt saved');
				}
			},
			  dataType: 'json'
			});
		}
	});
}

function add_steps(el){
	event.preventDefault();

	$('#dialog-modal').dialog('open');
	
	var url = $(el).attr('href');
	$('#dialog-modal').find('a#new-step-save').unbind('click');
	$('#dialog-modal').find('a#new-step-save').click(function(){
		event.preventDefault();
		$.ajax({
		  type: 'POST',
		  url: url+'.json',
		  data: 'data[Step][title]='+$('#new-step').val(),
		  success: function(data){
			if(data.status == "success"){
				$('#dialog-modal').dialog('close');
				
				var div 	= $("<div>").attr('id', 'step_'+data.notes.Step.id).addClass('step').css('display','none');
				var input 	= $('<input type="checkbox">').addClass('pressly-check').attr('name','step-'+data.notes.Step.id).attr('id','step-'+data.notes.Step.id);
				$(input).change(make_checkboxes_checkable);
				var label 	= $('<label for="step-'+data.notes.Step.id+'">').text(data.notes.Step.title);
				$(div).append(input);
				$(div).append(label);
				$(div).insertBefore('div#milestone-'+data.notes.Step.milestone_id+' a.add-step').fadeIn(1000).delay(100).effect('highlight',{},3000);
				console.log('div#milestone-'+data.notes.Step.milestone_id+' a.add-step');
				
				
			}else{
				alert("For some reason, that steo could not be saved" + data.notes);
			}
		},
		  dataType: 'json'
		});
		
		
	});
}

function add_milestones(el){
	$('#dialog-modal-milestone').dialog('open');
	
	var url = $(el).attr('href');
	
	$('#dialog-modal-milestone').find('a#new-milestone-save').click(function(){
		$.ajax({
		  type: 'POST',
		  url: url+'.json',
		  data: 'data[Milestone][title]='+$('#new-milestone').val(),
		  success: function(data){
			if(data.status == "success"){
				// console.log(data);

				$('#dialog-modal-milestone').dialog('close');
				// 
				var div 	= $("<div>").attr('id', 'milestone-'+data.notes.Milestone.id).addClass('milestone').addClass('progress-'+data.notes.Milestone.id).css('display','none');
				var prog	= $("<div>").addClass('progressbar').addClass('progress-'+data.notes.Milestone.id);
				var h3		= $('<h3>').addClass("title").text(data.notes.Milestone.title);
				var h3del	= $('<a>').attr('href','milestones/delete/'+data.notes.Milestone.id).addClass('delete-milestone').text('Delete').click(delete_milestone);
				$(h3).append(h3del);
				var link 	= $('<a>').attr('href','steps/add/milestone_id:'+data.notes.Milestone.id+'.json').addClass('add-step').text('+ Add').click(function(){
					add_steps(link);
				});
				
				
				$(div).append(prog);
				$(div).append(h3);
				$(div).append(link);
				
				
				$('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.milestone');
				// $(div).css('width',newWidth);
				$(div).insertBefore('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.clear').fadeIn(1000).delay(100).effect('highlight',{},3000);
				set_milestone_width(data.notes.Milestone.roadmap_id);
				// $('div#roadmap-'+data.notes.Milestone.roadmap_id).append(div);

				update_progress_bar();
				
			}else{
				alert("For some reason, that steo could not be saved" + data.notes);
			}
		},
		  dataType: 'json'
		});
		
		
	});
}

function set_milestone_width(roadmap_id){
	// reset the widths
	var current 	= (100 / $('div#roadmap-'+roadmap_id+' div.milestone').length) - 1;
	current = current + "%";
	$('div#roadmap-'+roadmap_id+' div.milestone').css('width',current);
}


function make_checkboxes_checkable(el){

		var checkedbox = $(this);
		var id = $(checkedbox).attr('name').split('-')[1];
		
		$.ajax({
		  type: 'POST',
		  url: 'steps/complete.json',
		  data: 'id='+id,
		  success: function(data){
			if(data.response.status == 'success'){
				update_progress_bar();
				if(data.response.action == 'uncomplete'){
					if($(checkedbox).parent().hasClass('complete')){
						$(checkedbox).parent().removeClass('complete');
					}
				}else{
					$(checkedbox).parent().addClass('complete');
					flash();
				}
				
			}else{
				alert('Problem saving that');
			}
		},
		  dataType: 'json'
		});
}

function delete_milestone(){

	event.preventDefault();
	var url 		= $(this).attr('href');
	var el_parent 	= $(this).parent();
	console.log(el_parent);
	
	$.ajax({
	  type: 'POST',
	  url: url+'.json',
	  success: function(data){
		if(data.status == 'success'){
			$('div#milestone-'+data.notes.Milestone.id).fadeOut(1000,function(){
				$(this).remove();
				set_milestone_width(data.notes.Milestone.roadmap_id);
			});
			
		}
	},
	  dataType: 'json'
	});
		
		

}

$(document).ready(function() {
	
	// A few stylings
	$('div.step:last-child').css('border','none');

	update_progress_bar();
	
	// Add in the sortable option
	make_steps_sortable();
	
	// 	Initiate the checkbox post function
	// make_checkboxes_checkable();
	
	$('a.add-step').click(function(){
		add_steps($(this));
	});
	$('a.add-milestone').click(function(event){
		event.preventDefault();
		add_milestones($(this));
	});
	
	$('input[type=checkbox]').change(make_checkboxes_checkable);
	
	// Add Modal
	$( "#dialog-modal").dialog({
				height: 180,
				width: 500,
				modal: true,
				autoOpen: false
			});

	$( "#dialog-modal-milestone").dialog({
				height: 180,
				width: 500,
				modal: true,
				autoOpen: false
			});
			
	$('a.delete-milestone').click(delete_milestone);
	
});
