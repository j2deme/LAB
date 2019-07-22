<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data['roles'] = Role::all();
    return view('role.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('role.new');
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
      'description' => 'required|max:100'
    ]);

    # Sanitización
    # ...

    # Guardado de datos
    $role              = new Role(); # Se crea una instancia del modelo
    $role->description = $request->get('description');
    $role->save();

    return redirect()->action('RoleController@index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role)
  {
    return $role->toJson();
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role)
  {
    return view('role.edit', ['role' => $role]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role)
  {
    # Validación
    $request->validate([
      'description' => 'required|max:100'
    ]);

    # Sanitización
    # ...

    # Guardado de datos
    $role->description = $request->get('description');
    $role->save();

    return redirect()->action('RoleController@index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role)
  {
    $role->delete();
    return redirect()->action('RoleController@index');
  }
}
