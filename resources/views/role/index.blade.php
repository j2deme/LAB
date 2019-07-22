@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <a href="{{ action('RoleController@create') }}" class="btn btn-primary">
        @fa('plus') Nuevo rol
      </a>
      <div class="card">
        <div class="card-header">Gestor de roles</div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          {{-- Tabla de roles --}}
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>@fa('cog')</i></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($roles as $role)
              <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->description }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ action('RoleController@show', $role) }}" class="btn btn-secondary">
                      @fa('eye')
                    </a>
                    <a href="{{ action('RoleController@edit', $role) }}" class="btn btn-secondary">
                      @fa('edit')
                    </a>
                    @if ($role->users->isEmpty())
                    <form class="btn-group" action="{{ action('RoleController@destroy', $role) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-danger confirm">
                        @fa('trash')
                      </button>
                    </form>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center">Añade usuarios</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <script>
  $('.confirm').click(function(e){
    e.preventDefault();
    if (confirm('Continuar?')) {
      $(e.target).closest('form').submit();
    }
  });
</script> --}}
@endsection
