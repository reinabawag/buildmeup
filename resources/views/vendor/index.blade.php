@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Vendor Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="{{ route('vendor.create') }}">Create vendor buildup</a>
                    <br><br>
                    <vendor-index :user="user" :vendors="vendors"></vendor-index>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const app = new Vue({
        el: '#app',
        data() {
            return {
                vendors: {!! $vendors !!},
                user: {!! Auth::user()->toJson() !!},
            }
        },
    });

    $(document).ready(function() {
        $('table').DataTable();
    });
</script>
@endsection