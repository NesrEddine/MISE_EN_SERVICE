<?php

namespace App\Models\Shop;

use App\Models\Comment;
use App\Models\Secteur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'featured' => 'boolean',
        'is_visible' => 'boolean',
        'backorder' => 'boolean',
        'requires_shipping' => 'boolean',
        'published_at' => 'date',
    ];

    protected $fillable = ['name', 'slug', 'sku', 'barcode', 'description', 'qty', 'security_stock', 'featured', 'is_visible', 'old_price', 'price', 'cost', 'type', 'backorder', 'requires_shipping', 'published_at', 'seo_title', 'seo_description', 'seo_description', 'weight_value', 'weight_unit', 'height_value', 'height_unit', 'width_value', 'width_unit', 'depth_value', 'depth_unit', 'volume_value', 'volume_unit'];

    /** @return BelongsTo<Brand,self> */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'shop_brand_id');
    }

    /** @return BelongsToMany<Category> */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'shop_category_product', 'shop_product_id', 'shop_category_id')->withTimestamps();
    }

    /** @return MorphMany<Comment> */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     *  Relations with secteurs
     */
    public function secteurs(): BelongsToMany
    {
        return $this->belongsToMany(Secteur::class, 'secteur_service');
    }

}
