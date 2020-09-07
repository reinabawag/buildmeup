@extends('layouts.app')

@section('styles')
{!! Html::style('css/parsley.css') !!}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
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

                    <div class="row">
                        <div class="col-md-6">
                            <h3>Create item builup</h3>
                            <hr>

                            {!! Form::open(['route' => 'item.store']) !!}
                            <div class="form-group">
                                {{ Form::label('item', 'Item Code') }}
                                {{ Form::text('item', null, array('class' => 'form-control', 'placeholder' => 'Item code', 'required' => '')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('description', 'Item Description') }}
                                {{ Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Item description', 'required' => '')) }}
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::hidden('stocked', false) }}
                                        <label class="checkbox-inline">{{ Form::checkbox('stocked', true) }}Stocked</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::hidden('lot_tracked', false) }}
                                        <label class="checkbox-inline">{{ Form::checkbox('lot_tracked', true) }}Lot Tracked</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::hidden('reservable', false) }}
                                        <label class="checkbox-inline">{{ Form::checkbox('reservable', true) }}Reservable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('type', 'Item Type') }}
                                        {{ Form::select('type', ['Material' => 'Material', 'Tool' => 'Tool', 'Fixture' => 'Fixture', 'Other' => 'Other'], 'Material', ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('source', 'Source') }}
                                        {{ Form::select('source', ['Purchased' => 'Purchased', 'Manufactured' => 'Manufactured', 'Transferred' => 'Transferred'], 'Manufactured', ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('cost_type', 'Cost Type') }}
                                        {{ Form::select('cost_type', ['Actual' => 'Actual', 'Standard' => 'Standard'], 'Actual', ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('cost_method', 'Cost Method') }}
                                        {{ Form::select('cost_method', ['Average' => 'Average', 'FIFO' => 'FIFO', 'LIFO' => 'LIFO', 'Specific' => 'Specific', 'Standard' => 'Standard'], 'Specific', ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('abc_code', 'ABC Code') }}
                                        {{ Form::select('abc_code', ['A' => 'A', 'B' => 'B', 'C' => 'C'], 'A', ['class' => 'form-control', 'required' => '']) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('family_code', 'Family code') }}
                                        {{ Form::select('family_code', ['CU' => 'CU', 'AL' => 'AL', 'ALB' => 'ALB'], 'CU', ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('product_code', 'Product Code') }}
                                        <select name="product_code" id="product_code" class="form-control" required>
                                            <option value="" selected>--Select Product Code--</option>
                                            @foreach ($prodCodes as $prodCode)
                                            <option value="{{ $prodCode->product_code }}">
                                                {{ $prodCode->product_code .' - '. $prodCode->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('unit_measure', 'Unit Measure') }}
                                        {{ Form::text('unit_measure', null, ['class' => 'form-control', 'placeholder' => 'Unit measure', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('unit_weight', 'Unit Weight') }}
                                        {{ Form::text('unit_weight', null, ['class' => 'form-control', 'placeholder' => 'Unit Weigth', 'required' => '']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('purchase_unit', 'Purchase Unit') }}
                                        {{ Form::text('purchase_unit', null, ['class' => 'form-control', 'placeholder' => 'Purchase Unit']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('stock_unit', 'Stock Unit') }}
                                        {{ Form::text('stock_unit', null, ['class' => 'form-control', 'placeholder' => 'Stock Unit']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('issue_unit', 'Issue Unit') }}
                                        {{ Form::text('issue_unit', null, ['class' => 'form-control', 'placeholder' => 'Issue unit']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Conversion', 'Conversion') }}
                                        {{ Form::text('Conversion', null, ['class' => 'form-control', 'placeholder' => 'Conversion', 'required' => '']) }}
                                    </div>
                                </div>

                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('pvc_weight', 'PVC weight') }}
                                        {{ Form::text('pvc_weight', null, ['class' => 'form-control', 'placeholder' => 'PVC weight', 'required' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('nylon_weight', 'Nylon weight') }}
                                        {{ Form::text('nylon_weight', null, ['class' => 'form-control', 'placeholder' => 'Nylon weight', 'required' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('pe_weight', 'PE weight') }}
                                        {{ Form::text('pe_weight', null, ['class' => 'form-control', 'placeholder' => 'PE weight', 'required' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('xlpe_weight', 'XLPE weight') }}
                                        {{ Form::text('xlpe_weight', null, ['class' => 'form-control', 'placeholder' => 'XLPE weight', 'required' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('semicon_weight', 'Semicon weight') }}
                                        {{ Form::text('semicon_weight', null, ['class' => 'form-control', 'placeholder' => 'Semicon weight', 'required' => '']) }}
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-block">Save</button>
                            {!! Form::close() !!}
                        </div>

                        
                        {{-- <div class="col-md-6">
                            <h3>Stock location</h3>
                            <hr>
                            
                            <div class="form-group">
                                <label for="loc">Location</label>
                                <select name="loc" id="loc" class="form-control" required>
                                    <option value="">--Select location--</option>
                                    <option value="">FG Local</option>
                                    <option value="">WIP</option>
                                    <option value="">WIP on Hold</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.21/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('table').dataTable();
    });
</script>
@endsection