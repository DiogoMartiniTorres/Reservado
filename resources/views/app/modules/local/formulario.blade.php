@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados do Local
                        <a href="{{ route('local.index') }}" class="btn btn-success btn-sm float-end">
                            Listar Locais
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
                        @if(Route::is('local.show'))
                            {!! Form::model($local,['method'=>'PATCH','url' => route('local.update',$local->id)]) !!}

                        @else
                        {!! Form::open(['method'=>'POST','url' => route('local.store')]) !!}

                        @endif
                        {!! Form::label('nome','Nome') !!}
                            {!! Form::input('text','nome',null,['class'=>'form-control mb-3','placeholder'=>'Nome','required','maxlenght'=>50,'autofocus']) !!}
                            {!! Form::label('endereco','Endereço') !!}
                            {!! Form::input('text','endereco',null,['class'=>'form-control','placeholder'=>'Endereço','required','maxlenght'=>150,'autofocus']) !!}
                            {!! Form::submit('Salvar',['class' => 'float-end btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
