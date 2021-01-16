<?php

namespace CryptaEve\Seat\Text\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = true;

    protected $table = 'crypta_seat_text';

    protected $fillable = [
        'url', 'name', 'text'
    ];

    /**
     * @return string
     */
    public function getLinkAttribute(): string
    {
        return route('text.public', $this->url);
    }
}
