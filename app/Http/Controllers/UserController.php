<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * Instantiate a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    #$this->middleware('role:Administrador');
    #$this->middleware('role:Básico')->except(['create','edit','delete']);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if(Auth::user()->hasRole(['Administrador','Básico','Visor'])){
      $data['users'] = User::all();
      return view('user.index', $data);
    } else {
      abort(404);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('user.new');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    # Validación
    $request->validate([
      'name'             => 'required|max:100',
      'email'            => 'required|email',
      'password'         => 'required',
      'password-confirm' => 'same:password'
    ]);

    # Sanitización
    # ...

    # Guardado de datos
    $user           = new User(); # Se crea una instancia del modelo
    $user->name     = $request->get('name');
    $user->email    = $request->get('email');
    $user->password = bcrypt($request->get('password'));
    $user->save();

    return redirect()->action('UserController@index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    return $user->toJson();
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $data['user']  = $user;
    $data['roles'] = Role::all()->sortBy('description');
    return view('user.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    # Validación
    $request->validate([
      'nombre' => 'required|max:100',
      'email'  => 'required|email',
    ]);

    # Sanitización
    # ...

    # Guardado de datos
    $user->name  = $request->get('nombre');
    $user->email = $request->get('email');
    # Revisa y guarda rol
    if($user->roles()->where('role_id', $request->get('role'))->exists()){
      # El rol existe, no debe insertarse nuevamente
      $user->roles()->detach($request->get('role'));
    } else {
      $user->roles()->attach($request->get('role'));
    }
    $user->save();

    return redirect()->action('UserController@index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->roles()->detach();
    $user->delete();
    return redirect()->action('UserController@index');
  }
}
