@extends('layouts.app')
@section('title', 'Main page')
@section('content')

<header class="page-header">
        <h2>Dashboard</h2>
    
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
            </ol>
    
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

                    
<div class="row wrapper white-bg page-heading">
    <div class="col-md-4 col-md-offset-8 offset-md-4">
        <div class="p-20 bgc-grey-100 layer w-100">
            <a href="" class="btn btn-primary btn-block">Novo imovel</a>
                <br>
        </div>
    </div>
</div>
<div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title">Actions</h2>
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
                 <form action="" method='GET' role="search">
                    <div class="form-group row">
                        <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label for="" class="control-label">Termo a pesquisar</label>
                            <input type="text" placeholder="" 
                            @if(array_key_exists('name_query', $requested_items))
                                    value="{{$requested_items['name_query']}}"
                            @endif                            
                            class="form-control" name="name_query" id="top-search" />
                        </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Tipo</label>
                                </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Data inicial</label>
                                    <input type="text" 
                                    data-plugin-datepicker
                                    @if(array_key_exists('StartDate', $requested_items))
                                            value="{{$requested_items['StartDate']}}"
                                    @endif
                                    class="form-control" name="StartDate" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Data final</label>
                                    <input 
                                        type="date"
                                        @if(array_key_exists('EndDate', $requested_items))
                                            value="{{$requested_items['EndDate']}}"
                                        @endif
                                        class="form-control" name="EndDate" />
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <input type='submit' value='Filtrar' href="#" id='search_btn' class="btn btn-block  btn-success" />
                                <a href="" id='search_btn' class="btn btn-block btn-light">
                                    Limpar pesquisa </a>
                            </div>
                    </div>
                </form>
                    <table class="table table-striped table-bordered">
                        <tr>
                                <th>
                                    Título
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Prazo
                                </th>
                                <th>
                                    Validade ANuncio
                                </th>
                                <th>
                                    Descrição
                                </th>
                                <td></td>
                        </tr>
                <tr>
                    <td>
                      Teste
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                   <td class="actions-hover">
                    <a href="#"><i class="fa fa-pencil"></i></a>
                </td>
                </tr>
                <tr>
                    <td>
                      Teste
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                   <td class="actions-hover">
                    <a href="#"><i class="fa fa-pencil"></i></a>
                </td>
                </tr>
                <tr>
                    <td>
                      Teste
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                    <td>
                       asd
                    </td>
                   <td class="actions-hover">
                    <a href="#"><i class="fa fa-pencil"></i></a>
                </td>
                </tr>

                    </table>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center" id="myModalLabel">Antes de remover...</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="" method="POST">
                {{method_field('delete')}}
                {{csrf_field()}}
            <div class="modal-body">
                  <p class="text-center">
                      Você tem certeza que deseja remover o registro?
                  </p>
                    <input type="hidden" name="id" id="itemid" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn " data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Sim, remover</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')
  <script>    
      $('#delete').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) 
          var itemid = button.data('itemid') 
          var modal = $(this)
          modal.find('.modal-body #itemid').val(itemid);
      })
  </script>
  @endsection