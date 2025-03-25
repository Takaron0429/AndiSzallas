document.addEventListener("DOMContentLoaded", function() {
    // Elemek kiválasztása
    const calendarEl = document.getElementById('booking-calendar');
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const errorParagraph = document.querySelector('.errorParagraph');
    const calculatedPrice = document.getElementById('calculatedPrice');
    const messagesContainer = document.getElementById('messages-container');
    const form = document.querySelector("form");
    
    // Állapot változók
    let foglaltNapok = [];
    let kivalasztottCheckin = null;
    let kivalasztottCheckout = null;
    const currentYear = new Date().getFullYear(); // Mindig az aktuális év
    let currentMonth = new Date().getMonth(); // Aktuális hónap

    // Csak május-augusztus (4-7) hónapok engedélyezése az aktuális évben
    const allowedMonths = [4, 5, 6, 7]; // május, június, július, augusztus
    
    // Ha épp nem ezek között van, állítsuk májusra
    if (!allowedMonths.includes(currentMonth)) {
        currentMonth = 4; // május
    }

    // Inicializálás
    function initialize() {
        loadBookedDates();
        setupFormValidation();
        setupResetButton();
    }

    // Reset gomb beállítása
    function setupResetButton() {
        const resetButton = document.createElement('button');
        resetButton.className = 'resetButton btn btn-secondary mt-3';
        resetButton.textContent = 'Választás törlése';
        resetButton.addEventListener('click', function(e) {
            e.preventDefault();
            resetSelection();
        });
        
        const calendarContainer = document.querySelector('.booking-calendar');
        if (calendarContainer) {
            calendarContainer.parentNode.insertBefore(resetButton, calendarContainer.nextSibling);
        }
    }

    // Hónap navigáció ellenőrzése
    function navigateMonth(direction) {
        let newMonth = direction === 'next' ? currentMonth + 1 : currentMonth - 1;
        
        // Korlátozzuk a hónapokat
        if (newMonth < Math.min(...allowedMonths)) {
            return; // Ne menjünk május előtti hónapra
        } else if (newMonth > Math.max(...allowedMonths)) {
            return; // Ne menjünk augusztus utáni hónapra
        }
        
        currentMonth = newMonth;
        renderCalendar();
    }

    // Választás törlése
    function resetSelection() {
        kivalasztottCheckin = null;
        kivalasztottCheckout = null;
        checkinInput.value = '';
        checkoutInput.value = '';
        document.getElementById('selected-checkin').textContent = '-';
        document.getElementById('selected-checkout').textContent = '-';
        calculatedPrice.textContent = 'Válassza ki a dátumot és a vendégek számát az ár megjelenítéséhez';
        calculatedPrice.style.color = '';
        calculatedPrice.style.fontWeight = '';
        renderCalendar();
    }

    // Hibák megjelenítése
    function showError(message, isSuccess = false) {
        clearMessages();
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${isSuccess ? 'success' : 'danger'} mt-3`;
        alertDiv.textContent = message;
        messagesContainer.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.classList.add('fade');
            setTimeout(() => {
                alertDiv.remove();
            }, 500);
        }, 5000);
    }

    // Üzenetek törlése
    function clearMessages() {
        while (messagesContainer.firstChild) {
            messagesContainer.removeChild(messagesContainer.firstChild);
        }
    }

    // Foglalt dátumok betöltése
    function loadBookedDates() {
        fetch('/admin/foglalt-napok')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Hálózati hiba történt');
                }
                return response.json();
            })
            .then(data => {
                // Csak az aktuális év május-augusztus dátumait tartjuk meg
                foglaltNapok = data.filter(dateStr => {
                    const date = new Date(dateStr);
                    return date.getFullYear() === currentYear && 
                           allowedMonths.includes(date.getMonth());
                });
                renderCalendar();
            })
            .catch(error => {
                showError("Hiba történt a foglalt dátumok betöltésekor: " + error.message);
            });
    }

    // Ellenőrzi, hogy van-e lefoglalt nap a kiválasztott időszakban
    function hasBookedDatesBetween(startDateStr, endDateStr) {
        const startDate = new Date(startDateStr);
        const endDate = new Date(endDateStr);
        let currentDate = new Date(startDate);
        
        while (currentDate < endDate) {
            currentDate.setDate(currentDate.getDate() + 1);
            const dateStr = currentDate.toISOString().split('T')[0];
            if (foglaltNapok.includes(dateStr)) {
                return true;
            }
        }
        return false;
    }

    // Naptár renderelése
    function renderCalendar() {
        errorParagraph.textContent = "";

        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const today = new Date();

        // Frissítjük a kiválasztott dátumokat
        document.getElementById('selected-checkin').textContent = kivalasztottCheckin || '-';
        document.getElementById('selected-checkout').textContent = kivalasztottCheckout || '-';

        let html = `
            <div class="calendar-header">
                <button class="nav-button" id="prev-month" ${currentMonth === 4 ? 'disabled' : ''}>❮</button>
                <h3>${getMonthName(currentMonth)} ${currentYear}</h3>
                <button class="nav-button" id="next-month" ${currentMonth === 7 ? 'disabled' : ''}>❯</button>
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
                const selectedDateObj = new Date(selectedDate);
                
                // Ellenőrizzük, hogy a kiválasztott dátum az aktuális évben van-e
                if (selectedDateObj.getFullYear() !== currentYear) {
                    showError("Csak az aktuális év május-augusztus időszakából választhat!");
                    return;
                }
                
                if (!kivalasztottCheckin || (kivalasztottCheckin && kivalasztottCheckout)) {
                    kivalasztottCheckin = selectedDate;
                    kivalasztottCheckout = null;
                    showError("");
                } else if (new Date(selectedDate) > new Date(kivalasztottCheckin)) {
                    if (hasBookedDatesBetween(kivalasztottCheckin, selectedDate)) {
                        showError("A kiválasztott időszakban már van lefoglalt nap!");
                        return;
                    }
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
            navigateMonth('prev');
        });

        document.getElementById('next-month').addEventListener('click', () => {
            navigateMonth('next');
        });
    }

    // Űrlap validáció
    function setupFormValidation() {
        checkinInput.addEventListener("change", validateForm);
        checkoutInput.addEventListener("change", validateForm);
        document.getElementById("felnott").addEventListener("change", validateForm);
        document.getElementById("gyerek").addEventListener("change", validateForm);

        form.addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault();
            } else {
                showError("Foglalás sikeresen elküldve!", true);
            }
        });
    }

    function validateForm() {
        clearMessages();
        const checkinDate = new Date(checkinInput.value);
        const checkoutDate = new Date(checkoutInput.value);
        const felnottCount = parseInt(document.getElementById("felnott").value, 10);
        const gyerekCount = parseInt(document.getElementById("gyerek").value, 10);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Ellenőrizzük, hogy a dátumok az aktuális évben vannak-e
        if (checkinDate.getFullYear() !== currentYear || checkoutDate.getFullYear() !== currentYear) {
            showError("Hiba: Csak az aktuális év május-augusztus időszakából választhat!");
            return false;
        }

        // Ellenőrizzük, hogy a hónapok engedélyezettek-e
        if (!allowedMonths.includes(checkinDate.getMonth()) || !allowedMonths.includes(checkoutDate.getMonth())) {
            showError("Hiba: Csak május-augusztus közötti dátumokat lehet választani!");
            return false;
        }

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

        if (hasBookedDatesBetween(checkinInput.value, checkoutInput.value)) {
            showError("Hiba: A kiválasztott időszakban már van lefoglalt nap!");
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
    function getMonthName(month) {
        const months = ['Január', 'Február', 'Március', 'Április', 'Május', 'Június',
                       'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'];
        return months[month];
    }

    // Indítás
    initialize();
});