@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <a href="{{ action('ItemController@create') }}" class="btn btn-primary">
        @fa('plus') Nuevo item
      </a>
      <a href="{{ action('ItemController@graph') }}" class="btn btn-success">
        @fa('chart-bar') Graficar stock
      </a>
      <div class="card">
        <div class="card-header">Gestor de inventario</div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          {{-- Tabla de items --}}
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>@fa('cog')</i></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->stock }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ action('ItemController@show', $item) }}" class="btn btn-secondary">
                      @fa('eye')
                    </a>
                    <a href="{{ action('ItemController@edit', $item) }}" class="btn btn-secondary">
                      @fa('edit')
                    </a>
                    <form class="btn-group" action="{{ action('ItemController@destroy', $item) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button class="btn btn-danger confirm">
                        @fa('trash')
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center">Añade items</td>
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
