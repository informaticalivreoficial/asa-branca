<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    CardapioController,
    UserController,
    EmailController,
    PostController,
    CatPostController,
    ConfigController,
    GaleriaController,
    MenuController,
    NewsletterController,
    SitemapController,
    SlideController,
};
use App\Http\Controllers\Web\RssFeedController;
use App\Http\Controllers\Web\SendEmailController;
use App\Http\Controllers\Web\WebController;

Route::group(['namespace' => 'Web', 'as' => 'web.'], function () {

    /** Página Inicial */
    Route::get('/', [WebController::class, 'home'])->name('home');
    Route::match(['post', 'get'], '/fetchCity', [WebController::class, 'fetchCity'])->name('fetchCity');

    //**************************** Emails ********************************************/
    Route::get('/atendimento', [WebController::class, 'atendimento'])->name('atendimento');
    Route::get('/sendEmail', [SendEmailController::class, 'sendEmail'])->name('sendEmail');
    
    //*************************************** Páginas *******************************************/
    Route::get('/pagina/{slug}', [WebController::class, 'pagina'])->name('pagina');
    
    //*************************************** Galerias *******************************************/
    Route::get('/galeria/{slug}', [WebController::class, 'galeria'])->name('galeria');
    Route::get('/galerias', [WebController::class, 'galerias'])->name('galerias');

    //*************************************** Cardápio *******************************************/
    Route::get('/cardapio/{categoria}', [WebController::class, 'cardapio'])->name('cardapio');

    /** FEED */
    Route::get('feed', [RssFeedController::class, 'feed'])->name('feed');
    Route::get('/politica-de-privacidade', [WebController::class, 'politica'])->name('politica');
    Route::get('/sitemap', [WebController::class, 'sitemap'])->name('sitemap');

});

