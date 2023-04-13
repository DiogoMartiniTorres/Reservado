@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista dos Locais
                        <a href="{{ route('local.create') }}" class="btn btn-success btn-sm float-end">
                            Novo Local
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
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($locais as $local)
                                    <tr>
                                        <td> {{ $local->id }}</td>
                                        <td>{{ $local->nome }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('local.show', $local->id) }}"
                                                class="btn btn-primary btn-sm mx-1">
                                                Editar
                                            </a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => route('local.destroy', $local->id),
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
                            {{ $locais->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
