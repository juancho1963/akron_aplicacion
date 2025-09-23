<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password',
                        'direcUser', 'zPostalUser', 'docIdenUser',
                        'numTelefoUser','profile_image', 'datoCompleUser'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        ];
    }
    //funcion ordenes del usuario 1:n
    public function pedids() {
        return $this->hasMany(Pedid::class) //metodo uno a muchos
            ->with('produs')
            ->latest(); //organizar por fecha
    }
    //funcion devolve url y foto del perfil del usuario
    public function image_path(){
        if($this->profile_image) {
            return asset($this->profile_image);
        }else{
            return 'https://img.icons8.com/?size=100&id=13042&format=png&color=000000';
        }
    }
}
