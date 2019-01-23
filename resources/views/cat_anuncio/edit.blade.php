@extends('layouts.app')
@section('title', 'Novo cat_anuncio')
@section('content')
<header class="page-header">
<h2>Cat_anuncio</h2>
<div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
        <li>
            <a href="index.html">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li><span>Cat_anuncio</span></li>
        <li><span>Editar</span></li>
    </ol>
    <a class="sidebar-right-toggle" ></a>
    </div>
</header>
<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>
            <h2 class="panel-title">Informação</h2>
        </header>
        <div class="panel-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
            @endif
            @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}"> 
                {!! session('message.content') !!}
            </div>
            @endif
                <form id="vue_app" class="form form-horizontal form-label-left"
                 name="form" action="{{ route('cat_anuncio.update', $item->id) }}" 
                 method="POST" novalidate>
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Nome" value="{{ $item->Nome }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Cor do rótulo</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Cor" value="{{ $item->Cor }}"  required>
                    </div>
                </div>
            </td>
            <td>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
    <footer class="panel-footer">
        <button class="btn btn-primary">Salvar </button>
        <button type="reset" class="btn btn-default">Limpar</button>
    </footer>
        </section>
    </div>
</div>
@endsection
@section ('scripts')
<script>
    var app = new Vue({
                el: '#app',
                data: {
                },
                methods: {
                },
                 beforeMount(){
                },
            });
    </script>
@endsection