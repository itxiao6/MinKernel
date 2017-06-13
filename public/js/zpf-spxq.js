document.documentElement.style.fontSize = innerWidth / 16 + 'px';

		onresize = function() {
			document.documentElement.style.fontSize = innerWidth / 16 + 'px';
		};
		

   var oDiv=document.getElementsByClassName("zpf-head")[0];
   var oH=oDiv.getElementsByTagName("h5");
   var oM=document.getElementsByClassName("zpf-max");

     for(var i=0;i<oH.length;i++){
     	oH[i].index=i;
     	oH[i].onclick=function(){
     		for(var n=0;n<oM.length;n++){
     			oH[n].className="";
     			oM[n].style.display="none";
     		}
     		   oH[this.index].className="zpf-active";
     			oM[this.index].style.display="block";
     	}
     }
    $(".zpf-dian").click(function(){
    	$(".zpf-link").hide(100)
    })
    $(".zpf-ji").click(function(){
    
    	$(".zpf-link").show(100)
    })
   $(".zpf-tiao").click(function(){
   	   window.location.href="zpf-dh.html";
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
