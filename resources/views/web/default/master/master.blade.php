<!DOCTYPE html>
<html lang="pt-br">
<head>	
    <meta charset="utf-8"/>    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="language" content="pt-br" /> 
    <meta name="author" content="{{env('DESENVOLVEDOR')}}"/>
    <meta name="designer" content="Renato Montanari">
    <meta name="publisher" content="Renato Montanari">
    <meta name="url" content="{{$configuracoes->dominio}}" />
    <meta name="keywords" content="{{$configuracoes->metatags}}">
    <meta name="distribution" content="web">
    <meta name="rating" content="general">
    <meta name="date" content="Dec 26">

    {!! $head ?? '' !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" sizes="72x72" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" sizes="114x114" href="{{$configuracoes->getfaveicon()}}"/>
            
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/bootstrap/bootstrap.css')}}" rel="stylesheet" media="screen"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/bootstrap/bootstrap-responsive.css')}}" rel="stylesheet" media="screen"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/slide/camera.css')}}" rel="stylesheet" media="screen"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/slide_rotation/style.css')}}" rel="stylesheet" media="all" />      
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/renato.css')}}" rel="stylesheet" media="all" />
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/style.css')}}" rel="stylesheet" media="all" />
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/js/fancybox/jquery.fancybox.css')}}" rel="stylesheet" media="all" />
    
    <link href="https://fonts.googleapis.com/css?family=Merienda:400,700" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Italianno" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Monda" rel="stylesheet"/>
    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- styles for IE -->
    <!--[if IE 8]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
    <![endif]-->

    @hasSection('css')
        @yield('css')
    @endif
 </head>
 <body>
    <nav>
        <div class="container">
          <div class="row-fluid" style="text-align: center;">         
                <ul id="menu" class="sf-menu">
                    <li><a href="{{route('web.home')}}">Início</a></li>
                    @if (!empty($Links) && $Links->count()  > 0)                            
                        @foreach($Links as $menuItem)                            
                        <li>
                            <a {{($menuItem->target == 1 ? 'target=_blank' : '')}} href="{{($menuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($menuItem->post != null ? $menuItem->PostObject->slug : '#') ]) : $menuItem->url)}}">{{ $menuItem->titulo }}</a>
                            @if( $menuItem->children && $menuItem->parent)
                            <ul>
                                @foreach($menuItem->children as $subMenuItem)
                                <li><a {{($subMenuItem->target == 1 ? 'target=_blank' : '')}} href="{{($subMenuItem->tipo == 'Página' ? route('web.pagina', [ 'slug' => ($subMenuItem->post != null ? $subMenuItem->PostObject->slug : '#') ]) : $subMenuItem->url)}}">{{ $subMenuItem->titulo }}</a></li>                                        
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    @endif                    
                    <li><a href="{{route('web.galerias')}}" title="Galerias">Fotos</a></li>
                    <li><a href="{{route('web.atendimento')}}" title="Atendimento">Atendimento</a></li>
                </ul>
          </div>
        </div>
    </nav>   
    
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
    </div>

    <!-- INÍCIO DO CONTEÚDO DO SITE -->
    @yield('content')
    <!-- FIM DO CONTEÚDO DO SITE -->

    <footer>
        <div class="container">
            <div class="row-fluid"> 
                <div class="span5">
                    <h2>{{$configuracoes->nomedosite}}</h2>
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
                    <p>    
                        @if($configuracoes->telefone1)
                            <strong>Telefone:</strong> {{$configuracoes->telefone1}}
                            @if($configuracoes->telefone2)
                                <br /><strong>Telefone:</strong> {{$configuracoes->telefone2}}
                            @endif
                            @if($configuracoes->telefone3)
                                <br /><strong>Telefone:</strong> {{$configuracoes->telefone3}}
                            @endif                            
                        @endif
                    </p>
                    @if($configuracoes->whatsapp)
                        <p><img src="{{url('frontend/'.$configuracoes->template.'/assets/images/zapzap.png')}}" alt="WhatsApp" /> {{$configuracoes->whatsapp}}</p>
                    @endif
                    @if($configuracoes->email)
                        <p><strong>E-mail:</strong> <a href="mailto:{{$configuracoes->email}}">{{$configuracoes->email}}</a></span></p>
                    @endif 
                    @if($configuracoes->email1)
                        <p><strong>E-mail:</strong> <a href="mailto:{{$configuracoes->email1}}">{{$configuracoes->email1}}</a></span></p>
                    @endif 
                    <ul class="social">
                        @if ($configuracoes->facebook)
                            <li><a target="_blank" href="{{$configuracoes->facebook}}" title="Facebook"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/facebook.png')}}" alt="Facebook" /></a></li>
                        @endif
                        @if ($configuracoes->twitter)
                            <li><a target="_blank" href="{{$configuracoes->twitter}}" title="Twitter"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/twitter.png')}}" alt="Twitter" /></a></li>
                        @endif
                        @if ($configuracoes->instagram)
                            <li><a target="_blank" href="{{$configuracoes->instagram}}" title="Instagram"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/instagram.png')}}" alt="Instagram" /></a></li>
                        @endif
                        @if ($configuracoes->linkedin)
                            <li><a target="_blank" href="{{$configuracoes->linkedin}}" title="linkedin"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/linkedin.png')}}" alt="linkedin" /></a></li>
                        @endif
                        @if ($configuracoes->youtube)
                            <li><a target="_blank" href="{{$configuracoes->youtube}}" title="Youtube"><img width="32" src="{{url('frontend/'.$configuracoes->template.'/assets/images/social/youtube.png')}}" alt="Youtube" /></a></li>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                
                    <h2>Receba novidades no seu e-mail</h2>
    
                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                        <form action="" method="post" class="j_formsubmitnews">
                            <div class="alertas"></div>
                            <input class="noclear" type="hidden" name="action" value="newsletter" />
                            <!-- HONEYPOT -->
                            <input type="hidden" class="noclear" name="bairro" value="" />
                            <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                            <input type="email" value="" name="email" class="email form_hide" placeholder="Digite seu e-mail"/>
                            <input type="submit" value="Cadastrar" id="submit" class="button subscribe-form-submit noclear form_hide"/>           
                        </form>                 
                    </div>
                    <!--End mc_embed_signup-->    
                    <div class="clearfix"></div>    
                </div>
              
                <div class="span7">
                    <!-- PORÇÕES E DRINKS -->
                    @if (!empty($Cardapio) && $Cardapio->count() > 0)
                        <h2>Conheça Nosso Cardápio</h2>
                        @foreach ($Cardapio as $item)
                            <div class="menu_list img_decoration">
                                <div class="span3 gallery">
                                    <a href="{{route('web.cardapio', ['categoria' => $item->categoriaObject->slug])}}" title="{{$item->titulo}}">
                                        <img src="{{$item->cover()}}" alt="{{$item->titulo}}" />
                                    </a>
                                </div>
                                <div class="span9" style="padding-left:5px;">
                                    <h2>{{$item->titulo}}</h2>
                                    {!!$item->content!!}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        @endforeach
                    @endif                
                </div>  
            </div>
        </div>
    </footer>

    <div class="copry"> 
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <p>© {{$configuracoes->ano_de_inicio}} - {{date('Y')}} {{$configuracoes->nomedosite}} - Todos os direitos reservados.</p>
                </div>
                <div class="span6">              
                    <ul>
                        <li><a href="{{route('web.galerias')}}" title="Galerias">Galerias</a></li> 
                        <li><a href="{{route('web.atendimento')}}" title="Atendimento">Atendimento</a></li>                          
                        <li><a href="{{route('web.politica')}}" title="Política de Privacidade">Política de Privacidade</a></li>  
                    </ul>             
                </div>
            </div>
          </div>
          <div class="container">
                <div class="row-fluid">
                    <div class="span12" style="text-align: center;">
                        <p class="font-accent text-right">
                            <span class="small text-silver-dark">Desenvolvido por <a style="color:#fff;" target="_blank" href="{{env('DESENVOLVEDOR_URL')}}">{{env('DESENVOLVEDOR')}}</a></span>
                        </p> 
                    </div>
                </div>
          </div>                  
    </div>
    
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.min.js')}}"></script>         
    <!--Nav-->
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/nav/tinynav.js')}}"></script> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/nav/superfish.js')}}"></script> 
    <!--Lightbox--> 
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/fancybox/jquery.fancybox.js')}}"></script>
    <!--Slide-->
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/slide/camera.js')}}" ></script>      
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/slide/jquery.easing.1.3.min.js')}}"></script>
    <!-- Slide Border -->
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/slide_border/modernizr.custom.53451.js')}}"></script>
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/slide_border/jquery.gallery.js')}}"></script> 
    <!-- book a table-->
    <script type="text/javascript" src="{{url('frontend/'.$configuracoes->template.'/assets/js/book_a_table/book_a_table.js')}}"></script>

    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery-func.js')}}"></script>
    
    <script type="text/javascript">
        $('#slide').camera({        
            height: '37%'
        });
    </script>
    
    <script>
        $(function () {    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    @hasSection('js')
        @yield('js')
    @endif    

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$configuracoes->tagmanager_id}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', '{{$configuracoes->tagmanager_id}}');
    </script>
</body>
</html>