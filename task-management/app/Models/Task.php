<?php
// app/Models/Task.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'assigned_user_id',
        'user_id',
        'completed',
    ];

    // Relation avec le modèle User pour l'utilisateur assigné
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
