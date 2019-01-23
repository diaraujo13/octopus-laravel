<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//web.php
/*
        Route::get('anuncio', 'AnuncioController@index')->name('anuncio.index');
        Route::get('anuncio/create', 'AnuncioController@create')->name('anuncio.create');
        Route::post('anuncio', 'AnuncioController@store')->name('anuncio.store');
        Route::get('anuncio/{anuncio}/edit', 'AnuncioController@edit')->name('anuncio.edit');
        Route::put('anuncio/{anuncio}', 'AnuncioController@update')->name('anuncio.update');
        Route::delete('anuncio/{anuncio}', 'AnuncioController@destroy')->name('anuncio.destroy');
*/
//api.php
/*
    Route::get('anuncio', 'AnuncioController@api_list')->name('anuncio_api.index');
    Route::get('anuncio/{id}', 'AnuncioController@api_show')->name('anuncio_api.index');
    Route::get('anuncio/{key?}', 'AnuncioController@API_fromNow')->name('anuncio_fromNow.index');
    Route::post('anuncio', 'AnuncioController@API_create')->name('anuncio_api.store');
    Route::put('anuncio/{anuncio}', 'AnuncioController@API_update')->name('anuncio_api.update');
    Route::delete('anuncio/{anuncio}', 'AnuncioController@api_destroy')->name('anuncio_api.destroy');
*/
use \App\Anuncio;
class AnuncioController extends Controller
{
    public function index(Request $request){
    $requested_items = $request->request->all();
    $name_query = $request->input('name_query');
    //Referência ao modelo
    $items = Anuncio::query();
            $Cat_anuncioReference = \App\Cat_anuncio::all();
            if($request->has('Cat_anuncioId'))
                $items = $items->where('Cat_anuncio_id', '=', $request->Cat_anuncioId);
            $ImovelReference = \App\Imovel::all();
            if($request->has('ImovelId'))
                $items = $items->where('Imovel_id', '=', $request->ImovelId);
        $items = $items->orWhere('title', 'LIKE', '%'.$name_query.'%');
        $items = $items->orWhere('email', 'LIKE', '%'.$name_query.'%');
        $items = $items->orWhere('telefone', 'LIKE', '%'.$name_query.'%');
        $items = $items->orWhere('sectel', 'LIKE', '%'.$name_query.'%');
            $items = $items->join('Cat_anuncio', 'Cat_anuncio.id', '=', 'Anuncio.Cat_anuncio_id');
            $items = $items->join('Imovel', 'Imovel.id', '=', 'Anuncio.Imovel_id');
    $items = $items->select('Anuncio.*');
            $items = $items->select('Cat_anuncio.*');
            $items = $items->select('Imovel.*');
    ;
    $items = $items->paginate(10);
    return view('anuncio.list')->with([
    'items' => $items,
    'requested_items' => $requested_items,
    //adiciona-se as outras variáveis
    ]);
    }
    public function create(){
        return view('anuncio.create');
    }
    public function store(Request $request){
        $item = new Anuncio();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Title' => 'nullable|string|max:255'  ,         
                'Ativo' => 'nullable|boolean',         
                'Validade' => 'nullable|date'  ,         
                'Email' => 'nullable|string|max:255'  ,         
                'Telefone' => 'nullable|string|max:255'  ,         
                'Sectel' => 'nullable|string|max:255'  ,         
                'Featured' => 'nullable|boolean',         
        );
        $messages = array(
                'Title.required' => 'É necessário informar o campo Título',         
                'Title.max' => 'Você ultrapassou o limite de 255 caracteres do campo Título',         
                'Ativo.required' => 'É necessário informar o campo Está ativo?',         
                'Validade.required' => 'É necessário informar o campo Anúncio válido até',         
                'Validade.date' => 'É necessário informar uma data válida para o campo Anúncio válido até',         
                'Email.required' => 'É necessário informar o campo E-mail contato',         
                'Email.max' => 'Você ultrapassou o limite de 255 caracteres do campo E-mail contato',         
                'Telefone.required' => 'É necessário informar o campo Telefone contato',         
                'Telefone.max' => 'Você ultrapassou o limite de 255 caracteres do campo Telefone contato',         
                'Sectel.required' => 'É necessário informar o campo Telefone secundário',         
                'Sectel.max' => 'Você ultrapassou o limite de 255 caracteres do campo Telefone secundário',         
                'Featured.required' => 'É necessário informar o campo Anúncio promovido?',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Title = $request->Title;
            $item->Valor = $request->Valor;
            $item->Antigo_valor = $request->Antigo_valor;
            $item->Ativo = $request->Ativo;
            $item->Validade = $request->Validade;
            $item->Email = $request->Email;
            $item->Telefone = $request->Telefone;
            $item->Sectel = $request->Sectel;
            $item->Featured = $request->Featured;
            $item->Cat_anuncio_id = $request->Cat_anuncio_id;
            $item->Imovel_id = $request->Imovel_id;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Anuncio foi salvo com sucesso!');
            return redirect()->back()->withInput();
        }else{
            $messages = $val->messages();
            // dd($messages);
            return redirect()->back()->withInput()->with('errors', $messages);
        }
    }
    public function show($id){
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){ 
        $item = Anuncio::find($id);
        return view('anuncio.edit')->with([ 'item' => $item ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){ 
        $item =  Anuncio::find($id);
        $requested_items = $request->request->all();
        // $requested_items['Cpf'] = str_replace(['.','-'],'', $requested_items['Cpf']);
        // $requested_items['Cnpj'] = str_replace(['.','-'],'', $requested_items['Cnpj']);
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Title' => 'nullable|string|max:255'  ,         
                'Ativo' => 'nullable|boolean',         
                'Validade' => 'nullable|date'  ,         
                'Email' => 'nullable|string|max:255'  ,         
                'Telefone' => 'nullable|string|max:255'  ,         
                'Sectel' => 'nullable|string|max:255'  ,         
                'Featured' => 'nullable|boolean',         
        );
        $messages = array(
                'Title.required' => 'É necessário informar o campo Título',         
                'Title.max' => 'Você ultrapassou o limite de 255 caracteres do campo Título',         
                'Ativo.required' => 'É necessário informar o campo Está ativo?',         
                'Validade.required' => 'É necessário informar o campo Anúncio válido até',         
                'Validade.date' => 'É necessário informar uma data válida para o campo Anúncio válido até',         
                'Email.required' => 'É necessário informar o campo E-mail contato',         
                'Email.max' => 'Você ultrapassou o limite de 255 caracteres do campo E-mail contato',         
                'Telefone.required' => 'É necessário informar o campo Telefone contato',         
                'Telefone.max' => 'Você ultrapassou o limite de 255 caracteres do campo Telefone contato',         
                'Sectel.required' => 'É necessário informar o campo Telefone secundário',         
                'Sectel.max' => 'Você ultrapassou o limite de 255 caracteres do campo Telefone secundário',         
                'Featured.required' => 'É necessário informar o campo Anúncio promovido?',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Title = $request->Title;
            $item->Valor = $request->Valor;
            $item->Antigo_valor = $request->Antigo_valor;
            $item->Ativo = $request->Ativo;
            $item->Validade = $request->Validade;
            $item->Email = $request->Email;
            $item->Telefone = $request->Telefone;
            $item->Sectel = $request->Sectel;
            $item->Featured = $request->Featured;
            $item->Cat_anuncio_id = $request->Cat_anuncio_id;
            $item->Imovel_id = $request->Imovel_id;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Anuncio foi salvo com sucesso!');
            // return 'ok';
            return redirect()->route('anuncio.edit', $item->id)->with([ 'item' => $item ]);
        }else{
            $messages = $val->messages();
            // dd($messages);
            return redirect()->back()->withInput()->with('errors', $messages);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        try{
            $item =  Anuncio::findOrFail($request->id);
        }
        catch(\Exception $exception){
            return redirect()->back()->with('errors', $exception);
        }
        try{
            $item->delete(); 
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Anuncio foi removido com sucesso!');
            return redirect()->route('anuncio.index');
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception);
        }
    }
    /**************************************************************************************
    ***************************************************************************************
                                ╦═╗╔═╗╔╦╗╔═╗╔═╗  ╔═╗╔═╗╦
                                ╠╦╝║ ║ ║ ╠═╣╚═╗  ╠═╣╠═╝║
                                ╩╚═╚═╝ ╩ ╩ ╩╚═╝  ╩ ╩╩  ╩
    ***************************************************************************************
    ***************************************************************************************/
    public function api_list(){
        $items = Anuncio::paginate(10)->toJson();
        return $items;
    }
    public function api_show($id){
         try{
            return Anuncio::findOrFail($id)->toJson();
         }catch(\Exception $e){
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ];
            return response()->json($json, 400);
         }
    }
    public function API_fromNow($field = 'created_at'){
        $items = Anuncio::where($field, '>=', date('Y-m-d'))->get()->toJson();
        return $items;
    }
    public function API_betweenDate($start, $end){
        $items = Anuncio::whereBetween('created_at', array($start, $end) )->get();
        return $items;
    }
    public function API_byDate($start){
        $items = Anuncio::where('created_at', '>=', $start.' 00:00:00' )->get();
        return $items;
    }
    public function API_today(){
        $items =  Anuncio::whereBetween('created_at',
        [  date('Y-m-d').' 00:00:00',
           date('Y-m-d').' 23:59:59'
        ])->get();
        return $items;
    }
    public function API_destroy($id){
        $item =  Anuncio::find($id);
        $item->delete(); 
        return true;
    }
    public function API_create(Request $request){
        $item = new Anuncio();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Title' => 'nullable|string|max:255'  ,         
                'Ativo' => 'nullable|boolean',         
                'Validade' => 'nullable|date'  ,         
                'Email' => 'nullable|string|max:255'  ,         
                'Telefone' => 'nullable|string|max:255'  ,         
                'Sectel' => 'nullable|string|max:255'  ,         
                'Featured' => 'nullable|boolean',         
        );
        $messages = array(
                'Title.required' => 'É necessário informar o campo Título',         
                'Title.max' => 'Você ultrapassou o limite de 255 caracteres do campo Título',         
                'Ativo.required' => 'É necessário informar o campo Está ativo?',         
                'Validade.required' => 'É necessário informar o campo Anúncio válido até',         
                'Validade.date' => 'É necessário informar uma data válida para o campo Anúncio válido até',         
                'Email.required' => 'É necessário informar o campo E-mail contato',         
                'Email.max' => 'Você ultrapassou o limite de 255 caracteres do campo E-mail contato',         
                'Telefone.required' => 'É necessário informar o campo Telefone contato',         
                'Telefone.max' => 'Você ultrapassou o limite de 255 caracteres do campo Telefone contato',         
                'Sectel.required' => 'É necessário informar o campo Telefone secundário',         
                'Sectel.max' => 'Você ultrapassou o limite de 255 caracteres do campo Telefone secundário',         
                'Featured.required' => 'É necessário informar o campo Anúncio promovido?',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Title = $request->Title;
            $item->Valor = $request->Valor;
            $item->Antigo_valor = $request->Antigo_valor;
            $item->Ativo = $request->Ativo;
            $item->Validade = $request->Validade;
            $item->Email = $request->Email;
            $item->Telefone = $request->Telefone;
            $item->Sectel = $request->Sectel;
            $item->Featured = $request->Featured;
            $item->Cat_anuncio_id = $request->Cat_anuncio_id;
            $item->Imovel_id = $request->Imovel_id;
            $item->save();
            $json = [
                'success' => true,
                'data' => $item
            ];
            return response()->json($json, 200);
        }else{
            $json = [
                'success' => false,
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ];
            return response()->json($json, 400);
        }
    }
    public function API_create(Request $request){
    }
}
