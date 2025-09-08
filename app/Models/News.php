<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'is_featured',
        'tags',
        'views_count',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELACIONAMENTOS ====================

    /**
     * Associação da notícia
     */
    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    /**
     * Autor da notícia
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ==================== ACCESSORS ====================

    /**
     * URL da imagem destacada
     */
    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        
        return asset('images/default-news.jpg');
    }

    /**
     * Resumo automático se não tiver excerpt
     */
    public function getExcerptAttribute($value): string
    {
        if ($value) {
            return $value;
        }
        
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Tempo de leitura estimado
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / 200)); // 200 palavras por minuto
    }

    /**
     * Data formatada para exibição
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->published_at ? 
            $this->published_at->format('d/m/Y \à\s H:i') : 
            $this->created_at->format('d/m/Y \à\s H:i');
    }

    /**
     * Data relativa (há 2 dias, etc.)
     */
    public function getRelativeDateAttribute(): string
    {
        $date = $this->published_at ?: $this->created_at;
        return $date->diffForHumans();
    }

    // ==================== SCOPES ====================

    /**
     * Notícias publicadas
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Notícias em rascunho
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Notícias arquivadas
     */
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    /**
     * Notícias em destaque
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Filtrar por associação
     */
    public function scopeByAssociation($query, $associationId)
    {
        return $query->where('association_id', $associationId);
    }

    /**
     * Buscar por termo
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('content', 'like', "%{$term}%")
              ->orWhere('excerpt', 'like', "%{$term}%");
        });
    }

    /**
     * Ordenar por data de publicação
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')
                    ->orderBy('created_at', 'desc');
    }

    // ==================== MÉTODOS ====================

    /**
     * Gerar slug automaticamente
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (!$news->slug) {
                $news->slug = Str::slug($news->title);
                
                // Garantir que o slug seja único
                $originalSlug = $news->slug;
                $counter = 1;
                
                while (static::where('slug', $news->slug)->exists()) {
                    $news->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title') && !$news->isDirty('slug')) {
                $news->slug = Str::slug($news->title);
                
                // Garantir que o slug seja único
                $originalSlug = $news->slug;
                $counter = 1;
                
                while (static::where('slug', $news->slug)->where('id', '!=', $news->id)->exists()) {
                    $news->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }

    /**
     * Publicar notícia
     */
    public function publish(): bool
    {
        return $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    /**
     * Despublicar notícia
     */
    public function unpublish(): bool
    {
        return $this->update([
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    /**
     * Arquivar notícia
     */
    public function archive(): bool
    {
        return $this->update(['status' => 'archived']);
    }

    /**
     * Incrementar visualizações
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Verificar se está publicada
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at <= now();
    }

    /**
     * Verificar se é rascunho
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Verificar se está arquivada
     */
    public function isArchived(): bool
    {
        return $this->status === 'archived';
    }

    /**
     * Obter badge do status
     */
    public function getStatusBadge(): string
    {
        return match($this->status) {
            'published' => '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Publicada</span>',
            'draft' => '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Rascunho</span>',
            'archived' => '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">Arquivada</span>',
            default => '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">Indefinido</span>'
        };
    }

    /**
     * Obter cor do status
     */
    public function getStatusColor(): string
    {
        return match($this->status) {
            'published' => 'green',
            'draft' => 'yellow',
            'archived' => 'gray',
            default => 'gray'
        };
    }
}
