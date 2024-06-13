<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Issue;
use App\Type;
use App\Severity;
use App\Ticstatus;
use App\User;
use App\Ticketlog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Ticket extends Model
{
    public $table = "tickets";

    protected $fillable = [
        "request_id", "ticket_no", "ticket_type", "severity_id", "ticstatus_id", "report_received",
        "created_by", "create_date", "updated_by", "update_date"
    ];

    protected $dates = ['report_received', 'create_date', 'update_date'];

    public $timestamps=false;

    // protected $appends = ['calc_duration'];

    // request_id
    public function issue()
    {
        return $this->belongsTo(Issue::class, 'request_id');
    }

    // ticket_type
    public function type()
    {
        return $this->belongsTo(Type::class, 'ticket_type');
    }

    // severity_id
    public function severity()
    {
        return $this->belongsTo(Severity::class, 'severity_id');
    }

    // ticstatus_id
    public function ticstatus()
    {
        return $this->belongsTo(Ticstatus::class, 'ticstatus_id');
    }

    // created_by
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // updated_by
    public function userr()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function ticketlog()
    {
        return $this->hasMany(Ticketlog::class);
    }

    public function latestTicketlog()
    {
        return $this->hasOne(Ticketlog::class)->latest('id');
    }

    // date time expected to ticket closed
    public function getExpectedClosureTimeAttribute()
    {
        // // find first Ticketlog entry where ticstatus_id=2 (Open)
        // $ticketlog = $this->ticketlog->where('ticstatus_id', 2)->first();

        // // check if the ticket log exists
        // if ($ticketlog) {
        //     try {
        //         $responseDateTime = Carbon::create(
        //             // ->column to be extract, start position first character, lenght characters to extract from start position
        //             // eg: response_date = '2024-06-08'
        //             // eg: response_time = '10:56:00'
        //             substr($ticketlog->response_date, 0, 4),  // extract year from response_date        eg: 2024
        //             substr($ticketlog->response_date, 5, 2),  // extract month from response_date       eg: 06
        //             substr($ticketlog->response_date, 8, 2),  // extract day from response_date         eg: 08
        //             substr($ticketlog->response_time, 0, 2),  // extract hour from response_time        eg: 10
        //             substr($ticketlog->response_time, 3, 2),  // extract minute from response_time      eg: 56
        //             substr($ticketlog->response_time, 6, 2)   // extract second from response_time      eg: 00
        //         );

        //         switch ($this->severity_id) {
        //             case 1:
        //                 return $responseDateTime->addHours(72);     // if severity_id=1 (Critical), add 72 hours to the response time
        //             case 2:
        //                 return $responseDateTime->addDays(14);      // if severity_id=2 (Major), add 14 days to the response time
        //             case 3:
        //                 return $responseDateTime->addMonths(3);     // if severity_id=3 (Minor), add 3 months to the response time
        //             default:
        //                 return null;
        //         }
        //     } catch (\Exception $e) {
        //         return 'Error: ' . $e->getMessage();
        //     }
        // }

        // return null;


        // check if the report_received date exists in tickets table
        if ($this->report_received) {
            try {
                $reportReceivedDateTime = Carbon::create(
                    substr($this->report_received, 0, 4),  // extract year from report_received
                    substr($this->report_received, 5, 2),  // extract month from report_received
                    substr($this->report_received, 8, 2),  // extract day from report_received
                    substr($this->report_received, 11, 2), // extract hour from report_received
                    substr($this->report_received, 14, 2), // extract minute from report_received
                    substr($this->report_received, 17, 2)  // extract second from report_received
                );

                switch ($this->severity_id) {
                    case 1:
                        return $reportReceivedDateTime->addHours(72);     // if severity_id=1 (Critical), add 72 hours to the report_received
                    case 2:
                        return $reportReceivedDateTime->addDays(14);      // if severity_id=2 (Major), add 14 days to the report_received
                    case 3:
                        return $reportReceivedDateTime->addMonths(3);     // if severity_id=3 (Minor), add 3 months to the report_received
                    default:
                        return null;
                }
            } catch (\Exception $e) {
                return 'Error: ' . $e->getMessage();
            }
        }

        return null;

    }

    // calculate duration ticket from report_received to response date & response time for specific log
    public function getCalcDurationForLog($log)
    {
        $responseDateTime = Carbon::create(
            substr($log->response_date, 0, 4),      // extract year from response_date 
            substr($log->response_date, 5, 2),      // extract month from response_date 
            substr($log->response_date, 8, 2),      // extract day from response_date
            substr($log->response_time, 0, 2),      // extract hour from response_time 
            substr($log->response_time, 3, 2),      // extract minute from response_time
            substr($log->response_time, 6, 2)       // extract second from response_time
        );

        // calculate duration between report_received time and response_date, response_ime
        $duration = $responseDateTime->diff($this->report_received);

        // display output format
        return sprintf(                                 // create a string
            '%d days, %d hours, %d minutes',            // %d means placeholder for an integer
            $duration->d,
            $duration->h,
            $duration->i
        );
    }    
    

    // public function getExpectedClosureTimeAttribute()
    // {
    //     $ticketlog = $this->ticketlog->where('ticstatus_id', 2)->first();

    //     if ($ticketlog) {
    //         try {
    //             $responseDateTime = Carbon::create(
    //                 substr($ticketlog->response_date, 0, 4),  // year
    //                 substr($ticketlog->response_date, 5, 2),  // month
    //                 substr($ticketlog->response_date, 8, 2),  // day
    //                 substr($ticketlog->response_time, 0, 2),  // hour
    //                 substr($ticketlog->response_time, 3, 2),  // minute
    //                 substr($ticketlog->response_time, 6, 2)   // second
    //             );

    //             switch ($this->severity_id) {
    //                 case 1:
    //                     $expectedClosureTime = $responseDateTime->addHours(72);
    //                     break;
    //                 case 2:
    //                     $expectedClosureTime = $responseDateTime->addDays(14);
    //                     break;
    //                 case 3:
    //                     $expectedClosureTime = $responseDateTime->addMonths(3);
    //                     break;
    //                 default:
    //                     $expectedClosureTime = null;
    //                     break;
    //             }

    //             return $expectedClosureTime ? $expectedClosureTime->format('Y-m-d H:i:s') : 'N/A';
    //         } catch (\Exception $e) {
    //             return 'Error: ' . $e->getMessage();
    //         }
    //     }

    //     return 'N/A';
    // }

    // calculate duration ticket from start open to closed
    // public function getCalcDurationAttribute()
    // {
    //     // // get all ticket logs for the current ticket(today), ordered by response_date and response_time
    //     // $logs = $this->ticketlog()->orderBy('response_date')->orderBy('response_time')->get();

    //     // // initialize the total duration to 0
    //     // $totalDuration = 0;

    //     // // variable to store when the ticket was last opened
    //     // $openLog = null;

    //     // // loop each log for this ticket
    //     // foreach ($logs as $ticketlog) {
    //     //     try {
    //     //         $responseDateTime = Carbon::create(
    //     //             // ->column to be extract, start position first character, lenght characters to extract from start position
    //     //             // eg: response_date = '2024-06-08'
    //     //             // eg: response_time = '10:56:00'
    //     //             substr($ticketlog->response_date, 0, 4),  // extract year from response_date        eg: 2024
    //     //             substr($ticketlog->response_date, 5, 2),  // extract month from response_date       eg: 06
    //     //             substr($ticketlog->response_date, 8, 2),  // extract day from response_date         eg: 08
    //     //             substr($ticketlog->response_time, 0, 2),  // extract hour from response_time        eg: 10
    //     //             substr($ticketlog->response_time, 3, 2),  // extract minute from response_time      eg: 56
    //     //             substr($ticketlog->response_time, 6, 2)   // extract second from response_time      eg: 00
    //     //         );
    //     //     } catch (\Exception $e) {
    //     //         return 'Error: ' . $e->getMessage();
    //     //     }

    //     //     if ($ticketlog->ticstatus_id == 2 && is_null($openLog)) {                   // check if current log marks the ticket as opened (ticstatus_id=2)
    //     //         // open ticket
    //     //         $openLog = $responseDateTime;
    //     //     } elseif ($ticketlog->ticstatus_id == 3 && !is_null($openLog)) {            // check if current log marks the ticket as put on hold (ticstatus_id=3)
    //     //         // KIV ticket
    //     //         $totalDuration += $responseDateTime->diffInMinutes($openLog);
    //     //         $openLog = null;
    //     //     } elseif ($ticketlog->ticstatus_id == 4 && !is_null($openLog)) {            // check if current log marks the ticket as closed (ticstatus_id=4)
    //     //         // closed ticket
    //     //         $totalDuration += $responseDateTime->diffInMinutes($openLog);
    //     //         $openLog = null;
    //     //     }
    //     // }

    //     // // convert total duration from minutes to days, hours, minutes
    //     // $days = floor($totalDuration / (60 * 24));                  // calculate total days
    //     // $hours = floor(($totalDuration % (60 * 24)) / 60);          // calculate remaining hours
    //     // $minutes = $totalDuration % 60;                             // calculate remaining minutes

    //     // return "{$days} days, {$hours} hours, {$minutes} minutes";


    //     // $logs = $this->ticketlog()->orderBy('response_date')->orderBy('response_time')->get();
    //     // $totalDuration = 0;

    //     // $reportReceived = Carbon::parse($this->report_received);

    //     // foreach ($logs as $ticketlog) {
    //     //     try {
    //     //         $responseDateTime = Carbon::create(
    //     //             substr($ticketlog->response_date, 0, 4),
    //     //             substr($ticketlog->response_date, 5, 2),
    //     //             substr($ticketlog->response_date, 8, 2),
    //     //             substr($ticketlog->response_time, 0, 2),
    //     //             substr($ticketlog->response_time, 3, 2),
    //     //             substr($ticketlog->response_time, 6, 2)
    //     //         );

    //     //         // calculate the difference in minutes between response and report received
    //     //         $duration = $responseDateTime->diffInMinutes($reportReceived);
    //     //         $totalDuration += $duration;
    //     //     } catch (\Exception $e) {
    //     //         return 'Error: ' . $e->getMessage();
    //     //     }
    //     // }

    //     // // convert totalDuration into days, hours, and minutes
    //     // $days = floor($totalDuration / (60 * 24));
    //     // $hours = floor(($totalDuration % (60 * 24)) / 60);
    //     // $minutes = $totalDuration % 60;

    //     // return "{$days} days, {$hours} hours, {$minutes} minutes";

    // }

}
