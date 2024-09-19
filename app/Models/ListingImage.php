<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['file_name'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
