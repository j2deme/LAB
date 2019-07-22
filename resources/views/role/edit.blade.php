@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Editar rol</div>
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
          <form action="{{ action('RoleController@update', $role) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group row" >
              <label for="description" class="col-md-4 col-form-label text-md-right">Nombre</label>
              <input type="text" class="form-control col-md-6" id="description" name="description" value="{{ $role->description }}">
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
