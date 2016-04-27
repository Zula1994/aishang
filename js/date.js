function FormatDate(d) {
	var d = new Date();
	var yyyy = d.getFullYear();
	var mm = d.getMonth() + 1;
	var dd = d.getDate();
	var h = d.getHours();
	var m = d.getMinutes();
	var s = d.getSeconds();
	var str = yyyy + "-" + Full(mm) + "-" + Full(dd) ;
	return str;
}

function Full(i) {
	if (i < 10)
		return '0' + i;
	else return '' + i;
}