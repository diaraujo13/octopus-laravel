<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//web.php
/*
        Route::get('cat_anuncio', 'Cat_anuncioController@index')->name('cat_anuncio.index');
        Route::get('cat_anuncio/create', 'Cat_anuncioController@create')->name('cat_anuncio.create');
        Route::post('cat_anuncio', 'Cat_anuncioController@store')->name('cat_anuncio.store');
        Route::get('cat_anuncio/{cat_anuncio}/edit', 'Cat_anuncioController@edit')->name('cat_anuncio.edit');
        Route::put('cat_anuncio/{cat_anuncio}', 'Cat_anuncioController@update')->name('cat_anuncio.update');
        Route::delete('cat_anuncio/{cat_anuncio}', 'Cat_anuncioController@destroy')->name('cat_anuncio.destroy');
*/
//api.php
/*
    Route::get('cat_anuncio', 'Cat_anuncioController@api_list')->name('cat_anuncio_api.index');
    Route::get('cat_anuncio/{id}', 'Cat_anuncioController@api_show')->name('cat_anuncio_api.index');
    Route::get('cat_anuncio/{key?}', 'Cat_anuncioController@API_fromNow')->name('cat_anuncio_fromNow.index');
    Route::post('cat_anuncio', 'Cat_anuncioController@API_create')->name('cat_anuncio_api.store');
    Route::put('cat_anuncio/{cat_anuncio}', 'Cat_anuncioController@API_update')->name('cat_anuncio_api.update');
    Route::delete('cat_anuncio/{cat_anuncio}', 'Cat_anuncioController@api_destroy')->name('cat_anuncio_api.destroy');
*/
use \App\Cat_anuncio;
class Cat_anuncioController extends Controller
{
    public function index(Request $request){
    $requested_items = $request->request->all();
    $name_query = $request->input('name_query');
    //Referência ao modelo
    $items = Cat_anuncio::query();
        $items = $items->orWhere('nome', 'LIKE', '%'.$name_query.'%');
        $items = $items->orWhere('cor', 'LIKE', '%'.$name_query.'%');
    $items = $items->select('Cat_anuncio.*');
    ;
    $items = $items->paginate(10);
    return view('cat_anuncio.list')->with([
    'items' => $items,
    'requested_items' => $requested_items,
    //adiciona-se as outras variáveis
    ]);
    }
    public function create(){
        return view('cat_anuncio.create');
    }
    public function store(Request $request){
        $item = new Cat_anuncio();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Nome' => 'nullable|string|max:255'  ,         
                'Cor' => 'nullable|string|max:255'  ,         
        );
        $messages = array(
                'Nome.required' => 'É necessário informar o campo Nome',         
                'Nome.max' => 'Você ultrapassou o limite de 255 caracteres do campo Nome',         
                'Cor.required' => 'É necessário informar o campo Cor do rótulo',         
                'Cor.max' => 'Você ultrapassou o limite de 255 caracteres do campo Cor do rótulo',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Nome = $request->Nome;
            $item->Cor = $request->Cor;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Cat_anuncio foi salvo com sucesso!');
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
        $item = Cat_anuncio::find($id);
        return view('cat_anuncio.edit')->with([ 'item' => $item ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){ 
        $item =  Cat_anuncio::find($id);
        $requested_items = $request->request->all();
        // $requested_items['Cpf'] = str_replace(['.','-'],'', $requested_items['Cpf']);
        // $requested_items['Cnpj'] = str_replace(['.','-'],'', $requested_items['Cnpj']);
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Nome' => 'nullable|string|max:255'  ,         
                'Cor' => 'nullable|string|max:255'  ,         
        );
        $messages = array(
                'Nome.required' => 'É necessário informar o campo Nome',         
                'Nome.max' => 'Você ultrapassou o limite de 255 caracteres do campo Nome',         
                'Cor.required' => 'É necessário informar o campo Cor do rótulo',         
                'Cor.max' => 'Você ultrapassou o limite de 255 caracteres do campo Cor do rótulo',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Nome = $request->Nome;
            $item->Cor = $request->Cor;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Cat_anuncio foi salvo com sucesso!');
            // return 'ok';
            return redirect()->route('cat_anuncio.edit', $item->id)->with([ 'item' => $item ]);
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
            $item =  Cat_anuncio::findOrFail($request->id);
        }
        catch(\Exception $exception){
            return redirect()->back()->with('errors', $exception);
        }
        try{
            $item->delete(); 
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Cat_anuncio foi removido com sucesso!');
            return redirect()->route('cat_anuncio.index');
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
        $items = Cat_anuncio::paginate(10)->toJson();
        return $items;
    }
    public function api_show($id){
         try{
            return Cat_anuncio::findOrFail($id)->toJson();
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
        $items = Cat_anuncio::where($field, '>=', date('Y-m-d'))->get()->toJson();
        return $items;
    }
    public function API_betweenDate($start, $end){
        $items = Cat_anuncio::whereBetween('created_at', array($start, $end) )->get();
        return $items;
    }
    public function API_byDate($start){
        $items = Cat_anuncio::where('created_at', '>=', $start.' 00:00:00' )->get();
        return $items;
    }
    public function API_today(){
        $items =  Cat_anuncio::whereBetween('created_at',
        [  date('Y-m-d').' 00:00:00',
           date('Y-m-d').' 23:59:59'
        ])->get();
        return $items;
    }
    public function API_destroy($id){
        $item =  Cat_anuncio::find($id);
        $item->delete(); 
        return true;
    }
    public function API_create(Request $request){
        $item = new Cat_anuncio();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Nome' => 'nullable|string|max:255'  ,         
                'Cor' => 'nullable|string|max:255'  ,         
        );
        $messages = array(
                'Nome.required' => 'É necessário informar o campo Nome',         
                'Nome.max' => 'Você ultrapassou o limite de 255 caracteres do campo Nome',         
                'Cor.required' => 'É necessário informar o campo Cor do rótulo',         
                'Cor.max' => 'Você ultrapassou o limite de 255 caracteres do campo Cor do rótulo',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Nome = $request->Nome;
            $item->Cor = $request->Cor;
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
