$(function() {
	ajax("http://localhost/aishang/Admin/json/gbook.txt", function(str) {
		showList(str);
	})
	function showList(str) {
		var json = eval("(" + str + ")").list;
		console.log(json);
		var d = new Date();
		for (var i = json.length-6; i <json.length-1; i++) {
			d.setTime(json[i].c_date);
			if(json[i].reply_content!=""){
			$("<div>",{
				class:"FeedBlock clear",
			}).prependTo(".FeedBack");
			$("<div>",{
				class:"Fleft",
			}).prependTo($('.FeedBack').find(".FeedBlock:eq(0)"));
			$("<div>",{
				class:"Ficon",
				html:"<img src='../images/PostIcon.gif' />",
			}).prependTo($(".FeedBlock:eq(0)").find(".Fleft:eq(0)"))
			$("<div>",{
				class:"Fname",
				text:json[i].f_name,
			}).appendTo($(".FeedBlock:eq(0)").find(".Fleft:eq(0)"))
			
			$("<div>",{
				class:"Fright",
			}).appendTo($('.FeedBack').find(".FeedBlock:eq(0)"));
			$("<div>",{
				class:"Fcontent clear",
			}).prependTo($(".FeedBlock:eq(0)").find(".Fright:eq(0)"));
			$("<div>",{
				class:"Ftime",
				text:FormatDate(d)
			}).appendTo($(".FeedBlock:eq(0)").find(".Fcontent:eq(0)"));
			$("<p>",{
				text:json[i].content,
			}).appendTo($(".FeedBlock:eq(0)").find(".Fcontent:eq(0)"));
			$("<div>",{
				class:"Freply",
			}).appendTo($(".FeedBlock:eq(0)").find(".Fcontent:eq(0)"));
			$("<div>",{
				class:"FRtitle",
				text:"回复",
			}).appendTo($(".FeedBlock:eq(0)").find(".Freply:eq(0)"));
			$("<p>",{
				text:json[i].reply_content,
			}).appendTo($(".FeedBlock:eq(0)").find(".Freply:eq(0)"));
		}
			}
	}
	
})

//<div class='FeedBlock clear'>
//	<div class='Fleft'>
//		<div class='Ficon'><img src='../images/PostIcon.gif'></div>
//		<div class='Fname'>Steve</div>
//	</div>
//	<div class='Fright'>
//		<div class='Fcontent clear'>
//			<div class='Ftime'>2012-5-21 21:58:02</div>
//			<p>日本消费电子业正在集体与旧日荣光道别。先是索尼、夏普迎来了历史性巨亏，这一次又轮到了松下</p>
//			<div class='Freply'>
//				<div class='FRtitle'>回 复</div>
//				<p>松下已经开始转型，它期望能在能源领域找到新的优势</p>
//			</div>
//		</div>
//		<div class='Fline'></div>
//	</div>
//</div>