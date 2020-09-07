@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <a role="button" href="{{ route('item.create') }}" class="btn btn-default">Create item buildup</a><br><br>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                            <tr>
                                <td>{{ $item->item }}</td>
                                <td>{{ $item->description }}</td>
                                <td>Encoded</td>
                                <td>
                                    <a href="{{ route('jasper', $item->id) }}" target="_blank" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-print"></span> Print</a>
                                    <a href="{{ route('item.show', $item->id) }}" role="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-file"></span> View</a>
                                    <a href="{{ route('item.edit', $item->id) }}" role="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <form action="{{ route('item.destroy', $item->id) }}" id="from-delete-{{ $item->id }}" method="post" style="display: none;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                    <a href="{{ route('item.destroy', $item->id) }}" onclick="event.preventDefault();var r = confirm('Are you sure you want to delete this item?');if(r){document.getElementById('from-delete-{{ $item->id }}').submit();}" role="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                               </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('table').dataTable();
    });
</script>
@endsection