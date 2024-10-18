// JavaScript for slider functionality
const sliders = document.querySelectorAll('.slider');

sliders.forEach(slider => {
    let currentSlide = 0;
    const slides = slider.querySelectorAll('img');
    const slideCount = slides.length;
    
    if (slideCount > 1) {
        setInterval(nextSlide, 3000); // Auto slide every 3 seconds
    }
    
    function nextSlide() {
        slides[currentSlide].style.display = 'none';
        currentSlide = (currentSlide + 1) % slideCount;
        slides[currentSlide].style.display = 'block';
    }
});

