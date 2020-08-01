<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\Mesa;
use DateTime;
use Illuminate\Validation\Rule;

class ReservaController extends Controller
{
    public function index() {
        
        DB::table('mesas')->whereNotExists(function ($query) {
            $query->select(DB::raw(1))->from('reservas')->whereRaw('mesas.id_mesa = id_mesa')->whereRaw('data_reserva > timestampadd(hour, -3, now())');
        })->update([
            'reservada' => false
        ]);
        
        $mesa = Mesa::orderby('qtd_cadeiras', 'asc')->orderby('tipo_mesa')->get();
        $reserva_marcada = Reserva::where('id_user','=', Auth::user()->id)->where('data_reserva', '>=', date('Y-m-d H:i:s'))->get();
        $dataAtual = date('d-m-Y');
        $mesaReservada = Mesa::where('reservada', '=', '1')->get(); 
        $reservasParaTabela = Reserva::where('data_reserva', '>=', date('Y-m-d H:i:s'))->orderby('id_mesa', 'asc')->get();

        return view('reservas', compact('mesa', 'reserva_marcada', 'dataAtual', 'reservasParaTabela', 'mesaReservada'));
    }

    public function store(Request $req) {
        $this->validate($req, [
            'cpf' => 'required',
            'mesa' => [
                'required',
                Rule::unique('reservas', 'id_mesa')->where(function ($query) use ($req) {
                    $query->where('data_reserva', '=', $req->data_reserva);
                })
            ],
            'data_reserva' => 'required|date|after:' . date('Y-m-d H:i:s'),
            'data_reserva' => 'before:' . date('Y-m-d', strtotime('+2 Years')) . 'T23:00:00'
        ], [
            'cpf.required' => 'Por favor, insira seu CPF.',
            'mesa.required' => 'Por favor, informe a mesa que você quer.',
            'data_reserva.required' => 'Por favor, preencha o campo da data da reserva.',
            'data_reserva.date' => 'Por favor, insira uma data coerente.',
            'data_reserva.after' => 'Você está tentando marcar a reserva para um horário que já passou.',
            'data_reserva.before' => 'Você está tentando marcar uma reserva para depois do prazo máximo!'
        ]);

        $hora = explode('T', $req->data_reserva)[1];
        if($hora < '10:00') {
            return redirect()->route('reserva')->with('horaMenor', 'Reservas apenas a partir das 10h e até 00:00!');
        }
        
        // Registrando os dados da reserva no banco de dados.
        $reservas = new Reserva;
        $reservas->id_user = Auth::user()->id;
        $reservas->cpf_user = $req->cpf;
        $reservas->id_mesa = $req->mesa;
        $reservas->data_reserva = $req->data_reserva;
        
        $mesaCompleta = Mesa::where('id_mesa', '=', $req->mesa)->first();
        $reservas->preco_total = $mesaCompleta->preco_mesa * $mesaCompleta->qtd_cadeiras;
        $reservas->save();
       
        $mesa = Mesa::find($mesaCompleta->id_mesa);
        $mesa->reservada = 1;
        $mesa->save();
        
        // Depois de salva a reserva, há uma mensagem.
        return redirect()->route('reserva')->with('reservaRegistrada', 'erro');
    }
}