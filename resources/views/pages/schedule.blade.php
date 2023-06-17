@extends('layouts.app', ['pageSlug' => 'Schedule'])

@section('content')

<div class="container">
    <h1>Schedule Interface
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addScheduleModal">Add New Schedule</button>
    </h1>

    <!-- Table to display schedule -->
    <table class="table">
        <thead>
            <tr>
                <th>Schedule ID</th>
                <th>Schedule Title</th>
                <th>Working Date</th>
                <th>Working Time</th>
                <th>Assign User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
            <tr>
                <td>{{ $schedule->ScheduleID }}</td>
                <td>{{ $schedule->ScheduleTitle }}</td>
                <td>{{ $schedule->WorkingDate }}</td>
                <td>{{ $schedule->WorkingTime }}</td>
                <td>{{ $schedule->AssignUser }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="model" data-target="editScheduleModal">Edit</button>

                    <form method="POST" style="display: inline;" action="{{ route('schedules.destroy', ['schedule' => $schedule->ScheduleID]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

<!-- Add Schedule Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="addScheduleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScheduleModalLabel">Add New Schedule
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addScheduleForm" action="{{ route('schedule.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="SchduleTitle">Schedule Title:</label>
                        <input type="text" name="ScheduleTitle" id="ScheduleTitle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="WorkingDate">Working Date:</label>
                        <input type="date" name="WorkingDate" id="WorkingDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="WorkingTime">Working Time:</label>
                        <input type="time" name="WorkingTime" id="WorkingTime" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="AssignUser">Assign User:</label>
                        <textarea name="AssignUser" id="AssignUser" class="form-control" rows="4"></textarea>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="addScheduleForm" class="btn btn-primary">Add Schedule</button>
                </div>
                    

<!-- Edit Schedule Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" role="dialog" aria-labelledby="editScheduleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScheduleModalLabel">Update Schedule
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editScheduleForm" action="{{ route('schedules.update', '') }}" method="POST">
                    <input type="text" name="ScheduleTitle" id="ScheduleTitle" class="form-control">
                    {{-- ['schedule' => $schedule->id] --}}
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="ScheduleTitle">Schedule Title:</label>
                        <input type="text" name="ScheduleTitle" id="ScheduleTitle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="WorkingDate">Working Date:</label>
                        <input type="date" name="WorkingDate" id="WorkingDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="WorkingTime">Working Time:</label>
                        <input type="time" name="WorkingTime" id="WorkingTime" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="AssignUser">Assign User:</label>
                        <textarea name="AssignUser" id="AssignUser" class="form-control" rows="4"></textarea>
                    </div>
                </form>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="editScheduleForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

</div>

@endsection