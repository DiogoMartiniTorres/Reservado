<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::paginate(25);

        return view('app.modules.clientes.lista',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('app.modules.clientes.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Clientes();
        $cliente->fill($request->all());

        if($cliente->save()){
            return Redirect::route('clientes.index')->with('menssagem_sucesso','Cliente criado com sucesso');
        }else{
            return Redirect::route('clientes.index')->with('menssagem_erro','Ocorreu um erro ao criar o Cliente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $cliente)
    {

        $cliente = Clientes::findOrFail($cliente->id);

        return view('app.modules.clientes.formulario',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientes $cliente)
    {
        $cliente = Clientes::findOrFail($cliente);

        return view('app.modules.clientes.formulario',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $cliente)
    {

        $cliente = Clientes::findOrFail($cliente->id);
        $cliente->fill($request->all());

        if($cliente->save()){
            return Redirect::route('clientes.index')->with('menssagem_sucesso','Cliente alterado com sucesso');
        }else{
            return Redirect::route('clientes.index')->with('menssagem_erro','Ocorreu um erro ao alterar o Cliente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $cliente)
    {

        $cliente->delete();

        return Redirect::to('clientes')->with('menssagem_sucesso','Clientes removido com sucesso');
    }
}