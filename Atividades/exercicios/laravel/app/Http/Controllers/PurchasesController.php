<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchasesRequest;
use App\Http\Requests\UpdatePurchasesRequest;
use App\Models\Person;
use App\Models\Product;
use App\Models\Purchase;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return view('purchases.index', ['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $people = Person::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        return view('purchases.create', ['people' => $people, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchasesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchasesRequest $request)
    {
        if (Purchase::create($request->all())) {
            return redirect()->route('purchases.index')->with('success', 'Compra cadastrada com sucesso!');
        } else {
            session()->flash('error-message', 'Erro ao cadastrar compra!');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchases.show', ['purchase' => $purchase]);
    }

    public function peopleShow()
    {
        $people = Purchase::orderBy('person_id')->get();
        return view('purchases.people', ['people' => $people]);
    }

    public function productsShow()
    {
        $products = Purchase::orderBy('product_id')->get();
        return view('purchases.products', ['products' => $products]);
    }

    public function dateShow()
    {
        $purchases = Purchase::orderBy('created_at')->get();
        return view('purchases.date', ['purchases' => $purchases]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $people = Person::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        return view('purchases.edit', ['purchase' => $purchase, 'people' => $people, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchasesRequest  $request
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchasesRequest $request, Purchase $purchase)
    {
        $purchase->fill($request->all());
        if ($purchase->save()) {
            return redirect()->route('purchases.index')->with('success', 'Compra atualizada com sucesso!');
        } else {
            session()->flash('error-message', 'Erro ao atualizar compra!');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        if ($purchase->delete()) {
            return redirect()->route('purchases.index')->with('success', 'Compra excluída com sucesso!');
        } else {
            session()->flash('error-message', 'Erro ao excluir compra!');
            return back()->withInput();
        }
    }
}
