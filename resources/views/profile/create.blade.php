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
            <form id="vue_app" class="form form-horizontal form-bordered" name="form" action="{{ route('profile.store') }}"" method="POST" novalidate>
                {!! csrf_field() !!}
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Nome</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Name')}}"name="Name"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
        </td>
            <td>
            <div class="form-group" >
                <<label class="col-md-3 control-label">Nascimento</label>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" name="Birthday" value="{{old('Birthday')}}" data-plugin-datepicker="" class="form-control">
                    </div>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Cidade</label>
                <div class="col-md-6">
                <!-- Será carregador via Ajax -->
                <!-- ou usar Laravel ::all -->
                <div v-if="isLoadingCity" class="loading">Carregando...</div>
                    <select name='{{CityId}}' v-if="!isLoadingCity" data-plugin-selectTwo class="form-control populate">
                        <optgroup label="--">
                            <option v-for="item in Citys.data" v-bind:value="item.Name">@{}</option>
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
                selectedCity: 0,
                isLoadingCity: false,
                Citys: [],
            },
            methods: {
                onChangeCity_id: async () => {
                    app.isLoadingCity = true;
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
