<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class AssociationPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'name',
        'slug',
        'type',
        'content',
        'components',
        'settings',
        'is_published',
        'is_home',
        'order',
    ];

    protected $casts = [
        'components' => 'array',
        'settings' => 'array',
        'is_published' => 'boolean',
        'is_home' => 'boolean',
    ];

    // Relacionamento com associação
    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    // Gerar slug automaticamente
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (!$page->slug) {
                $page->slug = Str::slug($page->name);
            }

            // Garante que o slug seja único dentro da associação
            $originalSlug = $page->slug;
            $counter = 1;
            while (static::where('association_id', $page->association_id)
                       ->where('slug', $page->slug)
                       ->exists()) {
                $page->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        // Quando marcar como home, desmarcar outras
        static::saving(function ($page) {
            if ($page->is_home && $page->isDirty('is_home')) {
                static::where('association_id', $page->association_id)
                    ->where('id', '!=', $page->id)
                    ->update(['is_home' => false]);
            }
        });
    }

    // Renderizar conteúdo
    public function render(): string
    {
        if ($this->type === 'html') {
            return $this->content ?? '';
        }

        // Para tipo builder, renderizar componentes
        return $this->renderComponents();
    }

    // Renderizar componentes do builder
    private function renderComponents(): string
{
    // Obtém o atributo e garante que é um array.
    // O getAttribute() irá acionar o 'cast' definido.
    $components = $this->getAttribute('components');
    
    // Se o cast falhar por algum motivo (e retornar uma string não vazia), 
    // ou se o valor for nulo/vazio, garantimos que é um array vazio para o foreach.
    if (is_null($components) || $components === '') {
        return '';
    }
    
    // Se for uma string (caso o cast não funcione), tentamos decodificar como fallback.
    // Se já for um array (como deveria ser), esta linha não fará nada de mal.
    if (is_string($components)) {
        $components = json_decode($components, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($components)) {
            // Se falhar a decodificação, retornamos vazio para evitar o erro.
            return ''; 
        }
    }
    
    // O cast no modelo deve tornar esta variável um array, mas 
    // para total segurança, garantimos que é iterável.
    if (!is_array($components)) {
         return '';
    }

    $html = '';
    foreach ($components as $component) { // Usa a variável local $components
        $html .= $this->renderComponent($component);
    }

    return $html;
}

    // Renderizar um componente individual
    private function renderComponent(array $component): string
    {
        $type = $component['type'] ?? 'text';
        $data = $component['data'] ?? [];

        return match($type) {
            'hero' => $this->renderHero($data),
            'features' => $this->renderFeatures($data),
            'pricing' => $this->renderPricing($data),
            'text' => $this->renderText($data),
            'image' => $this->renderImage($data),
            'cta' => $this->renderCTA($data),
            'testimonials' => $this->renderTestimonials($data),
            'contact' => $this->renderContact($data),
            'custom' => $data['html'] ?? '',
            default => '',
        };
    }

    // Templates de componentes
    private function renderHero(array $data): string
    {
        $title = $data['title'] ?? 'Título';
        $subtitle = $data['subtitle'] ?? '';
        $buttonText = $data['button_text'] ?? '';
        $buttonLink = $data['button_link'] ?? '#';
        $bgColor = $data['bg_color'] ?? 'bg-gradient-to-br from-purple-600 to-blue-500';
    
        // ✅ Define o botão antes
        $buttonHtml = '';
        if ($buttonText) {
            $buttonHtml = "<a href='{$buttonLink}' class='inline-block bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition'>{$buttonText}</a>";
        }
    
        return <<<HTML
        <section class="{$bgColor} text-white py-20 px-4">
            <div class="max-w-6xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">{$title}</h1>
                <p class="text-xl md:text-2xl mb-8 text-white/90">{$subtitle}</p>
                {$buttonHtml}
            </div>
        </section>
        HTML;
    }
    

    private function renderFeatures(array $data): string
    {
        $title = $data['title'] ?? 'Recursos';
        $features = $data['features'] ?? [];
        
        $featuresHtml = '';
        foreach ($features as $feature) {
            $icon = $feature['icon'] ?? 'check';
            $featureTitle = $feature['title'] ?? '';
            $description = $feature['description'] ?? '';
            
            $featuresHtml .= <<<HTML
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                    <i data-lucide="{$icon}" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">{$featureTitle}</h3>
                <p class="text-gray-600 dark:text-gray-300">{$description}</p>
            </div>
            HTML;
        }
        
        return <<<HTML
        <section class="py-20 px-4 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">{$title}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {$featuresHtml}
                </div>
            </div>
        </section>
        HTML;
    }

    private function renderPricing(array $data): string
    {
        $title = $data['title'] ?? 'Planos';
        $plans = $data['plans'] ?? [];
        
        $plansHtml = '';
        foreach ($plans as $plan) {
            $planName = $plan['name'] ?? '';
            $price = $plan['price'] ?? '';
            $features = $plan['features'] ?? [];
            $buttonText = $plan['button_text'] ?? 'Assinar';
            $buttonLink = $plan['button_link'] ?? '#';
            $featured = $plan['featured'] ?? false;
            
            $featuresListHtml = '';
            foreach ($features as $feature) {
                $featuresListHtml .= "<li class='flex items-center gap-2'><i data-lucide='check' class='w-5 h-5 text-green-500'></i><span>{$feature}</span></li>";
            }
            
            $cardClass = $featured ? 'border-2 border-purple-500 shadow-2xl scale-105' : 'border border-gray-200 dark:border-gray-700';
            
            $plansHtml .= <<<HTML
            <div class="bg-white dark:bg-gray-800 rounded-xl {$cardClass} p-8 hover:shadow-xl transition">
                <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">{$planName}</h3>
                <div class="text-4xl font-bold mb-6 text-purple-600 dark:text-purple-400">{$price}</div>
                <ul class="space-y-3 mb-8 text-gray-600 dark:text-gray-300">{$featuresListHtml}</ul>
                <a href="{$buttonLink}" class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">{$buttonText}</a>
            </div>
            HTML;
        }
        
        return <<<HTML
        <section class="py-20 px-4">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">{$title}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {$plansHtml}
                </div>
            </div>
        </section>
        HTML;
    }

    private function renderText(array $data): string
    {
        $content = $data['content'] ?? '';
        $align = $data['align'] ?? 'left';
        
        return <<<HTML
        <section class="py-12 px-4">
            <div class="max-w-4xl mx-auto text-{$align} prose dark:prose-invert">
                {$content}
            </div>
        </section>
        HTML;
    }

    private function renderImage(array $data): string
{
    $src = $data['src'] ?? '';
    $alt = $data['alt'] ?? '';
    $caption = $data['caption'] ?? '';

    // ✅ Cria o caption antes
    $captionHtml = '';
    if ($caption) {
        $captionHtml = "<p class='text-center text-gray-600 dark:text-gray-400 mt-4'>{$caption}</p>";
    }

    return <<<HTML
    <section class="py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <img src="{$src}" alt="{$alt}" class="w-full rounded-xl shadow-lg">
            {$captionHtml}
        </div>
    </section>
    HTML;
}


    private function renderCTA(array $data): string
    {
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        $buttonText = $data['button_text'] ?? '';
        $buttonLink = $data['button_link'] ?? '#';
        $bgColor = $data['bg_color'] ?? 'bg-purple-600';
        
        return <<<HTML
        <section class="{$bgColor} text-white py-16 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">{$title}</h2>
                <p class="text-xl mb-8 text-white/90">{$description}</p>
                <a href="{$buttonLink}" class="inline-block bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">{$buttonText}</a>
            </div>
        </section>
        HTML;
    }

    private function renderTestimonials(array $data): string
{
    $title = $data['title'] ?? 'Depoimentos';
    $testimonials = $data['testimonials'] ?? [];

    $testimonialsHtml = '';
    foreach ($testimonials as $testimonial) {
        $name = $testimonial['name'] ?? '';
        $role = $testimonial['role'] ?? '';
        $content = $testimonial['content'] ?? '';
        $avatar = $testimonial['avatar'] ?? '';

        // ✅ Aqui está a correção do ternário
        if ($avatar) {
            $avatarHtml = "<img src='{$avatar}' alt='{$name}' class='w-12 h-12 rounded-full'>";
        } else {
            $avatarHtml = "<div class='w-12 h-12 rounded-full bg-purple-200 dark:bg-purple-800'></div>";
        }

        $testimonialsHtml .= <<<HTML
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
            <p class="text-gray-600 dark:text-gray-300 mb-4 italic">"{$content}"</p>
            <div class="flex items-center gap-3">
                {$avatarHtml}
                <div>
                    <div class="font-semibold text-gray-900 dark:text-white">{$name}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{$role}</div>
                </div>
            </div>
        </div>
        HTML;
    }

    return <<<HTML
    <section class="py-20 px-4 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-900 dark:text-white">{$title}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {$testimonialsHtml}
            </div>
        </div>
    </section>
    HTML;
}


    private function renderContact(array $data): string
    {
        $title = $data['title'] ?? 'Entre em Contato';
        $description = $data['description'] ?? '';
        
        return <<<HTML
        <section class="py-20 px-4">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-4xl font-bold text-center mb-4 text-gray-900 dark:text-white">{$title}</h2>
                <p class="text-center text-gray-600 dark:text-gray-300 mb-12">{$description}</p>
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome</label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mensagem</label>
                        <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition">Enviar Mensagem</button>
                </form>
            </div>
        </section>
        HTML;
    }
}
