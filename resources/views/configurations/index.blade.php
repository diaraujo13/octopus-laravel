@extends('layouts.app')

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
	<li><span>Configurações do portal</span></li>
</ol>

<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
        <form class="form-horizontal form-bordered" method="POST" action="{{route('config.store')}}">
        @csrf

        <div class="panel-body">
                

                @foreach($items as $item)
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputHelpText">{{$item->displayName}}</label>
                    @if($item->key == 'logo_url')
                    <div class="col-md-6">
                        <input type="hidden" name="item[{{$item->id}}][id]" value="{{$item->id}}">
                        @if($item->value)
                            <img style='width: 300px' class='img-responsive' src="{{ url('/storage').'/'. $item->value }}" alt="">
                        @endif
                        <input type="file" name="item[{{$item->id}}][value]" value="{{$item->value}}" class="form-control" id="inputHelpText">
                    </div>
                    @else
                    <div class="col-md-6">
                        <input type="hidden" name="item[{{$item->id}}][id]" value="{{$item->id}}">
                        <input type="text" name="item[{{$item->id}}][value]" value="{{$item->value}}" class="form-control" id="inputHelpText">
                    </div>
                    @endif
                </div>
                @endforeach
                


        </div>
        <footer class="panel-footer">
            <button class="btn btn-primary">Salvar </button>
            <button type="reset" class="btn btn-default">Limpar</button>
        </footer>
        </form>
        </section>
    </div>
</div>




@endsection