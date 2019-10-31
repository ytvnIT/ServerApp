<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $table;
    protected $fillable;
    
    protected $primaryKey = "id";
    protected $keyType = "integer";
    public $incrementing = true;
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getfillable(){
        return $this->fillable;
    }
    public function __construct() {
        $this->fillable = array (
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        );
    }

    
}
