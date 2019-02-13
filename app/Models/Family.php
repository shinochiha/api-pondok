<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
	// use SoftDeletes;
	
	// protected $table = 'families';
	protected $guarded = ['id'];
	protected $hidden = [
        'parent_income', 'created_at', 'updated_at'
    ];

	public function profile()
	{
		return $this->belongsTo(Profile::clas);
	}
}
