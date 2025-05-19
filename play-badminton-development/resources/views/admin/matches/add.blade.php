@extends('admin.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Matches</h3>
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
                        <a href="#">Matches</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Match</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Match</div>
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
                                    <form action="{{ route('matches.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Event -->
                                                <div class="form-group">
                                                    <label for="event_id">Event</label>
                                                    <select class="form-control @error('event_id') is-invalid @enderror"
                                                        id="event_id" name="event_id">
                                                        <option value="">Select Event</option>
                                                        @foreach ($events as $event)
                                                            <option value="{{ $event->id }}"
                                                                {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                                                {{ $event->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('event_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Team 1 -->
                                                        <div class="form-group">
                                                            <label for="team1_id">Team 1</label>
                                                            <select
                                                                class="form-control @error('team1_id') is-invalid @enderror"
                                                                id="team1_id" name="team1_id">
                                                                <option value="">Select Team 1</option>
                                                                @foreach ($teams as $team)
                                                                    <option value="{{ $team->id }}"
                                                                        {{ old('team1_id') == $team->id ? 'selected' : '' }}>
                                                                        {{ $team->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('team1_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!-- Team 2 -->
                                                        <div class="form-group">
                                                            <label for="team2_id">Team 2</label>
                                                            <select
                                                                class="form-control @error('team2_id') is-invalid @enderror"
                                                                id="team2_id" name="team2_id">
                                                                <option value="">Select Team 2</option>
                                                                @foreach ($teams as $team)
                                                                    <option value="{{ $team->id }}"
                                                                        {{ old('team2_id') == $team->id ? 'selected' : '' }}>
                                                                        {{ $team->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('team2_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Type -->
                                                <div class="form-group">
                                                    <label for="type">Match Type</label>
                                                    <select class="form-control @error('type') is-invalid @enderror"
                                                        id="type" name="type">
                                                        <option value="Group"
                                                            {{ old('type') == 'Group' ? 'selected' : '' }}>Group</option>
                                                        <option value="Knockout"
                                                            {{ old('type') == 'Knockout' ? 'selected' : '' }}>Knockout
                                                        </option>
                                                    </select>
                                                    @error('type')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Sets -->
                                                <div class="form-group">
                                                    <label for="sets">Match Sets</label>
                                                    <select class="form-control @error('sets') is-invalid @enderror"
                                                        id="sets" name="sets">
                                                        <option value="Single"
                                                            {{ old('sets') == 'Single' ? 'selected' : '' }}>Single</option>
                                                        <option value="Best of 3"
                                                            {{ old('sets') == 'Best of 3' ? 'selected' : '' }}>Best of 3
                                                        </option>
                                                    </select>
                                                    @error('sets')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Setting -->
                                                <div class="form-group">
                                                    <label for="setting">Is match setting available?</label>
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input @error('setting') is-invalid @enderror"
                                                            id="setting" name="setting" value="1"
                                                            {{ old('setting') ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="setting">Yes</label>
                                                    </div>
                                                    @error('setting')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        <div class="card-action" style="border-top: 0px solid !important">
                                            <button class="btn btn-success" type="submit">Submit</button>
                                            <a href="{{ route('matches.index') }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('team1_id').addEventListener('change', function() {
            const team1Selected = this.value;
            const team2Dropdown = document.getElementById('team2_id');

            // Enable all options initially
            Array.from(team2Dropdown.options).forEach(option => {
                option.disabled = false;
            });

            // Disable the selected team in Team 2 dropdown
            if (team1Selected) {
                const optionToDisable = team2Dropdown.querySelector(`option[value="${team1Selected}"]`);
                if (optionToDisable) {
                    optionToDisable.disabled = true;
                }
            }
        });
    </script>
@section('script')
    <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
@endsection


@endsection
