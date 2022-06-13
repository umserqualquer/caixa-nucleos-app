@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-2">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- <example-component></example-component> --}}
                    {{-- <invoice-list-component></invoice-list-component> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
