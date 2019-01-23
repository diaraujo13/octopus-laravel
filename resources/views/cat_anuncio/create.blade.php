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
        <li><span>Novo</span></li>
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
            <form id="vue_app" class="form form-horizontal form-bordered" name="form" action="{{ route('cat_anuncio.store') }}"" method="POST" novalidate>
                {!! csrf_field() !!}
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Nome</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Nome')}}"name="Nome"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Cor do rótulo</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Cor')}}"name="Cor"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
        <td>
        </form>
    </div>
    <footer class="panel-footer">
        <button class="btn btn-primary">Salvar </button>
        <button type="reset" class="btn btn-default">Limpar</button>
    </footer>
        </section>
    </div>
</div>
<script>
var app = new Vue({
            el: '#vue_app',
            data: {
            },
            methods: {
            },
             beforeMount(){
            },
        });
</script>
@endsection
