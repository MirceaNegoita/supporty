@extends('layouts.app')

@section('title', 'Open Ticket')
    
@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Open New Ticket</div>

            <div class="panel-body">
                @include('includes.flash')

                <form action="{{ url('/new_ticket') }}" method="POST" class="form-horizontal" role="form">

                    <div class="form-group{{ $errors->hast('title') ? 'has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input type="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                            @if($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('category') ? 'has-error' : '' }}">
                        <label for="category" class="col-md-4 control-label">Category</label>

                        <div class="col-md-6">
                            <select name="category" id="category" type="category" class="form-control">
                                <option value="" disabled selected>Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('priority') ? 'has-error' : '' }}">
                        <label for="priority" class="col-md-4 control-label">Priority</label>

                        <div class="col-md-6">
                            <select name="priority" id="priority" type="" class="form-control">
                                <option value="" disabled selected>Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>

                            @if($errors->has('priority'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('message') ? 'has-error' : '' }}">
                        <label for="message" class="col-md-3 control-label">Message</label>

                        <div class="col-md-6">
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>

                            @if($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-ticket"></i>Open Ticket
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection