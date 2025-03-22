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