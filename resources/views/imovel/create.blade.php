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
            <form id="vue_app" class="form form-horizontal form-bordered" name="form" action="{{ route('imovel.store') }}"" method="POST" novalidate>
                {!! csrf_field() !!}
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Cidade</label>
                <div class="col-md-6">
                <!-- Será carregador via Ajax -->
                <!-- ou usar Laravel ::all -->
                    <select name='CityId' data-plugin-selectTwo class="form-control populate">
                            @foreach($CityReference as $City)
                            <option>{{$City->cidade}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Descrição</label>
                <div class="col-md-6">
                    <textarea class="form-control" value="{{old('Descr')}}" name="Descr"></textarea>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group">
                <label class="col-md-3 control-label">Endereço</label>
                <div class="col-md-6">
                    <input class="form-control"  value="{{old('Address')}}"name="Address"   data-plugin-maxlength="" maxlength="200" required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Número de quartos</label>
                <div class="col-md-6">
                    <input type="email" class="form-control"  value="{{old('Qtd_quartos')}}"name="Qtd_quartos"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Número de suíte</label>
                <div class="col-md-6">
                    <input type="email" class="form-control"  value="{{old('Qtd_suite')}}"name="Qtd_suite"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Número de banheiros</label>
                <div class="col-md-6">
                    <input type="email" class="form-control"  value="{{old('Qtd_banheiros')}}"name="Qtd_banheiros"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Garagem para quantos</label>
                <div class="col-md-6">
                    <input type="email" class="form-control"  value="{{old('Qtd_garagem')}}"name="Qtd_garagem"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Comprimento</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Comp')}}"name="Comp"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Largura</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Larg')}}"name="Larg"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Área Útil</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Area_util')}}"name="Area_util"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Área Total</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Area_total')}}"name="Area_total"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Taxa de condomínio</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Condominio')}}"name="Condominio"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">IPTU</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Iptu')}}"name="Iptu"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Latitude</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Lat')}}"name="Lat"  required>
                </div>
            </div>
        </td>
            <td>
            <div class="form-group" >
                <label class="col-md-3 control-label">Longitude</label>
                <div class="col-md-6">
                    <input type="number" class="form-control"  value="{{old('Long')}}"name="Long"  required>
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
