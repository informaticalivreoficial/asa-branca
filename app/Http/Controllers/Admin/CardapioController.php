<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CardapioRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Cardapio;
use App\Models\CardapioCat;
use App\Models\CardapioGb;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        $itens = Cardapio::orderBy('status', 'ASC')
                ->orderBy('created_at', 'DESC')
                ->paginate(25);
        return view('admin.cardapio.index', [
            'itens' => $itens
        ]);
    }

    public function create()
    {
        return view('admin.cardapio.create');
    }

    public function edit($id)
    {
        $categorias = CardapioCat::orderBy('titulo', 'ASC')->whereNull('id_pai')->get();
        $subcategorias = CardapioCat::orderBy('titulo', 'ASC')->whereNotNull('id_pai')->get();
        $item = Cardapio::where('id', $id)->first();                
        return view('admin.cardapio.edit', [
            'item' => $item, 
            'categorias' => $categorias,           
            'subcategorias' => $subcategorias           
        ]);
    }

    public function update(CardapioRequest $request, $id)
    {
        $itemUpdate = Cardapio::where('id', $id)->first();
        $itemUpdate->fill($request->all());
        $itemUpdate->save();
        $itemUpdate->setSlug();

        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if ($validator->fails() === true) {
            return redirect()->back()->withInput()->with([
                'color' => 'orange',
                'message' => 'Todas as imagens devem ser do tipo jpg, jpeg ou png.',
            ]);
        }

        if ($request->allFiles()) {
            foreach ($request->allFiles()['files'] as $image) {
                $itemGb = new CardapioGb();
                $itemGb->cardapio = $itemUpdate->id;
                $itemGb->path = $image->storeAs(env('AWS_PASTA') . 'cardapio/' . $itemUpdate->id, Str::slug($request->titulo) . '-' . str_replace('.', '', microtime(true)) . '.' . $image->extension());
                $itemGb->save();
                unset($itemGb);
            }
        }

        return redirect()->route('cardapio.edit', [
            'id' => $itemUpdate->id,
        ])->with(['color' => 'success', 'message' => 'Item atualizado com sucesso!']);
    }

    public function categoriaList(Request $request)
    {   
        $data['subcategorias'] = CardapioCat::where('id_pai', $request->categoria)->available()->get(["titulo", "id"]);     
        if($data){
            return response()->json($data);
        }        
    }

    public function setStatus(Request $request)
    {        
        $item = Cardapio::find($request->id);
        $item->status = $request->status;
        $item->save();
        return response()->json(['success' => true]);
    }

    public function imageRemove(Request $request)
    {
        $imageDelete = CardapioGb::where('id', $request->image)->first();
        Storage::delete($imageDelete->path);
        $imageDelete->delete();
        $json = [
            'success' => true,
        ];
        return response()->json($json);
    }

    public function imageSetCover(Request $request)
    {
        $imageSetCover = CardapioGb::where('id', $request->image)->first();
        $allImage = CardapioGb::where('cardapio', $imageSetCover->cardapio)->get();
        foreach ($allImage as $image) {
            $image->cover = null;
            $image->save();
        }
        $imageSetCover->cover = true;
        $imageSetCover->save();
        $json = [
            'success' => true,
        ];
        return response()->json($json);
    }
}
