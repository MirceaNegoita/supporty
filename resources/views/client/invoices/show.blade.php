@extends('layouts.app')

@section('title', $invoice->title)

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    #{{ $invoice->invoice_id }} - {{ $invoice->title }}
                </div>

                <div class="panel-body">
                    @include('includes.flash')

                    <div class="invoice-info">
                        <p>{{ $invoice->message }}</p>
                        <p>Month: {{ $invoice->month }}</p>
                        <p>
                        @if ($invoice->status === 'Open')
                            Status: <span class="label label-success">{{ $invoice->status }}</span>
                        @else
                            Status: <span class="label label-danger">{{ $invoice->status }}</span>
                        @endif
                        </p>
                        <p>Created on: {{ $invoice->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>

                    <div class="comments">
                        @foreach ($comments as $comment)
                            <div class="panel panel-@if($invoice->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                                <div class="panel panel-heading">
                                    {{ $comment->user->name }}
                                    <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                </div>

                                <div class="panel panel-body">
                                    {{ $comment->comment }}     
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="comment-form">
                        <form action="{{ url('/client/comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection