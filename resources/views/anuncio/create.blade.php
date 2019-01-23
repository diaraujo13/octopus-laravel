@extends('layouts.app')
@section('title', 'Novo anuncio')
@section('content')
<header class="page-header">
<h2>Anuncio</h2>
<div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
        <li>
            <a href="index.html">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li><span>Anuncio</span></li>
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
            <form id="vue_app" class="form form-horizontal form-bordered" name="form" action="{{ route('anuncio.store') }}"" method="POST" novalidate>
                {!! csrf_field() !!}
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Título</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Title')}}"name="Title"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Valor atual do imóvel</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Valor')}}"name="Valor"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Valor antigo</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Antigo_valor')}}"name="Antigo_valor"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label" for="ativo">Está ativo?</label>
                <div class="col-md-6">
                    <input type="checkbox" value="{{old('Ativo')}}" class="switch" >
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <<label class="col-md-3 control-label">Anúncio válido até</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" name="Validade" value="{{old('Validade')}}" data-plugin-datepicker="" class="form-control">
                    </div>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">E-mail contato</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Email')}}"name="Email"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Telefone contato</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Telefone')}}"name="Telefone"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Telefone secundário</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Sectel')}}"name="Sectel"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label" for="featured">Anúncio promovido?</label>
                <div class="col-md-6">
                    <input type="checkbox" value="{{old('Featured')}}" class="switch" >
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Categoria</label>
                <div class="col-md-6">
                <!-- Será carregador via Ajax -->
                <!-- ou usar Laravel ::all -->
                <div v-if="isLoadingCat_anuncio" class="loading">Carregando...</div>
                    <select name='{{Cat_anuncioId}}' v-if="!isLoadingCat_anuncio" data-plugin-selectTwo class="form-control populate">
                        <optgroup label="--">
                            <option v-for="item in Cat_anuncios.data" v-bind:value="item.Name">@{}</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Imovel</label>
                <div class="col-md-6">
                <!-- Será carregador via Ajax -->
                <!-- ou usar Laravel ::all -->
                <div v-if="isLoadingImovel" class="loading">Carregando...</div>
                    <select name='{{ImovelId}}' v-if="!isLoadingImovel" data-plugin-selectTwo class="form-control populate">
                        <optgroup label="--">
                            <option v-for="item in Imovels.data" v-bind:value="item.Name">@{}</option>
                        </optgroup>
                    </select>
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
                selectedCat_anuncio: 0,
                isLoadingCat_anuncio: false,
                Cat_anuncios: [],
                selectedImovel: 0,
                isLoadingImovel: false,
                Imovels: [],
            },
            methods: {
                onChangeCat_anuncio_id: async () => {
                    app.isLoadingCat_anuncio = true;
                    fetch('/api/Cat_anuncio/')
                        .then(raw => raw.json())
                        .then(response => {
                            console.log(response);
                            app.Cat_anuncios = response;
                        })
                        .catch(err => console.err(err))
                        .finally(() => app.isLoadingCat_anuncio = false);
                },
                onChangeImovel_id: async () => {
                    app.isLoadingImovel = true;
                    fetch('/api/Imovel/')
                        .then(raw => raw.json())
                        .then(response => {
                            console.log(response);
                            app.Imovels = response;
                        })
                        .catch(err => console.err(err))
                        .finally(() => app.isLoadingImovel = false);
                },
            },
             beforeMount(){
                    this.onChangeCat_anuncio_id(),
                    this.onChangeImovel_id(),
            },
        });
</script>
@endsection
