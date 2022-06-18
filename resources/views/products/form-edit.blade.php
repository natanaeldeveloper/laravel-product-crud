@extends('layouts.app')

@section('styles')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                FORMULÁRIO DE EDIÇÃO DE PRODUTO
            </div>
            <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST">
                <div class="panel-body">

                    {{ method_field('PUT') }}

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="campoNome">Nome: </label>
                                <input type="text" class="form-control" name="nome" placeholder="Nome" id="campoNome" value="{{ old('nome') ? old('nome') : $product->nome }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="campoCategoria">Categoria: </label>
                                <select name="id_categoria" id="campoCategoria" class="form-control" value="{{ old('id_categoria') ? old('id_categoria') : $product->id_categoria }}">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nome }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="campoDescricao">Descrição: </label>
                                <input type="text" class="form-control" name="descricao" placeholder="Nome" id="campoDescricao" value="{{ old('descricao') ? old('descricao') : $product->descricao }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer" style="display: flex;justify-content: flex-end;">
                    <a href="{{ route('product.index') }}" class="btn btn-default" style="margin-right: 5px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection
