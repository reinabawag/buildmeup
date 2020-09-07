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
                    
                    <h3>Tag for <em>{{ $tag->name }}</em></h3><br>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    {{ Form::open(['route' => 'code.store']) }}
                        <input type="hidden" name="tag_id" value="{{ $tag->id }}">
                    <div class="form-group">
                        {{ Form::label('code', 'Code') }}
                        {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('type', 'Type description') }}
                        {{ Form::text('type', null, ['class' => 'form-control', 'placeholder' => 'Type description']) }}
                    </div>
                        {{ Form::submit('Add', ['class' => 'btn btn-success btn-block']) }}
                    {{ Form::close() }}

                    <br>
                    
                    @foreach ($itemTags as $itemTag)
                        <p><a href="{{ route('code.show', $itemTag->id) }}">{{ $itemTag->code }} - {{ $itemTag->type }}</a></p>
                    @endforeach
                    
                </div>                       
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.js"></script>
@endsection