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
                <h3 class="fw-bold mb-3">Players</h3>
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
                        <a href="{{ route('players.index') }}">Players</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Player</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Player</div>
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
                                    <form action="{{ route('players.update', $player->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- First Name and Surname -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        id="first_name" placeholder="Enter First Name" name="first_name"
                                                        value="{{ $player->first_name ?? old('first_name') }}" />
                                                    @error('first_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="surname">Surname</label>
                                                    <input type="text"
                                                        class="form-control @error('surname') is-invalid @enderror"
                                                        id="surname" placeholder="Enter Surname" name="surname"
                                                        value="{{ $player->surname ?? old('surname') }}" />
                                                    @error('surname')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Preferred Name and Year of Birth -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="preferred_name">Preferred Name</label>
                                                    <input type="text"
                                                        class="form-control @error('preferred_name') is-invalid @enderror"
                                                        id="preferred_name" placeholder="Enter Preferred Name"
                                                        name="preferred_name"
                                                        value="{{ $player->preferred_name ?? old('preferred_name') }}" />
                                                    @error('preferred_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="year_of_birth">Year of Birth</label>
                                                    <input type="date"
                                                        class="form-control @error('year_of_birth') is-invalid @enderror"
                                                        id="year_of_birth" name="year_of_birth"
                                                        value="{{ $player->year_of_birth ?? old('year_of_birth') }}" />
                                                    @error('year_of_birth')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email and Contact Number -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" placeholder="Enter Email" name="email"
                                                        value="{{ $player->email ?? old('email') }}" />
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_number">Contact Number</label>
                                                    <input type="text"
                                                        class="form-control @error('contact_number') is-invalid @enderror"
                                                        id="contact_number" placeholder="Enter Contact Number"
                                                        name="contact_number"
                                                        value="{{ $player->contact_number ?? old('contact_number') }}" />
                                                    @error('contact_number')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Profile Picture and Registration with Badminton England -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="picture">Profile Picture</label>
                                                    <input type="file"
                                                        class="form-control @error('picture') is-invalid @enderror"
                                                        id="picture" name="picture" />
                                                    @error('picture')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Registered with Badminton England and Registration Number -->
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <!-- Registered with Badminton England -->
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-group">
                                                            <label for="registered_with_badminton_england">Registered with
                                                                Badminton England
                                                            </label>
                                                            <div class="form-check">
                                                                <input type="checkbox"
                                                                    class="form-check-input @error('registered_with_badminton_england') is-invalid @enderror"
                                                                    id="registered_with_badminton_england"
                                                                    name="registered_with_badminton_england"
                                                                    value="1"
                                                                    {{ $player->registered_with_badminton_england ? 'checked' : '' }} />
                                                                <label class="form-check-label"
                                                                    for="registered_with_badminton_england">Yes
                                                                </label>
                                                            </div>
                                                            @error('registered_with_badminton_england')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Registration Number -->
                                                    <div class="col-md-6 col-6">
                                                        <div id="registration_number_container" class="form-group"
                                                            style="display: {{ $player->registered_with_badminton_england ? 'block' : 'none' }}">
                                                            <label for="registration_number">Registration Number</label>
                                                            <input type="text"
                                                                class="form-control @error('registration_number') is-invalid @enderror"
                                                                id="registration_number"
                                                                placeholder="Enter Registration Number"
                                                                name="registration_number"
                                                                value="{{ $player->registration_number ?? old('registration_number') }}" />
                                                            @error('registration_number')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Select teams -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Teams</label>
                                                    <select multiple name="team_id[]" id="team_id"
                                                        class="form-control @error('team_id') is-invalid @enderror"
                                                        data-allow-clear="1">
                                                        <option value="" disabled>Select Teams</option>
                                                        @foreach ($teams as $team)
                                                            <option value="{{ $team->id }}"
                                                                {{ in_array($team->id, old('team_id', $selectedTeams)) ? 'selected' : '' }}>
                                                                {{ $team->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>


                                                    @error('team_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Submit and Cancel Buttons -->
                                        <div class="card-action" style="border-top: 0px solid !important">
                                            <button class="btn btn-success" type="submit">Update</button>
                                            <a href="{{ route('players.index') }}" class="btn btn-danger">Cancel</a>
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

    {{-- Registration script file --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('registered_with_badminton_england');
            console.log(checkbox);
            const registrationContainer = document.getElementById('registration_number_container');

            function toggleRegistrationNumber() {
                registrationContainer.style.display = checkbox.checked ? 'block' : 'none';
            }

            // Attach event listener
            checkbox.addEventListener('change', toggleRegistrationNumber);

            // Initial visibility based on checkbox state
            toggleRegistrationNumber();
        });
    </script>

    {{-- multi team select script --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function() {
            $('select').each(function() {
                $(this).select2({
                    theme: 'bootstrap4',
                    width: 'style',
                    placeholder: $(this).attr('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        });
    </script>
@endsection
