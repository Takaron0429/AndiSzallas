document.addEventListener("DOMContentLoaded", function() {
    // Elemek kiválasztása
    const calendarEl = document.getElementById('booking-calendar');
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const errorParagraph = document.querySelector('.errorParagraph');
    const calculatedPrice = document.getElementById('calculatedPrice'); // Összeg megjelenítésére
    
    // Űrlap elemek
    const felnott = document.getElementById("felnott");
    const gyerek = document.getElementById("gyerek");
    const form = document.querySelector("form");
    
    // Állapot változók
    let foglaltNapok = [];
    let kivalasztottCheckin = null;
    let kivalasztottCheckout = null;
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    // Inicializálás
    function initialize() {
        loadBookedDates();
        setupFormValidation();
    }

    // Foglalt dátumok betöltése
    function loadBookedDates() {
        fetch('/admin/foglalt-napok')
            .then(response => response.json())
            .then(data => {
                foglaltNapok = data;
                renderCalendar();
            })
            .catch(error => {
                showError("Hiba történt a foglalt dátumok betöltésekor");
            });
    }

    // Naptár renderelése
    function renderCalendar() {
        errorParagraph.textContent = "";

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const today = new Date();

        let html = `
            <div class="calendar-header">
                <button class="nav-button" id="prev-month">❮</button>
                <h3>${getMonthName(currentMonth)} ${currentYear}</h3>
                <button class="nav-button" id="next-month">❯</button>
            </div>
            <div class="calendar-grid">
                <div class="day-header">H</div>
                <div class="day-header">K</div>
                <div class="day-header">Sze</div>
                <div class="day-header">Cs</div>
                <div class="day-header">P</div>
                <div class="day-header">Szo</div>
                <div class="day-header">V</div>
        `;

        // Üres cellák
        for (let i = 0; i < (firstDay === 0 ? 6 : firstDay - 1); i++) {
            html += `<div class="calendar-day empty"></div>`;
        }

        // Napok generálása
        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dateObj = new Date(dateStr);
            const isBooked = foglaltNapok.includes(dateStr);
            const isToday = dateObj.toDateString() === today.toDateString();
            const isCheckin = dateStr === kivalasztottCheckin;
            const isCheckout = dateStr === kivalasztottCheckout;
            const isBetween = kivalasztottCheckin && kivalasztottCheckout &&
                dateObj > new Date(kivalasztottCheckin) && 
                dateObj < new Date(kivalasztottCheckout);

            let dayClass = 'calendar-day';
            if (isBooked) dayClass += ' booked';
            if (isToday) dayClass += ' today';
            if (isCheckin) dayClass += ' checkin';
            if (isCheckout) dayClass += ' checkout';
            if (isBetween) dayClass += ' between';

            html += `
                <div class="${dayClass}" data-date="${dateStr}">
                    ${day}
                    ${isCheckin ? '<div class="selection-label">Be</div>' : ''}
                    ${isCheckout ? '<div class="selection-label">Ki</div>' : ''}
                </div>`;
        }

        html += `</div>`;
        calendarEl.innerHTML = html;

        // Eseménykezelők napokhoz
        document.querySelectorAll('.calendar-day:not(.booked):not(.empty)').forEach(day => {
            day.addEventListener('click', () => {
                const selectedDate = day.dataset.date;
                
                if (!kivalasztottCheckin || (kivalasztottCheckin && kivalasztottCheckout)) {
                    kivalasztottCheckin = selectedDate;
                    kivalasztottCheckout = null;
                    showError("");
                } else if (new Date(selectedDate) > new Date(kivalasztottCheckin)) {
                    kivalasztottCheckout = selectedDate;
                    showError("");
                } else {
                    showError("A kijelentkezés dátuma a bejelentkezés után kell legyen!");
                    return;
                }

                checkinInput.value = kivalasztottCheckin;
                checkoutInput.value = kivalasztottCheckout;
                renderCalendar();
                validateForm();
            });
        });

        // Hónap navigáció
        document.getElementById('prev-month').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        });
    }

    // Űrlap validáció
    function setupFormValidation() {
        checkinInput.addEventListener("change", validateForm);
        checkoutInput.addEventListener("change", validateForm);
        felnott.addEventListener("change", validateForm);
        gyerek.addEventListener("change", validateForm);

        form.addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    }

    function validateForm() {
        const checkinDate = new Date(checkinInput.value);
        const checkoutDate = new Date(checkoutInput.value);
        const felnottCount = parseInt(felnott.value, 10);
        const gyerekCount = parseInt(gyerek.value, 10);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Hibák törlése
        errorParagraph.textContent = "";
        calculatedPrice.textContent = "";

        // Validációk
        if (felnottCount < 1) {
            showError("Hiba: Legalább 1 felnőttet kell kiválasztani!");
            return false;
        }

        if (!checkinInput.value || !checkoutInput.value) {
            showError("Hiba: Mindkét dátumot ki kell tölteni!");
            return false;
        }

        if (checkinDate < today) {
            showError("Hiba: A bejelentkezés dátuma nem lehet korábbi a mai dátumnál!");
            return false;
        }

        if (checkoutDate <= checkinDate) {
            showError("Hiba: A kijelentkezés dátuma későbbinek kell lennie a bejelentkezésnél!");
            return false;
        }

        const timeDifference = checkoutDate - checkinDate;
        const daysDifference = timeDifference / (1000 * 60 * 60 * 24);

        if (daysDifference < 1) {
            showError("Hiba: Legalább 1 éjszaka különbség szükséges a két dátum között!");
            return false;
        }

        // Ár kiszámítása
        const felnottAr = 10000;
        const gyerekAr = 5000;
        const osszeg = (felnottCount * felnottAr + gyerekCount * gyerekAr) * daysDifference;

        // Összeg megjelenítése
        calculatedPrice.textContent = `Összeg: ${osszeg.toLocaleString('hu-HU')} Ft`;
        calculatedPrice.style.color = "green";
        calculatedPrice.style.fontWeight = "bold";
        return true;
    }

    // Segédfüggvények
    function showError(message) {
        errorParagraph.textContent = message;
        if (message) {
            errorParagraph.style.display = "block";
            errorParagraph.style.color = "red";
            setTimeout(() => {
                errorParagraph.style.opacity = 0;
                setTimeout(() => {
                    errorParagraph.style.display = "none";
                    errorParagraph.style.opacity = 1;
                }, 500);
            }, 10000);
        }
    }

    function getMonthName(month) {
        const months = ['Január', 'Február', 'Március', 'Április', 'Május', 'Június',
                       'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'];
        return months[month];
    }

    // Indítás
    initialize();
});