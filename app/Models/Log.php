<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model 
{
    use HasFactory;

    protected $table = 'logs';  // Confirme o nome da tabela

    protected $fillable = [
        'user_id', 
        'action', 
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}