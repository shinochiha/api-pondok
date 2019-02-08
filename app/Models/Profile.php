<?php 

 namespace App\Models;

 use App\Models\User;

 use App\Models\Profile;
 use Illuminate\Database\Eloquent\Model;

 class Profile extends Model
 {
 	protected $guarded = [];

 	// Relation One to One , User -> Profile
 	public function user()
 	{
 		return $this->belongsTo(User::class);
 	}
 }

