<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data['items'] = Item::all();
    return view('item.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('item.new');
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
      'name'        => 'required|max:100',
      'description' => 'max:150',
      'stock'       => 'numeric|min:10'
    ]);

    # Sanitización
    # ...

    # Guardado de datos
    $item              = new Item();
    $item->name        = $request->get('name');
    $item->description = $request->get('description');
    $item->stock       = $request->get('stock');
    $item->save();

    return redirect()->action('ItemController@index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Item  $item
   * @return \Illuminate\Http\Response
   */
  public function show(Item $item)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Item  $item
   * @return \Illuminate\Http\Response
   */
  public function edit(Item $item)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Item  $item
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Item $item)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Item  $item
   * @return \Illuminate\Http\Response
   */
  public function destroy(Item $item)
  {
    //
  }

  /**
   * Muestra de forma gráfica el stock
   *
   * @return \Illuminate\Http\Response
   */
  public function graph()
  {
    $data['items'] = Item::all();
    //dd($data['items']->pluck('name')->toJson());
    return view('item.graph', $data);
  }

  public function stock($id, $action)
  {
    $item = Item::find($id);
    $stock = $item->stock;
    if ($action == 'add') {
      $item->stock = $stock + 1;
    } else {
      if ($stock > 0) {
        $item->stock = $stock - 1;
      }
    }
    $item->save();

    return redirect()->action('ItemController@index');
  }
}
