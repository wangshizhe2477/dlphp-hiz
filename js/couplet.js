
var tips;
var theTop;
var tipss;

tips = document.getElementById("floatbox_left");
moveTips();
tipss = document.getElementById("floatbox_right");
moveTipss();

function moveTips(){

	var iHeight;
	if(document.documentElement.clientHeight<=document.body.clientHeight&&document.documentElement.clientHeight){
	 iHeight = document.documentElement.clientHeight;
	}else{
	 iHeight = document.body.clientHeight;
	}

	var scrollTop;
	if (document.documentElement && document.documentElement.scrollTop){
	  scrollTop = document.documentElement.scrollTop;
	}else if (document.body){
	  scrollTop = document.body.scrollTop;
	}else if (window.pageYOffset){
	  scrollTop = window.pageYOffset;
	}

	theTop=140;
	var old=theTop;
	var tt=100;
	if(window.innerHeight){
		pos=window.pageYOffset
	}else if(document.documentElement&&document.documentElement.scrollTop){
		pos=document.documentElement.scrollTop
	}else if(document.body){
		pos=document.body.scrollTop;
	};

	pos=pos-tips.offsetTop+theTop;

	pos=tips.offsetTop+pos/5;



	if(pos<theTop){
		pos=theTop;
	};
	if(pos!=old){
		pos = pos+6;
		tips.style.top=pos+"px";
		tt=5;
	};
	old=pos;
	setTimeout(moveTips,tt);
};

function moveTipss(){

	var iHeight;
	if(document.documentElement.clientHeight<=document.body.clientHeight&&document.documentElement.clientHeight){
	 iHeight = document.documentElement.clientHeight;
	}else{
	 iHeight = document.body.clientHeight;
	}

	var scrollTop;
	if (document.documentElement && document.documentElement.scrollTop){
	  scrollTop = document.documentElement.scrollTop;
	}else if (document.body){
	  scrollTop = document.body.scrollTop;
	}else if (window.pageYOffset){
	  scrollTop = window.pageYOffset;
	}

	theTop=140;
	var old=theTop;
	var tt=100;
	if(window.innerHeight){
		poss=window.pageYOffset
	}else if(document.documentElement&&document.documentElement.scrollTop){
		poss=document.documentElement.scrollTop
	}else if(document.body){
		poss=document.body.scrollTop;
	};

	poss=pos-tipss.offsetTop+theTop;

	poss=tipss.offsetTop+pos/5;



	if(poss<theTop){
		poss=theTop;
	};
	if(poss!=old){
		poss = pos+6;
		tipss.style.top=poss+"px";
		tt=5;
	};
	old=poss;
	setTimeout(moveTipss,tt);
};