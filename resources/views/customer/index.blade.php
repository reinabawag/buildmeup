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
                    @if ( ! Auth::user()->hasAnyRole('approver'))
                    <a role="button" href="{{ route('customer.create') }}" class="btn btn-default">Create new customer</a><br><br>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($customers as $key => $customer)
                            <tr>
                                <td>{{ $customer->code == null ? 'CODE'.$key : $customer->code }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->status }}</td>
                                <td>
                                    @if (Auth::user()->hasAnyRole('approver'))
                                    <form action="{{ route('customer.update', $customer->id) }}" id="frm-approve-{{ $customer->id }}" method="POST" style="display: none;">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="sa" name="is_approved" value="true">
                                    </form>
                                    <a href="{{ route('customer.update', $customer->id) }}" class="btn btn-warning btn-sm" id="btn-approve" onclick="event.preventDefault();var r = confirm('Approve this customer buildup?\n{{ $customer->name }}');if(r){document.getElementById('frm-approve-{{ $customer->id }}').submit();}"><span class="glyphicon glyphicon-check"></span> Approve</a>
                                    @endif
                                    <a href="{{ route('customer.edit', $customer->id) }}" role="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-file"></span> View</a>
                                    <a href="{{ route('customer.edit', $customer->id) }}" role="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <form action="{{ route('customer.destroy', $customer->id) }}" id="delete-form-{{ $customer->id }}" method="post" style="display: none;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                    <a href="{{ route('customer.destroy', $customer->id) }}" onclick="event.preventDefault();var r = confirm('Are you sure you want to delete this customer?');if(r){document.getElementById('delete-form-{{ $customer->id }}').submit();}" role="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                    <h3>List of my approved customer(s)</h3>
                    <ul>
                        @foreach ($approvedCustomers as $approvedCustomer)
                            <li><a href="{{ route('customer.edit', $approvedCustomer->id) }}">{{ $approvedCustomer->name }}</a></li>
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

<script>
    $(document).ready(function() {
        $('table').dataTable();
    });
</script>
@endsection