@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <a href="{{ action('UserController@create') }}" class="btn btn-primary">
        @fa('user-plus') Nuevo usuario
      </a>
      <div class="card">
        <div class="card-header">Gestor de usuarios</div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          {{-- Tabla de usuarios --}}
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>@fa('cog')</i></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                  @if (count($user->roles) == 0)
                  &mdash;
                  @else
                  {{ $user->roles->pluck('description')->implode(', ') }}
                  @endif
                </td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ action('UserController@show', $user) }}" class="btn btn-secondary">
                      @fa('eye')
                    </a>
                    @if (
                    (Auth::user()->id == $user->id or
                    Auth::user()->hasRole("Administrador")) and
                    !Auth::user()->hasRole('Visor')
                    )
                {{-- (((id == id) or (Admin?)) and (!visor)) --}}
                    <a href="{{ action('UserController@edit', $user) }}" class="btn btn-secondary">
                      @fa('edit')
                    </a>
                    @endif
                    @if (Auth::user()->id != $user->id and Auth::user()->hasRole("Administrador"))
                    <form class="btn-group" action="{{ action('UserController@destroy', $user) }}" method="POST">
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
