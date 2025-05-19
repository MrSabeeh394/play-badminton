@extends('admin.main')
@section('style')
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- select2-bootstrap4-theme -->
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Events</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('events.index') }}">Events</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Event </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Event</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <!-- Display error messages -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Title and Level -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="title" name="title" placeholder="Enter Title"
                                                        value="{{ old('title') }}">
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="level">Level</label>
                                                    <select class="form-control @error('level') is-invalid @enderror"
                                                        id="level" name="level">
                                                        <option value="">Select Level</option>
                                                        <option value="Beginner"
                                                            {{ old('level') == 'Beginner' ? 'selected' : '' }}>
                                                            Beginner</option>
                                                        <option value="Intermediate"
                                                            {{ old('level') == 'Intermediate' ? 'selected' : '' }}>
                                                            Intermediate
                                                        </option>
                                                        <option value="Advanced"
                                                            {{ old('level') == 'Advanced' ? 'selected' : '' }}>
                                                            Advanced</option>
                                                    </select>
                                                    @error('level')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Team Type and Max Team -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="team_type">Team Type</label>
                                                    <select class="form-control @error('team_type') is-invalid @enderror"
                                                        id="team_type" name="team_type">
                                                        <option value="" disabled selected>Select Team Type</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Double">Double</option>
                                                    </select>
                                                    @error('team_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Max Teams -->
                                                        <div class="form-group">
                                                            <label for="max_teams">Max Teams</label>
                                                            <input type="number"
                                                                class="form-control @error('max_teams') is-invalid @enderror"
                                                                id="max_teams" name="max_teams"
                                                                value="{{ old('max_teams', 64) }}">
                                                            @error('max_teams')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- Match Points -->
                                                        <div class="form-group">
                                                            <label for="points">Match Points</label>
                                                            <select
                                                                class="form-control @error('points') is-invalid @enderror"
                                                                id="points" name="points">
                                                                <option value="10"
                                                                    {{ old('points') == 10 ? 'selected' : '' }}>
                                                                    10
                                                                </option>
                                                                <option value="20"
                                                                    {{ old('points') == 20 ? 'selected' : '' }}>
                                                                    20
                                                                </option>
                                                                <option value="30"
                                                                    {{ old('points') == 30 ? 'selected' : '' }}>
                                                                    30
                                                                </option>
                                                            </select>
                                                            @error('points')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Event Type and Shuttle Type -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Event Type -->
                                                        <div class="form-group">
                                                            <label for="event_type">Event Type</label>
                                                            <select
                                                                class="form-control @error('event_type') is-invalid @enderror"
                                                                id="event_type" name="event_type">
                                                                <option value="">Select Event Type</option>
                                                                <option value="Tournament"
                                                                    {{ old('event_type') == 'Tournament' ? 'selected' : '' }}>
                                                                    Tournament
                                                                </option>
                                                                <option value="League"
                                                                    {{ old('event_type') == 'League' ? 'selected' : '' }}>
                                                                    League
                                                                </option>
                                                                <option value="Friendly"
                                                                    {{ old('event_type') == 'Friendly' ? 'selected' : '' }}>
                                                                    Friendly
                                                                </option>
                                                                <option value="Other"
                                                                    {{ old('event_type') == 'Other' ? 'selected' : '' }}>
                                                                    Other
                                                                </option>
                                                            </select>
                                                            @error('event_type')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- Shuttle Type -->
                                                        <div class="form-group">
                                                            <label for="shuttle_type">Shuttle Type</label>
                                                            <select
                                                                class="form-control @error('shuttle_type') is-invalid @enderror"
                                                                id="shuttle_type" name="shuttle_type">
                                                                <option value="">Select Shuttle Type</option>
                                                                <option value="feather"
                                                                    {{ old('shuttle_type') == 'feather' ? 'selected' : '' }}>
                                                                    Feather
                                                                </option>
                                                                <option value="nylon"
                                                                    {{ old('shuttle_type') == 'nylon' ? 'selected' : '' }}>
                                                                    Nylon
                                                                </option>
                                                            </select>
                                                            @error('shuttle_type')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Date -->
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="date"
                                                        class="form-control @error('date') is-invalid @enderror"
                                                        id="date" name="date" value="{{ old('date') }}">
                                                    @error('date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Event details and Location -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Event Detail -->
                                                <div class="form-group">
                                                    <!-- Event Detail -->
                                                    <label for="event_detail">Event Detail</label>
                                                    <select
                                                        class="form-control @error('event_detail') is-invalid @enderror"
                                                        id="event_detail" name="event_detail">
                                                        <option value="">Select Event Detail</option>
                                                        <option value="Double League (Feather)"
                                                            {{ old('event_detail') == 'Double League (Feather)' ? 'selected' : '' }}>
                                                            Double League (Feather)</option>
                                                        <option value="Double League (Nylon)"
                                                            {{ old('event_detail') == 'Double League (Nylon)' ? 'selected' : '' }}>
                                                            Double League (Nylon)</option>
                                                        <option value="Single League (Feather)"
                                                            {{ old('event_detail') == 'Single League (Feather)' ? 'selected' : '' }}>
                                                            Single League (Feather)</option>
                                                        <option value="Double Tournament (Cat C)"
                                                            {{ old('event_detail') == 'Double Tournament (Cat C)' ? 'selected' : '' }}>
                                                            Double Tournament (Cat C)</option>
                                                        <option value="Double Tournament (Cat D)"
                                                            {{ old('event_detail') == 'Double Tournament (Cat D)' ? 'selected' : '' }}>
                                                            Double Tournament (Cat D)</option>
                                                        <option value="Double Tournament (Open)"
                                                            {{ old('event_detail') == 'Double Tournament (Open)' ? 'selected' : '' }}>
                                                            Double Tournament (Open)</option>
                                                        <option value="Single Tournament (Cat C)"
                                                            {{ old('event_detail') == 'Single Tournament (Cat C)' ? 'selected' : '' }}>
                                                            Single Tournament (Cat C)</option>
                                                        <option value="Single Tournament (Cat D)"
                                                            {{ old('event_detail') == 'Single Tournament (Cat D)' ? 'selected' : '' }}>
                                                            Single Tournament (Cat D)</option>
                                                        <option value="Single Tournament (Open)"
                                                            {{ old('event_detail') == 'Single Tournament (Open)' ? 'selected' : '' }}>
                                                            Single Tournament (Open)</option>
                                                        <option value="Mini Tournament (Double)"
                                                            {{ old('event_detail') == 'Mini Tournament (Double)' ? 'selected' : '' }}>
                                                            Mini Tournament (Double)</option>
                                                        <option value="Mini Tournament (Single)"
                                                            {{ old('event_detail') == 'Mini Tournament (Single)' ? 'selected' : '' }}>
                                                            Mini Tournament (Single)</option>
                                                        <option value="Friendly (Single)"
                                                            {{ old('event_detail') == 'Friendly (Single)' ? 'selected' : '' }}>
                                                            Friendly (Single)</option>
                                                        <option value="Friendly (Double)"
                                                            {{ old('event_detail') == 'Friendly (Double)' ? 'selected' : '' }}>
                                                            Friendly (Double)</option>
                                                        <option value="Other"
                                                            {{ old('event_detail') == 'Other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>
                                                    @error('event_detail')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- location -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="location">Location</label>
                                                    <input type="text"
                                                        class="form-control @error('location') is-invalid @enderror"
                                                        id="location" name="location" value="{{ old('location') }}">
                                                    @error('location')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Teams Select and Completeness -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="team_id">Select Teams</label>
                                                    <select multiple name="team_id[]" id="team_id"
                                                        class="form-control">
                                                        <!-- Options will be dynamically added here -->
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Complete Results -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="complete_results">
                                                        Include Complete Results
                                                    </label>
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input @error('complete_results') is-invalid @enderror"
                                                            id="complete_results" name="complete_results" value="1"
                                                            {{ old('complete_results') ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="complete_results">Yes</label>
                                                    </div>
                                                    @error('complete_results')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Submit Button -->
                                        <div class="card-action" style="border-top: 0px !important">
                                            <button class="btn btn-success" type="submit">Submit</button>
                                            <a href="{{ route('events.index') }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize Select2 on all select elements
                $('select').select2({
                    theme: 'bootstrap4',
                    width: 'style',
                    placeholder: 'Select an option',
                    allowClear: true,
                });

                // Handle team type change
                $('#team_type').on('change', function() {
                    const teamType = $(this).val(); // Get selected team type
                    const teamSelect = $('#team_id'); // Get the team select element

                    // Clear existing options
                    teamSelect.html('<option value="" disabled selected>Loading...</option>');

                    if (teamType) {
                        // Make an AJAX request to fetch teams based on the selected team type
                        fetch(`/get-teams/${teamType}`)
                            .then(response => response.json())
                            .then(teams => {
                                // Clear options again after loading data
                                teamSelect.html('');

                                // Populate teams dropdown
                                teams.forEach(team => {
                                    const option =
                                        `<option value="${team.id}">${team.name}</option>`;
                                    teamSelect.append(option);
                                });

                                // Reinitialize Select2 for dynamically updated options
                                teamSelect.select2({
                                    theme: 'bootstrap4',
                                    width: 'style',
                                    placeholder: 'Select Teams',
                                    allowClear: true,
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching teams:', error);
                                alert('Failed to fetch teams. Please try again.');
                            });
                    }
                });
            });
        </script>

    @endsection
