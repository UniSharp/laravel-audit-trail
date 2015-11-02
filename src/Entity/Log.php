<?php

namespace Unisharp\AuditTrail\Entity;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'action', 'subject', 'subject_id', 'comment'];
}