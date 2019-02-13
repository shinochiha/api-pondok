<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
	use SoftDeletes;

	protected $guarded = ['id'];
	protected $hidden = [
        'created_at', 'updated_at'
    ];

    # Relationships
	public function user()
	{
		return $this->belongsTo(User::clas);
	}

	public function education()
    {
        return $this->hasOne(Education::class);
    }

    public function family()
    {
        return $this->hasOne(Family::class);
    }
}
