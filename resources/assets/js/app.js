// Loading bootstrap
require('./bootstrap');
function searchVideos(search_word) {
	var list = {};
	$.ajax({
		type : 'GET',
		dataType : 'json',
		url : '/search-videos',
		data : {
			'search_word' : search_word
		},
		success : function(x) {
			var listLayer = $('#list');
			if (x.items) {
				var yt_item_html = atob(window.yt_item);
				var replaced_html = '';
				var tags = {};
				$('#notices').text('');  // clearing previous results
				listLayer.html('');  // clearing previous results
				listLayer.html('Results for <strong>' + search_word
						+ '</strong>: ');
				$.each(x.items, function(index, item) {
					replaced_html = yt_item_html; // fresh template 
					
					// tags to replace in the template
					tags = {
						title : item.snippet.title,
						description : item.snippet.description,
						videoId : item.id.videoId
					};
					
					// replace in action
					$.each(tags, function(tag_name, tag_value) {
						replaced_html = replaced_html.replace('[' + tag_name
								+ ']', tag_value);
					});

					// appending replaced template to the list of videos
					listLayer.append(replaced_html);
				});
			} else {
				listLayer.html(''); // clearing previous results
				$('#notices').text(x.error ? x.error : 'Unknown error');
			}
		}
	});
}
$('document').ready(function() {
	$('#search-word').keypress(function(event) {
		if (event.which == 13) {
			searchVideos($(this).val());
		}
	});

	$('#search-btn').click(function(event) {
		searchVideos($('#search-word').val());
	});
});