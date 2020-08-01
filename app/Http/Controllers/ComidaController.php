<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comida;

class ComidaController extends Controller
{
    // O método index retorna a view comidas.blade.php
    public function index() {
        // É dado um select para cada tipo de comida, com seus valores armazenados em variáveis distintas
        $comidaAlemanha = Comida::where('nacionalidade_comida', '=', 'alemanha')->get();
        $comidaItalia = Comida::where('nacionalidade_comida', '=', 'italia')->get();
        $comidaJapao = Comida::where('nacionalidade_comida', '=', 'japao')->get();

        // Esse if checa se o restaurante ainda está em horário de funcionamento. Se sim, a view é retornada
        if(date('H:i:s') > "23:00" && date('H:i:s') < "05:00") {
            return redirect()->route('fechado');
        }else {
            //O subtítulo da página, jutamente às variáveis de cada comida são passados para a view no compact
            $subtitulo = "- Comidas";
            return view('comidas', compact('comidaAlemanha', 'comidaItalia', 'comidaJapao', 'subtitulo'));
        }
    }

    // Esse método retorna a view comidas_create.blade.php. É nela que dá pra inserir comidas com imagem e tudo
    public function create() {
        $subtitulo = "- Create";
        return view('comidas_create', compact('subtitulo'));
    }

    // Esse é o método que realiza o cadastro da comida no banco dados, efetivamente
    public function store(Request $req) {
        $this->validate($req, [
            'nome_comida' => 'required',
            'preco_comida' => 'required|numeric',
            'imagem_comida' => 'required',
            'descricao_comida' => 'required',
            'nacionalidade_comida' => 'required'
        ], [
            'preco_comida.numeric' => "Preencha o preço apenas com números."
        ]);

        // A imagem não é salva diretamente no banco, mas sim numa pasta, e o caminho da imagem que é
        // armazenado no banco de dados.
        if($req->hasFile('imagem_comida')) {
            $imagem = $req->file('imagem_comida');
            $num = rand(1111,9999);
            $dir = "img/comidas";
            $extension = $imagem->guessClientExtension();
            $nomeImagem = "imagem_comida_" . $num . "." . $extension;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem_comida'] = $dir . "/" . $nomeImagem;
        }

        // Vcs já sabem como isso funciona é nós.
        $comida = new Comida;
        $comida->nome_comida = $req->nome_comida;
        $comida->preco_comida = $req->preco_comida;
        $comida->imagem_comida = $dados['imagem_comida'];
        $comida->descricao_comida = $req->descricao_comida;
        $comida->nacionalidade_comida = $req->nacionalidade_comida;

        $comida->save();
        // Após a comida ser salvada, a página é recarregada para facilitar a inserção de uma nova
        return redirect(route('comida_create')-with('msgSucesso,', 'Comida cadastrada.'));
    }
}
