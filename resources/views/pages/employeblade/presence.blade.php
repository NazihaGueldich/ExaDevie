@extends('main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Présences</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <a type="button" class="btn btn-light px-5 mr-2" href="{{ route('historique_presence_employe') }}" >
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

        <!-- Modal  -->
        <div class="modal fade" id="dayModal" tabindex="-1" role="dialog" aria-labelledby="dayModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dayModalLabel">Ajouter une information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="dateselectionner" value="" hidden>
                        <form action="{{ route('presenceEmpl.store') }}" method="POST" id="formCalendra">
                            @csrf
                            @method('POST')
                            <p class="alert alert-danger" style="display:none" id="msgerr"></p>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Types</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="type" name="type" onchange="TypeEnregst()">
                                        <option value="" disabled selected>Choisir un type</option>
                                        <option value="0">Présence</option>
                                        <option value="1">Absence</option>
                                        <option value="2">Demande Congé</option>
                                    </select>
                                </div>
                            </div>
                            <div id='pres' style="display: none">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date début</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" name="dateDP" id="dateDP">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date fin</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" name="dateFP" id="dateFP">
                                    </div>
                                </div>
                            </div>
                            <div id='abs' style="display: none">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date début</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" name="dateDA" id="dateDA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date fin</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" name="dateFA" id="dateFA">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-2">Cause</label>
                                    <textarea type="text" class="form-control" id="causeA" name="causeA"
                                        placeholder="Saisir la cause de vos absences"></textarea>
                                </div>
                            </div>
                            <div id='demC' style="display: none">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date début</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" name="dateDDC" id="dateDDC">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Date fin</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" name="dateFDC" id="dateFDC">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-2">Cause</label>
                                    <textarea type="text" class="form-control" id="causeDC" name="causeDC"
                                        placeholder="Saisir la cause de vos absences"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success " id="myButton"
                            onclick="verifier()">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay toggle-menu"></div>
    </div>
    @if (session('dem'))
        <input hidden id="dem" value="{{ session('dem') }}">
    @else
        <input hidden id="dem" value="0">
    @endif
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
        $(document).ready(function() {
            var success = parseInt(document.getElementById('dem').value);
            if (success === 1) {
                Swal.fire({
                    title: 'Congé',
                    text: "Votre demande est envoyer",
                    icon: 'success',
                    confirmButtonColor: 'forestgreen',
                });
            }
        });
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
                events.push({
                    title: className === 'presence-green' ? 'Presence' : 'Absence',
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
                dateClick: function(info) {
                    document.getElementById('dateselectionner').value = info.dateStr;
                    $('#dayModal').modal('show');
                }
            });

            calendar.render();
        });



        function TypeEnregst() {
            type = document.getElementById('type').value;
            dateselectionner = document.getElementById('dateselectionner').value;
            if (type == 0) {
                document.getElementById("pres").style.display = "block";
                document.getElementById("abs").style.display = "none";
                document.getElementById("demC").style.display = "none";
                //7atit max day yjim ya5tar lyoum
                const today = new Date().toISOString().split("T")[0];
                document.getElementById("dateDP").setAttribute("max", today);
                document.getElementById("dateFP").setAttribute("max", today);
                document.getElementById("dateDP").value = dateselectionner;
                document.getElementById("dateFP").value = dateselectionner;
                

                const now = new Date().toISOString().slice(0, 16);
                document.getElementById("dateDP").setAttribute("max", now);
                document.getElementById("dateFP").setAttribute("max", now);
                let parts = dateselectionner.split('/');
                if (parts.length === 3) {
                    let [month, day, year] = parts;
                    dateselectionner = `${year}-${month}-${day}`;
                }
                let DateWithTimeS = `${dateselectionner}T08:00`;
                let DateWithTimeE = `${dateselectionner}T18:00`;
                document.getElementById("dateDP").value = DateWithTimeS;
                document.getElementById("dateFP").value = DateWithTimeE;
            } else if (type == 1) {
                document.getElementById("pres").style.display = "none";
                document.getElementById("abs").style.display = "block";
                document.getElementById("demC").style.display = "none";
                //7atit max day yjim ya5tar lyoum
                const now = new Date().toISOString().slice(0, 16);
                document.getElementById("dateDA").setAttribute("max", now);
                document.getElementById("dateFA").setAttribute("max", now);
                let parts = dateselectionner.split('/');
                if (parts.length === 3) {
                    let [month, day, year] = parts;
                    dateselectionner = `${year}-${month}-${day}`;
                }
                let DateWithTimeS = `${dateselectionner}T08:00`;
                let DateWithTimeE = `${dateselectionner}T18:00`;
                document.getElementById("dateDA").value = DateWithTimeS;
                document.getElementById("dateFA").value = DateWithTimeE;
            } else if (type == 2) {
                document.getElementById("pres").style.display = "none";
                document.getElementById("abs").style.display = "none";
                document.getElementById("demC").style.display = "block";
                //7atit max day yjim ya5tar lyoum
                const now = new Date().toISOString().slice(0, 16);
                document.getElementById("dateDDC").setAttribute("min", now);
                document.getElementById("dateFDC").setAttribute("min", now);
                let parts = dateselectionner.split('/');
                if (parts.length === 3) {
                    let [month, day, year] = parts;
                    dateselectionner = `${year}-${month}-${day}`;
                }
                let DateWithTimeS = `${dateselectionner}T08:00`;
                let DateWithTimeE = `${dateselectionner}T18:00`;
                document.getElementById("dateDDC").value = DateWithTimeS;
                document.getElementById("dateFDC").value = DateWithTimeE;
            }
        }

        function verifier() {
            type = document.getElementById('type').value;
            msg = '';
            find = 0;
            msgerr = document.getElementById("msgerr");
            if (type == '') {
                msg = msg + "- Vous devez choisir un type !</br>";
                find = 1;
            } else if (type == 0) {
                dateD = document.getElementById("dateDP").value;
                dateF = document.getElementById("dateFP").value;
                if (dateD.length == 0) {
                    msg = msg + "- Vous devez choisir le date de début !</br>";
                    find = 1;
                }
                if (dateF.length == 0) {
                    msg = msg + "- Vous devez choisir le date fin !</br>";
                    find = 1;
                }
                if (dateF.length != 0 && dateD.length != 0 && dateD > dateF) {
                    msg = msg + "- Date incorrecte !</br>";
                    find = 1;
                }
            } else if (type == 1) {
                dateD = document.getElementById("dateDA").value;
                dateF = document.getElementById("dateFA").value;
                if (dateD.length == 0) {
                    msg = msg + "- Vous devez choisir le date de début !</br>";
                    find = 1;
                }
                if (dateF.length == 0) {
                    msg = msg + "- Vous devez choisir le date fin !</br>";
                    find = 1;
                }
                if (dateF.length != 0 && dateD.length != 0 && dateD > dateF) {
                    msg = msg + "- Date incorrecte !</br>";
                    find = 1;
                }
                cause = document.getElementById('causeA').value;
                if (cause.length == 0) {
                    msg = msg + "- Vous devez choisir la cause d'absence !</br>";
                    find = 1;
                }
            } else if (type == 2) {
                dateD = document.getElementById("dateDDC").value;
                dateF = document.getElementById("dateFDC").value;
                if (dateD.length == 0) {
                    msg = msg + "- Vous devez choisir le date de début !</br>";
                    find = 1;
                }
                if (dateF.length == 0) {
                    msg = msg + "- Vous devez choisir le date fin !</br>";
                    find = 1;
                }
                if (dateF.length != 0 && dateD.length != 0 && dateD > dateF) {
                    msg = msg + "- Date incorrecte !</br>";
                    find = 1;
                }
                cause = document.getElementById('causeDC').value;
                if (cause.length == 0) {
                    msg = msg + "- Vous devez choisir la cause d'absence !</br>";
                    find = 1;
                }
            }

            if (find == 0) {
                const myButton = document.querySelector('#myButton');
                myButton.disabled = true;
                $("#formCalendra").submit();
                console.log('tsagal');
            } else {
                msgerr.style.display = "block";
                msgerr.innerHTML = msg;
            }
        }
    </script>
@endsection
