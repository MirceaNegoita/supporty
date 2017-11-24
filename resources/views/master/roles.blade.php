@extends('layouts.app')

@section('content')

<div class="row">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Roles</div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#editRole">Edit</button></td>
                                <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteRole">Danger</button></td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-success bootstra-modal-form-open" data-toggle="modal" data-target="#addRole">Add Role</button>
            </div>
        </div>
    </div>
</div>

@component('components.modal')

@slot('modal_id')
    addRole
@endslot

@slot('modal_title')
    Add Role
@endslot

@slot('modal_body')
     <form class="form-horizontal bootstrap-modal-form" method="POST" action="">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Add Category
                </button>
            </div>
        </div>
    </form>
@endslot
    
@endcomponent

@component('components.modal')
    
@slot('modal_id')
    editRole
@endslot

@slot('modal_title')
    Edit Role
@endslot

@slot('modal_body')
    <form action="" class="form form-horizontal bootstrap-modal-form" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PATCH">
        <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" value="{{ old('name') }}" required autofocus>

                @if($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button class="btn btn-primary" type="submit">
                    Edit Role
                </button>
            </div>
        </div>
    </form>
@endslot

@endcomponent

@component('components.modal')

@slot('modal_id')
    deleteRole
@endslot

@slot('modal_title')
    Delete Role
@endslot

@slot('modal_body')
    <form action="" method="post">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">

        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
@endslot
    
@endcomponent

@endsection