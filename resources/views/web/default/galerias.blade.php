@extends("web.{$configuracoes->template}.master.master")

@section('content')
    <div class="container main_content">        
        <div class="divisor">
            <div class="circle_left"></div>
            <span class="shadow_divisor"></span>
            <div class="circle_right"></div>
        </div>
        <div class="title">
            <h2>Galeria de Fotos</h2>
        </div>
    </div>
    
    <div class="row-fluid comfundo" style="padding-bottom: 50px;padding-top: 20px;">
        <div class="container main_content" style="padding-bottom: 50px;padding-top: 20px;">
            @if (!empty($galerias) && $galerias->count() > 0)
                <div class="row-fluid">
                    <div class="">
                        @foreach ($galerias as $galeria)
                            <div class="span4">
                                <div class="image_hover" style="border: 6px solid #fff; box-shadow: 0px 0px 2px rgba(0,0,0,0.5);">
                                    <a title="{{$galeria->titulo}}" href="{{route('web.galeria',['slug' => $galeria->slug])}}">
                                        <img class="img" src="{{$galeria->cover()}}" alt="{{$galeria->titulo}}" />
                                    </a>
                                    <div class="info_hover">
                                        <div class="text_hover">
                                            <h3>{{$galeria->titulo}}</h3>
                                            <p>&nbsp;</p>
                                            <a title="{{$galeria->titulo}}" href="{{route('web.galeria',['slug' => $galeria->slug])}}" class="button">+ Ver as Fotos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endif                   
        </div>            
    </div>
@endsection

@section('css')
    <style>
        .img{
            width: 358px !important;
            height: 241px !important;
        }
    </style>
@endsection