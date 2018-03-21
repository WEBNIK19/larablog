<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Notifiable;
		
		public function scopePgnt($query, $first, $per_page){
			return $query->latest()->offset($first)->limit($per_page)->get(['id','user_id','header','demo','created_at']);
		}
}
