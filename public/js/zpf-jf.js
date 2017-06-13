document.documentElement.style.fontSize = innerWidth / 16 + 'px';

		onresize = function() {
			document.documentElement.style.fontSize = innerWidth / 16 + 'px';
		};
		

var mySwiper = new Swiper(".swiper-container", {
            autoplay: 5000,//可选选项，自动滑动
            speed: 500,//滑动速率
            loop: true,//循环
            pagination : '.swiper-pagination'//分页器
        });