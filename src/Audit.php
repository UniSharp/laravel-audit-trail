<?php

namespace Unisharp\AuditTrail;

use Illuminate\Database\Eloquent\Model;
use Unisharp\AuditTrail\Entity\Log;

class Audit
{

	public static function log(Model $model, $action, $comment = null, $subject = null, $subject_id = null)
	{
		$Log = self::getLogModel($model);
		$data = array(
			'user_id' => \Auth::id(),
			'action' => $action,
			'subject' => $subject,
			'subject_id' => $subject_id,
			'comment' => $comment
			);

		return $Log->create($data);
	}

	public static function getLogModel(Model $model)
	{
		$map_array = config('audit.model_map');
		$model_name = get_class($model);

		if (array_key_exists($model_name, $map_array) && class_exists($map_array[$model_name])) {
			return new $map_array[$model_name]();
		}

		return new Log();
	}

	public static function clean(Model $model)
	{
		$Log = self::getLogModel($model);

		return $Log->truncate();
	}

}