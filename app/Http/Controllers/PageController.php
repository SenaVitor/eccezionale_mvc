<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactEmail as ContactEmail;

class PageController extends Controller {

    // Função para retornar a view de Contato com seu subtítulo
    public function getContact()
    {
        $subtitulo = "- Contato";
        return view('contact', compact('subtitulo'));
    }

    // Função para salvar no banco a mensagem do usuário
    public function postContact(Request $request)
    {    
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message'=>'required'
         ], [
             'name.required' => "Por favor, insira seu nome.",
             'email.required' => "Por favor, insira um e-mail.",
             'email.email' => "Por favor, insira um e-mail válido!",
             'message' => "Por favor, insira uma mensagem."
         ]);

      ContactEmail::create($request->all());
      // É enviada uma notificação para a página de contato, que é exibida dentro de uma div
       $notification = array(
            'message' => 'Obrigado! Entraremos em contato em breve.', 
            'alert-type' => 'success'
        );
       return redirect()->back()->with($notification);
    }
}
