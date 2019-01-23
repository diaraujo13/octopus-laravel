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
                 name="form" action="{{ route('anuncio.update', $item->id) }}" 
                 method="POST" novalidate>
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Título</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Title" value="{{ $item->Title }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Valor atual do imóvel</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Valor" value="{{ $item->Valor }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Valor antigo</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Antigo_valor" value="{{ $item->Antigo_valor }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="ativo">Está ativo?</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="checkbox" class="switch" >
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Anúncio válido até</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" class="form-control" name="Validade" value="{{ $item->Validade }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">E-mail contato</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Email" value="{{ $item->Email }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Telefone contato</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Telefone" value="{{ $item->Telefone }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Telefone secundário</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Sectel" value="{{ $item->Sectel }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="featured">Anúncio promovido?</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="checkbox" class="switch" >
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Categoria</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- Será carregador via Ajax -->
                    <div v-if="isLoadingCat_anuncio" class="loading">Carregando...</div>
                        <select name='city' v-if="!isLoadingCat_anuncio" class="form-control">
                            <optgroup label="--">
                                <option v-for="item in Cat_anuncios.data" v-bind:value="item.id">@{{item.Name}}</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Imovel</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- Será carregador via Ajax -->
                    <div v-if="isLoadingImovel" class="loading">Carregando...</div>
                        <select name='city' v-if="!isLoadingImovel" class="form-control">
                            <optgroup label="--">
                                <option v-for="item in Imovels.data" v-bind:value="item.id">@{{item.Name}}</option>
                            </optgroup>
                        </select>
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
                    selectedCat_anuncio: 0,
                    isLoadingCat_anuncio: false,
                    Cat_anuncios: [],
                    selectedImovel: 0,
                    isLoadingImovel: false,
                    Imovels: [],
                },
                methods: {
                    onChangeCat_anuncio_id: async () => {
                        this.isLoadingCat_anuncio = true;
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
                        this.isLoadingImovel = true;
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