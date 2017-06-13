		document.documentElement.style.fontSize = innerWidth / 16 + 'px';

		onresize = function() {
			document.documentElement.style.fontSize = innerWidth / 16 + 'px';
		};
    var oDiv=document.getElementsByClassName("zpf-ban")[0];
    var oP=oDiv.getElementsByTagName("li");
    var oZ=document.getElementsByClassName("zpf-link");
    for(var i=0;i<oP.length;i++){
    	oP[i].index=i;
    	oP[i].onclick=function(){
    		for(var n=0;n<oZ.length;n++){
    			oP[n].className="";
    			oZ[n].style.display="none";
    		}
    		   oP[this.index].className="zpf-active";
    			oZ[this.index].style.display="block";
    	}
    }