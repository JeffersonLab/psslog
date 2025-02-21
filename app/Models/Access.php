<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Access extends Model
{
    // properties that differ from standard Laravel conventions
    protected $primaryKey = 'psslog_id';
    protected $table = 'accesses';

    protected $casts = [
        'time_in' => 'datetime',
        'time_out' => 'datetime',
    ];

    protected $with = ['psslog'];
    public $timestamps = false;


    /**
     * Maps key letters to Area names
     * //TODO BSY vs. Hall B
     */
    private $map = array('I'=>'INJ','N'=>'NL','S'=>'SL','B'=>'BSY',
        'A'=>'HALLA','B'=>'HALLB','C'=>'HALLC',
        'D'=>'HALLD','T'=>'HDTAGGER', 'F'=>'LERF');



    /**
     * The informational psslog entry that owns the Access
     */
    public function psslog() : BelongsTo{
        return $this->belongsTo(Psslog::class, 'psslog_id', 'psslog_id');
    }

    //TODO Figure out Users/SSO Table business

    /**
     * The SSO who signed the user in
     */
    public function entrySso() {
        // TODO convert to return a User object
        return $this->sso_in;
    }

    /**
     * The SSO who signed the user out
     */
    public function exitSso() {
        // TODO convert to return a User object
        return $this->sso_out;
    }

}
