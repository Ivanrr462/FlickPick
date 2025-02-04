let sliderIndex = 0;
const slides = document.querySelectorAll('.slider-section');
const dotsContainer = document.querySelector('.dots-container');

function createDots() {
    for (let i = 0; i < slides.length; i++) {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        dot.addEventListener('click', () => goToSlide(i));
        dotsContainer.appendChild(dot);
    }
}

function goToSlide(index) {
    slides[sliderIndex].classList.remove('active-slide');
    dotsContainer.children[sliderIndex].classList.remove('active-dot');
    sliderIndex = index;
    slides[sliderIndex].classList.add('active-slide');
    dotsContainer.children[sliderIndex].classList.add('active-dot');
}

function moveToNextSlide() {
    goToSlide((sliderIndex + 1) % slides.length);
}

function moveToPreviousSlide() {
    goToSlide((sliderIndex - 1 + slides.length) % slides.length);
}

document.querySelector('.btn-right').addEventListener('click', moveToNextSlide);
document.querySelector('.btn-left').addEventListener('click', moveToPreviousSlide);

createDots();
goToSlide(0);
