@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section id="inicio">
    <div class="container main_content">
    
        <!-- Header -->
       <div class="row-fluid">            
            <div class="info_place">
                <div class="span4">
                    <ul class="social">
                        @if ($configuracoes->facebook)
                            <li><a target="_blank" href="{{$configuracoes->facebook}}" title="Facebook"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/facebook.png')}}" alt="Facebook" /></a>
                        @endif
                        @if ($configuracoes->twitter)
                            <li><a target="_blank" href="{{$configuracoes->twitter}}" title="Twitter"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/twitter.png')}}" alt="Twitter" /></a>
                        @endif
                        @if ($configuracoes->instagram)
                            <li><a target="_blank" href="{{$configuracoes->instagram}}" title="Instagram"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/instagram.png')}}" alt="Instagram" /></a>
                        @endif
                        @if ($configuracoes->linkedin)
                            <li><a target="_blank" href="{{$configuracoes->linkedin}}" title="linkedin"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/linkedin.png')}}" alt="linkedin" /></a>
                        @endif
                        @if ($configuracoes->youtube)
                            <li><a target="_blank" href="{{$configuracoes->youtube}}" title="Youtube"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/youtube.png')}}" alt="Youtube" /></a>
                        @endif
                    </ul>
                </div>
                <div class="span4 logo">
                    <a href="{{route('web.home')}}">
                        <img src="{{$configuracoes->getLogomarca()}}" alt="{{$configuracoes->nomedosite}}"/>
                    </a>                    
                </div>
                <div class="span4">                    
                    @if($configuracoes->telefone1)
                        <div class="phone">
                            <p>Atendimento: <span class="color">{{$configuracoes->telefone1}}</span></p>
                            @if($configuracoes->rua)
                                <p style="font-size:14px;">
                                    {{$configuracoes->rua}}
                                    @if($configuracoes->num)
                                        , {{$configuracoes->num}}
                                    @endif
                                    @if($configuracoes->complemento)
                                        <br /> {{$configuracoes->complemento}}
                                    @endif
                                    @if($configuracoes->bairro)
                                        , {{$configuracoes->bairro}}
                                    @endif
                                    @if($configuracoes->cidade)  
                                        - {{\App\Helpers\Cidade::getCidadeNome($configuracoes->cidade, 'cidades')}}
                                    @endif
                                </p>                            
                            @endif                            
                        </div> 
                    @endif                    
                </div>
            </div>       
       </div>
       <!-- Header -->
       
        @if (!empty($slides) && $slides->count() > 0)
            <div class="row-fluid">
                <div class="row-fluid">
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
            <!-- PORÇÕES E DRINKS -->
            <?php
            // $readPorcoesRand = read('cardapio',"WHERE exibir = '1' AND id_pai IS NOT NULL ORDER BY RAND() LIMIT 6");
            // foreach($readPorcoesRand as $porcoesRand);
            // if($porcoesRand){
            //     echo '<div class="row-fluid">';
            //     echo '<div class="more_info">';
            //     echo '<div class="span12">';
            //     echo '<h2>Porções e Drinks</h2>';
            //     echo '<div class="row-fluid img_decoration">';
            //     foreach($readPorcoesRand as $porcoesRands):
            //     if($porcoesRands['img'] == ''){
            //     echo '<div class="span2"><a href="'.BASE.'/pagina/cardapio/'.getCardapio($porcoesRands['id_pai'], 'url').'"><img src="'.BASE.'/tim.php?src='.PATCH.'/images/image.jpg&w=770&h=511&q=100&zc=1" alt="'.$porcoesRands['nome'].'" /></a></div>';
            //     }else{
            //     echo '<div class="span2"><a href="'.BASE.'/pagina/cardapio/'.getCardapio($porcoesRands['id_pai'], 'url').'"><img src="'.BASE.'/tim.php?src='.BASE.'/uploads/cardapio/'.$porcoesRands['img'].'&w=770&h=511&q=100&zc=1" alt="'.$porcoesRands['nome'].'"/></a></div>';
            //     }
            //     endforeach;
            //     echo '</div>';
            //     echo '<div class="clearfix"></div>';
            //     echo '</div>';
            //     echo '</div>';
            //     echo '</div>';
                
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