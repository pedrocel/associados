<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids as HashidsFacade; 
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'name',
        'description',
        'recurrence',
        'image',
        'is_active',
        'client_type',
        'hash_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Plan $plan) {
            // Instancia a classe Hashids.
            // O primeiro parâmetro é o "salt" (use sua APP_KEY para segurança).
            // O segundo parâmetro é o comprimento mínimo do hash (opcional, mas recomendado).
            $hashids = new Hashids(config('app.key'), 8); 
            
            // Gera um hash único com base no timestamp atual.
            // Você pode usar o ID do plano após ele ser salvo, mas para 'creating', timestamp é uma opção.
            // Se o ID do plano for auto-incrementado, você pode gerar o hash após o 'created' event.
            // Para garantir unicidade antes de salvar, usar um UUID ou um timestamp é comum.
            $plan->hash_id = $hashids->encode(time()); 
        });
    }
    
    // Define o relacionamento com a associação
    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    // Define o relacionamento com os produtos
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'plan_product');
    }

    // Acessor para calcular o preço total do plano
    public function getTotalPriceAttribute(): float
    {
        return $this->products->sum('price');
    }
}