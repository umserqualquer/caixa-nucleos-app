<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->account_type == 'cpf'){
            return Order::where('payer', Auth::user()->cpf)->orWhere('receiver', Auth::user()->cpf);
        }else{
            return Order::where('payer', Auth::user()->cnpj)->orWhere('receiver', Auth::user()->cnpj);
        }

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

        $request->validate([
            'name_payer' => 'required',
            'due_date' => 'required',
            'selected' => 'required',
            'value' => 'required',
            'title' => 'required'
        ]);

        if(Auth::user()->cpf){
            $receiver_identify = Auth::user()->cpf;
        }else{
            $receiver_identify = Auth::user()->cpnj;
        }

        if($request->selected == 'cpf'){
            $payer_identify = $request->cpf;
        }else{
            $payer_identify = $request->cpnj;
        }

        $result = Order::create([
            'title' => $request->title,
            'total' => $request->value,
            'due_date' => $request->due_date,
            'payer_name' => $request->name_payer,
            'payer' => $payer_identify,
            'receiver_name' => Auth::user()->name,
            'receiver' => $receiver_identify
        ]);

        return response()->json(['message' => 'Order criada com sucesso!', 'result' => $result]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
