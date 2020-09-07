@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage users</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h3>Users</h3>
                    <ul class="list-unstyled">
                    @foreach ($users as $user)
                        <li>
                            <a href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</a>&nbsp;{{ $user->email }}
                        </li>
                    @endforeach
                    </ul>

                    <h3>Departments</h3>
                    <ul class="list-unstyled">
                    @foreach ($departments as $department)
                        <li>
                            <a href="{{ route('admin.department.show', $department->id) }}">{{ $department->name }}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection