<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


#[Guarded(['id'])]
class Donation extends Model
{
    protected $table = 'donations';

    public function generateRef()
    {
        $name = Str::before(trim($this->donature_name), ' ');

        do {
            $ref = now()->format('Y')
                . '-' . Str::upper($name)
                . '-' . Str::upper(Str::random(6));
        } while (self::where('no_ref', $ref)->exists());

        return $ref;
    }
}
