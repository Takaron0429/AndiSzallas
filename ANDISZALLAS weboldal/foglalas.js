document.addEventListener("DOMContentLoaded", function() {
    const checkin = document.getElementById("checkin");
    const checkout = document.getElementById("checkout");
    const result = document.getElementById("days");

    function calculateDays() {
        const checkinDate = new Date(checkin.value);
        const checkoutDate = new Date(checkout.value);
        
        if (!checkin.value || !checkout.value) {
            result.textContent = "";
            return;
        }
        
        if (checkoutDate <= checkinDate) {
            result.textContent = "Hiba: A kijelentkezés dátumának későbbinek kell lennie a bejelentkezésnél!";
        } else {
            const days = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
            result.textContent = `amely ${days} éjszaka`;
        }
    }

    checkin.addEventListener("change", calculateDays);
    checkout.addEventListener("change", calculateDays);
});
