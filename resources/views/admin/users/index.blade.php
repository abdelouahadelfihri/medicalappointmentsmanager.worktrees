@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add User
        </a>
    </div>

    <p class="text-muted mb-3">Click any column header to sort the user list.</p>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('admin.users.index', ['sort' => 'id', 'direction' => $sort === 'id' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                ID
                                @if($sort === 'id')
                                    <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.users.index', ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Name
                                @if($sort === 'name')
                                    <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.users.index', ['sort' => 'email', 'direction' => $sort === 'email' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Email
                                @if($sort === 'email')
                                    <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('admin.users.index', ['sort' => 'role', 'direction' => $sort === 'role' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                                Role
                                @if($sort === 'role')
                                    <i class="bi bi-caret-{{ $direction === 'asc' ? 'up' : 'down' }}-fill"></i>
                                @endif
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                {{ $user->name }}
                                @if($user->id === auth()->id())
                                    <span class="text-muted">(You)</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    $badgeClasses = [
                                        'admin' => 'bg-primary',
                                        'patient' => 'bg-success',
                                        'doctor' => 'bg-info text-dark',
                                        'secretary' => 'bg-warning text-dark',
                                    ];
                                @endphp
                                <span class="badge {{ $badgeClasses[$user->role] ?? 'bg-secondary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-sm btn-secondary" disabled title="You cannot delete the user currently logged in.">
                                        Current user
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
