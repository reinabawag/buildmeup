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
                        {{ Form::model($item) }}
                        <div class="col-md-6">
                            <h3>Item buildup</h3>
                            <hr>

                            <div class="form-group">
                                {{ Form::label('item', 'Item Code') }}
                                {{ Form::text('item', $item->item, array('class' => 'form-control', 'placeholder' => 'Item code', 'required' => '', 'readonly' => '')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('description', 'Item Description') }}
                                {{ Form::text('description', $item->description, array('class' => 'form-control', 'placeholder' => 'Item description', 'required' => '', 'readonly' => '')) }}
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" name="stocked" {{ $item->stocked ? 'checked' : '' }} disabled>Stocked</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" name="lot_tracked" {{ $item->lot_tracked ? 'checked' : '' }} disabled>Lot Tracked</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" name="reservable" {{ $item->reservable ? 'checked' : '' }} disabled>Reservable</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('type', 'Item Type') }}
                                        <input type="text" class="form-control" value="{{ $item->type }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('source', 'Source') }}
                                        <input type="text" class="form-control" value="{{ $item->source }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('cost_type', 'Cost Type') }}
                                        <input type="text" class="form-control" value="{{ $item->cost_type }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('cost_method', 'Cost Method') }}
                                        <input type="text" class="form-control" value="{{ $item->cost_method }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('abc_code', 'ABC Code') }}
                                        <input type="text" class="form-control" value="{{ $item->abc_code }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('family_code', 'Family code') }}
                                        <input type="text" class="form-control" value="{{ $item->family_code }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('product_code', 'Product Code') }}
                                        <input type="text" class="form-control" value="{{ $item->product_code }}" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('unit_measure', 'Unit Measure') }}
                                        <input type="text" class="form-control" value="{{ $item->unit_measure }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('unit_weight', 'Unit Weight') }}
                                        <input type="text" class="form-control" value="{{ $item->unit_weight }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('purchase_unit', 'Purchase Unit') }}
                                        <input type="text" class="form-control" value="{{ $item->purchase_unit }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('stock_unit', 'Stock Unit') }}
                                        <input type="text" class="form-control" value="{{ $item->stock_unit }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('issue_unit', 'Issue Unit') }}
                                        <input type="text" class="form-control" value="{{ $item->issue_unit }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Conversion', 'Conversion') }}
                                        <input type="text" class="form-control" value="{{ $item->conversion }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('pvc_weight', 'PVC weight') }}
                                        {{ Form::text('pvc_weight', null, ['class' => 'form-control', 'placeholder' => 'PVC weight', 'readonly' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('nylon_weight', 'Nylon weight') }}
                                        {{ Form::text('nylon_weight', null, ['class' => 'form-control', 'placeholder' => 'Nylon weight', 'readonly' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('pe_weight', 'PE weight') }}
                                        {{ Form::text('pe_weight', null, ['class' => 'form-control', 'placeholder' => 'PE weight', 'readonly' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('xlpe_weight', 'XLPE weight') }}
                                        {{ Form::text('xlpe_weight', null, ['class' => 'form-control', 'placeholder' => 'XLPE weight', 'readonly' => '']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('semicon_weight', 'Semicon weight') }}
                                        {{ Form::text('semicon_weight', null, ['class' => 'form-control', 'placeholder' => 'Semicon weight', 'readonly' => '']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}



                        <div class="col-md-6">
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
                        </div>
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