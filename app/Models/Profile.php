<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath = $this->image ? $this->image : 'profile/rDFtplUqPzEq86RgevH0UsWH4A3mdG3TsLh3KaD0.png';
        return '/storage/' . $imagePath;
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
