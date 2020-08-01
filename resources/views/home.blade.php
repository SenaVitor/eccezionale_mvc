@extends('layout.main')

@section('css-home')
<!-- Fontes -->
<link
    href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Playfair+Display:400,400i,700,700i,900,900i"
    rel="stylesheet">
<!-- Arquivo css -->
<link href="{{ asset('/css/styleHome.css') }}" rel="stylesheet">
<!-- Outras coisas para o código funcionar -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
@endsection

@section('content')
<!-- Header -->
<div id="header" class="container-fluid">
    <div class="row justify-content-center text-white">
        <div class="col-12 text-center py-3">
            <h2 class="fonteNegrito">O Único</h2>
            <h1 class="restaurante">Restaurante</h1>
            <p class="fonteNegrito">ITALIANO | JAPONÊS | ALEMÃO</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <a href="{{ route('comida') }}" style="border: none"><button type="button"
                            class="btn btn-warning ">Faça seu pedido</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header -->

<!-- Sobre -->
<div id="about" class="py-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4 col-12">
                <div class="div-img-bg">
                    <div class="about-img">
                        <img src="{{ asset('img/mobral.png') }}" class="img-responsive" alt="me">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12 pt-3 pt-lg-0">
                <div class="about-title text-center">
                    <p class="restaurante h1">Sobre o restaurante</p>
                </div>

                <div class="about-descr">
                    <h3 class="p-heading py-2">"O restaurante ideal para os mais variados gostos e interesses, desde
                        reservas
                        até entregas na porta da sua casa!"</h3>
                    <p class="p-heading">O restaurante Eccezionale MVC foi inaugurado em 2020, com apoio de diferentes
                        entusiastas alemães, italianos e japoneses. Ele se propõe a oferecer as mais variadas comidas
                        para quem estiver disposto a nos dar uma chance!</p>
                    <p class="p-heading">Conta com uma equipe dos melhores cozinheiros de cada país, e cardápios de dar
                        água na boca, além
                        de um ambiente agradável e bonito, mesclando o que há de melhor em cada cultura.</p>
                </div>

                <img src="{{ asset('/img/stars.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<!-- Sobre -->

<!-- Serviços -->
<div id="services">
    <div class="container">
        <div class="services-titulo text-center">
            <p class="restaurante h1" style="color: grey;"> Nossos Serviços</p>
        </div>
    </div>

    <div class="box">
        <div class="container">
            <div class="row text-white">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="box-part-1 text-center">
                        <i class="fa fa-credit-card fa-3x" aria-hidden="true"></i>
                        <div class="title">
                            <h3>Econômicos</h4>
                        </div>
                        <div class="text">
                            <span>Nosso restaurante oferece opções variadas de menu, possibilitando desde pratos
                                sofisticados à pratos convencionais, agradando a qualquer tipo de gosto e bolso.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="box-part-2 text-center">
                        <i class="fa fa-umbrella fa-3x" aria-hidden="true"></i>
                        <div class="title">
                            <h3>Acessíveis</h4>
                        </div>
                        <div class="text">
                            <span>Aqui você pode degustar de um bom café da manhã e um maravilhoso jantar à noite. Temos
                                serviços de entrega de 5h as 23h , além de reservas com mesas de sua escolha.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="box-part-3 text-center">
                        <i class="fas fa-drumstick-bite fa-3x"></i>
                        <div class="title">
                            <h3>Saborosos</h4>
                        </div>
                        <div class="text">
                            <span>Contamos com os melhores ingredientes dos principais mercados do país, para que você
                                possa ter a melhor experiência possível ao degustar os pratos de nosso
                                restaurante.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="box-part-4 text-center">
                        <i class="fa fa-id-card fa-3x" aria-hidden="true"></i>
                        <br>
                        <div class="title">
                            <h3>Referenciados</h4>
                        </div>
                        <div class="text">
                            <span>Aqui no Eccezionale MVC, o delivery é pago no ato da entrega, e as reservas são pagas
                                em dinheiro ou cartão apenas ao fim da refeição, visando a sua aprovação.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Serviços-->

<!-- Cozinheiros -->
<div id="journal" class="text-left">

    <p class="restaurante h1 text-center pt-3 pb-2 text-white">Nossos Chefs</p>
    <div class="container">
        <div class="journal-block">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="journal-info">
                        <a href="https://github.com/Andrew-2609"><img
                                src="{{ asset('img/chef2.jpg') }}" class="img-responsive"
                                alt="img"></a>
                        <div class="journal-txt">
                            <a href="https://github.com/Andrew-2609" class="nomesLinks" target="_blank">
                                <h4 class="pt-2">ANDREW MÜLLER</h4>
                            </a>
                            <p class="separator">Um renomado cozinheiro de origem alemã, sempre disposto a produzir
                                novas comidas e aprimorar as favoritas de nossos clientes. Nascido em Munique, cozinha
                                desde a infância e ganhou duas vezes o prêmio "Koch des Jahres" (Cozinheiro do Ano) em
                                Berlim.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="journal-info">
                        <a href="#"><img src="{{ asset('img/chef3.jpg') }}" class="img-responsive"
                                alt="img"></a>
                        <div class="journal-txt">
                            <a href="#" class="nomesLinks" target="_blank">
                                <h4 class="pt-2">HERBERTO RICARDO</h4>
                            </a>
                            <p class="separator">Considerado o melhor cozinheiro italiano da década, Herberto Ricardo
                                aceitou juntar-se ao nosso elenco de cozinheiros, prometendo trazer o que há de melhor
                                da culinária italiana para quaisquer clientes de nosso restaurante, juntamente aos seus
                                fiéis assistentes.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="journal-info">
                        <a href="#"><img src="{{ asset('img/chef1.jpg') }}" class="img-responsive"
                                alt="img"></a>
                        <div class="journal-txt">
                            <a href="#" class="nomesLinks" target="_blank">
                                <h4 class="pt-2">VIDARU SEN</h4>
                            </a>
                            <p class="separator">Vidaru Sen é, sem dúvida, nosso mais experiente Chef. Sua culinária de
                                origem japonesa já conquistou todo o continente asiático, e hoje ele está em busca de um
                                desafio: alegrar os clientes do Eccezionale MVC com a melhor culinária japonesa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Cozinheiros-->
@endsection
