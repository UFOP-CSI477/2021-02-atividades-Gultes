<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Equipamento, Registro};

class EquipamentoController extends Controller
{
    public function index()
    {
        $equipamentos = Equipamento::orderBy('nome')->get();
        $registros = Registro::with('equipamento', 'user')->orderBy('data_limite')->get();

        return view('index', ['equipamentos' => $equipamentos, 'registros' => $registros]);
    }

    public function equipamentosAdm()
    {
        $equipamentos = Equipamento::with('registros')->get();
        return view('equipamento.index', ['equipamentos' => $equipamentos]);
    }

    public function create()
    {
        return view('equipamento.create');
    }

    public function store(Request $request)
    {
        try {
            Equipamento::create([
                'nome' => $request->nome
            ]);

            $request->session()->flash('success', 'Equipamento cadastrado com sucesso.');
            return redirect()->route('sistema.equipamento.index');
        } catch (\Throwable $th) {
            report($th);
            $request->session()->flash('error', 'Erro ao cadastrar equipamento.');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('equipamento.edit', ['equipamento' => $equipamento]);
    }

    public function update(Request $request, $id)
    {
        try {
            Equipamento::findOrFail($id)->update([
                'nome' => $request->nome,
            ]);
            $request->session()->flash('success', 'Equipamento atualizado com sucesso.');
            return redirect()->route('sistema.equipamento.index');
        } catch (\Throwable $th) {
            report($th);
            $request->session()->flash('error', 'Erro ao atualzar equipamento.');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        try {
            $equipamento = Equipamento::findOrFail($request->id);
            if (count($equipamento->registros) > 0) {
                $request->session()->flash('warning', 'Este equipamento não pode ser deletado, pois possui registros.');
                return redirect()->back();
            }
            $equipamento->delete();
            $request->session()->flash('success', 'Equipamento deletado com sucesso.');
            return redirect()->route('sistema.equipamento.index');
        } catch (\Throwable $th) {
            report($th);
            $request->session()->flash('error', 'Erro ao deletar equipamento.');
            return redirect()->back();
        }
    }
}
