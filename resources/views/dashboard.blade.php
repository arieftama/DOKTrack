@extends('layouts.main')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Total Tasks -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Tasks</span>
                    <span class="info-box-number">
                        {{ $totalTasks }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Tasks</span>
                    <span class="info-box-number">
                        {{ $pendingTasks }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Completed Tasks</span>
                    <span class="info-box-number">
                        {{ $completedTasks }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Active Members -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Members</span>
                    <span class="info-box-number">
                        {{ $activeMembers }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Calendar</h5>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Chart -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Task Statistics</h5>
                </div>
                <div class="card-body">
                    <canvas id="taskChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <!-- FullCalendar Styles -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/core/index.global.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/daygrid/index.global.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/timegrid/index.global.min.css" rel="stylesheet">

    <style>
        .fc-event {
            cursor: pointer;
        }
        #calendar {
            background: white;
            padding: 15px;
            border-radius: 4px;
            height: 600px;
        }
    </style>
@stop

@section('js')
    <!-- FullCalendar Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/core/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/daygrid/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/timegrid/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/interaction/index.global.min.js"></script>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'interaction'],
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialView: 'dayGridMonth',
        events: {!! json_encode($events) !!}, // Data events dari backend
        editable: true, // Agar event dapat di-drag
        selectable: true, // Agar user bisa klik tanggal
        nowIndicator: true,
        dayMaxEvents: true, // Jika event banyak, tampilkan "more"
        });
    calendar.render();
    });


            // Initialize Chart.js
            const ctx = document.getElementById('taskChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($taskDates) !!},
                    datasets: [{
                        label: 'Tasks Created',
                        data: {!! json_encode($taskCounts) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        tension: 0.1,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: { display: true, text: 'Date' }
                        },
                        y: {
                            title: { display: true, text: 'Task Count' },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop
