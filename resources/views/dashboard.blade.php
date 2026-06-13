@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome</h1>
    <p>Select a module from the menu.</p>

    @auth
        @if (auth()->user()->isAdmin())
            <div class="card mt-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Admin Quick Actions</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Manage Doctors</a>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">Manage Services</a>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Manage Patients</a>
                    </div>
                </div>
            </div>
        @endif
    @endauth
</div>
@endsection