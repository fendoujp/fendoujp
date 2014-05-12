function getId(id){return(document.getElementById(id));}
function setA(fileName,urlQ) {
	var newScript = document.createElement("script");
	if(urlQ){
		newScript.src =""+ fileName+".php"+urlQ;
	}else{
		newScript.src =""+ fileName+".php";
	}
	document.getElementsByTagName("head")[0].appendChild(newScript); 
} 
function insertHTML(objId,html){
	try{
		document.getElementById(objId).innerHTML=unescape(html);
	}catch(e){}
}
function getQ(name){
	var reg = new RegExp("(^|\\?|&)"+ name +"=([^&]*)(\\s|&|$)", "i");
	if (reg.test(location.href)) return unescape(RegExp.$2.replace(/\+/g, " ")); return "";
}

function menuF(ids){
	if(getId(ids).style.display=="none"){
		getId(ids).style.display="block";
	}else{
		getId(ids).style.display="none";
	}
	
	
}
function closeOpenUploadFile(s_name){
	document.getElementById("div_"+s_name).removeChild(document.getElementById("divchild_"+s_name));
}






function openUploadFile(s_name){
	var text="";
	var newDiv = document.createElement("div");
	newDiv.id = "divchild_"+s_name;
	newDiv.style.position="absolute";
	newDiv.style.zIndex="9999";
	newDiv.style.border="1px solid #555";
	newDiv.style.width="450px";
	newDiv.style.height="100px";
	newDiv.style.background="#f1f1f1";
	newDiv.style.left = "150"+"px";
	//newDiv.addonmousedown='startDrag(this,event)';
	//newDiv.onMouseMove='drag(this,event)' ;
	//newDiv.onMouseUp='stopDrag(this)'
	//dragTF="onMouseDown='startDrag(this,event)' onMouseMove='drag(this,event)' onMouseUp='stopDrag(this)'";
	dragTF="";
	text+="<div id='xing-fdakjreiu' "+dragTF+" style='text-align:right; padding:3px;background:#A6CAF0'><a style='color:#fff' href=javascript:closeOpenUploadFile('"+s_name+"')  >关闭<a></div>";
	text+="<div style='padding:0px'>";
	text+="<iframe width='100%' height='77' src='../../inc/citupload.php?s_name="+s_name+"' frameborder='none'></iframe>";
	text+="</div>";
	newDiv.innerHTML = text;
	document.getElementById("div_"+s_name).appendChild(newDiv);
	
	//var str = "";
	//str += "<div id='div_"+s_name+"'>";
	
	//str +="</div>";
}


var myalertX=0,myalertY=0,myalertX1=0,myalertY1=0;
var moveable=false;
var myalertIndex=10000;
var closeNum= false;
function myalert(text,divWidth,diwHeight,divLeft,divTop,dragTF,bgColor,alphaNun,divBorder,closeBackGround,closeColor){
	getWidth = document.compatMode != "BackCompat" ? Math.max(document.documentElement.scrollWidth, document.documentElement.clientWidth) : Math.max(document.body.scrollWidth, document.body.clientWidth);
	getHeight=document.compatMode != "BackCompat"?Math.max(document.documentElement.scrollHeight, document.documentElement.clientHeight) : Math.max(document.body.scrollHeight, document.body.clientHeight);
	if (!bgColor||bgColor==""){bgColor="#ffaaaa";}
	if(!alphaNun||alphaNun==""){alphaNun=50;}
	if(!divWidth||divWidth==""){divWidth=400}
	if(!diwHeight||diwHeight==""){diwHeight=150}
	if(!divLeft||divLeft==""){divLeft=((getWidth/2)-(divWidth/2)+30)+"px";}
	if(!divTop||divTop==""){divTop=document.documentElement.scrollTop+200+"px";}
	if(!divBorder||divBorder==""){divBorder="1px solid #BB0749";}
	if(!closeBackGround||closeBackGround==""){closeBackGround="url(images/pro_detail_tit_hover.jpg)";	}
	if(!closeColor||closeColor==""){closeColor="#fff";}
	if(!dragTF||dragTF==1){
		dragTF="onMouseDown='startDrag(this,event)' onMouseMove='drag(this,event)' onMouseUp='stopDrag(this)'"
	}else if(dragTF==2){dragTF="";}
	var newIframe = document.createElement("div");
	newIframe.id="myalertWindIframe";
	var ifr = newIframe.style;
	ifr.width=getWidth;
	ifr.height=getHeight;
	ifr.filter="alpha(opacity="+alphaNun+")";
	ifr.MozOpacity=alphaNun/100;  //firefox下
	ifr.position="absolute";
	ifr.background=bgColor;
	ifr.zIndex="1000";
	ifr.left="0px";
	ifr.top="0px";
	
	
	document.getElementsByTagName("body")[0].appendChild(newIframe);
	var newDiv = document.createElement("div");
	newDiv.id="myalertWinDiv";
	ndv = newDiv.style;
	ndv.position="absolute";
	ndv.zIndex="5000";
	ndv.left=divLeft;
	ndv.top=divTop;
	ndv.width=divWidth;
	ndv.height=diwHeight;
	ndv.border=divBorder
	ndv.background="#ffffff";
	
	newDiv.innerHTML="<div id='myalertWinClose' "+dragTF+" style='cursor:move;height:25px; line-height:25px;text-align:right; font-size:12px; font-weight:600; background:"+closeBackGround+"; padding:2px 10px 0px 0px;'><a style='color:"+closeColor+"' href='javascript:void(0);' onclick=windowClose('"+newIframe.id+"','"+newDiv.id+"') >关闭 </a></div><div style='text-align:center;'><div style='margin-top:0px;font-size:16px;color:#555;font-family:微软雅黑';>"+text+"</div></div>";
	
	document.getElementsByTagName("body")[0].appendChild(newDiv);
	return false
}
function windowClose(iframeId,winId){
	document.body.removeChild(document.getElementById(iframeId));  
	document.body.removeChild(document.getElementById(winId));
	return true;
}
function startDrag(obj,evt){
	e=evt?evt:window.event;
	if(true){
		if (!window.captureEvents){obj.setCapture();}
		else{window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);}
		var win=obj.parentNode;//取得父窗体
		win.style.zIndex=++myalertIndex;//设置父窗体的Z轴值
		myalertX= e.clientX;//取得当前鼠标的X坐标
		myalertY= e.clientY;//取得当前鼠标的Y坐标
		myalertX1 = parseInt(win.style.left);//将父窗体的距浏览器左边界的距离转换为NUMBER
		myalertY1 = parseInt(win.style.top);//将父窗体的距浏览器上边界的距离转换为NUMBER
		moveable=true;
		}
}
function drag(obj,evt){
	e=evt?evt:window.event;
	if(moveable){
	var win=obj.parentNode;
	win.style.left=myalertX1+e.clientX-myalertX;
	win.style.top=myalertY1+e.clientY-myalertY;
	}
}
function stopDrag(obj){
	if(moveable){
		if (!window.captureEvents){obj.releaseCapture();} 
		else{window.releaseEvents(Event.MOUSEMOVE|Event.MOUSEUP); }
		moveable = false;
	}
}

function talert(text,ttNum){
	myalert(text,320,80,"","",2,'#fff',50,'1px solid #000','','#ffffff');
	if(!ttNum){setTimeout("windowClose('myalertWindIframe','myalertWinDiv')",1000);}
	
}

function xalert(text,ttNum){
	myalert(text,420,230,"","",1,'#BAE3F5',60,'2px solid #2D7900','#2D7900','#fff');
	if(!ttNum){setTimeout("windowClose('myalertWindIframe','myalertWinDiv')",15000);}
	
}
function closeAlert(){
	windowClose('myalertWindIframe','myalertWinDiv');
}