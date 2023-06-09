@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Tipos
                        <a href="{{ route('create.tipo') }}" class="btn btn-success btn-sm float-end">
                            Novo Tipo
                        </a>
                    </div>
                    <div class="card-body">
                        @if (Session::has('menssagem_sucesso'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('menssagem_sucesso') }}
                            </div>
                        @endif
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Titulo</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tipos as $tipo)
                                    <tr>
                                        <td> {{ $tipo->id }}</td>
                                        <td>{{ $tipo->titulo }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('editar.tipo', $tipo->id) }}"
                                                class="btn btn-primary btn-sm mx-1">
                                                Editar
                                            </a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => route('deletar.tipo', $tipo->id),
                                                'style' => 'display:inline',
                                            ]) !!}
                                            <button type="submit" class="btn btn-danger btn-sm mx-1">
                                                Excluir
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @empty

                                <tr><td colspan="3" >Nâo há itens para listar</td></tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $tipos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
