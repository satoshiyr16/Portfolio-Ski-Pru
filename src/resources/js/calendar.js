import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import momentPlugin from '@fullcalendar/moment';

var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin,momentPlugin],
    themeSystem: 'bootstrap5',
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev",
        center: "title",
        right: "next",
    },
    locale: "ja",
    selectable: true,
    dateClick: function(info) {
        var date = info.dateStr;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/today_diary_check',
            type: 'POST',
            data: {date: date},
            dataType: 'json',
            success: function(response) {
                // 日付がデータベースに存在する場合、リダイレクトする
                if (response.exists) {
                    window.location.href = "/diary_edit/" + date;
                }
                else {
                    window.location.href = "/diary/" + date;
                }
            }
        });
    },
    events: '/diary_data_get',
    eventClassNames: function(info) {
        let skin_tone = info.event.extendedProps.skin_tone;
        switch (skin_tone) {
            case '良い':
            return 'skin-status-1';
            case '少し良い':
            return 'skin-status-2';
            case '普通':
            return 'skin-status-3';
            case '少し悪い':
            return 'skin-status-4';
            case '悪い':
            return 'skin-status-5';
        }
    },
});
calendar.render();
