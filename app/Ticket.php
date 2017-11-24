<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function category(){
        return $this->belongsTo(TicketCategory::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
