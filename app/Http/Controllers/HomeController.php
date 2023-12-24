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
        // fetch ticket counts by month from the db
        $ticketCounts = Ticket::selectRaw('MONTH(report_received) as month, COUNT(*) as count')
                                ->groupBy('month')
                                ->orderBy('month')
                                ->pluck('count', 'month');

        // if want to fill in months with zero counts, use the following code
        $allMonths = range(1, 12);
        $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());

        // donut chart
        $totalTickets = Ticket::count();
        $totalTicketHardware = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 1)->count();
        $totalTicketSoftware = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 2)->count();
        $totalTicketNetwork = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 3)->count();
        $totalTicketNonsystem = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 4)->count();

        return view('/dashboard/mydashboard', compact('tickets', 'allTixOpen', 'allTixClosed', 'allTixKiv', 
                                                    'knowledgebases', 'users', 'sites', 'equipments', 
                                                    'ticketCounts',
                                                    'totalTickets', 'totalTicketHardware', 'totalTicketSoftware', 'totalTicketNetwork', 'totalTicketNonsystem'));
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

        // counts the number of tickets associated with the user's site based on ticstatus_id = 4; 4=Closed
        $closedTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 4)
                        ->count();

        // counts the number of tickets associated with the user's site based on ticstatus_id = 3; 3=KIV
        $kivTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 3)
                        ->count();

        // area chart
        // fetch ticket counts by month from the db based on site_id
        $ticketCounts = Ticket::whereHas('issue', function ($query) use ($site_id) {
                                            $query->where('site_id', $site_id);
                                        })
                                        ->selectRaw('MONTH(report_received) as month, COUNT(*) as count')
                                        ->groupBy('month')
                                        ->orderBy('month')
                                        ->pluck('count', 'month');

        // if want to fill in months with zero counts, use the following code
        $allMonths = range(1, 12);
        $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());
        
        // donut chart
        // counts the total number of tickets by logged in user's site_id
        $ttlTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.site_id', $site_id)->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 1; 1=Hardware
        $hardwareTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 1)
                                    ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 2; 2=Software
        $softwareTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 2)
                                    ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 3; 3=Network
        $networkTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 3)
                                    ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 4; 4=Non System
        $nonsystemTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 4)
                                    ->count();

        return view('/dashboard/dashboardadmin', compact('totalTickets', 'openTickets', 'closedTickets', 'kivTickets',
                                                        'ticketCounts',
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

        // counts the number of tickets associated with the user's site based on ticstatus_id = 4; 4=Closed
        $closedTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 4)
                        ->count();

        // counts the number of tickets associated with the user's site based on ticstatus_id = 3; 3=KIV
        $kivTickets = DB::table('tickets')
                        ->join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 3)
                        ->count();

        // area chart
        // fetch ticket counts by month from the db based on site_id
        $ticketCounts = Ticket::whereHas('issue', function ($query) use ($site_id) {
                                            $query->where('site_id', $site_id);
                                        })
                                        ->selectRaw('MONTH(report_received) as month, COUNT(*) as count')
                                        ->groupBy('month')
                                        ->orderBy('month')
                                        ->pluck('count', 'month');

        // if want to fill in months with zero counts, use the following code
        $allMonths = range(1, 12);
        $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());
        
        // donut chart
        // counts the total number of tickets by logged in user's site_id
        $ttlTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.site_id', $site_id)->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 1; 1=Hardware
        $hardwareTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 1)
                                    ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 2; 2=Software
        $softwareTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 2)
                                    ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 3; 3=Network
        $networkTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 3)
                                    ->count();

        // counts the total number of tickets by logged in user's site_id based on req_category = 4; 4=Non System
        $nonsystemTickets = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                    ->where('issues.site_id', $site_id)
                                    ->where('issues.reqcategory_id', 4)
                                    ->count();

        return view('/dashboard/dashboarduser', compact('totalTickets', 'openTickets', 'closedTickets', 'kivTickets',
                                                        'ticketCounts',
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

    //---------------------------------------------------------------------- CARD TICKETS ----------------------------------------------------------------------
    
    // super admin's card
    public function allticket()
    {
        $allTic = Ticket::orderBy('ticket_no', 'desc')->get();

        return view('/dashboard/infohub/allticket', compact('allTic'));
    }

    public function allopen()
    {
        $allOpen = Ticket::where('ticstatus_id', '2')->orderBy('ticket_no', 'desc')->get();

        return view('/dashboard/infohub/allopen', compact('allOpen'));
    }

    public function allclosed()
    {
        $allClosed = Ticket::where('ticstatus_id', '4')->orderBy('ticket_no', 'desc')->get();

        return view('/dashboard/infohub/allclosed', compact('allClosed'));
    }

    public function allkiv()
    {
        $allKiv = Ticket::where('ticstatus_id', '3')->orderBy('ticket_no', 'desc')->get();

        return view('/dashboard/infohub/allkiv', compact('allKiv'));
    }

    // site admin's card
    public function listticket()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $listTic = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/listticket', compact('listTic'));
    }

    public function listopen()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $listOpen = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 2)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/listopen', compact('listOpen'));
    }

    public function listclosed()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $listClosed = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 4)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/listclosed', compact('listClosed'));
    }

    public function listkiv()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $listKiv = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 3)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/listkiv', compact('listKiv'));
    }

    // site user's card
    public function entireticket()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $entireTic = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/entireticket', compact('entireTic'));
    }

    public function entireopen()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $entireOpen = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 2)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/entireopen', compact('entireOpen'));
    }

    public function entireclosed()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $entireClosed = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 4)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/entireclosed', compact('entireClosed'));
    }

    public function entirekiv()
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $entireKiv = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                        ->where('issues.site_id', $site_id)
                        ->where('tickets.ticstatus_id', 3)
                        ->orderBy('ticket_no', 'desc')
                        ->get();

        return view('/dashboard/infohub/entirekiv', compact('entireKiv'));
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