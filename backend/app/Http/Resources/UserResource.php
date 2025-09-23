<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this ->id,
            'name' => $this ->name,
            'email' => $this ->email,
            'direcUser' => $this ->direcUser,
            'zPostalUser' => $this ->zPostalUser,
            'docIdenUser' => $this ->docIdenUser,
/*             'city' => $this ->city,
            'country' => $this ->country, */
            'numTelefoUser' => $this ->numTelefoUser,
            'profile_image' => $this ->image_path(),
            'datoCompleUser' => $this ->datoCompleUser,
        ];
    }
}
