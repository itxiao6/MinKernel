document.documentElement.style.fontSize = innerWidth / 16 + 'px';

		onresize = function() {
			document.documentElement.style.fontSize = innerWidth / 16 + 'px';
		};
  $(".zpf-dian").click(function(){
  
  	$(".zpf-dong").show(100)
  })
  $(".zpf-ji").click(function(){
  
  	$(".zpf-dong").hide(100)
  })
  
$(document).ready(function(){
	//加的效果
	$(".zpf-add").click(function(){
	var n=$(this).prev().val();
	var num=parseInt(n)+1;
	if(num==0){ return;}
	$(this).prev().val(num);
	});
	//减的效果
	$(".zpf-jian").click(function(){
	var n=$(this).next().val();
	var num=parseInt(n)-1;
	if(num==0){ return}
	$(this).next().val(num);
	});
	})
  $(".zpf-tiao").click(function(){
  	window.location.href="zpf-zf.html";
  })
 
    var oP=document.getElementsByClassName("zpf-up");
	var images = ['images/zpf-20.jpg', 'images/zpf-21.jpg']
//	$("#zpf-fe").click(function(){
//		
//	if($("#zpf-fe").attr("class")=="zpf-up"){
//	$("#zpf-fe").attr("src",images[1]);
//	
//	}else{
//	$("#zpf-fe").attr("src",images[0]);
//
//	}
//	});
	var oP=document.getElementsByClassName("zpf-cont");
	  oP.onclick=function(){
	  	alert()
	  }
	
