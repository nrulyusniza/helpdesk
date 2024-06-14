<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Issue;
use App\Site;
use App\Status;


class BellNotification extends Notification
{
    use Queueable;

    public $issue;

    public $type;

    public $site;

    public $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $url = url('/home');
        // $url = URL::where('role_id', 1)
        //             ->orWhere(function ($query) use ($selectedSiteId) {
        //                 $query->where('role_id', 2)->where('site_id', $selectedSiteId);
        //             })
        //             ->orWhere(function ($query) use ($selectedSiteId) {
        //                 $query->where('role_id', 3)->where('site_id', $selectedSiteId);
        //             })
        //             ->get();

        return (new MailMessage)
                    ->subject('Ticket Submission Confirmed' )
                    ->from('aienshazrein95@gmail.com','NCO')
                    ->greeting('Hello, ')
                    ->line('Your new request for '. $this->issue->request_no. ' was successful created.')
                    ->line('Request Type : '. $this->issue->type->request_type. ' ')
                    ->line('Site Name : '. $this->issue->site->site_name. ' ')
                    ->line('Reporting Person : '. $this->issue->reportingperson->rptpers_name. ' ')
                    // ->line('Status Ticket : '. $this->issue->status->status_label. ' ')
                    ->action('View Ticket', url('issues/allissue'));
                    // ->action('View Ticket',  route('issue.allissue', $this->issue->id));
                   
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'data' => 'Request of ' . $this->issue->request_no . ' has been submitted.',
            'issue_id' => $this->issue->id,
            // 'link' => route('issues.allissuedetail', ['id' => $this->issue->id]),
        ];
    }
}
