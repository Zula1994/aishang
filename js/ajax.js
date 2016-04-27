//封装ajax函数
function ajax(url, fnSucc) {
	var request;
	//1.创建ajax
	if (window.XMLHttpRequest) {
		request = new XMLHttpRequest();
	} else {
		request = new ActiveXObject("Msxml2.XMLHTTP");
	}
	//2.建立连接
	request.open("get", url, true);
	//3.发送请求
	request.send();
	//4.接收响应
	//IE 不支持中文目录,访问时会解析错误 返回12152错误
	request.onreadystatechange = function() {
		if (request.readyState == 4) {
			if (request.status == 200) {
				var str = request.responseText;
				fnSucc(str);
			} 
		}
	}
}