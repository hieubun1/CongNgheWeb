<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class issues extends Model  // Đổi tên thành "Issue"
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['computer_id', 'reported_by', 'reported_date', 'description', 'urgency', 'status'];

    // Quan hệ với model Computer
    public function computer()
    {
        return $this->belongsTo(Computer::class);  // Dùng tên model đúng
    }
}
