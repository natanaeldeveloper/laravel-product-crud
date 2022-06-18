@extends('layouts.app')

@section('styles')

<style>
    .center {
        text-align: center;
    }
</style>

@endsection

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1" style="display: flex;justify-content: flex-end;">
        <a href="{{ route('product.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Produto</a>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                LISTA DE PRODUTOS
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="tabelaProdutos">
                    <thead>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th class="center">Opções</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr data-id="{{ $product->id }}">
                            <td>{{ $product->nome }}</td>
                            <td>{{ $product->categoria->nome }}</td>
                            <td class="center col-md-3">
                                <div class="btn-group btn-group-xs">
                                    <button onclick="excluirProduto({{ $product->id }})" class="btn btn-danger btn-remove" style="margin-right: 3px;"><i class="fa fa-trash" aria-hidden="true"></i> Remover</button>
                                    <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>

        function excluirProduto(productId) {
            if(confirm('Deseja mesmo remover este produto? \n\n *Esta ação excluirá os dados do produto permanentemente')) {
                let xhr = $.ajax({
                    url: `/products/${productId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                xhr.done(function (data) {
                    const response = typeof data == 'string' ? JSON.parse(data) : data

                    if(response.error) {
                        alert(response.msg)
                    } else {
                        alert(response.msg)
                        $(`#tabelaProdutos tbody tr[data-id="${productId}"]`).remove()
                    }
                })
            }
        }
    </script>
@endsection
