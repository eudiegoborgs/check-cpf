<?php

namespace App\Http\Controllers;

use App\BlackList;
use App\CPF;
use Illuminate\Http\Request;

class BlackListController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'results' => BlackList::orderBy('id')->pluck('cpf', 'id')
        ]);
    }
    public function checkCpf(Request $request)
    {
        if (!$request->has('cpf')) {
            abort(422, 'CPF não informado em sua consulta.');
        }

        $cpf = new CPF($request->input('cpf'));

        if (!$cpf->isValidCPF()) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'O CPF informado é invalido.'
            ]);
        }

        if ($cpf->inBlackList()) {
            return response()->json([
                'status'    => 'danger',
                'message'   => 'O CPF informado está cadastrado em nossa black list.'
            ]);
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'O CPF informado não está cadastrado em nossa black list.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('cpf')) {
            abort(422, 'CPF não informado em sua consulta.');
        }

        $cpf = new CPF($request->input('cpf'));

        if (!$cpf->isValidCPF()) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'O CPF informado é invalido.'
            ]);
        }

        $data = $cpf->insertInBlackList();

        return response()->json([
            'status'    => 'success',
            'message'   => 'CPF informado inserido com sucesso.',
            'created'   => true,
            'data'      => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\string  $cpf
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $cpf = null)
    {
        if (!$cpf) {
            abort(422, 'CPF não informado em sua consulta.');
        }

        $cpf = new CPF($cpf);
        $item = $cpf->inBlackList();
        if ($item) {
            $item->delete();
            return response()->json([
                'status'    => 'success',
                'message'   => 'O CPF foi removido da black list.'
            ]);
        }

        return response()->json([
            'status'    => 'error',
            'message'   => 'O CPF informado não existe na black list.'
        ]);
    }
}
