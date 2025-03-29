document.addEventListener("DOMContentLoaded", function() {
    const progressBars = document.querySelectorAll('.progress-bar');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.getAttribute('aria-valuenow') + '%';
                progressBar.style.setProperty('--progress-width', width); // Beállítjuk az animáció végértékét
                progressBar.classList.add('animate'); // Animáció aktiválása
                observer.unobserve(progressBar); // Leállítjuk a megfigyelést
            }
        });
    }, { threshold: 0.5 }); // 50%-ban láthatóvá válás után aktiválódik

    progressBars.forEach(progressBar => {
        observer.observe(progressBar); // Minden progress bar megfigyelése
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carouselExample');
    const fullscreenToggle = carousel.querySelector('.fullscreen-toggle');
    const fullscreenOverlay = document.querySelector('.fullscreen-overlay');
    const closeFullscreen = document.querySelector('.close-fullscreen');
    const fullscreenCarousel = document.getElementById('fullscreenCarousel');
    let fullscreenCarouselInstance = null;
    
    // Copy carousel items to fullscreen
    fullscreenToggle.addEventListener('click', function() {
        const items = carousel.querySelectorAll('.carousel-item');
        const activeIndex = Array.from(items).findIndex(item => item.classList.contains('active'));
        const fullscreenInner = fullscreenCarousel.querySelector('.carousel-inner');
        fullscreenInner.innerHTML = '';
        
        items.forEach((item, index) => {
            const clone = item.cloneNode(true);
            if (index === activeIndex) clone.classList.add('active');
            else clone.classList.remove('active');
            fullscreenInner.appendChild(clone);
        });
        
        fullscreenOverlay.classList.add('show');
        document.body.style.overflow = 'hidden';
        
        // Initialize Bootstrap Carousel for fullscreen
        if (fullscreenCarouselInstance) {
            fullscreenCarouselInstance.dispose();
        }
        fullscreenCarouselInstance = new bootstrap.Carousel(fullscreenCarousel, {
            interval: false
        });
    });
    
    // Close fullscreen
    closeFullscreen.addEventListener('click', function() {
        fullscreenOverlay.classList.remove('show');
        document.body.style.overflow = '';
    });
    
    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && fullscreenOverlay.classList.contains('show')) {
            fullscreenOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});