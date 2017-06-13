document.documentElement.style.fontSize = innerWidth / 16 + 'px';

		onresize = function() {
			document.documentElement.style.fontSize = innerWidth / 16 + 'px';
		};
		
    var oDiv=document.getElementsByClassName("zpf-cont")[0];
   var oH=oDiv.getElementsByTagName("li");
   var oM=document.getElementsByClassName("zpf-link");
     for(var i=0;i<oH.length;i++){
     	oH[i].index=i;
     	oH[i].onclick=function(){
     		for(var n=0;n<oM.length;n++){
     			oH[n].className="";
     			oM[n].style.display="block";
     		}
     		   oH[this.index].className="zpf-active";
     			oM[this.index].style.display="none";
     	}
     }