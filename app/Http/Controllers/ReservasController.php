<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Local;
use App\Models\Reservas;
use App\Models\Equipamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $reservas = Reservas::with('equipamento')->with('local')->with('cliente')->paginate(25);


        return view('app.modules.reservas.lista',compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Clientes::select('nome','id')->pluck('nome','id');
        $equipamentos = Equipamentos::select('nome','id')->pluck('nome','id');
        $locais = Local::select('nome','id')->pluck('nome','id');

        return view('app.modules.reservas.formulario',compact('clientes','equipamentos','locais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Reservas $reservas)
    {
        $reservas = new Reservas();
        $reservas->fill($request->all());

        if($reservas->save()){
            return Redirect::route('reservas.index')->with('menssagem_sucesso','Reservas criado com sucesso');
        }else{
            return Redirect::route('reservas.index')->with('menssagem_erro','Ocorreu um erro ao criar o Reservas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($reservas)
    {

        $reserva = Reservas::findOrFail($reservas);

        $clientes = Clientes::select('nome','id')->pluck('nome','id');
        $equipamentos = Equipamentos::select('nome','id')->pluck('nome','id');
        $locais = Local::select('nome','id')->pluck('nome','id');

        return view('app.modules.reservas.formulario',
        compact('reserva','clientes','equipamentos','locais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($reservas)
    {
        $reserva = Reservas::findOrFail($reservas);

        $clientes = Clientes::select('nome','id')->pluck('nome','id');
        $equipamentos = Equipamentos::select('nome','id')->pluck('nome','id');
        $locais = Local::select('nome','id')->pluck('nome','id');

        return view('app.modules.reservas.formulario',
        compact('reserva','clientes','equipamentos','locais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reservas = Reservas::findOrFail($id);
        $reservas->fill($request->all());

        if($reservas->save()){
            return Redirect::route('reservas.index')->with('menssagem_sucesso','Reserva alterado com sucesso');
        }else{
            return Redirect::route('reservas.index')->with('menssagem_erro','Ocorreu um erro ao alterar a Reserva');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($reservas)
    {

        $reservas = Reservas::findOrFail($reservas);

        $reservas->delete();

        if(!$reservas){

            return Redirect::to('reservas')->with('menssagem_erro','Erro ao remover a Reserva');
        }else{
            return Redirect::to('reservas')->with('menssagem_sucesso','Reserva removida com sucesso');
        }
    }

    public function devolucao($id){
        $date = Carbon::now();

        $reserva = Reservas::findOrFail($id);

        $reserva->devolucao = $date;
        $reserva->save();

        if($reserva){
            return Redirect::to('reservas')->with('menssagem_erro','Erro ao devolver a Reserva');
        }else{
            return Redirect::to('reservas')->with('menssagem_sucesso','Reserva devolvida com sucesso');
        }
    }
}