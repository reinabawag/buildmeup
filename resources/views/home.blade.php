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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Welcome to Build me up!</h1>
                    <p align="justify">A project of Management Information Systems Department 2020.</p>
                    <p>Where you can create a request for Customer, Item and Vendor Buildup.</p>
                    <br>
                    
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