<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Carrinho;
use App\Comida;
use App\Delivery;
use App\DeliveryItem;

class CarrinhoController extends Controller
{
    // Essa função adiciona as comidas no carrinho sem que a página de Comidas seja atualizada, utilizando funções do Laravel
    public function adicionarAoCarrinho(Request $request) {
        // Validação dos dados
        $this->validate($request, [
            'idComida' => ['required', Rule::unique('carrinho', 'id_comida')->where(function($query) {
                $query->where('id_user', '=', Auth::user()->id);
            })],
            'quantidadeComida' => ['required', 'numeric', 'integer']
        ], [
            // Aqui são definidas mensagens personalizadas, dependendo do tipo de erro na validação
            'idComida.unique' => 'Essa comida já está no seu carrinho!',
            'quantidadeComida.required' => "Por favor, informe uma quantidade.",
            'quantidadeComida.numeric' => "Por favor, preencha apenas com números.",
            'quantidadeComida.integer' => "Por favor, insira apenas valores inteiros."
        ]);

        $carrinho = new Carrinho;
        $carrinho->id_user = Auth::user()->id;
        $carrinho->id_comida = $request->idComida;
        $carrinho->quantidade_delivery = $request->quantidadeComida;

        $carrinho->save();
        // É dado um POST no Carrinho, mas a página de Comidas não é atualizada
        return response()->json($request->all());
    }

    // Função que retorna a view do Carrinho, com os registros do usuário logado
    public function verCarrinho() {
        $id = Auth::user()->id;
        $carrinho = Carrinho::where('id_user', '=', $id)->get();

        // Essa função faz com que a página já carregue com o total a ser pago dentro de uma variável $total
        $total = $carrinho->reduce(function ($carry, $item) {
            $carry += $item->quantidade_delivery * $item->comida->preco_comida;

            return $carry;
        }, 0);

        // Esse if verifica se o restaurante ainda está em seu horário de funcionamento, e se estiver, permite
        // olhar o carrinho
        if(date('H:i:s') > "23:00" && date('H:i:s') < "05:00") {
            return redirect()->route('fechado');
        } else {
            // Tanto o $carrinho como o $carry (preço total) são retornados juntos à view usando o compact,
            // além do subtítulo da página.
            $subtitulo = "- Carrinho";
            return view('carrinho', compact('carrinho', 'total', 'subtitulo'));
        }
    }

    // Essa função é responsável por várias coisas, dentre elas:
    // Salvar a comida do carrinho do usuário na tabela de delivery
    // Salvar os dados de cada comida do delivery individualmente na tabela de delivery_item
    // Excluir o registro do carrinho, já que ele já foi enviado para entrega
    public function encomendar(Request $request) {
        $this->validate($request, [
            'cep' => 'required',
            'numero' => 'required',
            'quantidade_delivery' => 'integer'
        ], [
            'cep.required' => 'Por favor, informe o CEP.',
            'numero.required' => 'Por favor, informe o número.'
        ]);

        // O DB::transaction é um método do Laravel para facilitar as ações do CRUD
        // possibilitando a realização de diversas delas de uma vez
        DB::transaction(function () use ($request) {
            $delivery = new Delivery;
            $delivery->id_user = Auth::user()->id;
            $delivery->cep_delivery = $request->cep;
            $delivery->numero_delivery = $request->numero;
            $delivery->complemento_delivery = $request->complemento;
            // É pego o momento exato da compra para ser inserido na tabela de delivery
            $delivery->data_entrega = date('Y-m-d H:i:s');
            $delivery->preco_total = $request->preco_total + 5;

            // O delivery é salvo, mas logo em seguida será usado na tabela delivery_item
            $delivery->save();

            // Cada registro do carrinho é deletado, e inserido na tabela de delivery_item
            foreach($request->carrinho as $item) {
                // Deleção do carrinho
                Carrinho::where('id_user', '=', Auth::user()->id)->where('id_comida', '=', $item['id_comida'])->delete();
                $delivery_item = new DeliveryItem;
                $delivery_item->id_delivery = $delivery->id_delivery;
                // A comida que estava no Carrinho é passada para a DeliveryItem
                $delivery_item->id_comida = $item['id_comida'];
                $delivery_item->quantidade_delivery = $item['quantidade_delivery'];
                // O preço da comida é encontrado pelo ID da comida que estava presente no Carrinho
                $delivery_item->preco_comida = Comida::find($item['id_comida'])->preco_comida;

                // Inserção no delivery_item
                $delivery_item->save();
            }
        });
        // No fim do processo, o usuário é redirecionado para a página de Delivery com uma mensagem de sucesso
        return redirect()->route('comida')->with('msgSucesso', 'Comida encomendada com sucesso!');
    }

    // Essa função é responsável por tirar a comida do carrinho sem que a página recarregue
    public function retirarComida(Request $request) {
        $idComida = $request->idComida;
        // A comida a ser retirada é encontrada pelo seu ID, e pelo ID do usuário logado
        // Como é um registro único, é usado no fim a função "first" do Laravel
        $registro = Carrinho::where('id_comida', '=', $idComida)->where('id_user', '=', Auth::user()->id)->first();

        // O registro em questão é deletado
        $registro->delete();

        // A página retorna o resultado, mas sem ser atualizada
        return response()->json($request->all());
    }
}
