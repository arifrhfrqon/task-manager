<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    protected $fillable = ['title','description','status','created_by','assigned_to','due_date'];
    public function creator() { return $this->belongsTo(User::class,'created_by'); }
    public function assignee() { return $this->belongsTo(User::class,'assigned_to'); }
}
