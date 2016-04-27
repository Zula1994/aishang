$(function() {
	ajax("../Admin/json/news.txt", function(str) {
		showList(str);
	})

	function showList(str) {
		var json = eval("(" + str + ")").list;
		var d = new Date();
		for (var i = 0; i < json.length; i++) {
			d.setTime(json[i].c_date);
			console.log(FormatDate(d));
			$("<li>", {
				"class": "ColorLink",
			}).prependTo($('#list')[0]);
			$("<span>", {
				text: FormatDate(d),
			}).appendTo($("#list>li:eq(0)"));
			$("<a>", {
				"href": "../html/1.html",
				"target": "_blank",
				text: json[i].title,
			}).appendTo($("#list>li:eq(0)"));
			$("<p>", {
				text: json[i].description,
			}).appendTo($("#list>li:eq(0)"));
		}
	}
});