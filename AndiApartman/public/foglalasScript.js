document.addEventListener("DOMContentLoaded", function () {
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

        // Create icon element
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-rotate-right';
        icon.style.marginRight = '8px'; // Add some spacing between icon and text

        // Add icon and text to button
        resetButton.appendChild(icon);
        resetButton.appendChild(document.createTextNode('Választás törlése'));

        resetButton.addEventListener('click', function (e) {
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
                //if (selectedDateObj.getFullYear() !== currentYear) {
                //    showError("Csak az aktuális év május-augusztus időszakából választhat!");
                //    return;
                //}

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

        form.addEventListener("submit", function (event) {
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
        //if (checkinDate.getFullYear() !== currentYear || checkoutDate.getFullYear() !== currentYear) {
        //    showError("Hiba: Csak az aktuális év május-augusztus időszakából választhat!");
        //    return false;
        //}

        // Ellenőrizzük, hogy a hónapok engedélyezettek-e
        //if (!allowedMonths.includes(checkinDate.getMonth()) || !allowedMonths.includes(checkoutDate.//getMonth())) {
        //    showError("Hiba: Csak május-augusztus közötti dátumokat lehet választani!");
        //    return false;
        //}

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

    // Payment method selection
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', function () {
            // Remove selected class from all options
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            // Add selected class to clicked option
            this.classList.add('selected');

            // Set payment method value
            const paymentMethod = this.id;
            document.getElementById('payment-method').value = paymentMethod;

            // Show appropriate payment details
            document.getElementById('bank-transfer-details').classList.add('d-none');
            document.getElementById('credit-card-form').classList.add('d-none');

            if (paymentMethod === 'bank-transfer') {
                document.getElementById('bank-transfer-details').classList.remove('d-none');
                updateDepositAmount();
            } else if (paymentMethod === 'credit-card') {
                document.getElementById('credit-card-form').classList.remove('d-none');
            }
        });
    });

    // Format card number input
    document.getElementById('card-number')?.addEventListener('input', function (e) {
        let value = this.value.replace(/\s+/g, ''); // Remove all spaces
        if (value.length > 0) {
            value = value.match(new RegExp('.{1,4}', 'g')).join(' '); // Add space every 4 chars
        }
        this.value = value;
    });

    // Format expiry date input
    document.getElementById('card-expiry')?.addEventListener('input', function (e) {
        let value = this.value.replace(/\D/g, ''); // Remove non-digits
        if (value.length > 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        this.value = value;
    });

    // Update deposit amount when price changes
    function updateDepositAmount() {
        const priceText = document.getElementById('calculatedPrice').textContent;
        const priceMatch = priceText.match(/(\d[\d\s]*) Ft/);

        if (priceMatch) {
            const price = parseInt(priceMatch[1].replace(/\s+/g, ''), 10);
            const deposit = Math.floor(price / 2);
            document.getElementById('deposit-amount').textContent = deposit.toLocaleString('hu-HU');
        }
    }
    (function () {
        // 1. Változók inicializálása
        let clickCount = 0;
        let lastClickTime = 0;
        const icon = document.getElementById('secretTrigger');

        // 2. Stílus hozzáadása dinamikusan
        const style = document.createElement('style');
        style.innerHTML = `
          #secretTrigger {
            transition: all 0.3s ease;
          }
          @keyframes spin {
            from { transform: rotate(0deg) scale(1.5); }
            to { transform: rotate(360deg) scale(1.5); }
          }
        `;
        document.head.appendChild(style);

        // 3. Kattintáskezelő
        icon.onclick = function () {
            const now = Date.now();

            // Ha több mint 1 másodperc telt el, reseteljük
            if (now - lastClickTime > 1000) {
                clickCount = 0;
            }

            clickCount++;
            lastClickTime = now;

            // Vizuális visszajelzés
            this.style.transform = `scale(${1 + clickCount * 0.1})`;

            // Üzenetek
            if (clickCount === 3) {
                showError('ok is the hardest istg');
            }
            if (clickCount === 5) {
                showError('we gon be ok💔💔💔');
            }

            // 5. kattintásnál átirányítás
            if (clickCount >= 5) {
                this.style.color = 'red';
                this.style.animation = 'spin 0.5s linear infinite';

                // Létrehozunk egy felugró üzenetet
                const popup = document.createElement('div');
                popup.innerHTML = `
  <div style="text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 10px;">
    COLD VISIONSSSSSS
  </div>
  <img src="img/gloriousking.jpg" alt="" 
       style="max-width: 200px; border-radius: 5px; display: block; margin: 0 auto;">
`;
                popup.style.position = 'fixed';
                popup.style.top = '20px';
                popup.style.left = '50%';
                popup.style.transform = 'translateX(-50%)';
                popup.style.background = 'white';
                popup.style.padding = '20px';
                popup.style.borderRadius = '5px';
                popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
                popup.style.zIndex = '9999';
                popup.style.textAlign = 'center';

                // Add animation
                popup.style.animation = 'fadeIn 0.5s ease-in-out';

                // Add fade-in animation
                const style = document.createElement('style');
                style.textContent = `
  @keyframes fadeIn {
    from { opacity: 0; transform: translateX(-50%) translateY(-20px); }
    to { opacity: 1; transform: translateX(-50%) translateY(0); }
  }
`;
                document.head.appendChild(style);

                document.body.appendChild(popup);

                // Remove popup after 3 seconds
                setTimeout(() => {
                    popup.style.animation = 'fadeOut 0.5s ease-in-out';

                    // Add fade-out animation
                    const fadeOutStyle = document.createElement('style');
                    fadeOutStyle.textContent = `
                    @keyframes fadeOut {
                    from { opacity: 1; transform: translateX(-50%) translateY(0); }
                    to { opacity: 0; transform: translateX(-50%) translateY(-20px); }
                    }
                    `;
                    document.head.appendChild(fadeOutStyle);

                    setTimeout(() => {
                        popup.remove();
                    }, 500);
                }, 3000);
                //2 sec utan redirect
                setTimeout(() => {
                    window.location.href = 'https://youtu.be/-5SkU7ALjwQ?si=yG-jBBUz3hWikcFm';
                }, 2000);

                clickCount = 0;
            }

            // 1 másodperc után visszaállítás
            setTimeout(() => {
                if (Date.now() - lastClickTime >= 1000) {
                    clickCount = 0;
                    icon.style.transform = 'scale(1)';
                }
            }, 1000);
        };
    })();
    // Call updateDepositAmount when price changes
    // Add this line to the end of your validateForm function, right before "return true;"
    updateDepositAmount();
    // Csomagok árának kezelése
    function updateTotalPrice() {
        const felnottCount = parseInt(document.getElementById("felnott").value, 10);
        const gyerekCount = parseInt(document.getElementById("gyerek").value, 10);
        const checkinDate = new Date(checkinInput.value);
        const checkoutDate = new Date(checkoutInput.value);

        if (!checkinInput.value || !checkoutInput.value) {
            return;
        }

        const timeDifference = checkoutDate - checkinDate;
        const daysDifference = timeDifference / (1000 * 60 * 60 * 24);

        // Alap ár számítás
        const felnottAr = 10000;
        const gyerekAr = 5000;
        let osszeg = (felnottCount * felnottAr + gyerekCount * gyerekAr) * daysDifference;

        // Csomagok árának hozzáadása
        document.querySelectorAll('.csomag-checkbox:checked').forEach(checkbox => {
            const csomagAr = parseInt(checkbox.dataset.ar, 10);
            osszeg += csomagAr;
        });

        // Összeg megjelenítése
        calculatedPrice.textContent = `Összeg: ${osszeg.toLocaleString('hu-HU')} Ft`;
        calculatedPrice.style.color = "green";
        calculatedPrice.style.fontWeight = "bold";

        // Banki utalás esetén a foglalóösszeg frissítése
        if (document.getElementById('payment-method').value === 'bank-transfer') {
            updateDepositAmount();
        }
    }

    // Eseményfigyelők hozzáadása a csomagokhoz
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.csomag-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateTotalPrice);
        });
    });

});