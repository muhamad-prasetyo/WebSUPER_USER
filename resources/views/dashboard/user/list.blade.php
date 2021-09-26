@extends('layouts.dashboard');

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Users</h3>
                </div>

                <div class="col-4">
                    <form action="{{ url('dashboard/users') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control form-control-sm" value="{{ $request['q'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Register</th>
                        <th>Edited</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tr>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td> <a href="{{ route('dashboard.users.edit', ['id' => $user->id]) }}" title="edit" class="btn btn-success btn-sm">
                                <i class="fas fa-pen"></i>
                            </a> </td>
                        </tr>
                    @endforeach
                </tbody>
                </tr>
            </table>

            {{ $users->appends($request)->links() }}

        </div>
    </div>
@endsection