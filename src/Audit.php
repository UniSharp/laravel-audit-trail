<?php

namespace Unisharp\AuditTrail;

use Illuminate\Database\Eloquent\Model;
use Unisharp\AuditTrail\Entity\Log;

class Audit
{
	public static function getByUserId($user_id)
	{
		return Log::where('user_id', $user_id)->get();
	}
	public static function log($action, $comment = null)
	{
		$data = array(
			'user_id' => \Auth::id(),
			'action' => $action,
			'comment' => $comment
			);
		return Log::create($data);
	}
}