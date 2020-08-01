<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Função para retornar a view da Home, junto com seu subtítulo
    public function index() {
        $subtitulo = "- Home";
        return view('home', compact('subtitulo'));
    }
}
