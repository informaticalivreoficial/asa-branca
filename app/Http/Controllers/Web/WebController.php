<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\{
    AlugueisClone,
    Cardapio,
    CardapioCat,
    Post,
    CatPost,
    Cidades,
    Galeria,
    Newsletter,
    Slide,
    User
};

use App\Services\ConfigService;
use App\Services\EstadoService;
use App\Support\Seo;
use Carbon\Carbon;
use Goutte\Client;

class WebController extends Controller
{
    protected $configService, $estadoService;
    protected $seo, $crowler;

    public function __construct(
        ConfigService $configService, 
        EstadoService $estadoService)
    {
        $this->configService = $configService;
        $this->estadoService = $estadoService;
        $this->seo = new Seo();    
        $this->crowler = new Client();    
    }

    public function fetchCity(Request $request)
    {
        $data['cidades'] = Cidades::where("estado_id",$request->estado_id)->get(["cidade_nome", "cidade_id"]);
        return response()->json($data);
    }

    public function home()
    {
        $slides = Slide::orderBy('created_at', 'DESC')
                    ->available()
                    ->where('expira', '>=', Carbon::now())
                    ->get();   
        $galerias = Galeria::orderBy('created_at', 'DESC')->available()->limit(12)->get();
        $cardapio = Cardapio::inRandomOrder()->available()->limit(6)->get();

        $url  = 'https://alugueisubatuba.com.br/imoveis/locacao';
        $page = $this->crowler->request('GET', $url);
        $result = $page->filter('.room-list .room')->each( function ($item){
            
            $this->results[] = [            
                 'titulo'  => $item->filter('h4')->text(),
                 'content' => $item->filter('.description')->text(),            
                 'thumb' => $item->filter('img')->attr('src'),
                 'url' => $item->filter('a')->attr('href'),
            ];
            
        });
        
        $head = $this->seo->render($this->configService->getConfig()->nomedosite ?? 'Informática Livre',
            $this->configService->getConfig()->descricao ?? 'Informática Livre desenvolvimento de sistemas web desde 2005',
            route('web.home'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        ); 

		return view('web.'.$this->configService->getConfig()->template.'.home',[
            'head' => $head,            
            'slides' => $slides,
            'galerias' => $galerias,
            'cardapio' => $cardapio,
            'imoveis' => $this->results
		]);
    }

    public function quemsomos()
    {
        $paginaQuemSomos = Post::where('tipo', 'pagina')->postson()->where('id', 5)->first();
        $head = $this->seo->render('Quem Somos - ' . $this->configService->getConfig()->nomedosite,
            $this->configService->getConfig()->descricao ?? 'Informática Livre desenvolvimento de sistemas web desde 2005',
            route('web.quemsomos'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );
        return view('web.'.$this->configService->getConfig()->template.'.quem-somos',[
            'head' => $head,
            'paginaQuemSomos' => $paginaQuemSomos
        ]);
    }

    public function politica()
    {
        $head = $this->seo->render('Política de Privacidade - ' . $this->configService->getConfig()->nomedosite ?? 'Informática Livre',
            'Política de Privacidade - ' . $this->configService->getConfig()->nomedosite,
            route('web.politica'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.politica',[
            'head' => $head
        ]);
    }

    public function pagina($slug)
    {
        $clientesCount = User::where('client', 1)->count();
        $post = Post::where('slug', $slug)->where('tipo', 'pagina')->postson()->first();        
        $post->views = $post->views + 1;
        $post->save();

        $head = $this->seo->render($post->titulo ?? 'Informática Livre',
            $post->titulo,
            route('web.pagina', ['slug' => $post->slug]),
            $post->cover() ?? $this->configService->getConfig()->getMetaImg()
        );

        return view('web.'.$this->configService->getConfig()->template.'.pagina', [
            'head' => $head,
            'post' => $post,
            'clientesCount' => $clientesCount
        ]);
    }    
    
    public function atendimento()
    {
        $head = $this->seo->render('Atendimento - ' . $this->configService->getConfig()->nomedosite,
            'Nossa equipe está pronta para melhor atender as demandas de nossos clientes!',
            route('web.atendimento'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );        

        return view('web.'.$this->configService->getConfig()->template.'.atendimento', [
            'head' => $head            
        ]);
    }

    public function sitemap()
    {
        $url = $this->configService->getConfig()->sitemap;
        $data = file_get_contents($url);
        return response($data, 200, ['Content-Type' => 'application/xml']);
    }

    public function galerias()
    {
        $galerias = Galeria::orderBy('created_at', 'DESC')->available()->get();
        
        $head = $this->seo->render('Galerias de Fotos - ' . $this->configService->getConfig()->nomedosite,
            'Galerias de Fotos',
            route('web.galerias'),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.galerias',[
            'galerias' => $galerias,
            'head' => $head
        ]);
    }

    public function galeria($slug)
    {
        $galeria = Galeria::where('slug', $slug)->available()->first();
        
        $head = $this->seo->render($galeria->titulo . ' - ' . $this->configService->getConfig()->nomedosite,
            $galeria->titulo,
            route('web.galeria', ['slug' => $galeria->slug]),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.galeria',[
            'galeria' => $galeria,
            'head' => $head
        ]);
    } 

    public function cardapio($categoria)
    {
        $categoria = CardapioCat::where('slug', $categoria)->first();
        $cardapio = Cardapio::orderBy('created_at', 'Desc')
                            ->available()
                            ->where('categoria', $categoria->id)
                            ->paginate(16);

        $head = $this->seo->render('Cardápio - ' . $categoria->titulo . ' - ' . $this->configService->getConfig()->nomedosite,
            'Cardápio - ' . $categoria->titulo,
            route('web.cardapio', ['categoria' => $categoria->slug]),
            $this->configService->getConfig()->getMetaImg() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );

        return view('web.'.$this->configService->getConfig()->template.'.cardapio',[
            'head' => $head,
            'categoria' => $categoria,
            'cardapio' => $cardapio
        ]);
    }
}
