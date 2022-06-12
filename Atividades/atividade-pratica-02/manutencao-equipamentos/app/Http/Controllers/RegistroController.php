<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Registro, Equipamento};
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function index()
    {
        $registros = Registro::with('equipamento')->get();
        return view('manutencoes.index', ['registros' => $registros]);
    }

    public function relatorio()
    {
        $registros = Equipamento::whereHas('registros')->with('registros.user')->get();
        return view('manutencoes.relatorio', ['registros' => $registros]);
    }

    public function create()
    {
        $equipamentos = Equipamento::all();
        return view('manutencoes.create', ['equipamentos' => $equipamentos]);
    }

    public function store(Request $request)
    {
        try {
            Registro::create([
                'equipamento_id' => $request->equipamento_id,
                'user_id' => Auth::user()->id,
                'descricao' => $request->descricao,
                'data_limite' => $request->data_limite,
                'tipo' => $request->tipo,
            ]);
            $request->session()->flash('success', 'Registro cadastrado com sucesso.');
            return redirect()->route('sistema.registro.index');
        } catch (\Throwable $th) {
            report($th);
            $request->session()->flash('error', 'Houve um erro ao cadastrar o registro.');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $registro = Registro::where('id', $id)->with('equipamento', 'user')->firstOrFail();
        $equipamentos = Equipamento::all();
        return view('manutencoes.edit', ['registro' => $registro, 'equipamentos' => $equipamentos]);
    }

    public function update(Request $request, $id)
    {
        try {
            Registro::findOrFail($id)->update([
                'equipamento_id' => $request->equipamento_id,
                'user_id' => Auth::user()->id,
                'descricao' => $request->descricao,
                'data_limite' => $request->data_limite,
                'tipo' => $request->tipo,
            ]);
            $request->session()->flash('success', 'Registro atualizado com sucesso.');
            return redirect()->route('sistema.registro.index');
        } catch (\Throwable $th) {
            report($th);
            $request->session()->flash('error', 'Houve um erro ao atualizar o registro.');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        try {
            Registro::findOrFail($request->id)->delete();
            $request->session()->flash('success', 'Registro deletado com sucesso.');
            return redirect()->back();
        } catch (\Throwable $th) {
            report($th);
            $request->session()->flash('error', 'Houve um erro ao deletar o registro.');
            return redirect()->back();
        }
    }
}
