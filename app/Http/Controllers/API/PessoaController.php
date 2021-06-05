<?php

namespace App\Http\Controllers\API;

use App\API\Apierror;
use App\Pessoa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    private $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    public function index()
    {
        $data = ['data' => $this->pessoa->paginate(10)];

        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {

            $pessoaData = $request->all();
            $this->pessoa->create($pessoaData);

            $retorno = ['data' => ['msg' => 'Criado com Sucesso!']];
            return response()->json($retorno, 201);

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010 , 500));

            }
            return response()->json(ApiError::errorMessage('Houve um erro ao criar!', 1010, 500));

        }
    }

    public function show($id)
    {
        $pessoa = $this->pessoa->find($id);        // faz a busca no banco.
        if(! $pessoa)                              // se nao encontar retorna uma mensagem e nao pagina de erro 404.
            return response()->json(ApiError::errorMessage('Pessoa não encontrado!', 4040), 404); // status 4040 para erros internos da aplicação.

        $data = ['data' => $pessoa];
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        try {

            $pessoaData = $request->all();
            $pessoa = $this->pessoa->find($id);
            $pessoa->update($pessoaData);

            $retorno = ['data' => ['msg' => 'Atualizado com sucesso!']];
            return response()->json($retorno, 201);

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012, 500)); // retorna o codigo de erro internos da aplicação.

            }
            return response()->json(ApiError::errorMessage('Houve um erro', 1012, 500));

        }
    }

    public function destroy($id)
    {
        try {
            $id->delete();

            return response()->json(['data' => ['msg' => 'Removido com sucesso! ']], 200);

        } catch (\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010, 500)); // retorna o codigo de erro internos da aplicação.

            }
            return response()->json(ApiError::errorMessage('Houve um erro ao excluir!', 1012, 500));
        }
    }
}
