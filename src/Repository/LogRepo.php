<?php
namespace Unisharp\AuditTrail\Repository;

use Unisharp\AuditTrail\Entity\Log;

class LogRepo
{

    public function create(Array $input)
    {
        return Log::create([
            'user_id' => $input['user_id'],
            'action' => $input['action'],
            'subject' => $input['subject'],
            'subject_id' => $input['subject_id'],
            'comment' => $input['comment']
        ]);
    }

}