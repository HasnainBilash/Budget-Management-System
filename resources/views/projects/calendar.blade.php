@extends('layouts.app')

@section('title', 'Project Calendar')

@section('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    #calendar { font-family: inherit; }
    .fc .fc-toolbar-title { font-size: 1.25rem; font-weight: 700; color: #0f172a; }
    .fc .fc-button-primary { background-color: #059669; border-color: #059669; }
    .fc .fc-button-primary:hover { background-color: #047857; border-color: #047857; }
    .fc .fc-button-primary:disabled { background-color: #a7f3d0; border-color: #a7f3d0; }
</style>
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1 class="page-title">Project calendar</h1>
        <a href="{{ route('projects.index') }}" class="btn-secondary">View all projects</a>
    </div>

    <div class="card card-body">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: @json($projects),
        eventClick: function(info) {
            if (info.event.url) {
                window.location.href = info.event.url;
                info.jsEvent.preventDefault();
            }
        }
    });
    calendar.render();
});
</script>
@endsection
