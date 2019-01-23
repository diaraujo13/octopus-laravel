<?php

namespace App\Http\Controllers;

use App\Configurations;
use Illuminate\Http\Request;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Configurations::all();

        return view('configurations.index')->with
        ([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $items = $request->get("item");
        
        foreach( $items as $_item ){
            Configurations::where('id', $_item['id'])->update([
                'value' => $_item['value']
            ]);
        }
        

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Configurações salvas com sucesso!');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configurations  $configurations
     * @return \Illuminate\Http\Response
     */
    public function show(Configurations $configurations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configurations  $configurations
     * @return \Illuminate\Http\Response
     */
    public function edit(Configurations $configurations)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configurations  $configurations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configurations $configurations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configurations  $configurations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configurations $configurations)
    {
        //
    }
}
