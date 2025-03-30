document.addEventListener("DOMContentLoaded", function () {
    var foglaltNapok = [];
    var erkezesNapok = [
    "2025-05-01", "2025-05-05", "2025-05-10", "2025-05-15", "2025-05-20", "2025-05-25",
    "2025-06-01", "2025-06-05", "2025-06-10", "2025-06-15", "2025-06-20", "2025-06-25",
    "2025-07-01", "2025-07-05", "2025-07-10", "2025-07-15", "2025-07-20", "2025-07-25",
    "2025-08-01", "2025-08-05", "2025-08-10", "2025-08-15", "2025-08-20"
];


    fetch('/admin/foglalt-napok') 
        .then(response => response.json())
        .then(data => {
            foglaltNapok = data; 
            generateCalendar("calendar-may", 2025, 4);  
            generateCalendar("calendar-june", 2025, 5); 
            generateCalendar("calendar-july", 2025, 6); 
            generateCalendar("calendar-august", 2025, 7); 
        });

    function generateCalendar(tableId, year, month) {
        var table = document.getElementById(tableId);
        var firstDay = new Date(year, month, 1).getDay();
        var daysInMonth = new Date(year, month + 1, 0).getDate();

        var html = `
        <thead>
            <tr>
                <th>H</th>
                <th>K</th>
                <th>Sze</th>
                <th>Cs</th>
                <th>P</th>
                <th>Szo</th>
                <th>V</th>
            </tr>
        </thead>
        <tbody>
        <tr>`;

       
        for (var i = 0; i < firstDay; i++) {
            html += "<td></td>";
        }

        for (var i = 1; i <= daysInMonth; i++) {
            var currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            var isFoglalt = foglaltNapok.includes(currentDate); 
            var isErkezes = erkezesNapok.includes(currentDate); 

           
            var cellClass = '';
            if (isErkezes) {
                cellClass = 'bg-warning text-white'; 
            } else if (isFoglalt) {
                cellClass = 'bg-danger text-white'; 
            } else {
                cellClass = 'bg-success text-white'; 
            }

            html += `<td class="${cellClass}">${i}</td>`;
            if ((firstDay + i - 1) % 7 === 6) {
                html += "</tr><tr>";
            }
        }

        html += "</tr></tbody>";
        table.innerHTML = html;
    }
    });



