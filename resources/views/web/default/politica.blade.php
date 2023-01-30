@extends("web.{$configuracoes->template}.master.master")

@section('content')

<div class="container main_content">        
    <div class="divisor">
        <div class="circle_left"></div>
        <span class="shadow_divisor"></span>
        <div class="circle_right"></div>
    </div>
    <div class="title">
        <h2>Política de Privacidade</h2>
    </div>
</div>
<div class="row-fluid comfundo">
    <div class="container main_content" style="padding-bottom: 50px;padding-top: 20px;">    
      <div class="row-fluid">        
          <div class="span12">
            {!! $configuracoes->politicas_de_privacidade !!}
          </div>
      </div>          
    </div>        
</div>
@endsection