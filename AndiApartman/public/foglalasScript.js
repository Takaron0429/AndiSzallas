document.addEventListener("DOMContentLoaded", function() {
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");
    const felnott = document.getElementById("felnott");
    const result = document.getElementById("days");
    const errorParagraph = document.querySelector(".errorParagraph"); // Az errorParagraph class-ú p tag
    const form = document.querySelector("form"); // Az űrlap elem

    function validateForm() {
        const checkinDate = new Date(checkin.value);
        const checkoutDate = new Date(checkout.value);
        const felnottCount = parseInt(felnott.value, 10); // Felnőttek száma
        const today = new Date(); // Jelenlegi dátum
        today.setHours(0, 0, 0, 0); // Az időpontot 00:00:00-ra állítjuk

        // Töröljük a korábbi hibákat
        errorParagraph.textContent = "";

        // Ellenőrizd, hogy legalább 1 felnőtt van-e kiválasztva
        if (felnottCount < 1) {
            errorParagraph.textContent = "Hiba: Legalább 1 felnőttet kell kiválasztani!";
            errorParagraph.style.color = "red";
            return false; // Az űrlap nem küldhető el
        }

        // Ellenőrizd, hogy mindkét dátum ki van-e töltve
        if (!checkin.value || !checkout.value) {
            errorParagraph.textContent = "Hiba: Mindkét dátumot ki kell tölteni!";
            errorParagraph.style.color = "red";
            return false; // Az űrlap nem küldhető el
        }

        // Ellenőrizd, hogy a bejelentkezés dátuma nem korábbi a mai dátumnál
        if (checkinDate < today) {
            errorParagraph.textContent = "Hiba: A bejelentkezés dátuma nem lehet korábbi a mai dátumnál!";
            errorParagraph.style.color = "red";
            return false; // Az űrlap nem küldhető el
        }

        // Ellenőrizd, hogy a kijelentkezés dátuma későbbi-e a bejelentkezésnél
        if (checkoutDate <= checkinDate) {
            errorParagraph.textContent = "Hiba: A kijelentkezés dátuma későbbinek kell lennie a bejelentkezésnél!";
            errorParagraph.style.color = "red";
            return false; // Az űrlap nem küldhető el
        }

        // Ellenőrizd, hogy legalább 1 éjszaka különbség legyen
        const timeDifference = checkoutDate - checkinDate;
        const daysDifference = timeDifference / (1000 * 60 * 60 * 24); // Átalakítás napokká

        if (daysDifference < 1) {
            errorParagraph.textContent = "Hiba: Legalább 1 éjszaka különbség szükséges a két dátum között!";
            errorParagraph.style.color = "red";
            return false; // Az űrlap nem küldhető el
        }

        // Ha minden rendben, töröljük a hibákat és engedélyezzük az űrlap elküldését
        errorParagraph.textContent = "";
        return true;
    }

    // Eseményfigyelők a dátumváltozásokra és a felnőttek számának változására
    checkin.addEventListener("change", validateForm);
    checkout.addEventListener("change", validateForm);
    felnott.addEventListener("change", validateForm);

    // Az űrlap elküldésének megakadályozása, ha hiba van
    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Megakadályozzuk az űrlap elküldését
        }
    });
});