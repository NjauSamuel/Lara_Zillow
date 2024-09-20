<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['file_name'];
    protected $appends = ['src'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    // An example of the function below output when converted to kebab/snake case is:
        // getRealSrcAttribute->real_src
    public function getSrcAttribute(){
        return asset("storage/{$this->file_name}");
    }
}
