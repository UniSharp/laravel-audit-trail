<?php

namespace Unisharp\AuditTrail;

use Unisharp\AuditTrail\Entity\Log;

trait Auditable
{

	public function log($action, $comment = null, $subject = null, $subject_id = null)
	{
		$data = array(
			'user_id' => \Auth::id(),
			'model' => get_class($this),
			'action' => $action,
			'subject' => $subject,
			'subject_id' => $subject_id,
			'comment' => $comment
			);

		 Log::create($data);
	}

	public function getLogs()
	{
		$Logs = Log::where('model', get_class($this));

		return $Logs;
	}

	public function cleanLogs()
	{
		return Log::delete()->where('model', get_class($this));
	}
}