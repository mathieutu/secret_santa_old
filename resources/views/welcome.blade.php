@extends('layout')
@section('content')
    <div class="message">
        <p>
            Salut à toi, jeune Neoxien ! <br>
            Pour ce Noël 2016, ta toute dévouée team Web t'a fait un petit cadeau bien spécial... <br>
            Te donner la possibilité d'en recevoir !
        </p>
        <p>As tu été sage ?</p>
    </div>

    <div class="center">
        <a href="{{ route('register') }}" class="btn">
            <span class="icn-gift"></span>
            Oui, et je veux participer !
        </a>
    </div>
@endsection
