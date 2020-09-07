@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Item tag</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    {{ Form::model($itemTag, ['route' => ['code.update', $itemTag->id], 'method' => 'PUT']) }}
                        <div class="form-group">
                            {{ Form::label('tag_id', 'Tag') }}
                            {{ Form::select('tag_id', $tags, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('code', 'Code') }}
                            {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('type', 'Type description') }}
                            {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type description']) }}
                        </div>
                        {{ Form::submit('Update', ['class' => 'btn btn-success btn-block']) }}
                    {{ Form::close() }}

                    <br>

                    {{ Form::open(['route' => ['code.destroy', $itemTag->id], 'method' => 'DELETE']) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
                    {{ Form::close() }}
                </div>                       
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.js"></script>
@endsection