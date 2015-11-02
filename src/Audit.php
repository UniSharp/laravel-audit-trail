<?php

namespace Unisharp\AuditTrail;

use Illuminate\Database\Eloquent\Model;
use Unisharp\AuditTrail\Repository\LogRepo;

class Audit
{

	public static function log(Model $model, $action, $comment = null, $subject = null, $subject_id = null)
	{
		$LogRepo = self::getLogModel($model);

		return $LogRepo->create([
			'user_id' => \Auth::id(),
			'action' => $action,
			'subject' => $subject,
			'subject_id' => $subject_id,
			'comment' => $comment
			]);
	}

	public static function getLogModel(Model $model)
	{
		$map_array = config('audit.model_map');
		$model_name = get_class($model);

		if (array_key_exists($model_name, $map_array) && class_exists($map_array[$model_name])) {
			return new $map_array[$model_name]();
		}

		return new LogRepo();
	}

}