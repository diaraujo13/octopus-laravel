<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//web.php
/*
        Route::get('imovel', 'ImovelController@index')->name('imovel.index');
        Route::get('imovel/create', 'ImovelController@create')->name('imovel.create');
        Route::post('imovel', 'ImovelController@store')->name('imovel.store');
        Route::get('imovel/{imovel}/edit', 'ImovelController@edit')->name('imovel.edit');
        Route::put('imovel/{imovel}', 'ImovelController@update')->name('imovel.update');
        Route::delete('imovel/{imovel}', 'ImovelController@destroy')->name('imovel.destroy');
*/
//api.php
/*
    Route::get('imovel', 'ImovelController@api_list')->name('imovel_api.index');
    Route::get('imovel/{id}', 'ImovelController@api_show')->name('imovel_api.index');
    Route::get('imovel/{key?}', 'ImovelController@API_fromNow')->name('imovel_fromNow.index');
    Route::post('imovel', 'ImovelController@API_create')->name('imovel_api.store');
    Route::put('imovel/{imovel}', 'ImovelController@API_update')->name('imovel_api.update');
    Route::delete('imovel/{imovel}', 'ImovelController@api_destroy')->name('imovel_api.destroy');
*/
use \App\Imovel;
class ImovelController extends Controller
{
    public function index(Request $request){
    $requested_items = $request->request->all();
    $name_query = $request->input('name_query');
    //Referência ao modelo
    $items = Imovel::query();
    $CityReference = \App\City::all();

        if($request->has('CityId'))
            $items = $items->where('city_id', '=', $request->CityId);

    $items = $items->orWhere('address', 'LIKE', '%'.$name_query.'%');
    $items = $items->join('city', 'city.id', '=', 'imovel.city_id');
    $items = $items->select('imovel.*');
    $items = $items->select('city.*');

    $items = $items->paginate(10);
    return view('imovel.list')->with([
    'items' => $items,
    'requested_items' => $requested_items,
    //adiciona-se as outras variáveis
    'CityReference' =>  $CityReference
    ]);
    }
    public function create(){
        $CityReference = \App\City::all();

        return view('imovel.create')->with([
            'CityReference' => $CityReference
        ]);
    }
    public function store(Request $request){
        $item = new Imovel();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Descr' => 'nullable|string|max:1024'  ,         
                'Address' => 'nullable|string|max:255'  ,         
                'Qtd_quartos' => 'nullable|numeric',          
                'Qtd_suite' => 'nullable|numeric',          
                'Qtd_banheiros' => 'nullable|numeric',          
                'Qtd_garagem' => 'nullable|numeric',          
        );
        $messages = array(
                'Descr.required' => 'É necessário informar o campo Descrição',
                'Descr.max' => 'Você ultrapassou o limite de 255 caracteres do campo Descrição',         
                'Address.required' => 'É necessário informar o campo Endereço',         
                'Address.max' => 'Você ultrapassou o limite de 255 caracteres do campo Endereço',         
                'Qtd_quartos.required' => 'É necessário informar o campo Número de quartos',   
                'Qtd_quartos.numeric' => 'Você precisa informar um valor numérico para o campo Número de quartos',         
                'Qtd_suite.required' => 'É necessário informar o campo Número de suíte',   
                'Qtd_suite.numeric' => 'Você precisa informar um valor numérico para o campo Número de suíte',         
                'Qtd_banheiros.required' => 'É necessário informar o campo Número de banheiros',   
                'Qtd_banheiros.numeric' => 'Você precisa informar um valor numérico para o campo Número de banheiros',         
                'Qtd_garagem.required' => 'É necessário informar o campo Garagem para quantos',   
                'Qtd_garagem.numeric' => 'Você precisa informar um valor numérico para o campo Garagem para quantos',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->City_id = $request->City_id;
            $item->Descr = $request->Descr;
            $item->Address = $request->Address;
            $item->Qtd_quartos = $request->Qtd_quartos;
            $item->Qtd_suite = $request->Qtd_suite;
            $item->Qtd_banheiros = $request->Qtd_banheiros;
            $item->Qtd_garagem = $request->Qtd_garagem;
            $item->Comp = $request->Comp;
            $item->Larg = $request->Larg;
            $item->Area_util = $request->Area_util;
            $item->Area_total = $request->Area_total;
            $item->Condominio = $request->Condominio;
            $item->Iptu = $request->Iptu;
            $item->Lat = $request->Lat;
            $item->Long = $request->Long;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Imovel foi salvo com sucesso!');
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
        $item = Imovel::find($id);
        return view('imovel.edit')->with([ 'item' => $item ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){ 
        $item =  Imovel::find($id);
        $requested_items = $request->request->all();
        // $requested_items['Cpf'] = str_replace(['.','-'],'', $requested_items['Cpf']);
        // $requested_items['Cnpj'] = str_replace(['.','-'],'', $requested_items['Cnpj']);
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Descr' => 'nullable|string|max:1024'  ,         
                'Address' => 'nullable|string|max:255'  ,         
                'Qtd_quartos' => 'nullable|numeric',          
                'Qtd_suite' => 'nullable|numeric',          
                'Qtd_banheiros' => 'nullable|numeric',          
                'Qtd_garagem' => 'nullable|numeric',          
        );
        $messages = array(
                'Descr.required' => 'É necessário informar o campo Descrição',
                'Descr.max' => 'Você ultrapassou o limite de 255 caracteres do campo Descrição',         
                'Address.required' => 'É necessário informar o campo Endereço',         
                'Address.max' => 'Você ultrapassou o limite de 255 caracteres do campo Endereço',         
                'Qtd_quartos.required' => 'É necessário informar o campo Número de quartos',   
                'Qtd_quartos.numeric' => 'Você precisa informar um valor numérico para o campo Número de quartos',         
                'Qtd_suite.required' => 'É necessário informar o campo Número de suíte',   
                'Qtd_suite.numeric' => 'Você precisa informar um valor numérico para o campo Número de suíte',         
                'Qtd_banheiros.required' => 'É necessário informar o campo Número de banheiros',   
                'Qtd_banheiros.numeric' => 'Você precisa informar um valor numérico para o campo Número de banheiros',         
                'Qtd_garagem.required' => 'É necessário informar o campo Garagem para quantos',   
                'Qtd_garagem.numeric' => 'Você precisa informar um valor numérico para o campo Garagem para quantos',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->City_id = $request->City_id;
            $item->Descr = $request->Descr;
            $item->Address = $request->Address;
            $item->Qtd_quartos = $request->Qtd_quartos;
            $item->Qtd_suite = $request->Qtd_suite;
            $item->Qtd_banheiros = $request->Qtd_banheiros;
            $item->Qtd_garagem = $request->Qtd_garagem;
            $item->Comp = $request->Comp;
            $item->Larg = $request->Larg;
            $item->Area_util = $request->Area_util;
            $item->Area_total = $request->Area_total;
            $item->Condominio = $request->Condominio;
            $item->Iptu = $request->Iptu;
            $item->Lat = $request->Lat;
            $item->Long = $request->Long;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Imovel foi salvo com sucesso!');
            // return 'ok';
            return redirect()->route('imovel.edit', $item->id)->with([ 'item' => $item ]);
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
            $item =  Imovel::findOrFail($request->id);
        }
        catch(\Exception $exception){
            return redirect()->back()->with('errors', $exception);
        }
        try{
            $item->delete(); 
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Imovel foi removido com sucesso!');
            return redirect()->route('imovel.index');
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
        $items = Imovel::paginate(10)->toJson();
        return $items;
    }
    public function api_show($id){
         try{
            return Imovel::findOrFail($id)->toJson();
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
        $items = Imovel::where($field, '>=', date('Y-m-d'))->get()->toJson();
        return $items;
    }
    public function API_betweenDate($start, $end){
        $items = Imovel::whereBetween('created_at', array($start, $end) )->get();
        return $items;
    }
    public function API_byDate($start){
        $items = Imovel::where('created_at', '>=', $start.' 00:00:00' )->get();
        return $items;
    }
    public function API_today(){
        $items =  Imovel::whereBetween('created_at',
        [  date('Y-m-d').' 00:00:00',
           date('Y-m-d').' 23:59:59'
        ])->get();
        return $items;
    }
    public function API_destroy($id){
        $item =  Imovel::find($id);
        $item->delete(); 
        return true;
    }
    public function API_create(Request $request){
        $item = new Imovel();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Descr' => 'nullable|string|max:1024'  ,         
                'Address' => 'nullable|string|max:255'  ,         
                'Qtd_quartos' => 'nullable|numeric',          
                'Qtd_suite' => 'nullable|numeric',          
                'Qtd_banheiros' => 'nullable|numeric',          
                'Qtd_garagem' => 'nullable|numeric',          
        );
        $messages = array(
                'Descr.required' => 'É necessário informar o campo Descrição',
                'Descr.max' => 'Você ultrapassou o limite de 255 caracteres do campo Descrição',         
                'Address.required' => 'É necessário informar o campo Endereço',         
                'Address.max' => 'Você ultrapassou o limite de 255 caracteres do campo Endereço',         
                'Qtd_quartos.required' => 'É necessário informar o campo Número de quartos',   
                'Qtd_quartos.numeric' => 'Você precisa informar um valor numérico para o campo Número de quartos',         
                'Qtd_suite.required' => 'É necessário informar o campo Número de suíte',   
                'Qtd_suite.numeric' => 'Você precisa informar um valor numérico para o campo Número de suíte',         
                'Qtd_banheiros.required' => 'É necessário informar o campo Número de banheiros',   
                'Qtd_banheiros.numeric' => 'Você precisa informar um valor numérico para o campo Número de banheiros',         
                'Qtd_garagem.required' => 'É necessário informar o campo Garagem para quantos',   
                'Qtd_garagem.numeric' => 'Você precisa informar um valor numérico para o campo Garagem para quantos',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->City_id = $request->City_id;
            $item->Descr = $request->Descr;
            $item->Address = $request->Address;
            $item->Qtd_quartos = $request->Qtd_quartos;
            $item->Qtd_suite = $request->Qtd_suite;
            $item->Qtd_banheiros = $request->Qtd_banheiros;
            $item->Qtd_garagem = $request->Qtd_garagem;
            $item->Comp = $request->Comp;
            $item->Larg = $request->Larg;
            $item->Area_util = $request->Area_util;
            $item->Area_total = $request->Area_total;
            $item->Condominio = $request->Condominio;
            $item->Iptu = $request->Iptu;
            $item->Lat = $request->Lat;
            $item->Long = $request->Long;
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
}
