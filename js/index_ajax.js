$(function() {
	ajax("http://localhost/aishang/Admin/json/news.txt", function(str) {
		showList(str);
	})
	
	function showList(str) {
		var json = eval("(" + str + ")").list;
		console.log(json);
		var d = new Date();
		for (var i = json.length-6; i <json.length-1; i++) {
			d.setTime(json[i].c_date);
			$("<tr>").prependTo('.MBlockTable');
			$("<td>",{
				width:"75%",
				text:"・ ",
			}).prependTo($(".MBlockTable").find("tr:eq(0)"));
			$("<a>",{
				href:"#",
				target:"_blank",
				title:json[i].title,
				text:json[i].title
			}).appendTo($(".MBlockTable").find("tr:eq(0)").find("td:eq(0)"))
			$("<td>",{
				width:"25%",
			}).appendTo(($(".MBlockTable").find("tr:eq(0)")));
			$("<span>",{
				
				text:FormatDate(d)
			}).appendTo($(".MBlockTable").find("tr:eq(0)").find("td:eq(1)"))
		}
	}
});