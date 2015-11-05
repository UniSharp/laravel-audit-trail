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
			'model' => get_class($model),
			'action' => $action,
			'subject' => $subject,
			'subject_id' => $subject_id,
			'comment' => $comment
			);

		try {
			return $Log->create($data);
		} catch (Illuminate\Database\QueryException $e) {
			\Log::error('Something went wrong while logging model: ' . get_class($model));
		}
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

		if ($Log instanceof Log) {
			return $Log->where('model', get_class($model))->delete();
		}
		
		return $Log->truncate();
	}

	public static function get(Model $model)
	{
		$Log = self::getLogModel($model);

		if ($Log instanceof Log) {
			return Log::where('model', get_class($model))->get();
		}
		
		return $Log->all();
	}

	public static function getByUserId($user_id)
	{
		$map_array = config('audit.model_map');
		$Collection = new \Illuminate\Database\Eloquent\Collection();

		foreach ($map_array as $key => $value) {
			if (!class_exists($value)) {
				continue;
			}
			$Log = new $value();
			$Collection = $Collection->merge($Log->where('user_id', $user_id)->get());	
		}

		$Collection = $Collection->merge(Log::where('user_id', $user_id)->get());

		return $Collection;
	}

}