@extends("web.{$configuracoes->template}.master.master")

@section('content')
    <div class="container main_content">        
        <div class="divisor">
            <div class="circle_left"></div>
            <span class="shadow_divisor"></span>
            <div class="circle_right"></div>
        </div>
        <div class="title">
            <h2>{{$categoria->titulo}}</h2>
        </div>
    </div>

    
@endsection

@section('css')
    <style>
        
    </style>
@endsection