$(document).ready(function() {
            const btns = document.querySelectorAll(".nav-btn");
            const slides = document.querySelectorAll(".img-slide");
            const contentSlides = document.querySelectorAll(".content-slide");
            let currentSlide = 0;

            let sliderNav = function(manual) {
                btns.forEach((btn) => {
                    btn.classList.remove("active");
                });

                slides.forEach((slide) => {
                    slide.classList.remove("active");
                });
                contentSlides.forEach((contentSlide) => {
                    contentSlide.classList.remove("active");
                });

                btns[manual].classList.add("active");
                slides[manual].classList.add("active");
                contentSlides[manual].classList.add("active");
            };

            let autoSlide = function() {
                currentSlide++;
                if (currentSlide >= slides.length) {
                    currentSlide = 0;
                }
                sliderNav(currentSlide);
            };
            let autoContentSlide = function() {
                currentSlide++;
                if (currentSlide >= content_slides.length) {
                    currentSlide = 0;
                }
                sliderNav(currentSlide);
            };

            let slideInterval = setInterval(autoSlide, 4000);

            btns.forEach((btn, i) => {
                btn.addEventListener("click", () => {
                    sliderNav(i);
                });
            });

            
 });
