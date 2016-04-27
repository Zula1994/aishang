$(function(){
	var Id=$("#news_id").text();
	$.getJSON("http://localhost/aishang/Admin/system/getHits.php",{id:Id} ,function(json){
		$("#hits").text(Number(json.hits));
		var Hits=Number(json.hits)+1;
		$.getJSON("http://localhost/aishang/Admin/system/getHits.php",{hits:Hits,id:Id});
	})
})

