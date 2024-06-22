<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $table="users";
    protected $primaryKey = 'id';
   // public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
  
     protected $fillable = [
        'code', 
        'cedula',
        'username', 
        'email', 
        'password', 
        'id_role', 
        'status',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean'
        ];
    } 
    
    protected static function boot()
    {
        parent::boot();

        // Configurar el campo 'status' automáticamente
        static::creating(function ($customer) {
            $customer->status = true;
        });
    }
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    public function rol()
    {   
        return $this->belongsTo(Rol::class, 'id_role');
    }

    public function details()
    {
        return $this->hasMany(Sale_details::class, 'seller_id',);
    }
}
