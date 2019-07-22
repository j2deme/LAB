@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Inicio</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          Bienvenido {{ Auth::user()->name }}
          <div class="container">
            <div class="row">
              @if (Auth::user()->hasRole(['Administrador','Básico','Visor']))
              <a href="{{ action('UserController@index') }}"
                class="dashboard-card card border-0 bg-primary shadow-lg col-md-5 mx-auto">
                <div class="card-body d-flex align-items-end flex-column text-right">
                  <h4>Usuarios</h4>
                  <p class="w-75"></p>
                  @fa('users')
                </div>
              </a>
              @endif
              @if (Auth::user()->hasRole('Administrador'))
              <a href="{{ action('RoleController@index') }}"
                class="dashboard-card card border-0 bg-primary shadow-lg col-md-5 mx-auto">
                <div class="card-body d-flex align-items-end flex-column text-right">
                  <h4>Roles</h4>
                  <p class="w-75"></p>
                  @fa('id-badge')
                </div>
              </a>
              @endif
              <a href="{{ action('ItemController@index') }}"
                class="dashboard-card card border-0 bg-primary shadow-lg col-md-5 mx-auto">
                <div class="card-body d-flex align-items-end flex-column text-right">
                  <h4>Inventario</h4>
                  <p class="w-75"></p>
                  @fa('boxes')
                </div>
              </a>
            </div>
          </div>
          <!-- .container>.row>.col-md-10 -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<style>
  .border-0 {
    border: 0 !important;
  }

  .shadow-lg {
    box-shadow: 0 2rem 1.5rem -1.5rem rgba(33, 37, 41, .15), 0 0 1.5rem .5rem rgba(33, 37, 41, .05) !important;
  }

  a.dashboard-card {
    color: #fff;
    position: relative;
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    transition: .15s box-shadow ease, .15s transform ease;
    -moz-transition: .15s box-shadow ease, .15s transform ease;
  }

  a.dashboard-card:hover {
    text-decoration: none;
    transform: translateY(-0.25rem);
    box-shadow: 0 2.25rem 1.5rem -1.5rem rgba(33, 37, 41, .3), 0 0 1.5rem .5rem rgba(33, 37, 41, .05) !important;
  }

  .align-items-end {
    align-items: flex-end !important;
  }

  .flex-column {
    flex-direction: column !important;
  }

  .d-flex {
    display: flex !important;
  }

  .card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
  }

  a.dashboard-card .card-body p {
    color: rgba(255, 255, 255, .7);
    font-weight: 600;
  }

  .w-75 {
    width: 75% !important;
  }

  a.dashboard-card .card-body i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 4rem;
    left: 1rem;
    color: rgba(255, 255, 255, .2);
    transition: .15s all ease;
  }

  a.dashboard-card:hover .card-body i {
    left: 1.5rem;
    font-size: 3rem;
  }

</style>
@endsection
