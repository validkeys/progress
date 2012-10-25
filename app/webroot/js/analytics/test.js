var cur;
var dataArray;

function nextProperty(){
	
}

function build(data, f){

	
	clear('',function(){
		f();
	});
	// $.each(data,function(key, val){
	// 	// console.log(val);
	// 	var h1 		= $('<h1>').attr('id','property').text(val.Account.title);
	// 	
	// 	// pageviews
	// 	var fLi = $('<li>');
	// 	fLi.append('<span class="title">New Visits</span>');
	// 	fLi.append('<span class="value">'+val.Account.newVisits+'</span>');
	// 	
	// 	$('div#google-test ul').append(fLi);
	// 	
	// });
	
	
}
function fadeLi(elem,t){
	 elem.fadeOut(700, function() { 
		if($("div#google-test ul li:visible").length == 0){
			$('h1#property').fadeOut(1000,function(t){
				t();
			});
		}else{
			fadeLi($(this).prev()); 	
		}
		
	});
}

function clear(p, fun){
	fadeLi($("div#google-test ul li:last"),function(){
		console.log('done')
	});
	// fun();
	
}



$(document).ready(function(){	
	// clear();
	$.getJSON('/pressly-progress/js/analytics/test.json',function(data){
		build(data,function(){
			console.log('test');
		});
	});
	
});

