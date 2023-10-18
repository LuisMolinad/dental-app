document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: "dayGridMonth" /*Inicializa por medio de la vista de mes*/ ,
        locale: "es" /*Idioma espanol*/ ,
       /*  height: 650, */
        headerToolbar: {
            left: 'prevYear,prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            //right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        //editable: true, //para que puedan moverse los eventos
        //dayMaxEvents: true, // cuando se encuentran muchos eventos se mostrara una burbuja

        //Formato de Tiempo
        eventTimeFormat: { // like '14:30:00'
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },

        //Para que no de el error pasada las 11:00 pm
        nextDayThreshold: '23:00:00',
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            year: 'Año'
        },
        dateClick: function(info) {
            // Cuando se hace clic en un día en el calendario, abre el modal
            $('#citaModal').modal('show'); 

            // Puedes acceder a la fecha haciendo info.date
            var fechaSeleccionada = info.date;
            alert(fechaSeleccionada);
        }
        
    });
    calendar.render();
});