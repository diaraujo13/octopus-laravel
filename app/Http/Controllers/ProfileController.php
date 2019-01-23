<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//web.php
/*
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::get('profile/create', 'ProfileController@create')->name('profile.create');
        Route::post('profile', 'ProfileController@store')->name('profile.store');
        Route::get('profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('profile/{profile}', 'ProfileController@update')->name('profile.update');
        Route::delete('profile/{profile}', 'ProfileController@destroy')->name('profile.destroy');
*/
//api.php
/*
    Route::get('profile', 'ProfileController@api_list')->name('profile_api.index');
    Route::get('profile/{id}', 'ProfileController@api_show')->name('profile_api.index');
    Route::get('profile/{key?}', 'ProfileController@API_fromNow')->name('profile_fromNow.index');
    Route::post('profile', 'ProfileController@API_create')->name('profile_api.store');
    Route::put('profile/{profile}', 'ProfileController@API_update')->name('profile_api.update');
    Route::delete('profile/{profile}', 'ProfileController@api_destroy')->name('profile_api.destroy');
*/
use \App\Profile;
class ProfileController extends Controller
{
    public function index(Request $request){
    $requested_items = $request->request->all();
    $name_query = $request->input('name_query');
    //Referência ao modelo
    $items = Profile::query();
            $CityReference = \App\City::all();
            if($request->has('CityId'))
                $items = $items->where('City_id', '=', $request->CityId);
        $items = $items->orWhere('name', 'LIKE', '%'.$name_query.'%');
            $items = $items->join('City', 'City.id', '=', 'Profile.City_id');
    $items = $items->select('Profile.*');
            $items = $items->select('City.*');
    ;
    $items = $items->paginate(10);
    return view('profile.list')->with([
    'items' => $items,
    'requested_items' => $requested_items,
    //adiciona-se as outras variáveis
    ]);
    }
    public function create(){
        return view('profile.create');
    }
    public function store(Request $request){
        $item = new Profile();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Name' => 'nullable|string|max:255'  ,         
                'Birthday' => 'nullable|date'  ,         
        );
        $messages = array(
                'Name.required' => 'É necessário informar o campo Nome',         
                'Name.max' => 'Você ultrapassou o limite de 255 caracteres do campo Nome',         
                'Birthday.required' => 'É necessário informar o campo Nascimento',         
                'Birthday.date' => 'É necessário informar uma data válida para o campo Nascimento',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Name = $request->Name;
            $item->Photo = $request->Photo;
            $item->Birthday = $request->Birthday;
            $item->City_id = $request->City_id;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Profile foi salvo com sucesso!');
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
        $item = Profile::find($id);
        return view('profile.edit')->with([ 'item' => $item ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){ 
        $item =  Profile::find($id);
        $requested_items = $request->request->all();
        // $requested_items['Cpf'] = str_replace(['.','-'],'', $requested_items['Cpf']);
        // $requested_items['Cnpj'] = str_replace(['.','-'],'', $requested_items['Cnpj']);
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Name' => 'nullable|string|max:255'  ,         
                'Birthday' => 'nullable|date'  ,         
        );
        $messages = array(
                'Name.required' => 'É necessário informar o campo Nome',         
                'Name.max' => 'Você ultrapassou o limite de 255 caracteres do campo Nome',         
                'Birthday.required' => 'É necessário informar o campo Nascimento',         
                'Birthday.date' => 'É necessário informar uma data válida para o campo Nascimento',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Name = $request->Name;
            $item->Photo = $request->Photo;
            $item->Birthday = $request->Birthday;
            $item->City_id = $request->City_id;
            $item->save();
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Profile foi salvo com sucesso!');
            // return 'ok';
            return redirect()->route('profile.edit', $item->id)->with([ 'item' => $item ]);
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
            $item =  Profile::findOrFail($request->id);
        }
        catch(\Exception $exception){
            return redirect()->back()->with('errors', $exception);
        }
        try{
            $item->delete(); 
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Profile foi removido com sucesso!');
            return redirect()->route('profile.index');
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
        $items = Profile::paginate(10)->toJson();
        return $items;
    }
    public function api_show($id){
         try{
            return Profile::findOrFail($id)->toJson();
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
        $items = Profile::where($field, '>=', date('Y-m-d'))->get()->toJson();
        return $items;
    }
    public function API_betweenDate($start, $end){
        $items = Profile::whereBetween('created_at', array($start, $end) )->get();
        return $items;
    }
    public function API_byDate($start){
        $items = Profile::where('created_at', '>=', $start.' 00:00:00' )->get();
        return $items;
    }
    public function API_today(){
        $items =  Profile::whereBetween('created_at',
        [  date('Y-m-d').' 00:00:00',
           date('Y-m-d').' 23:59:59'
        ])->get();
        return $items;
    }
    public function API_destroy($id){
        $item =  Profile::find($id);
        $item->delete(); 
        return true;
    }
    public function API_create(Request $request){
        $item = new Profile();
        $requested_items = $request->request->all();
        // Para mais regras e suas formatações especiais, veja a documentação
        // https://laravel.com/docs/5.7/validation#rule-email
        $rules = array(
                'Name' => 'nullable|string|max:255'  ,         
                'Birthday' => 'nullable|date'  ,         
        );
        $messages = array(
                'Name.required' => 'É necessário informar o campo Nome',         
                'Name.max' => 'Você ultrapassou o limite de 255 caracteres do campo Nome',         
                'Birthday.required' => 'É necessário informar o campo Nascimento',         
                'Birthday.date' => 'É necessário informar uma data válida para o campo Nascimento',         
        );
        $val = Validator::make($requested_items, $rules, $messages);
        if ($val->passes()) 
        {
            $item->Name = $request->Name;
            $item->Photo = $request->Photo;
            $item->Birthday = $request->Birthday;
            $item->City_id = $request->City_id;
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
