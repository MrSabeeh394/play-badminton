@extends('admin.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Results</h3>
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
                        <a href="#">Results</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Result</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Result</div>
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

                                    <form action="{{ route('results.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="match_id" value="{{ $match->id }}" />
                                        <input type="hidden" name="team1_id" value="{{ $match->team1->id }}" />
                                        <input type="hidden" name="team2_id" value="{{ $match->team2->id }}" />
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="team1_name">Team 1</label>
                                                    <input type="text" class="form-control" id="team1_name"
                                                        placeholder="{{ $match->team1->name }}" name="team1_name"
                                                        value="{{ $match->team1->name }}" readonly />
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="team2_name">Team 2</label>
                                                    <input type="text" class="form-control" id="team2_name"
                                                        placeholder="{{ $match->team2->name }}" name="team2_name"
                                                        value="{{ $match->team2->name }}" readonly />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="score_team1">Team 1 Score</label>
                                                            <input type="number"
                                                                class="form-control @error('score_team1') is-invalid @enderror"
                                                                id="score_team1" placeholder="" name="score_team1"
                                                                value="{{ old('score_team1') }}" />
                                                            @error('score_team1')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="score_team2">Team 2 Score</label>
                                                            <input type="number"
                                                                class="form-control @error('score_team2') is-invalid @enderror"
                                                                id="score_team2" placeholder="" name="score_team2"
                                                                value="{{ old('score_team2') }}" />
                                                            @error('score_team2')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="is_final">
                                                        Is Final Result?
                                                    </label>
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                            class="form-check-input @error('is_final') is-invalid @enderror"
                                                            id="is_final" name="is_final" value="1"
                                                            {{ old('is_final') ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="is_final">Yes</label>
                                                    </div>
                                                    @error('is_final')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
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
@section('script')
    <script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
@endsection
@endsection
