$(function() {
	var shortenedSkeleton = '<li class="link_details clearfix">' +
			'<div class="short_link_ct clearfix">' +
			'<a class="short_link" href="#"></a>' +
			'<span class="clippy">' +
			'<a class="copy_bto" href="#">Copy</a>' +
			'</span>' +
			'</div>' +
			'<a class="stats_link" href="#"></a>' +
			'<a class="long_link" href="#"></a>' +
			'</li>';

	$("#shortener_form").submit(function(e) {

		e.preventDefault();

		$.post($(this).attr("action"), $("#shortener_form").serialize(), function(resp) {
			if (!resp) return false;

			if (typeof resp.errors != "undefined") {
				$.jGrowl(resp.errors, { header: 'Error', theme: 'jGrowl_error_1'});
			}

			var myShortenedSkeleton = $(shortenedSkeleton).clone();

			$(myShortenedSkeleton).find("a.short_link").html(resp.short_link).attr("href", resp.short_link);
			$(myShortenedSkeleton).find("a.stats_link").html("Stats").attr("href", resp.stats_link);
			$(myShortenedSkeleton).find("a.long_link").html(resp.long_link).attr("href", resp.long_link);

			$("ul#shortened_results").prepend(myShortenedSkeleton);
			$("#url_input").val("");
			$("#form_custom_shorturl").val("");

			if (!$("#shortened").is(":visible")) {
				$("#shortened").fadeIn();
			}

			assignZclipTrigger();

		}, "json");

	});

	assignZclipTrigger();


	// more options
	$("#options_toggle").click(function(){
		$("#options_elements").slideToggle("fast");
	});

	$("#options_elements").hide();
	$("#options_toggle").show();

});

var assignZclipTrigger = function() {

	$('.copy_bto').zclip('remove');
	$(".copy_bto").zclip({
		path:'assets/swf/ZeroClipboard.swf',
		copy: function() {
			return $(this).parents(".short_link_ct").find(".short_link").eq(0).attr("href");
		},
		afterCopy: function() {
			$.jGrowl("Short Link has been copied to your clipboard.", { header: 'Info', theme: 'jGrowl_info_1'});
		}
	});
	
}