@extends("web.{$configuracoes->template}.master.master")

@section('content')
  <div class="container main_content">        
    <div class="divisor">
        <div class="circle_left"></div>
        <span class="shadow_divisor"></span>
        <div class="circle_right"></div>
    </div>
    <div class="title">
        <h2>Atendimento</h2>
    </div>
  </div>


<div class="row-fluid comfundo">
  <div class="container main_content" style="padding-bottom: 50px;padding-top: 20px;">    
    <div class="row-fluid">
      <div class="contact">
        <div class="span6">
          <h2>Localização</h2> 
          <div class="contact_information">           
            {!!$configuracoes->mapa_google!!}
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
            @if($configuracoes->telefone1)
                <strong>Telefone:</strong> {{$configuracoes->telefone1}}
                @if($configuracoes->telefone2)
                    <br /><strong>Telefone:</strong> {{$configuracoes->telefone2}}
                @endif
                @if($configuracoes->telefone3)
                    <br /><strong>Telefone:</strong> {{$configuracoes->telefone3}}
                @endif                            
            @endif
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
        </div>
              
        <div class="span6">
          <h2>Formulário de Atendimento</h2>
          <div class="contact_form">  
              <form action="" method="post" class="j_formsubmit">
                  @csrf
                  <div id="js-contact-result"></div>
                  <!-- HONEYPOT -->
                  <input type="hidden" class="noclear" name="bairro" value="" />
                  <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                  <div class="form_hide">
                    <input type="text" name="nome" placeholder="Seu Nome" />
                    <input type="email" name="email" placeholder="Seu E-mail" />
                    Menssagem: <textarea class="comment-text"  name="mensagem" rows="10"></textarea>
                    
                    <div class="clearfix"></div>
                    <div class="buttons" style="width: 100%;">
                        <input style="width: 100%;font-weight: bold;height:45px;font-size: 18px;" class="button button-md noclear btncheckout" name="submit" type="submit" value="Enviar Agora"/>                   
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>          
  </div>        
</div>
@endsection

@section('css')
    <style>
      .alert {
          margin-bottom: 5px;        
      }
    </style>
@endsection

@section('js')
<script>
    $(function () {

        // Seletor, Evento/efeitos, CallBack, Ação
        $('.j_formsubmit').submit(function (){
            var form = $(this);
            var dataString = $(form).serialize();

            $.ajax({
                url: "{{ route('web.sendEmail') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find(".btncheckout").attr("disabled", true);
                    form.find('.btncheckout').val("Carregando...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-100}, 'slow');
                    if(resposta.error){
                        form.find('#js-contact-result').html('<div class="alert alert-danger error-msg">'+ resposta.error +'</div>');
                        form.find('.error-msg').fadeIn();                    
                    }else{
                        form.find('#js-contact-result').html('<div class="alert alert-success error-msg">'+ resposta.sucess +'</div>');
                        form.find('.error-msg').fadeIn();                    
                        form.find('input[class!="noclear"]').val('');
                        form.find('textarea[class!="noclear"]').val('');
                        form.find('.form_hide').fadeOut(500);
                    }
                },
                complete: function(resposta){
                    form.find(".btncheckout").attr("disabled", false);
                    form.find('.btncheckout').val("Enviar Agora");                                
                }
            });

            return false;
        });

    });
</script>   
@endsection