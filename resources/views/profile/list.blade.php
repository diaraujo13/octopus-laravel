@extends('layouts.app')
@section('title', 'Main page')
@section('content')
<header class="page-header">
        <h2>profile</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Home</span></li>
                <li><span>profile</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
</header>
<div class="row wrapper white-bg page-heading">
    <div class="col-sm-4">
        <h2 class='p-20 layer w-100'>profile</h2>
    </div>
    <div class="col-md-4 col-md-offset-4 offset-md-4">
        <div class="p-20 bgc-grey-100 layer w-100">
            <a href="{{route('profile.create')}}" class="btn btn-primary btn-block">Novo profile</a>
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
                <h2 class="panel-title">Registros</h2>
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
                 <form action="{{route('profile.index')}}" method='GET' role="search">
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
                                $CityReference = \App\City::all();
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Tipo</label>
                                            <select name="CityId" id="" class="form-control">
                                                @foreach($CityReference as $ref)
                                                <option
                                                @if(array_key_exists('$CityId', $requested_items)
                                                    && $requested_items['Id'] == $ref->id)
                                                selected
                                                @endif
                                                value="{{ref->id}}">{{ref->Name}}</option>
                                                @endforeach
                                            </select>
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
                                     <input type="text" 
                                    data-plugin-datepicker
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
                                <a href="{{route('profile.index')}}" id='search_btn' class="btn btn-block btn-light">
                                    Limpar pesquisa </a>
                            </div>
                    </div>
                </form>
                    <table class="table table-striped table-bordered">
                        <tr>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Foto
                                </th>
                                <th>
                                    Nascimento
                                </th>
                                <th>
                                    Cidade
                                </th>
                                <td></td>
                        </tr>
                @foreach($items as $item)
                <tr>
                    <td>
                       {{ $item->Name }}
                    </td>
                    <td>
                       {{ $item->Photo }}
                    </td>
                    <td>
                       {{ $item->Birthday }}
                    </td>
                    <td>
                       {{ $item->City_id }}
                    </td>
                   <td class="actions-hover">
                    <a href={{route("profile.edit", $item->id )}}><i class="fa fa-pencil"></i></a>
                    <a data-itemid={{$item->id}} data-toggle="modal" data-target="#delete" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
                </tr>
                @endforeach
                    </table>
                </div>
                    <span>{{$items}}</span>
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
        <form action="{{route('profile.destroy', 'test')}}" method="POST">
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
