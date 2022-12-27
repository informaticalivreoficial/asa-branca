<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'cardapio'; 

    protected $fillable = [
        'titulo',
        'content',
        'slug',
        'tags',
        'views',
        'categoria',
        'cat_pai',        
        'status'
    ];

    /**
     * Scopes
    */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Relacionamentos
    */
    public function categoriaObject()
    {
        return $this->hasOne(CardapioCat::class, 'id', 'categoria');
    }
    
    public function images()
    {
        return $this->hasMany(CardapioGb::class, 'cardapio', 'id')->orderBy('cover', 'ASC');
    }

    public function countimages()
    {
        return $this->hasMany(CardapioGb::class, 'cardapio', 'id')->count();
    }

    /**
     * Accerssors and Mutators
     */

    public function getContentWebAttribute()
    {
        return Str::words($this->content, '20', ' ...');
    }
        
    public function cover()
    {
        $images = $this->images();
        $cover = $images->where('cover', 1)->first(['path']);

        if(!$cover) {
            $images = $this->images();
            $cover = $images->first(['path']);
        }

        if(empty($cover['path']) || !Storage::disk()->exists($cover['path'])) {
            return url(asset('backend/assets/images/image.jpg'));
        }

        return Storage::url($cover['path']);
    }

    public function setSlug()
    {
        if(!empty($this->titulo)){
            $post = Cardapio::where('titulo', $this->titulo)->first(); 
            if(!empty($post) && $post->id != $this->id){
                $this->attributes['slug'] = Str::slug($this->titulo) . '-' . $this->id;
            }else{
                $this->attributes['slug'] = Str::slug($this->titulo);
            }            
            $this->save();
        }
    }
}
