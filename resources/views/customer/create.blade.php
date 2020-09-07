@extends('layouts.app')

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

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form action="{{ route('customer.store') }}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="">Bill to</h3>
                                <hr>

                                <div class="form-group">
                                    <label for="code" class="control-label col-sm-2">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="code" id="code" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="control-label col-sm-2">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                                            placeholder="Customer name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addr1" class="control-label col-sm-2">Address[1]</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="addr1" id="addr1" value="{{ old('addr1') }}"
                                            placeholder="Address 1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addr2" class="control-label col-sm-2">Address[2]</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="addr2" id="addr2" value="{{ old('addr2') }}"
                                            placeholder="Address 2">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addr3" class="control-label col-sm-2">Address[3]</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="addr3" id="addr3" value="{{ old('addr3') }}"
                                            placeholder="Address 3">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="addr4" class="control-label col-sm-2">Address[4]</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="addr4" id="addr4" value="{{ old('addr4') }}"
                                            placeholder="Address 4 or tradename">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="control-label col-sm-2">City</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}"
                                            placeholder="City">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="zip" class="control-label col-sm-2">Zip</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="zip" id="zip" value="{{ old('zip') }}"
                                            placeholder="Zip">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="region" class="control-label col-sm-2">Region</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="region" id="region" value="{{ old('region') }}"
                                            placeholder="Region">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="industry" class="control-label col-sm-2">Industry</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="industry" id="industry" value="{{ old('industry') }}"
                                            placeholder="Industry">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="slsman" class="control-label col-sm-2">Salesman</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="slsman" id="slsman" value="{{ old('slsman') }}"
                                            placeholder="Sales person">
                                    </div>
                                </div>

                                <h3 class="">Credit</h3>
                                <hr>

                                <div class="form-group">
                                    <label for="terms" class="control-label col-sm-2">Terms</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="terms" id="terms" value="{{ old('terms') }}"
                                            placeholder="Terms">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <b>Allowable over due</b>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="overdue_days" class="control-label col-sm-2">Days</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="overdue_days" id="overdue_days"
                                            value="{{ old('overdue_days') }}" placeholder="Allowable over due days">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="overdue_amt" class="control-label col-sm-2">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="overdue_amt" id="overdue_amt"
                                            value="{{ old('overdue_amt') }}" placeholder="Allowable overdue amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <b>Allowable terms</b>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="terms_days" class="control-label col-sm-2">Days</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="terms_days" id="terms_days"
                                            value="{{ old('terms_days') }}" placeholder="Allowable terms days">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="">Contacts</h3>
                                <hr>

                                <div class="form-group">
                                    <label for="order_contact" class="control-label col-sm-2">Order contact</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="order_contact" id="order_contact"
                                            value="{{ old('order_contact') }}" placeholder="Order contact">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact_phone" class="control-label col-sm-2">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                                            value="{{ old('contact_phone') }}" placeholder="Order contact phone number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fax" class="control-label col-sm-2">Fax</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="fax" id="fax" value="{{ old('fax') }}"
                                            placeholder="Fax number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="billing_contact" class="control-label col-sm-2">Billing contact</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="billing_contact" id="billing_contact"
                                            value="{{ old('billing_contact') }}" placeholder="Billing contact">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="billing_phone" class="control-label col-sm-2">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="billing_phone" id="billing_phone"
                                            value="{{ old('billing_phone') }}" placeholder="Billing contact phone number">
                                    </div>
                                </div>

                                <h3 class="">Codes</h3>
                                <hr>

                                <div class="form-group">
                                    <label for="vat_code" class="control-label col-sm-2">Vat code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="vat_code" id="vat_code" value="{{ old('vat_code') }}"
                                            placeholder="Value added tax code">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ewt_code" class="control-label col-sm-2">Ewt code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ewt_code" id="ewt_code" value="{{ old('ewt_code') }}"
                                            placeholder="Expanded witholding tax">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tin_code" class="control-label col-sm-2">Tin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tin_code" id="tin_code" value="{{ old('tin_code') }}"
                                            placeholder="Tax indentification number">
                                    </div>
                                </div>

                                <h3>Remarks</h3>
                                <hr>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <textarea class="form-control" name="remarks" id="" cols="30" rows="10" value="{{ old('remarks') }}"
                                            placeholder="Enter remarks here"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="status" class="control-label col-sm-2">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="status" class="form-control">
                                            <option value="draft">Draft</option>
                                            <option value="final">Final</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>
                                        Create</button>

                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection