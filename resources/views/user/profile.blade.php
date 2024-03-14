@extends('dashboard')

@section('profile')
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center ms-4">
                    <i class="bi bi-person ms-5" style="font-size: 120px"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->divisi }}</p>
                    <p class="card-text"><small class="text-muted">ini bebas buat apa</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection
