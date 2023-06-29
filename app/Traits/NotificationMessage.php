<?php

namespace App\Traits;

trait NotificationMessage
{

    /**
     * returns notification message and alert 
     *
     * @param string $success   successfull message
     * @param string $failure   failure message 
     * @return array
     */
    public function notification($data, string $success, string $failure): array
    {
        return [
            'alert' => $data ? 'success' : 'failed',
            'message' => $data ?  $success : $failure,
        ];
    }
}
