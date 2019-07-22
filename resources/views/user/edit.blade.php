@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Editar usuario</div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <form action="{{ action('UserController@update', $user) }}" method="post">
            @method('PUT')
            @csrf

            <div class="form-group row">
              <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
              <input type="text" class="form-control col-md-6" id="nombre" name="nombre" value="{{ $user->name }}">
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
              <input type="email" class="form-control col-md-6" id="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="form-group row">
              <label for="role" class="col-md-4 col-form-label text-md-right">Rol</label>
              <select class="form-control col-md-6" id="role" name="role">
                @php
                  $firstRole = ($user->roles->isNotEmpty()) ? $user->roles->first()->id : 0;
                @endphp
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $role->id == $firstRole ? "selected" : null }}>{{ $role->description }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    @fa('save') Guardar
                  </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
