<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class TiposController extends Controller
{


   public function listar()
   {
        // $tipos =  Tipo::all();
        $tipos =  Tipo::paginate(25);

        return view('app.modules.tipo.lista',compact('tipos'));
        // return view('tipo',['tipos' => $tipos]);
   }


   public function deletar(Request $request,$tipo_id)
   {
        $tipo = Tipo::findOrFail($tipo_id);
        $tipo->delete();
        // $request->session()->flash('menssagem_sucesso','Tipo removido com sucesso');
        return Redirect::to('tipo')->with('menssagem_sucesso','Tipo removido com sucesso');
   }

   public function create()
   {
        return view('app.modules.tipo.formulario');
   }

   public function store(Request $request){
        $tipo = new Tipo();
        $tipo->fill($request->all());

        if($tipo->save()){

            return Redirect::route('create.tipo')->with('menssagem_sucesso','Tipo criado com sucesso');
        }else{
            return Redirect::route('create.tipo')->with('menssagem_erro','Ocorreu um erro ao criar o Tipo');

            //Retorna os valores nos inputs
            // return Redirect::route('create.tipo')->withInput(['titulo' => $request->titulo, 'icone' => $request->icone])->with('menssagem_erro','Ocorreu um erro ao criar o Tipo');

        }

    }

    public function show($id)
    {

        $tipo = Tipo::FindOrFail($id);

        return view('app.modules.tipo.formulario',compact('tipo'));

    }

    public function update(Request $request,$id){
        $tipo = Tipo::FindOrFail($id);
        $tipo->fill($request->all());

        if($tipo->save()){

            return Redirect::route('editar.tipo',$id)->with('menssagem_sucesso','Tipo alterado com sucesso');
        }else{
            return Redirect::route('editar.tipo',$id)->with('menssagem_erro','Ocorreu um erro ao criar o Tipo');

            //Retorna os valores nos inputs
            // return Redirect::route('create.tipo')->withInput(['titulo' => $request->titulo, 'icone' => $request->icone])->with('menssagem_erro','Ocorreu um erro ao criar o Tipo');

        }

    }

}