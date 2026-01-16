<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'date_of_initiation',
        'birthday',
        'photo_path',
    ];

    protected $casts = [
        'date_of_initiation' => 'date',
        'birthday' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photoUrl(): ?string
    {
        if (! $this->photo_path) return null;
        return Storage::disk('public')->url($this->photo_path);
    }

    public function fullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}