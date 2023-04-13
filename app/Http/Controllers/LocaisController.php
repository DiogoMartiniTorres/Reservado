<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $locais = Local::paginate(25);

        return view('app.modules.local.lista',compact('locais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.modules.local.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $local = new Local();
        $local->fill($request->all());

        if($local->save()){
            return Redirect::route('local.index')->with('menssagem_sucesso','Local criado com sucesso');
        }else{
            return Redirect::route('local.index')->with('menssagem_erro','Ocorreu um erro ao criar o Local');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        return view('app.modules.local.formulario',compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local)
    {
        return view('app.modules.local.formulario',compact('local'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local)
    {

        $local->fill($request->all());

        if($local->save()){
            return Redirect::route('local.edit',$local)->with('menssagem_sucesso','Local alterado com sucesso');
        }else{
            return Redirect::route('local.edit',$local)->with('menssagem_erro','Ocorreu um erro ao alterar o Local');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        $local->delete();
        return Redirect::to('local')->with('menssagem_sucesso','Local removido com sucesso');
    }
}