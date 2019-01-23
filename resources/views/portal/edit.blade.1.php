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
        <div class="panel-body">
            <form class="form-horizontal form-bordered" method="get">
                

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputHelpText">Título Principal</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="inputHelpText">
                        <span class="help-block">Título exibido na página inicial.</span>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-md-3 control-label" for="textareaDefault">Descrição principal</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="3" id="textareaDefault"></textarea>
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



<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">Estrutura</h2>
        </header>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" method="get">
                

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputHelpText">Título Principal</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="inputHelpText">
                        <span class="help-block">Título exibido na página inicial.</span>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputHelpText">Subtítulo Principal</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="inputHelpText">
                        <span class="help-block">Título exibido na página inicial.</span>
                    </div>
                </div>


            </form>
        </div>
        </section>
    </div>
</div>






<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">Redes sociais</h2>
        </header>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" method="get">
                

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputHelpText">Título Principal</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="inputHelpText">
                        <span class="help-block">Título exibido na página inicial.</span>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputHelpText">Subtítulo Principal</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="inputHelpText">
                        <span class="help-block">Título exibido na página inicial.</span>
                    </div>
                </div>


            </form>
        </div>
        </section>
    </div>
</div>


<div class="row">
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="fa fa-caret-down"></a>
                <a href="#" class="fa fa-times"></a>
            </div>

            <h2 class="panel-title">Páginas</h2>
        </header>
        <div class="panel-body">
            <form class="form-horizontal form-bordered" method="get">
                

 
                <div class="form-group">
                    <label class="col-md-3 control-label" for="textareaDefault">Sobre a empresa</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="3" id="textareaDefault"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label" for="textareaDefault">Informações legais</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="3" id="textareaDefault"></textarea>
                    </div>
                </div>


            </form>
        </div>
        </section>
    </div>
</div>

@endsection