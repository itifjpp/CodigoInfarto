/* Webarch Admin Dashboard 
-----------------------------------------------------------------*/	
$(document).ready(function() {
    $('#calendarDay').fullCalendar({
        locale: 'es',
        eventRender: function (event, element, view) {
            element.find('.fc-list-item-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">'+event.description+'</span></div>');
        },
        height: 558,
        header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
        },
        googleCalendarApiKey: $('input[name=googleCalendarApiKey]').val(),
        events: {
            googleCalendarId: $('input[name=googleCalendarId]').val()
        },	
        views: {
        listDay: { buttonText: 'list day' }
        },

        defaultView: 'listDay',
        editable: true,
        eventClick: function(event) {
            // opens events in a popup window
            var y = window.top.outerHeight / 2 + window.top.screenY - ( 600 / 1.5);
            var x = window.top.outerWidth / 2 + window.top.screenX - ( 700 / 2)
            window.open(event.url,'gcalevent','width='+700+',height='+600+',top='+y+',left='+x);
            return false;
        },
        eventLimit: true,

    });
    $('body #calendarDay .fc-left,.fc-right').addClass('hide');
    $('#calendar').fullCalendar({
        contentHeight: 590,
        locale: 'es',
        header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
        },
        googleCalendarApiKey: $('input[name=googleCalendarApiKey]').val(),
        events: {
            googleCalendarId: $('input[name=googleCalendarId]').val()
        },	
        editable: true,
        eventClick: function(event) {
            // opens events in a popup window
            var y = window.top.outerHeight / 2 + window.top.screenY - ( 600 / 1.5);
            var x = window.top.outerWidth / 2 + window.top.screenX - ( 700 / 2)
            window.open(event.url,'gcalevent','width='+700+',height='+600+',top='+y+',left='+x);
            return false;
        },
        eventLimit: true,

    });
    $('body .fc-button-group').addClass('btn-group');
    $('body .fc-prev-button,.fc-next-button,.fc-today-button').addClass('btn btn-success');
    $('body .fc-month-button,.fc-agendaWeek-button,.fc-agendaDay-button').addClass('btn btn-primary');
});