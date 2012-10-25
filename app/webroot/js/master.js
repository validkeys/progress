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
	var messages = ["Shipped, Bitch!","Fucking Rights!","You guys are amazing!","Holy Shit! Amazing work guys","Unbelievable!","FINGER CLAP!!!","I JUST !@#$'d in my @#$$","AMAZING!!!!","You are reaching god-like excellence","Backrubs on Jeff","We're Really Doing It, Harry"];
	msg = messages[Math.floor(Math.random()*messages.length)];

	var flash_element = $("<div>").addClass("flash-message");
	$(flash_element).append($("<h1>").text(msg));
	$('body').prepend(flash_element);
	$(flash_element).delay(1000).fadeOut(1000,function(){
		$('.flash-message').remove();
	});
	
}

function make_user_stories_sortable(){
	$('div.milestone').sortable({
		items: 'div.step',
		axis: 'y',
		scroll: true,
		tolerance: 'pointer',
		update: function(event, ui){
			$.ajax({
			  type: 'POST',
			  url: 'user_stories/sort.json',
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

function make_milestones_sortable(){
	$('div.roadmap').sortable({
		items: 'div.milestone',
		axis: 'x',
		scroll: true,
		tolerance: 'pointer',
		update: function(event, ui){
			$.ajax({
			  type: 'POST',
			  url: $('.roadmap').attr('data-webroot')+'milestones/sort.json',
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


function add_user_stories(evt, el){

	evt.preventDefault();

	$('#dialog-modal').dialog('open');
	
	var url = $(el).attr('href');
	$('#dialog-modal').find('a#new-step-save').unbind('click');
	$('#dialog-modal').find('a#new-step-save').click(function(event){
		event.preventDefault();
		$.ajax({
		  type: 'POST',
		  url: url+'.json',
		  data: {title: $('#new-step').val()},
		  success: function(data){
			if(data.status == "success"){
				$('#dialog-modal').dialog('close');
				
				$('input#new-step').val("");
				
				
				// Clear empty milestone div if exists
				if($('div#milestone-'+data.notes.UserStory.milestone_id+' div.emptyMilestone')){
					$('div#milestone-'+data.notes.UserStory.milestone_id+' div.emptyMilestone').fadeOut(100);
				}
				var new_data = data.form;

				

				$(new_data).insertBefore('div#milestone-'+data.notes.UserStory.milestone_id+' div.bottom').delay(500).slideDown(300).delay(100).effect('highlight',{},3000);
				$("div#user_story-"+data.notes.UserStory.id).find('a.step-delete').click(delete_user_story);
				$("div#user_story-"+data.notes.UserStory.id).find('a.task-open').click(toggle_task_listing);
				$("div#user_story-"+data.notes.UserStory.id).find('a.add-task-link').click(toggle_add_task_form);
				$("div#user_story-"+data.notes.UserStory.id).find('.add-task-form form').submit(submit_task_form);
				// console.log('div#milestone-'+data.notes.Step.milestone_id+' a.add-step');
				
				update_progress_bar();
				// console.log(data.notes);
				// $.scrollTo('#bottom-'+data.notes.Step.milestone_id,{duration: 700});
				
				
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

	$('#dialog-modal-milestone').find('a#new-milestone-save').unbind('click');
	$('#dialog-modal-milestone').find('a#new-milestone-save').click(function(event){
		
		event.preventDefault();
		// console.log(url);
		$.ajax({
		  type: 'POST',
		  url: url+'.json',
		  data: {title : $('#new-milestone').val(),due_date : $('#new-milestone-date').val()},
		  success: function(data){
			if(data.status == "success"){
				// console.log(data);

				$('#dialog-modal-milestone').dialog('close');
				$('input#new-milestone').val("");
				if($('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.empty-roadmap').length > 0){
					$('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.empty-roadmap').fadeOut(200).remove();
				}
				
				// 
				var div 	= $("<div>").attr('id', 'milestone-'+data.notes.Milestone.id).addClass('milestone').addClass('progress-'+data.notes.Milestone.id).css('display','none');
				var prog	= $("<div>").addClass('progressbar').addClass('progress-'+data.notes.Milestone.id);
				var h3		= $('<h3>').addClass("title").text(data.notes.Milestone.title);
				// <a href="#" class="magnify" rel="milestone-<?php echo $milestone['id'] ?>">+</a>
				var magnifier = $('<a>').addClass('magnify').attr('href','#').attr('rel','milestone-'+data.notes.Milestone.id).text('+');
				$(magnifier).click(magnify);
				$(h3).append(magnifier);
				var emptyDiv 	= $('<div>').addClass('emptyMilestone').text('Beer me some stories');
				var bottom 		= $('<div>').addClass('bottom').attr('id','bottom-'+data.notes.Milestone.id);
				var h3del		= $('<a>').attr('href','milestones/delete/'+data.notes.Milestone.id).addClass('btn btn-danger delete-milestone').text('Delete').click(delete_milestone);
				
				var link 	= $('<a>').attr('href','user_stories/add/milestone_id:'+data.notes.Milestone.id+'.json').addClass('btn add-step').text('+ Add').click(function(event){
					add_user_stories(event, link);
				});
				
				
				$(div).append(prog);
				$(div).append(h3);
				$(div).append(emptyDiv);
				$(div).append(bottom);
				$(bottom).append(link);
				$(bottom).append(h3del);
				$(bottom).append($('<div class="clear-bottom" style="clear:both"></div>'));
				
				// console.log(div);
				$('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.milestone');
				// $(div).css('width',newWidth);
				$(div).insertBefore('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.clear').fadeIn(1000).delay(100).effect('highlight',{},3000);
				// set_milestone_width(data.notes.Milestone.roadmap_id);
				// $('div#roadmap-'+data.notes.Milestone.roadmap_id).append(div);

				update_progress_bar();
				make_milestones_sortable();
				make_user_stories_sortable();
				$.scrollTo('#milestone-'+data.notes.Milestone.id+' div.bottom',{duration: 700});
				
			}else{
				alert("For some reason, that steo could not be saved" + data.notes);
			}
		},
		  dataType: 'json'
		});
		
		
	});
}

// function set_milestone_width(roadmap_id){
	
// 	var current 	= (((100 / $('div#roadmap-'+roadmap_id+' div.milestone').length) - 2) / 100) * 830;
// 	current = current + "px";
// 	$('div#roadmap-'+roadmap_id+' div.milestone').css('width',current);
// }


function make_user_story_checkboxes_checkable(el){

		var checkedbox = $(this);
		var id = $(checkedbox).attr('name').split('-')[1];
		console.log(checkedbox);
		$.ajax({
		  type: 'POST',
		  url: $('.roadmap').attr('data-story-complete-url'),
		  data: 'id='+id,
		  success: function(data){
		  	console.log(data);
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

function toggle_task_completeness(evt){
		evt.preventDefault();
		var form = $(this).parent();
		$.ajax({
		  type: 'POST',
		  url: $('.roadmap').attr('data-task-complete-url'),
		  data: $(form).serialize(),
		  success: function(data){
			if(data.response.status != 'success'){
				alert('Problem saving that');
			}
		},
		  dataType: 'json'
		});
}


function delete_milestone(event){

	event.preventDefault();
	var url 		= $(this).attr('href');
	var el_parent 	= $(this).parent();
	// console.log(el_parent);
	
	$.ajax({
	  type: 'POST',
	  url: url+'.json',
	  success: function(data){
		if(data.status == 'success'){
			$('div#milestone-'+data.notes.Milestone.id).fadeOut(1000,function(){
				$(this).remove();
				if($('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.milestone').length == 0){
					var emptyRoadmap = $('<div>').addClass('empty-roadmap');
					$(emptyRoadmap).insertBefore('div#roadmap-'+data.notes.Milestone.roadmap_id+' div.clear');
				}
				// set_milestone_width(data.notes.Milestone.roadmap_id);
			});
		}else{
			alert('There was a problem deleting that. Try refreshing the page and doing it again. Sorry, I kind of suck');
		}
	},
	  dataType: 'json'
	});
}

function delete_user_story(event){

	event.preventDefault();
	var url 		= $(this).attr('href');

	
	$.ajax({
	  type: 'POST',
	  url: url+'.json',
	  success: function(data){
		if(data.status == 'success'){
			$('div#user_story-'+data.notes.UserStory.id).slideUp(1000,function(){

				var parent = $('div#user_story-'+data.notes.UserStory.id).parent();
				if($(parent).find('div.step').length > 1){
					console.log('still steps');
				}else{
					var emptyDiv = $('<div>').addClass('emptyMilestone').text('Beer me some stories');
					$(emptyDiv).insertBefore($('div#milestone-'+data.notes.UserStory.milestone_id+ ' div.bottom'));
				}
				
				$(this).remove();
			});
			
		}
	},
	  dataType: 'json'
	});
}


function delete_roadmap(event){

	event.preventDefault();
	var url = $(this).attr('href');
	// console.log($(this));
	
	$.ajax({
	  type: 'POST',
	  url: url+'.json',
	  success: function(data){
		if(data.status == 'success'){
			$('div#roadmap-'+data.notes.Roadmap.id).slideUp(200,function(){
				$(this).remove();
			});
		}
	},
	  dataType: 'json'
	});
}

function add_roadmap(event){
	
	event.preventDefault();
	
	$('#dialog-modal-roadmap').dialog('open');
	
	var url = $(this).attr('href');
	
	$('#dialog-modal-roadmap').find('a#new-roadmap-save').unbind('click');
	$('#dialog-modal-roadmap').find('a#new-roadmap-save').click(function(event){
		event.preventDefault();
		$.ajax({
		  type: 'POST',
		  url: url+'.json',
		  data: {title : $('#new-roadmap').val()},
		  success: function(data){
			if(data.status == "success"){
				$('#dialog-modal-roadmap').dialog('close');
				$('input#new-roadmap').val("");
				// Create the container elements
				var container 	= $('<div>').addClass('roadmap').attr('id','roadmap-'+data.notes.Roadmap.id);
				var h2			= $('<h2>').text(data.notes.Roadmap.title);
				var addLink		= $('<a>').attr('href','milestones/add/roadmap_id:'+data.notes.Roadmap.id+'.json').addClass('add-milestone').text('Add Milestone');
				$(addLink).click(function(event){
					event.preventDefault();
					add_milestones($(this));
				});
				var delLink			= $('<a>').attr('href','roadmaps/delete/'+data.notes.Roadmap.id).addClass('delete-roadmap').text('Delete');
				$(delLink).click(delete_roadmap);
				var emptyRoadmap 	= $('<div>').addClass('empty-roadmap').css('display','none');
				var divclear 		= $('<div>').addClass('clear').css('clear','both');
				$(h2).append(addLink);
				$(h2).append(delLink);
				$(container).append(h2);
				$(container).append(emptyRoadmap);
				$(container).append(divclear);

				// console.log(container);
				$('#content-container').append(container);
				// $.scrollTo('#roadmap-'+data.notes.Roadmap.id + ' div.scroller',{duration: 700});
				$('html, body').animate({scrollTop:$(document).height()},700);
				$('#roadmap-'+data.notes.Roadmap.id + ' div.empty-roadmap').fadeIn(1500);
				
			}else{
				alert("For some reason, that roadmap could not be saved" + data.notes);
			}
		},
		  dataType: 'json'
		});
		
		
	});	
}

function magnify(event){
	// console.log($(this));
	event.preventDefault();
	var rel = $(this).attr('rel');
	var bgdiv = $('<div>').addClass('lightboxbg').css('width',$(window).width()).css('height',$(window).height());
	var close = $('<a href="#" class="close-window"></a>');
	$('div#'+rel).find('a.magnify').hide();
	$(close).click(function(){
		$(bgdiv).remove();
		$('div#'+rel).removeClass('lightbox');
		$(this).remove();
		$('div#'+rel).find('a.magnify').show();
	})
	$('div#'+rel).prepend(close);
	$('body').prepend(bgdiv);
	$('div#'+rel).addClass('lightbox');
}

function submit_task_form(evt){
	var el = $(this);
	evt.preventDefault(evt);
	$.ajax({
	  type: 'POST',
	  url: $(this).attr('action')+'.json',
	  data: $(this).serialize(),
	  success: function(data){
		if(data.status == "success"){
			$(el).parent().parent().parent().find('.tasks-inner').append(data.form);
			$(el).find('input.task-title-element').val('');
		}else{
			alert("For some reason, that steo could not be saved" + data.notes);
		}
	},
	  dataType: 'json'
	});
}

function toggle_task_listing(evt){
		evt.preventDefault();
		$(this).parent().parent().find('.tasks-wrapper').toggle();
}

function toggle_add_task_form(evt){
	evt.preventDefault();
	$(this).parent().find('.add-task-form').toggle();
}


$(document).ready(function() {
	
	// A few stylings
	$('div.step:last-child').css('border','none');
	
	update_progress_bar();
	
	// Add in the sortable option
	make_user_stories_sortable();
	
	// 	Initiate the checkbox post function
	// make_checkboxes_checkable();
	
	$('a.add-step').click(function(event){
		add_user_stories(event, $(this));
	});
	$('a.add-milestone').click(function(event){
		event.preventDefault();
		add_milestones($(this));
	});
	
	make_milestones_sortable();
	
	$('input.user-story-check').change(make_user_story_checkboxes_checkable);
	$('input.task-check').change(toggle_task_completeness);
	
	// Add Modal
	$( "#dialog-modal").dialog({
				height: 190,
				width: 500,
				modal: true,
				autoOpen: false
			});

	$( "#dialog-modal-milestone").dialog({
				height: 190,
				width: 500,
				modal: true,
				autoOpen: false
			});


	$( "#dialog-modal-roadmap").dialog({
				height: 190,
				width: 500,
				modal: true,
				autoOpen: false
			});

			
	$('a.delete-milestone').click(delete_milestone);
	
	$('a.step-delete').click(delete_user_story);
	
	$('a#roadmap-add').click(add_roadmap);
	
	$('a.delete-roadmap').click(delete_roadmap);
	
	$('a.magnify').click(magnify);
	
	$('a.task-open').click(toggle_task_listing);

	$('a.add-task-link').click(toggle_add_task_form);

	$('.add-task-form form').submit(submit_task_form);
});
