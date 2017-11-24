<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $fillable = ['user_id', 'invoice_id','title', 'month','message','status'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
