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
                                    <a href="'.BASE.'/pagina/cardapio/'.getCardapio($porcoesRands['id_pai'], 'url').'" title="{{$item->titulo}}">
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
                
            
            <!-- BUSCA OS IMÓVEIS NO ALUGUÉIS UBATUBA -->  
            <?php
            // $readImoveis = read2('imoveis',"WHERE status = '1' ORDER BY RAND() LIMIT 3");
            // foreach($readImoveis as $imovel);
            // if($imovel){
            //     echo '<div class="title">';
            //     echo '<h2>Locação Para Temporada</h2>';
            //     echo '</div>';
                
            //     echo '<div class="row-fluid">';
            //     echo '<div class="banner" style="margin-top: 0px;">';
            //     foreach($readImoveis as $imoveis):
            //         echo '<div class="span4">';
            //         echo '<div class="image_hover">';
            //         echo '<a target="_blank" href="https://alugueisubatuba.com.br/pagina/imovel/'.$imoveis['url'].'">';
            //         if($imovel['img'] == ''){
            //         echo '<img src="'.PATCH.'/images/image.jpg&w=370&h=260&q=100&zc=1" alt="'.$imoveis['nome'].'" />';
            //         }else{
            //         echo '<img src="https://alugueisubatuba.com.br/tim.php?src=https://alugueisubatuba.com.br/uploads/imoveis/'.$imoveis['img'].'&w=370&h=260&q=100&zc=1" alt="'.$imoveis['nome'].'" />';
            //         }
            //         echo '</a>';
            //         echo '<div class="info_hover">';
            //         echo '<div class="text_hover">';
            //         echo '<h3>'.$imoveis['nome'].'</h3>';
            //         echo '<p>bulum molestie lacunean nonumm ... </p>';
            //         echo '<a target="_blank" href="https://alugueisubatuba.com.br/pagina/imovel/'.$imoveis['url'].'" class="button">+ detalhes</a>';
            //         echo '</div>';
            //         echo '</div>';
            //         echo '</div>';
            //         echo '</div>';
            //     endforeach;
            //     echo '</div>';
            //     echo '</div>';
                
            //     echo '<div class="clearfix"></div>';
                
            //     echo '<!-- divisor -->';
            //     echo '<div class="divisor">';
            //     echo '<div class="circle_left"></div>';
            //     echo '<div class="circle_right"></div>';
            //     echo '</div>';
            //     echo '<!-- divisor -->';
            // }else{
            //     echo '';
            // }
            ?>
            
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