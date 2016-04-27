window.onload = function() {
	fn1();
	fn2();
	fn3();
	fn4();


}

function getStyle(obj, attr) {
	if (obj.currentStyle) {
		//ie支持
		return obj.currentStyle[attr];
	} else {
		return getComputedStyle(obj, null)[attr];
	}
}
<!--导航栏的下拉菜单-->
function fn1() {
	var osddm = document.getElementById("sddm");
	var osddmLi = sddm.getElementsByTagName("li");
	var aDiv = [];
	var isIn = false;
	for (var i = 0; i < osddmLi.length; i++) {
		osddmLi[i].index = i;
		aDiv[i] = osddmLi[i].getElementsByTagName("div")[0];
		osddmLi[i].onmouseover = function() {
			var oDiv = aDiv[this.index];
			if (oDiv) {
				oDiv.style.display = "block";
				oDiv.onmouseover = function() {
					//oDiv1.style.display = "none";
					isIn = true;
					oDiv.style.display = "block";
				}
				oDiv.onmouseout = function() {
					//oDiv1.style.display = "none";
					isIn = false;
					oDiv.style.display = "none";
				}
			}
		}
		osddmLi[i].onmouseout = function() {
			var oDiv = aDiv[this.index];
			if (!isIn) {
				if (oDiv) {
					oDiv.style.display = "none";
				}
			}
		}
	}
}

<!--主页面滑动显示-->
function fn2() {
	var tab_hd = document.getElementsByClassName('tab-hd');
	var tab_bd = document.getElementsByClassName('tab-bd');
	var tab = document.getElementsByClassName('tab');
	for (var i = 0; i < tab.length; i++) {
		tab[i].index = i;
		tab[i].onmousemove = function() {
			var tab_hdLi = tab_hd[this.index].children;
			var tab_bdLi = tab_bd[this.index].children;
			for (var i = 0; i < tab_hdLi.length; i++) {
				tab_hdLi[i].index = i;
				tab_hdLi[i].onmousemove = function() {
					tab_bdLi[0].style.display = 'none';
					tab_bdLi[this.index].style.display = 'block';
				}
				tab_hdLi[i].onmouseout = function() {
					tab_bdLi[this.index].style.display = 'none';
				}

			}
		}
		tab[i].onmouseout = function() {
			var tab_bdLi = tab_bd[this.index].children;
			tab_bdLi[0].style.display = 'block';
		}
	}

}

<!--产品分类的侧拉菜单-->
function fn3() {
	var suckertree1 = document.getElementById("suckertree1");
	var suckLi = suckertree1.children;
	var suckLiUl = [];
	for (var i = 0; i < suckLi.length; i++) {
		suckLi[i].index = i;
		var arr = suckLi[i].children;
		//给有下级菜单的li加背景图
		for (var j = 0; j < arr.length; j++) {
			if (arr[j].nodeName == "UL") {
				suckLi[i].style.background = "url(..dimages/arrow-list.gif) no-repeat 150px center";
				//arr[j].style.display="block"
			}
		}
		suckLi[i].onmousemove = function() {
			var col = this.children;
			for (var k = 0; k < col.length; k++) {
				if (col[k].nodeName == "UL") {
					col[k].style.display = "block"
				}
			}
		}
		suckLi[i].onmouseout = function() {
			var col = this.children;
			for (var k = 0; k < col.length; k++) {
				if (col[k].nodeName == "UL") {
					col[k].style.display = "none"
				}
			}
		}
	}
}
<!--图片轮播-->
function fn4() {
	var box = document.getElementsByClassName("box");
	var i = 1;
	var s = "-326";
	box[0].style.position = "absolute";
	box[0].style.left = "0px";
	setInterval(function() {
		if (i < box.length - 2) {
			box[0].style.left = s * i + "px";
			for (var j = 1; j < box.length; j++) {
				box[j].style.position = "absolute";
				box[j].style.left = (parseInt(box[j - 1].style.left) + 326) + "px";
			}
			i++;
		} else {
			i = 1;
		}
	}, 5000);

}