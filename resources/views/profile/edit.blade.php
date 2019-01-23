@extends('layouts.app')
@section('title', 'Novo profile')
@section('content')
<header class="page-header">
<h2>Profile</h2>
<div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
        <li>
            <a href="index.html">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li><span>Profile</span></li>
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
                 name="form" action="{{ route('profile.update', $item->id) }}" 
                 method="POST" novalidate>
                <input name="_method" type="hidden" value="PUT">
                {!! csrf_field() !!}
                <td>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" name="Name" value="{{ $item->Name }}"  required>
                    </div>
                </div>
            </td>
                <td>
            </td>
                <td>
                <div class="form-group" >
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nascimento</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" class="form-control" name="Birthday" value="{{ $item->Birthday }}"  required>
                    </div>
                </div>
            </td>
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