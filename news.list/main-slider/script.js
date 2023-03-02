let mainSlider = {
	preloadPictures: [],
	init: function () {
		mainSlider.preloadingPictures();
	},
	preloadingPictures: function () {
		let image = new Image();
		for (let i=0; i < mainSlider.preloadPictures.length; i++) {
			image.src = mainSlider.preloadPictures[i];
		}
	}
};

$(document).ready(mainSlider.init);

var loop;
if((document.querySelectorAll('.mainSwiper .swiper-slide:not(.swiper-slide-duplicate)')).length > 1) {
	loop = true;
} else {
	loop = false;
}
var swiper = new Swiper(".mainSwiper", {
	speed: 2000,
	slidesPerView: 1,
	loop: loop,
	autoplay: {
		delay: 10000,
		disableOnInteraction: false,        
	  },
	pagination: {
	  el: ".swiper-pagination",
	  clickable: true,
	  renderBullet: function (index, className) {
		return '<span class="' + className + '">' + (index + 1) + "</span>";
	  },
	},
	navigation: {
	  nextEl: ".swiper-button-next",
	  prevEl: ".swiper-button-prev",
	},
	on: {
		transitionEnd: function () {
			document.querySelectorAll('.mainSwiper .swiper-slide').forEach(element => {
				if(!element.classList.contains('swiper-slide-active')) {
					element.querySelectorAll('.main-info-items').forEach(item => {
						item.classList.remove('animation-right');
					});
				}
			});
		},
	}
});
if(window.innerWidth >= 1000) {
	document.querySelectorAll('.mainSwiper .swiper-slide, .mainSwiper .swiper-pagination, .mainSwiper .swiper-button-next, .mainSwiper .swiper-button-prev').forEach(element => {
		element.addEventListener("mouseover", function() {
			document.querySelector('.mainSwiper .swiper-slide-active .main-info-items').classList.add('animation-right');
			document.querySelector('.mainSwiper .swiper-slide-active .main-info-items').classList.remove('animation-left');
		});
		element.addEventListener("mouseout", function() {
			document.querySelector('.swiper-slide-active .main-info-items').classList.remove('animation-right');
			document.querySelector('.swiper-slide-active .main-info-items').classList.add('animation-left');
		});
	});

	document.querySelectorAll('.swiper-pagination-bullet').forEach(element => {
		var slide = document.querySelectorAll('.mainSwiper .swiper-slide');
		slide.forEach(slide =>{
			if(slide.dataset.number == (element.innerHTML - 1)) {
				element.innerHTML = '<span class="pagination-number">' + element.innerHTML + '</span><img class="pagination-image" src="' + slide.dataset.min + '"/>';
			}
		});
		element.addEventListener("mouseover", function() {
			element.classList.add('animation-big');
		});
		element.addEventListener("mouseout", function() {
			element.classList.remove('animation-big');
		});
	});
} else {
	document.querySelectorAll('.mainSwiper .swiper-slide .main-info-items').forEach(element => {
		element.style.left = "0";
	});
}