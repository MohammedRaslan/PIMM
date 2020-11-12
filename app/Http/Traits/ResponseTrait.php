<?php

/*
 * status: true || false
 * data: ......
 * error: 200(no error) || (error number)
 * */
namespace App\Http\Traits;
use Carbon\CarbonPeriod;
use App\Enums\StatusType;
use App\Models\User;
use App\Models\StatusLog;
use OneSignal;

trait ResponseTrait{
    public function jsonResponse($data= null, $error = null, $responseCode)
    {
        $response = [
            'data' => $data,
            'error' => $error,
            'code' => $responseCode,
        ];
        return response()->json($response);
    }

    public function days($startDate,$endDate){
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {
            $new = $date->format('Y-m-d');
            $unixTimestamp = strtotime($new);
            $days[] = date("l", $unixTimestamp);
        }
        return $days;
    }

    public function notify($contatcs, $user_id = null)
    {
        foreach($contatcs as $contact){
            $number = count($this->days($contact->created_at,now()));
            if($number < 14){
                $user = User::find($contact->pimmed_id);
                if($user->id != $user_id){
                $user->status = StatusType::getValue('EXPOSED');
                $user->save();
                }
                StatusLog::create([
                    'user_id' => $user->id,
                    'status' => StatusType::getValue('EXPOSED')
                    ]); 
                    /*OneSignal::sendNotificationToUser(
                        "Some Message",
                        $userId,
                        $url = null,
                        $data = null,
                        $buttons = null,
                        $schedule = null
                    );*/
            }
        }
    }
}