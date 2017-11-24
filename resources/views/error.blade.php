@extends('layouts.app')

@section('content')

<div class="row">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Error</div>

            <div class="panel-body">
                <h1>There was an error, please try again!</h1>

                {{--  {{ dd(Auth::user()->role) }}  --}}
            </div>
        </div>
    </div>
</div>
    
@endsection