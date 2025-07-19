<?php

namespace App\Models;

use App\Models\Shop\Service;
use App\Models\Secteur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdminService extends Model
{
    /**
     * @var string
     */
    protected $table = 'admin_service';
    public $incrementing = true; // si tu as un id auto-incrément
    protected $fillable = ['admin_id', 'service_id'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function secteurs()
    {
        return $this->belongsToMany(Secteur::class, 'admin_service_secteur', 'admin_service_id', 'secteur_id');
    }

}
