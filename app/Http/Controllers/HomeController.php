<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // logout
    public function destroy(Request $request)
    {
        /*Auth::logout();

        return redirect()->route('welcome');*/

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }

    //---------------------------------------------------------------------- SUPER ADMIN DASHBOARD ----------------------------------------------------------------------

    // super admin's dashboard
    public function mydashboard()
    {
        // cards
        $tickets = DB::table('tickets')->count();
        $allTixOpen = DB::table('tickets')->where('ticstatus_id', '2')->count();
        $allTixClosed = DB::table('tickets')->where('ticstatus_id', '4')->count();
        $allTixKiv = DB::table('tickets')->where('ticstatus_id', '3')->count();
        $knowledgebases = DB::table('knowledgebases')->count();
        $users = DB::table('users')->count();
        $sites = DB::table('sites')->count();
        $equipments = DB::table('equipments')->count();

        // area chart
        
        // donut chart
        $issues = DB::table('issues')->count();
        $totalTicketHardware = DB::table('issues')->where('reqcategory_id', '1')->count();
        $totalTicketSoftware = DB::table('issues')->where('reqcategory_id', '2')->count();
        $totalTicketNetwork = DB::table('issues')->where('reqcategory_id', '3')->count();
        $totalTicketNonsystem = DB::table('issues')->where('reqcategory_id', '4')->count();

        return view('/dashboard/mydashboard', compact('tickets', 'allTixOpen', 'allTixClosed', 'allTixKiv', 
                                                    'knowledgebases', 'users', 'sites', 'equipments', 
                                                    'issues', 'totalTicketHardware', 'totalTicketSoftware', 'totalTicketNetwork', 'totalTicketNonsystem'));
    }

    //---------------------------------------------------------------------- SITE ADMIN DASHBOARD ----------------------------------------------------------------------

    // site admin's dashboard
    public function dashboardadmin()
    {
        // cards
        // retrieves the logged in user's site_id
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        // counts the total number of tickets associated with the user's site
        $totalTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->count();

        // counts the number of tickets associated with the user's site based on ticstatus_id = 2; 2=Open
        $openTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 2)
                        ->count();

        // // counts the number of tickets associated with the user's site based on ticstatus_id = 4; 4=Closed
        $closedTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 4)
                        ->count();

        // // counts the number of tickets associated with the user's site based on ticstatus_id = 3; 3=KIV
        $kivTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 3)
                        ->count();

        // area chart
        
        // donut chart
        // counts the total number of tickets by logged in user's site_id
        $ttlTickets = DB::table('tickets')
                            ->join('issues', 'tickets.request_id', '=', 'issues.id')
                            ->where('issues.site_id', '=', $site_id)
                            ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 1; 1=Hardware
        // $hardwareTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '1')
        //                     ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 2; 2=Software
        // $softwareTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '2')
        //                     ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 3; 3=Network
        // $networkTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '3')
        //                     ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 4; 4=Non System
        // $nonsystemTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '4')
        //                     ->count();

        $hardwareTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '1')->count();
        $softwareTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '2')->count();
        $networkTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '3')->count();
        $nonsystemTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '4')->count();

        return view('/dashboard/dashboardadmin', compact('totalTickets', 'openTickets', 'closedTickets', 'kivTickets',
                                                        'ttlTickets', 'hardwareTickets', 'softwareTickets', 'networkTickets', 'nonsystemTickets'));
    }

    //---------------------------------------------------------------------- SITE USER DASHBOARD ----------------------------------------------------------------------

    // site user's dashboard
    public function dashboarduser()
    {
        // cards
        // retrieves the logged in user's site_id
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        // counts the total number of tickets associated with the user's site
        $totalTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->count();

        // counts the number of tickets associated with the user's site based on ticstatus_id = 2; 2=Open
        $openTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 2)
                        ->count();

        // // counts the number of tickets associated with the user's site based on ticstatus_id = 4; 4=Closed
        $closedTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 4)
                        ->count();

        // // counts the number of tickets associated with the user's site based on ticstatus_id = 3; 3=KIV
        $kivTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 3)
                        ->count();

        // area chart
        
        // donut chart
        // counts the total number of tickets by logged in user's site_id
        $ttlTickets = DB::table('tickets')
                            ->join('issues', 'tickets.request_id', '=', 'issues.id')
                            ->where('issues.site_id', '=', $site_id)
                            ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 1; 1=Hardware
        // $hardwareTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '1')
        //                     ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 2; 2=Software
        // $softwareTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '2')
        //                     ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 3; 3=Network
        // $networkTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '3')
        //                     ->count();

        // // counts the total number of tickets by logged in user's site_id based on req_category = 4; 4=Non System
        // $nonsystemTickets = DB::table('tickets')
        //                     ->join('issues', 'tickets.request_id', '=', 'issues.id')
        //                     ->join('reqcategorys', 'issues.reqcategory_id', '=', 'reqcategorys.id')
        //                     ->where('issues.site_id', '=', $site_id)
        //                     ->where('reqcategorys.req_category', '=', '4')
        //                     ->count();

        $hardwareTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '1')->count();
        $softwareTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '2')->count();
        $networkTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '3')->count();
        $nonsystemTickets = DB::table('issues')->where('issues.site_id', '=', $site_id)->where('reqcategory_id', '4')->count();

        return view('/dashboard/dashboarduser', compact('totalTickets', 'openTickets', 'closedTickets', 'kivTickets',
                                                        'ttlTickets', 'hardwareTickets', 'softwareTickets', 'networkTickets', 'nonsystemTickets'));
    }

    //---------------------------------------------------------------------- EXTENSION ----------------------------------------------------------------------
    
    // super admin's extension
    public function myextension()
    {
        $types = DB::table('types')->count();
        $reqcategorys = DB::table('reqcategorys')->count();
        $severitys = DB::table('severitys')->count();
        $statuss = DB::table('statuss')->count();
        $reactions = DB::table('reactions')->count();
        $kbcategorys = DB::table('kbcategorys')->count();
        $ticstatuss = DB::table('ticstatuss')->count();
        $equipmentstatuss = DB::table('equipmentstatuss')->count();
        
        return view('myextension', compact('types', 'reqcategorys', 'severitys', 'statuss',
                                            'reactions', 'kbcategorys', 'ticstatuss', 'equipmentstatuss'));
    }

    //---------------------------------------------------------------------------------------------------------------------------

    // try chatbot sementara
    public function chat()
    {
        return view('chat');
    }
}

// use BotMan\BotMan\BotMan;
// use BotMan\BotMan\Messages\Attachments\File;
// use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

// class ChatController
// {
//     public function sendAttachment(BotMan $bot)
//     {
//         $fileAttachment = new File('/path/to/video.mp4');

//         $message = OutgoingMessage::create('Here is a video for you')
//             ->withAttachment($fileAttachment);

//         $bot->reply($message);
//     }
// }