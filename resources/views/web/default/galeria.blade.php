@extends("web.{$configuracoes->template}.master.master")

@section('content')
    <div class="container main_content">        
        <div class="divisor">
            <div class="circle_left"></div>
            <span class="shadow_divisor"></span>
            <div class="circle_right"></div>
        </div>
        <div class="title">
            <h2>{{$galeria->titulo}}</h2>
        </div>
    </div>

    <div class="row-fluid comfundo" style="padding-bottom: 50px;padding-top: 20px;">
        <div class="container main_content" style="padding-bottom: 50px;padding-top: 20px;">
            @if ($galeria->images()->get()->count())
                <div class="row-fluid">
                    <div class="gallery">
                        @php $i = 0; @endphp
                        @foreach ($galeria->images()->get() as $gb)
                        @php if($i == 6){echo '</div></div><div class="row-fluid"><div class="gallery">';} @endphp
                            <div class="span2" style="margin-bottom: 20px;">
                                <a class="fancybox" title="{{$galeria->titulo}}" href="{{ $gb->url_image }}" >
                                    <img src="{{ $gb->url_image }}" alt="{{$galeria->titulo}}"/>
                                </a>
                            </div>
                        @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            @else
                <div class="container"><br />
                    <div class="alert alert-danger">
                        Desculpe, não existem fotos cadastradas nessa Galeria :(
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('css')
    <style>
        
    </style>
@endsection