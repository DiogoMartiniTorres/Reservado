@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Tipo
                        <a href="{{ route('listar.tipos') }}" class="btn btn-success btn-sm float-end">
                            Listar Tipos
                        </a> </div>
                    <div class="card-body">
                        @if (Session::has('menssagem_sucesso'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('menssagem_sucesso') }}
                            </div>
                        @endif
                        @if (Session::has('menssagem_erro'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('menssagem_erro') }}
                            </div>
                        @endif
                        @if(Route::is('editar.tipo'))
                        {!! Form::model($tipo,['method'=>'PATCH','url' => route('editar.tipo',$tipo->id)]) !!}

                        @else
                        {!! Form::open(['method'=>'POST','url' => route('store.tipo')]) !!}

                        @endif
                        {!! Form::label('titulo','Titulo') !!}
                            {!! Form::input('text','titulo',null,['class'=>'form-control mb-3','placeholder'=>'Titulo','required','maxlenght'=>50,'autofocus']) !!}
                            {!! Form::label('icone','Icone') !!}
                            {!! Form::input('text','icone',null,['class'=>'form-control','placeholder'=>'Icone','required','maxlenght'=>150,'autofocus']) !!}
                            {!! Form::submit('Salvar',['class' => 'float-end btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
