@extends('admin.main')
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
                        <a href="{{ route('players.show', $player->id) }}">Show Player</a>
                    </li>
                </ul>
            </div>
            <div class="container d-flex justify-content-center align-items-center mb-5" style="min-height: 100vh;">
                <div class="row justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="card shadow-lg border-light">
                            <div class="card-header text-center bg-primary text-white">
                                <h3 class="m-0">Player Team : {{ $playerTeam->team->name ?? 'No Team Assigned' }}</h3>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ $player->picture }}" alt="Player Image" class="img-fluid rounded-circle mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;">

                                <h5 class="card-title mb-3">{{ $player->first_name . ' ' . $player->surname }}</h5>

                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>First Name</th>
                                            <td>{{ $player->first_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Surname</th>
                                            <td>{{ $player->surname ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Preferred Name</th>
                                            <td>{{ $player->preferred_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Year of Birth</th>
                                            <td>{{ $player->year_of_birth }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $player->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Number</th>
                                            <td>{{ $player->contact_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Registered with Badminton England</th>
                                            <td>{{ $player->registered_with_badminton_england ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Registration Number</th>
                                            <td>{{ $player->registration_number ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
@endsection
@endsection
