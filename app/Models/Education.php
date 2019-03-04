<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
	// use SoftDeletes;
	// protected $table = 'educations';
	protected $guarded = ['id'];
	protected $hidden = [
        'created_at', 'updated_at'
    ];

	public function profile()
	{
		return $this->belongsTo(Profile::clas);
	}
}
