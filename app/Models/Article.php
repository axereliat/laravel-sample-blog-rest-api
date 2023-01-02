<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'created_by', 'updated_by'];

    protected $casts = ['created_by' => 'integer', 'updated_by' => 'integer'];

    public function createdByAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
