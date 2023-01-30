@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section id="inicio">
    <div class="container main_content">
        @if (!empty($slides) && $slides->count() > 0)
            <div class="row-fluid">
                <div class="shadow">
                    <div class="camera_wrap" id="slide">
                        @foreach ($slides as $key => $slide)  
                            <div  data-src="{{$slide->getimagem()}}"></div>                            
                        @endforeach 
                    </div> 
                </div> 
            </div>          
        @endif
    </div>

    <div class="row-fluid comfundo">
        <div class="container main_content" style="padding-bottom: 50px;padding-top: 20px;">
            @if (!empty($cardapio) && $cardapio->count() > 0)
                <div class="row-fluid">
                    <div class="more_info">
                        <div class="span12">
                            <h2>Porções e Drinks</h2>
                            <div class="row-fluid img_decoration">
                                @foreach ($cardapio as $item)
                                <div class="span2 gallery">
                                    <a href="{{route('web.cardapio', ['categoria' => $item->categoriaObject->slug])}}" title="{{$item->titulo}}">
                                        <img src="{{$item->cover()}}" alt="{{$item->titulo}}"/>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div> 
                <div class="divisor"><div class="circle_left"></div><div class="circle_right"></div></div>
            @endif            
                
            
            {{-- BUSCA OS IMÓVEIS NO ALUGUÉIS UBATUBA --}}            
            @if (!empty($imoveis) && count($imoveis) > 0)
                <div class="title">
                    <h2>Locação Para Temporada</h2>
                </div>

                <div class="row-fluid">
                    <div class="banner" style="margin-top: 0px;">
                        @foreach ($imoveis as $key => $imovel)
                            @if ($key <= 2)
                                <div class="span4">
                                    <div class="image_hover">
                                        <a target="_blank" href="{{$imovel['url']}}">
                                            <img src="{{$imovel['thumb']}}" alt="{{$imovel['titulo']}}" />
                                        </a>
                                        <div class="info_hover">
                                            <div class="text_hover">
                                                <h3>{{$imovel['titulo']}}</h3>
                                                <p>{{\App\Helpers\Renato::Words($imovel['content'], 12)}}</p>
                                                <a target="_blank" href="{{$imovel['url']}}" class="button">+ detalhes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif                            
                        @endforeach
                    </div>
                </div>
                <div class="clearfix"></div>

            @endif  
            
        </div>    
    </div> 


































</section>

@endsection

@section('css')
    
@endsection

@section('js')
<script src="{{url(asset('backend/assets/js/jquery.mask.js'))}}"></script>
<script>

    $(document).ready(function () { 
        var $whatsapp = $(".whatsapp");
        $whatsapp.mask('(99) 99999-9999', {reverse: false});
    });

    $(function () {

        $('.modalcadastro').click(function (){
            $('.dialog').css('display','block');
        });
        
        $('.btnfechar').click(function (){
            $('.dialog').modal().hide();
        });
    });
   
</script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=1787040554899561";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>  
@endsection