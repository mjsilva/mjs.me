$(function()
{

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

	$("#shortener_form").submit(function(e)
	{

		e.preventDefault();

		$.post($(this).attr("action"), {url: $("#form_url").val()}, function(resp)
		{
			if (!resp) return false;

			var myShortenedSkeleton = $(shortenedSkeleton).clone();

			$(myShortenedSkeleton).find("a.short_link").html(resp.short_link).attr("href", resp.short_link);
			$(myShortenedSkeleton).find("a.stats_link").html("Stats").attr("href", resp.stats_link);
			$(myShortenedSkeleton).find("a.long_link").html(resp.long_link).attr("href", resp.long_link);

			$("ul#shortened_results").prepend(myShortenedSkeleton);
			$("#url_input input").val("");

			if(!$("#shortened").is(":visible"))
			{
				$("#shortened").fadeIn();
			}

		}, "json");

	});

});