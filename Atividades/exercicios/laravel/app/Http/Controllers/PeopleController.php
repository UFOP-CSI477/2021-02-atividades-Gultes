<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;
use App\Models\City;
use App\Models\Person;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::orderBy('id')->get();
        return view('people.index', ['people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('people.create', ['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePeopleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleRequest $request)
    {
        if (Person::create($request->all())) {
            return redirect()->route('people.index')->with('success', 'Pessoa cadastrada com sucesso!');
        } else {
            session()->flash('error-message', 'Erro ao cadastrar pessoa!');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('people.show', ['person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $cities = City::orderBy('name')->get();
        return view('people.edit', ['person' => $person, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleRequest  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleRequest $request, Person $person)
    {
        $person->fill($request->all());
        if ($person->save()) {
            return redirect()->route('people.index')->with('success', 'Pessoa atualizada com sucesso!');
        } else {
            session()->flash('error-message', 'Erro ao atualizar pessoa!');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        if ($person->delete()) {
            return redirect()->route('people.index')->with('success', 'Pessoa excluída com sucesso!');
        } else {
            session()->flash('error-message', 'Erro ao excluir pessoa!');
            return back()->withInput();
        }
    }
}
