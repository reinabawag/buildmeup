@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">                   
                    <div class="row">
                        <div class="col-md-4">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (count($errors) > 0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            
                            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="" id="" class="form-control" value="{{ $user->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="" id="" class="form-control" value="{{ $user->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Created at</label>
                                    <input type="text" name="" id="" class="form-control" value="{{ date('M. d, Y', strtotime($user->created_at)) }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="status" class="form-control">
                                        <option value="">--Select department--</option>
                                        @foreach ($departments as $department)
                                            <option {{ $department->id == $user->department_id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- {{ dd($roles->toArray()) }} --}}
                                @foreach ($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="role[]" value="{{ $role['id'] }}" {{ $role['status'] ? 'checked' : '' }}>is&nbsp;{{ $role['type'] }}
                                    </label>
                                </div>
                                @endforeach
                                

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $user->status == 'approved' ? 'selected' : '' }} value="approved">approved</option>
                                        <option {{ $user->status == 'denied' ? 'selected' : '' }} value="denied">denied</option>
                                        <option {{ $user->status == 'pending' ? 'selected' : '' }} value="pending">pending</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Update status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection