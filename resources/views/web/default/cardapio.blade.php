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

    <div class="row-fluid comfundo" style="padding-bottom: 50px;padding-top: 20px;">
        <div class="container main_content" style="padding-bottom: 50px;padding-top: 20px;">
            @if (!empty($cardapio) && $cardapio->count() > 0)
                <div class="span6">                    
                    @php $i = 0; @endphp
                    @foreach ($cardapio as $item)
                    @php if($i == 8){echo '</div><div class="span6">';} @endphp
                        <div class="row-fluid">
                            <div class="menu_list img_decoration" style="margin-bottom: 136px;">
                                <div class="span3">
                                    <a class="fancybox" title="{{$item->titulo}}" href="{{ $item->cover() }}" >
                                        <img src="{{ $item->cover() }}" alt="{{$item->titulo}}"/>
                                    </a>
                                </div>
                                <div class="span9">
                                    <h2>{{$item->titulo}}</h2>
                                    <p>{!!$item->content!!}</p>
                                </div>
                            </div>
                        </div>
                    @php $i++; @endphp
                    @endforeach                    
                </div>
                
                <div class="row-fluid" style="text-align: center;">            
                    <div class="span12">                        
                        @if (isset($filters))
                            {{ $cardapio->appends($filters)->links('pagination::default') }}
                        @else
                            {{ $cardapio->links('pagination::default') }}
                        @endif                                              
                    </div>
                </div>
                
            @else
                <div class="container"><br />
                    <div class="alert alert-danger">
                        Desculpe, não existem itens cadastradas nesse Cardápio :(
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