Route::prefix('admin')->middleware('auth')->group( function(){

    //******************************* Newsletter *********************************************/
    Route::match(['post', 'get'], 'listas/padrao', [NewsletterController::class, 'padraoMark'])->name('listas.padrao');
    Route::get('listas/set-status', [NewsletterController::class, 'listaSetStatus'])->name('listas.listaSetStatus');
    Route::get('listas/delete', [NewsletterController::class, 'listaDelete'])->name('listas.delete');
    Route::delete('listas/deleteon', [NewsletterController::class, 'listaDeleteon'])->name('listas.deleteon');
    Route::put('listas/{id}', [NewsletterController::class, 'listasUpdate'])->name('listas.update');
    Route::get('listas/{id}/editar', [NewsletterController::class, 'listasEdit'])->name('listas.edit');
    Route::get('listas/cadastrar', [NewsletterController::class, 'listasCreate'])->name('listas.create');
    Route::post('listas/store', [NewsletterController::class, 'listasStore'])->name('listas.store');
    Route::get('listas', [NewsletterController::class, 'listas'])->name('listas');

    Route::put('listas/email/{id}', [NewsletterController::class, 'newsletterUpdate'])->name('listas.newsletter.update');
    Route::get('listas/email/{id}/edit', [NewsletterController::class, 'newsletterEdit'])->name('listas.newsletter.edit');
    Route::get('listas/email/delete', [NewsletterController::class, 'emailDelete'])->name('listas.newsletter.delete');
    Route::delete('listas/email/deleteon', [NewsletterController::class, 'emailDeleteon'])->name('listas.newsletter.deleteon');
    Route::get('listas/email/cadastrar', [NewsletterController::class, 'newsletterCreate'])->name('lista.newsletter.create');
    Route::post('listas/email/store', [NewsletterController::class, 'newsletterStore'])->name('listas.newsletter.store');
    Route::get('listas/emails/categoria/{categoria}', [NewsletterController::class, 'newsletters'])->name('lista.newsletters');

    //******************* Slides ************************************************/
    Route::get('slides/set-status', [SlideController::class, 'slideSetStatus'])->name('slides.slideSetStatus');
    Route::get('slides/delete', [SlideController::class, 'delete'])->name('slides.delete');
    Route::delete('slides/deleteon', [SlideController::class, 'deleteon'])->name('slides.deleteon');
    Route::put('slides/{slide}', [SlideController::class, 'update'])->name('slides.update');
    Route::get('slides/{slide}/edit', [SlideController::class, 'edit'])->name('slides.edit');
    Route::get('slides/create', [SlideController::class, 'create'])->name('slides.create');
    Route::post('slides/store', [SlideController::class, 'store'])->name('slides.store');
    Route::get('slides', [SlideController::class, 'index'])->name('slides.index');

    Route::match(['post', 'get'], 'configuracoes/fetchCity', [ConfigController::class, 'fetchCity'])->name('configuracoes.fetchCity');
    Route::put('configuracoes/{config}', [ConfigController::class, 'update'])->name('configuracoes.update');
    Route::get('configuracoes', [ConfigController::class, 'editar'])->name('configuracoes.editar');

    //********************* Categorias para Posts *******************************/
    Route::get('categorias/delete', [CatPostController::class, 'delete'])->name('categorias.delete');
    Route::delete('categorias/deleteon', [CatPostController::class, 'deleteon'])->name('categorias.deleteon');
    Route::put('categorias/posts/{id}', [CatPostController::class, 'update'])->name('categorias.update');
    Route::get('categorias/{id}/edit', [CatPostController::class, 'edit'])->name('categorias.edit');
    Route::match(['post', 'get'],'posts/categorias/create/{catpai}', [CatPostController::class, 'create'])->name('categorias.create');
    Route::post('posts/categorias/store', [CatPostController::class, 'store'])->name('categorias.store');
    Route::get('posts/categorias', [CatPostController::class, 'index'])->name('categorias.index');

    //********************** Blog ************************************************/
    Route::get('posts/set-status', [PostController::class, 'postSetStatus'])->name('posts.postSetStatus');
    Route::get('posts/set-menu', [PostController::class, 'postSetMenu'])->name('posts.postSetMenu');
    Route::get('posts/delete', [PostController::class, 'delete'])->name('posts.delete');
    Route::delete('posts/deleteon', [PostController::class, 'deleteon'])->name('posts.deleteon');
    Route::post('posts/image-set-cover', [PostController::class, 'imageSetCover'])->name('posts.imageSetCover');
    Route::delete('posts/image-remove', [PostController::class, 'imageRemove'])->name('posts.imageRemove');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::post('posts/categoriaList', [PostController::class, 'categoriaList'])->name('posts.categoriaList');
    Route::get('posts/artigos', [PostController::class, 'index'])->name('posts.artigos');
    Route::get('posts/noticias', [PostController::class, 'index'])->name('posts.noticias');
    Route::get('posts/paginas', [PostController::class, 'index'])->name('posts.paginas');

    //*********************** Email **********************************************/
    Route::get('email/suporte', [EmailController::class, 'suporte'])->name('email.suporte');
    Route::match(['post', 'get'], 'email/enviar-email', [EmailController::class, 'send'])->name('email.send');
    Route::post('email/sendEmail', [EmailController::class, 'sendEmail'])->name('email.sendEmail');
    Route::match(['post', 'get'], 'email/success', [EmailController::class, 'success'])->name('email.success');

    //*********************** Usuários *******************************************/
    Route::match(['get', 'post'], 'usuarios/pesquisa', [UserController::class, 'search'])->name('users.search');
    Route::match(['post', 'get'], 'usuarios/fetchCity', [UserController::class, 'fetchCity'])->name('users.fetchCity');
    Route::delete('usuarios/deleteon', [UserController::class, 'deleteon'])->name('users.deleteon');
    Route::get('usuarios/set-status', [UserController::class, 'userSetStatus'])->name('users.userSetStatus');
    Route::get('usuarios/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('usuarios/time', [UserController::class, 'team'])->name('users.team');
    Route::get('usuarios/view/{id}', [UserController::class, 'show'])->name('users.view');
    Route::put('usuarios/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('usuarios/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('usuarios/create', [UserController::class, 'create'])->name('users.create');
    Route::post('usuarios/store', [UserController::class, 'store'])->name('users.store');
    Route::get('usuarios', [UserController::class, 'index'])->name('users.index');

    //****************************** Menu *******************************************/
    Route::get('menus/set-status', [MenuController::class, 'menuSetStatus'])->name('menus.menuSetStatus');
    Route::delete('menus/deleteon', [MenuController::class, 'deleteon'])->name('menus.deleteon');
    Route::get('menus/delete', [MenuController::class, 'delete'])->name('menus.delete');
    Route::put('menus/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::get('menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::get('menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('menus/store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');

    //****************************** Galerias *******************************************/
    Route::get('galerias/set-status', [GaleriaController::class, 'galeriaSetStatus'])->name('galerias.galeriaSetStatus');
    Route::delete('galerias/deleteon', [GaleriaController::class, 'deleteon'])->name('galerias.deleteon');
    Route::post('galerias/image-set-cover', [GaleriaController::class, 'imageSetCover'])->name('galerias.imageSetCover');
    Route::delete('galerias/image-remove', [GaleriaController::class, 'imageRemove'])->name('galerias.imageRemove');
    Route::get('galerias/delete', [GaleriaController::class, 'delete'])->name('galerias.delete');
    Route::put('galerias/{id}', [GaleriaController::class, 'update'])->name('galerias.update');
    Route::get('galerias/{id}/edit', [GaleriaController::class, 'edit'])->name('galerias.edit');
    Route::get('galerias/create', [GaleriaController::class, 'create'])->name('galerias.create');
    Route::post('galerias/store', [GaleriaController::class, 'store'])->name('galerias.store');
    Route::get('/galerias', [GaleriaController::class, 'index'])->name('galerias.index');
    
    //****************************** Cardápio *******************************************/
    Route::post('cardapio/categoriaList', [CardapioController::class, 'categoriaList'])->name('cardapio.categoriaList');
    Route::get('cardapio/set-status', [CardapioController::class, 'setStatus'])->name('cardapio.setStatus');
    Route::delete('cardapio/deleteon', [CardapioController::class, 'deleteon'])->name('cardapio.deleteon');
    Route::post('cardapio/image-set-cover', [CardapioController::class, 'imageSetCover'])->name('cardapio.imageSetCover');
    Route::delete('cardapio/image-remove', [CardapioController::class, 'imageRemove'])->name('cardapio.imageRemove');
    Route::get('cardapio/delete', [CardapioController::class, 'delete'])->name('cardapio.delete');
    Route::put('cardapio/{id}', [CardapioController::class, 'update'])->name('cardapio.update');
    Route::get('cardapio/{id}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
    Route::get('cardapio/create', [CardapioController::class, 'create'])->name('cardapio.create');
    Route::post('cardapio/store', [CardapioController::class, 'store'])->name('cardapio.store');
    Route::get('/cardapio', [CardapioController::class, 'index'])->name('cardapio.index');
    
    //******************** Sitemap *********************************************/
    Route::get('gerarxml', [SitemapController::class, 'gerarxml'])->name('gerarxml');

    Route::get('/', [AdminController::class, 'home'])->name('home');
});


Auth::routes();
