<?php

namespace App\Http\Controllers;

use App\Models\Equipamentos;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipamentos = Equipamentos::with('tipo')->paginate(25);

        return view('app.modules.equipamento.lista',compact('equipamentos'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $tipos = Tipo::select('titulo','id')->pluck('titulo','id');

        return view('app.modules.equipamento.formulario',compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $equipamento = new Equipamento();
        $equipamento->fill($request->all());

        if($equipamento->save()){
            return Redirect::route('equipamento.index')->with('menssagem_sucesso','Equipamento criado com sucesso');
        }else{
            return Redirect::route('equipamento.index')->with('menssagem_erro','Ocorreu um erro ao criar o Equipamento');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipamento $equipamento)
    {
        $equipamento = Equipamentos::findOrFail($equipamento->id);
        $tipos = Tipo::select('titulo','id')->pluck('titulo','id');

           return view('app.modules.equipamento.formulario',
           compact('equipamento','tipos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipamento $equipamento)
    {
        $equipamento = Equipamentos::findOrFail($equipamento->id);
        $tipos = Tipo::select('titulo','id')->pluck('titulo','id');

        return view('app.modules.equipamento.formulario',compact('equipamento','tipos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipamento $equipamento)
    {

        $equipamento = Equipamentos::findOrFail($equipamento->id);
        $equipamento->fill($request->all());

        if($equipamento->save()){
            return Redirect::route('equipamento.index')->with('menssagem_sucesso','equipamento alterado com sucesso');
        }else{
            return Redirect::route('equipamento.index')->with('menssagem_erro','Ocorreu um erro ao alterar o Equipamento');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipamento $equipamento)
    {
        
        $equipamento->delete();

        return Redirect::to('equipamento')->with('menssagem_sucesso','equipamento removido com sucesso');
    }
}