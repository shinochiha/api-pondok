<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidGenerator;

class Education extends Model
{
	use SoftDeletes, UuidGenerator;

	protected $guarded = [
		'id', 'uuid', 'created_at', 'updated_at'
	];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    # Relationship(s)
	public function profile()
	{
		return $this->belongsTo(Profile::clas);
	}
}
