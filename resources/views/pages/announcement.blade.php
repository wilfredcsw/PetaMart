@extends('layouts.app', ['pageSlug' => 'Announcement'])

@section('content')


<div class="container">
    <h1>Announcement Interface
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAnnouncementModal">Add Announcement</button>
    </h1>

    <!-- Table to display announcements -->
    <table class="table">
        <thead>
            <tr>
                <th>Announcement ID</th>
                <th>Announcement Title</th>
                <th>Announcement Date</th>
                <th>Announcement Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $announcements as $announcement)
            <tr>
                <td>
                    {{$loop->iteration}}
                </td>
                <td>
                    {{$announcement->AnnouncementTitle}}
                </td>
                <td>
                    {{$announcement->AnnouncementDate}}
                </td>
                <td>
                    {{$announcement->AnnouncementDesc}}
                </td>

                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editAnnouncementModal">Edit</button>

                    <form method="POST" style="display: inline;" action="{{ route('announcements.destroy', ['announcement' => $announcement->AnnouncementID]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
<!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addAnnouncementForm" action="{{ route('announcements.store') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="AnnouncementTitle">Announcement Title:</label>
                        <input type="text" name="AnnouncementTitle" id="AnnouncementTitle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="AnnouncementDate">Announcement Date:</label>
                        <input type="date" name="AnnouncementDate" id="AnnouncementDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="AnnouncementDesc">Announcement Description:</label>
                        <textarea name="AnnouncementDesc" id="AnnouncementDesc" class="form-control" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="addAnnouncementForm" class="btn btn-primary">Add Announcement</button>
            </div>
        </div>
    </div>
</div>

{{-- <!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="editAnnouncementModal"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnnouncementModal">Edit Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAnnouncementForm" action="{{ route('announcements.update',['announcement' => $announcement->AnnouncementID]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="AnnouncementTitle">Announcement Title:</label>
                        <input type="text" name="AnnouncementTitle" id="AnnouncementTitle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="AnnouncementDate">Announcement Date:</label>
                        <input type="date" name="AnnouncementDate" id="AnnouncementDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="AnnouncementDesc">Announcement Description:</label>
                        <textarea name="AnnouncementDesc" id="AnnouncementDesc" class="form-control" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="editAnnouncementForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div> --}}

</div>
@endsection
