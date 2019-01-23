@extends('layouts.app')
@section('title', 'Novo imovel')
@section('content')
<header class="page-header">
<h2>Imovel</h2>
<div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
        <li>
            <a href="index.html">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li><span>Imovel</span></li>
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
                 name="form" action="{{ route('imovel.update', $item->id) }}" 
                 method="POST" novalidate>
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Cidade</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- Será carregador via Ajax -->
                    <div v-if="isLoadingCity" class="loading">Carregando...</div>
                        <select name='city' v-if="!isLoadingCity" class="form-control">
                            <optgroup label="--">
                                <option v-for="item in Citys.data" v-bind:value="item.id">@{{item.Name}}</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Descrição</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="Descr" value="{{ $item->Descr }}"></textarea>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Endereço</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Address" value="{{ $item->Address }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Número de quartos</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" class="form-control" name="Qtd_quartos" value="{{ $item->Qtd_quartos }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Número de suíte</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" class="form-control" name="Qtd_suite" value="{{ $item->Qtd_suite }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Número de banheiros</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" class="form-control" name="Qtd_banheiros" value="{{ $item->Qtd_banheiros }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Garagem para quantos</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" class="form-control" name="Qtd_garagem" value="{{ $item->Qtd_garagem }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Comprimento</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Comp" value="{{ $item->Comp }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Largura</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Larg" value="{{ $item->Larg }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Área Útil</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Area_util" value="{{ $item->Area_util }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Área Total</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Area_total" value="{{ $item->Area_total }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Taxa de condomínio</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Condominio" value="{{ $item->Condominio }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">IPTU</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Iptu" value="{{ $item->Iptu }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Latitude</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Lat" value="{{ $item->Lat }}"  required>
                    </div>
                </div>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Longitude</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" class="form-control" name="Long" value="{{ $item->Long }}"  required>
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
                    selectedCity: 0,
                    isLoadingCity: false,
                    Citys: [],
                },
                methods: {
                    onChangeCity_id: async () => {
                        this.isLoadingCity = true;
                        fetch('/api/City/')
                            .then(raw => raw.json())
                            .then(response => {
                                console.log(response);
                                app.Citys = response;
                            })
                            .catch(err => console.err(err))
                            .finally(() => app.isLoadingCity = false);
                    },
                },
                 beforeMount(){
                        this.onChangeCity_id(),
                },
            });
    </script>
@endsection