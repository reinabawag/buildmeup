@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage tags</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('tag.create') }}" class="btn btn-default">Create tag</a>
                    <br><br>
                    <div class="list-group">
                        @foreach ($tags as $tag)
                            <a href="{{ route('tag.show', $tag->id) }}" class="list-group-item"><span class="badge">{{ count($tag->itemTags) }}</span>{!! $tag->name !!}</a>
                        @endforeach
                    </div>

                   @foreach ($tags as $tag)
                        <b>{{ $tag->name }}</b>
                       @foreach ($tag->itemTags as $itemTag)
                           <p>{{ $itemTag->type }}</p>
                       @endforeach
                   @endforeach

                    </ul>
                </div>                       
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.js"></script>
@endsection