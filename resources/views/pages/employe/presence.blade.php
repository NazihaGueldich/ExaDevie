@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Présences de M(e).{{$employe->nom}} {{$employe->pnom}}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <a type="button" class="btn btn-light px-5 mr-2" href="{{ route('historiquepresenceemploye', ['id' => $employe->id]) }}" >
                            Historiques</a>
                    </div>
                </div>
                <hr>
                <div>
                    <div id='calendar-container' wire:ignore>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="overlay toggle-menu"></div>
    </div>
    <style>
        #calendar-container {
            position: relative;
            width: 100%;
            padding-top: 20px;
        }

        #calendar {
            margin: 10px auto;
            padding: 10px;
            max-width: 1100px;
            height: 700px;
        }

        .presence-green {
            background-color: green !important;
            color: white;
        }

        .absence-red {
            background-color: red !important;
            color: white;
        }

        .conge-yellow {
            background-color: yellow !important;
            color: white;
        }
    </style>

    <!-- Include FullCalendar JS and CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>

    <!-- Initialize FullCalendar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');
            //54it les inf de pres abs wcong
            const presences = @json($presences);
            const conges = @json($conjs);

            //fct bch nara 3atiha date start wend wtraga3 les dates ili binhom ilkoll
            function getDatesInRange(startDate, endDate) {
                const dates = [];
                let currentDate = new Date(startDate);
                while (currentDate <= new Date(endDate)) {
                    dates.push(currentDate.toISOString().split('T')[0]); 
                    currentDate.setDate(currentDate.getDate() + 1); 
                }
                return dates;
            }

            const events = [];

            presences.forEach(presence => {
                let className = '';

                if (presence.etat === 0) {
                    className = 'presence-green'; // Presence
                } else if (presence.etat === 1) {
                    className = 'absence-red'; // Absence
                }
                const timeD = new Date(presence.dateD).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
                const timeF = new Date(presence.dateF).toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
                const title = (className === 'presence-green') ?
                    'Presence:de ' + timeD + ' jusqu\'à ' + timeF :
                    'Absence:de ' + timeD + ' jusqu\'à ' + timeF;
                events.push({
                    title: title,
                    start: presence.dateD.split(' ')[0],
                    allDay: true,
                    classNames: className
                });
            });

            conges.forEach(conge => {
                const congeDates = getDatesInRange(conge.dateD.split(' ')[0], conge.dateF.split(' ')[0]);

                congeDates.forEach(date => {
                    events.push({
                        title: 'Congé',
                        start: date,
                        allDay: true,
                        classNames: 'conge-yellow' 
                    });
                });
            });

            const calendar = new Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    /* right: 'dayGridMonth,timeGridWeek,timeGridDay' */
                    right: 'dayGridMonth'
                },
                events: events,
               
            });

            calendar.render();
        });
    </script>
@endsection
