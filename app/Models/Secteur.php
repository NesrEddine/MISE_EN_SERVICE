<?php

namespace App\Models;

use App\Models\Shop\Service;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Secteur extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'secteurs';

    /**
     * @var array<string, string>
     */
    protected $casts = [

    ];

    protected $fillable = ['code_postale', 'name_secteur'];


    //public function service(): BelongsToMany
   //{
   //    return $this->belongsToMany(Service::class, 'secteur_service');
   //}
    public function adminServices()
    {
        return $this->belongsToMany(AdminService::class, 'admin_service_secteur', 'secteur_id', 'admin_service_id');
    }



}
