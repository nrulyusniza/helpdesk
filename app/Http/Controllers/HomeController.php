<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Ticket;
use App\Ticketlog;
use Carbon\Carbon;                      // Import library, PHP API extension for date and time
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

    //---------------------------------------------------------------------- PAGE ERROR ----------------------------------------------------------------------
    public function pagenotfound()
    {        
        return view('error.pagenotfound');
    }

    //---------------------------------------------------------------------- SUPER ADMIN DASHBOARD ----------------------------------------------------------------------

    // super admin's dashboard
    public function mydashboard()
    {
        // paramount
        $allNewTodayCount = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                                    ->where('ticstatus_id', 1)
                                    ->whereDate('report_received', Carbon::today())
                                    ->count();

        $allUpcomingDueCount = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                                    ->where('ticstatus_id', 1)
                                    ->whereDate('report_received', Carbon::today())
                                    ->count();

        $allOverdueCount = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                                    ->where('ticstatus_id', 1)
                                    ->whereDate('report_received', Carbon::today())
                                    ->count();

        // cards
        $tickets = DB::table('tickets')->count();
        // $allTixOpen = DB::table('tickets')->where('ticstatus_id', '2')->count();
        // $allTixClosed = DB::table('tickets')->where('ticstatus_id', '4')->count();
        // $allTixKiv = DB::table('tickets')->where('ticstatus_id', '3')->count();

        $allTixOpen = Ticket::where(function ($query) {
                                $query->select('ticstatus_id')
                                    ->from('ticketlogs')
                                    ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                    ->latest('id')
                                    ->limit(1);
                            }, '=', 2)
                            ->count();
        
        $allTixClosed = Ticket::where(function ($query) {
                                $query->select('ticstatus_id')
                                    ->from('ticketlogs')
                                    ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                    ->latest('id')
                                    ->limit(1);
                            }, '=', 4)
                            ->count();
        
        $allTixKiv = Ticket::where(function ($query) {
                                $query->select('ticstatus_id')
                                    ->from('ticketlogs')
                                    ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                    ->latest('id')
                                    ->limit(1);
                            }, '=', 3)
                            ->count();

        $knowledgebases = DB::table('knowledgebases')->count();
        $users = DB::table('users')->count();
        $sites = DB::table('sites')->count();
        $equipments = DB::table('equipments')->count();

        // // area chart
        // $currentYear = now()->year;
        
        // // fetch ticket counts by month from the db
        // $ticketCounts = Ticket::selectRaw('MONTH(report_received) as month, COUNT(*) as count')
        //                         ->whereYear('report_received', $currentYear)
        //                         ->groupBy('month')
        //                         ->orderBy('month')
        //                         ->pluck('count', 'month');

        // // if want to fill in months with zero counts, use the following code
        // $allMonths = range(1, 12);
        // $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());

        // ###############################--------------------------------------###############################
        // area chart - current months and 6 months before (backwards)
        // tickets from the 6 months before the current month to the current month
        // current year and month
        // $currentYear = now()->year;
        // $currentMonth = now()->month;

        // // calculate the starting month 6 months before the current month
        // $startMonth = Carbon::now()->subMonths(6)->month;

        // // start year
        // $startYear = $currentYear;
        // if ($startMonth > $currentMonth) {
        //     $startYear -= 1;        // if start month is greater than current month, adjust start year
        // }

        // // fetch ticket counts by month from the database
        // $ticketCounts = Ticket::selectRaw('MONTH(report_received) as month, COUNT(*) as count')
        //                     ->whereYear('report_received', '>=', $startYear)
        //                     ->where(function($query) use ($startMonth, $currentMonth, $startYear, $currentYear) {
        //                         if ($startYear == $currentYear) {
        //                             $query->whereBetween(DB::raw('MONTH(report_received)'), [$startMonth, $currentMonth]);
        //                         } else {
        //                             $query->where(function($query) use ($startMonth, $currentYear, $startYear) {
        //                                 $query->where('report_received', '>=', Carbon::create($startYear, $startMonth, 1)->format('Y-m-d'))
        //                                         ->where('report_received', '<', Carbon::create($currentYear, $currentMonth, 1)->format('Y-m-d'));
        //                             });
        //                         }
        //                     })
        //                     ->groupBy('month')
        //                     ->orderBy('month')
        //                     ->pluck('count', 'month');

        // // fill in months with zero counts
        // $allMonths = range($startMonth, $currentMonth);
        // $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());

        // // convert month numbers to month names for labels
        // $labels = [];
        // foreach ($allMonths as $month) {
        //     $labels[] = __(date('M', mktime(0, 0, 0, $month, 1)));
        // }

        // ###############################--------------------------------------###############################
        // area chart - tickets from the 6 months before the current month to the current month
        $currentDate = now();   // get current date and time
        $startDate = $currentDate->copy()->subMonths(5)->startOfMonth();    // find start of the month, five months ago
        $endDate = $currentDate->copy()->endOfMonth();      // find end of the current month.

        // fetch ticket counts by month from the db
        $ticketCounts = Ticket::selectRaw('YEAR(report_received) as year, MONTH(report_received) as month, COUNT(*) as count')  // get the year, month, and number of tickets
                                ->whereBetween('report_received', [$startDate, $endDate])   // only include tickets from date range based on report_received
                                ->groupBy('year', 'month')      // group results
                                ->orderBy('year')
                                ->orderBy('month')
                                ->get()
                                // ->keyBy(function($item) {
                                //     return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                                // });
                                ->mapWithKeys(function($item) {         // convert results to an array
                                    return [sprintf('%04d-%02d', $item->year, $item->month) => $item->count];
                                });

        // create collection to ensure every month in the range has a value, even if it is 0 (0 = no ticket)
        $allMonths = collect();
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {    // check each month from start to end date, adding each one to collection with a count of zero
            $allMonths->put($date->format('Y-m'), 0);       // DB use Y-m-d (2024-02-01), Y-m because only that part want to be calculate
        }
        // $ticketCounts = $allMonths->merge($ticketCounts->pluck('count', 'month'));
        $ticketCounts = $allMonths->merge($ticketCounts);   // add zero-count months with actual ticket counts

        // convert to arrays for passing to the view
        $ticketCountsArray = $ticketCounts->values()->toArray();

        // month name labels for the chart
        $monthLabels = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {    // loop through each month again
            $monthLabels[] = $date->format('M Y');      // M - A short textual representation of a month (three letters), Y - A four digit representation of a year
        }

        // donut chart
        $totalTickets = Ticket::count();
        $totalTicketHardware = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 1)->count();
        $totalTicketSoftware = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 2)->count();
        $totalTicketNetwork = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 3)->count();
        $totalTicketNonsystem = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')->where('issues.reqcategory_id', 4)->count();

        return view('/dashboard/mydashboard', compact('allNewTodayCount', 'allUpcomingDueCount', 'allOverdueCount',
                                                    'tickets', 'allTixOpen', 'allTixClosed', 'allTixKiv', 
                                                    'knowledgebases', 'users', 'sites', 'equipments', 
                                                    // 'ticketCounts', 'monthLabels',
                                                    // 'ticketCounts' => $ticketCounts->values()->toArray(),
                                                    // 'labels' => $labels,
                                                    'ticketCountsArray', 'monthLabels',
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

        // ###############################--------------------------------------###############################
        // // area chart
        // $currentYear = now()->year;

        // // fetch ticket counts by month from the db based on site_id
        // $ticketCounts = Ticket::whereHas('issue', function ($query) use ($site_id) {
        //                                     $query->where('site_id', $site_id);
        //                                 })
        //                                 ->selectRaw('MONTH(report_received) as month, COUNT(*) as count')
        //                                 ->whereYear('report_received', $currentYear)
        //                                 ->groupBy('month')
        //                                 ->orderBy('month')
        //                                 ->pluck('count', 'month');

        // // if want to fill in months with zero counts, use the following code
        // $allMonths = range(1, 12);
        // $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());
        // ###############################--------------------------------------###############################
        // area chart - tickets from the 6 months before the current month to the current month
        $currentDate = now();   // get current date and time
        $startDate = $currentDate->copy()->subMonths(5)->startOfMonth();    // find start of the month, five months ago
        $endDate = $currentDate->copy()->endOfMonth();      // find end of the current month.

        // fetch ticket counts by month from the db based on site_id
        $ticketCounts = Ticket::whereHas('issue', function ($query) use ($site_id) {
                                                 $query->where('site_id', $site_id);
                                })
                                ->selectRaw('YEAR(report_received) as year, MONTH(report_received) as month, COUNT(*) as count')  // get the year, month, and number of tickets
                                ->whereBetween('report_received', [$startDate, $endDate])   // only include tickets from date range based on report_received
                                ->groupBy('year', 'month')      // group results
                                ->orderBy('year')
                                ->orderBy('month')
                                ->get()
                                // ->keyBy(function($item) {
                                //     return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                                // });
                                ->mapWithKeys(function($item) {         // convert results to an array
                                    return [sprintf('%04d-%02d', $item->year, $item->month) => $item->count];
                                });

        // create collection to ensure every month in the range has a value, even if it is 0 (0 = no ticket)
        $allMonths = collect();
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {    // check each month from start to end date, adding each one to collection with a count of zero
            $allMonths->put($date->format('Y-m'), 0);       // DB use Y-m-d (2024-02-01), Y-m because only that part want to be calculate
        }
        // $ticketCounts = $allMonths->merge($ticketCounts->pluck('count', 'month'));
        $ticketCounts = $allMonths->merge($ticketCounts);   // add zero-count months with actual ticket counts

        // convert to arrays for passing to the view
        $ticketCountsArray = $ticketCounts->values()->toArray();

        // month name labels for the chart
        $monthLabels = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {    // loop through each month again
            $monthLabels[] = $date->format('M Y');      // M - A short textual representation of a month (three letters), Y - A four digit representation of a year
        }

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
                                                        // 'ticketCounts',
                                                        'ticketCountsArray', 'monthLabels',
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

        // ###############################--------------------------------------###############################
        // // area chart
        // $currentYear = now()->year;

        // // fetch ticket counts by month from the db based on site_id
        // $ticketCounts = Ticket::whereHas('issue', function ($query) use ($site_id) {
        //                                     $query->where('site_id', $site_id);
        //                                 })
        //                                 ->selectRaw('MONTH(report_received) as month, COUNT(*) as count')
        //                                 ->whereYear('report_received', $currentYear)
        //                                 ->groupBy('month')
        //                                 ->orderBy('month')
        //                                 ->pluck('count', 'month');

        // // if want to fill in months with zero counts, use the following code
        // $allMonths = range(1, 12);
        // $ticketCounts = array_replace(array_fill_keys($allMonths, 0), $ticketCounts->toArray());
        // ###############################--------------------------------------###############################
        // area chart - tickets from the 6 months before the current month to the current month
        $currentDate = now();   // get current date and time
        $startDate = $currentDate->copy()->subMonths(5)->startOfMonth();    // find start of the month, five months ago
        $endDate = $currentDate->copy()->endOfMonth();      // find end of the current month.

        // fetch ticket counts by month from the db based on site_id
        $ticketCounts = Ticket::whereHas('issue', function ($query) use ($site_id) {
                                                 $query->where('site_id', $site_id);
                                })
                                ->selectRaw('YEAR(report_received) as year, MONTH(report_received) as month, COUNT(*) as count')  // get the year, month, and number of tickets
                                ->whereBetween('report_received', [$startDate, $endDate])   // only include tickets from date range based on report_received
                                ->groupBy('year', 'month')      // group results
                                ->orderBy('year')
                                ->orderBy('month')
                                ->get()
                                // ->keyBy(function($item) {
                                //     return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                                // });
                                ->mapWithKeys(function($item) {         // convert results to an array
                                    return [sprintf('%04d-%02d', $item->year, $item->month) => $item->count];
                                });

        // create collection to ensure every month in the range has a value, even if it is 0 (0 = no ticket)
        $allMonths = collect();
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {    // check each month from start to end date, adding each one to collection with a count of zero
            $allMonths->put($date->format('Y-m'), 0);       // DB use Y-m-d (2024-02-01), Y-m because only that part want to be calculate
        }
        // $ticketCounts = $allMonths->merge($ticketCounts->pluck('count', 'month'));
        $ticketCounts = $allMonths->merge($ticketCounts);   // add zero-count months with actual ticket counts

        // convert to arrays for passing to the view
        $ticketCountsArray = $ticketCounts->values()->toArray();

        // month name labels for the chart
        $monthLabels = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addMonth()) {    // loop through each month again
            $monthLabels[] = $date->format('M Y');      // M - A short textual representation of a month (three letters), Y - A four digit representation of a year
        }

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
                                                        // 'ticketCounts',
                                                        'ticketCountsArray', 'monthLabels',
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
        // $allTic = Ticket::orderBy('ticket_no', 'desc')->get();

        // $allTicCount = Ticket::count();
        // $allOpenCount = Ticket::where('ticstatus_id', '2')->count();
        // $allClosedCount = Ticket::where('ticstatus_id', '4')->count();
        // $allKivCount = Ticket::where('ticstatus_id', '3')->count();

        $allTic = Ticket::orderByRaw("SUBSTRING(ticket_no, 4, 7) DESC, SUBSTRING(ticket_no, 12) DESC")  // SUBSTRING(original_string, start_position, length)
                        ->get();

        $allTicCount = Ticket::count();
                     
        $allOpenCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 2)
                        ->count();

        $allClosedCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 4)
                        ->count();
        
        $allKivCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 3)
                        ->count();

        return view('/dashboard/infohub/allticket', compact('allTic', 'allTicCount', 'allOpenCount', 'allClosedCount', 'allKivCount'));
    }

    public function allopen()
    {
        // $allOpen = Ticket::where('ticstatus_id', '2')->orderBy('ticket_no', 'desc')->get();

        // $allTicCount = Ticket::count();
        // $allOpenCount = Ticket::where('ticstatus_id', '2')->count();
        // $allClosedCount = Ticket::where('ticstatus_id', '4')->count();
        // $allKivCount = Ticket::where('ticstatus_id', '3')->count();

        $allOpen = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 2)
                        ->orderByRaw("SUBSTRING(ticket_no, 4, 7) DESC, SUBSTRING(ticket_no, 12) DESC")  // SUBSTRING(original_string, start_position, length)
                        ->get();

        $allTicCount = Ticket::count();
                     
        $allOpenCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 2)
                        ->count();

        $allClosedCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 4)
                        ->count();
        
        $allKivCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 3)
                        ->count();

        return view('/dashboard/infohub/allopen', compact('allOpen', 'allTicCount', 'allOpenCount', 'allClosedCount', 'allKivCount'));
    }

    public function allclosed()
    {
        // $allClosed = Ticket::where('ticstatus_id', '4')->orderBy('ticket_no', 'desc')->get();

        // $allTicCount = Ticket::count();
        // $allOpenCount = Ticket::where('ticstatus_id', '2')->count();
        // $allClosedCount = Ticket::where('ticstatus_id', '4')->count();
        // $allKivCount = Ticket::where('ticstatus_id', '3')->count();

        $allClosed = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 4)
                        ->orderByRaw("SUBSTRING(ticket_no, 4, 7) DESC, SUBSTRING(ticket_no, 12) DESC")  // SUBSTRING(original_string, start_position, length)
                        ->get();

        $allTicCount = Ticket::count();

        $allOpenCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 2)
                        ->count();

        $allClosedCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 4)
                        ->count();

        $allKivCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 3)
                        ->count();

        return view('/dashboard/infohub/allclosed', compact('allClosed', 'allTicCount', 'allOpenCount', 'allClosedCount', 'allKivCount'));
    }

    public function allkiv()
    {
        // $allKiv = Ticket::where('ticstatus_id', '3')->orderBy('ticket_no', 'desc')->get();

        // $allTicCount = Ticket::count();
        // $allOpenCount = Ticket::where('ticstatus_id', '2')->count();
        // $allClosedCount = Ticket::where('ticstatus_id', '4')->count();
        // $allKivCount = Ticket::where('ticstatus_id', '3')->count();

        $allKiv = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 3)
                        ->orderByRaw("SUBSTRING(ticket_no, 4, 7) DESC, SUBSTRING(ticket_no, 12) DESC")  //SUBSTRING(original_string, start_position, length)
                        ->get();

        $allTicCount = Ticket::count();

        $allOpenCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 2)
                        ->count();

        $allClosedCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 4)
                        ->count();

        $allKivCount = Ticket::where(function ($query) {
                            $query->select('ticstatus_id')
                                ->from('ticketlogs')
                                ->whereRaw('ticketlogs.ticket_id = tickets.id')
                                ->latest('id')
                                ->limit(1);
                        }, '=', 3)
                        ->count();                

        return view('/dashboard/infohub/allkiv', compact('allKiv', 'allTicCount', 'allOpenCount', 'allClosedCount', 'allKivCount'));
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

        $listTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $listOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $listClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $listKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/listticket', compact('listTic', 'listTicCount', 'listOpenCount', 'listClosedCount', 'listKivCount'));
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

        $listTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $listOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $listClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $listKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/listopen', compact('listOpen', 'listTicCount', 'listOpenCount', 'listClosedCount', 'listKivCount'));
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

        $listTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $listOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $listClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $listKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/listclosed', compact('listClosed', 'listTicCount', 'listOpenCount', 'listClosedCount', 'listKivCount'));
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

        $listTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $listOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $listClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $listKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/listkiv', compact('listKiv', 'listTicCount', 'listOpenCount', 'listClosedCount', 'listKivCount'));
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

        $entireTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $entireOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $entireClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $entireKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/entireticket', compact('entireTic', 'entireTicCount', 'entireOpenCount', 'entireClosedCount', 'entireKivCount'));
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
        
        $entireTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $entireOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $entireClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $entireKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/entireopen', compact('entireOpen', 'entireTicCount', 'entireOpenCount', 'entireClosedCount', 'entireKivCount'));
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

        $entireTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $entireOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $entireClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $entireKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/entireclosed', compact('entireClosed', 'entireTicCount', 'entireOpenCount', 'entireClosedCount', 'entireKivCount'));
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
        
        $entireTicCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->count();
        $entireOpenCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 2)
                                ->count();
        $entireClosedCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 4)
                                ->count();
        $entireKivCount = Ticket::join('issues', 'tickets.request_id', '=', 'issues.id')
                                ->where('issues.site_id', $site_id)
                                ->where('tickets.ticstatus_id', 3)
                                ->count();

        return view('/dashboard/infohub/entirekiv', compact('entireKiv', 'entireTicCount', 'entireOpenCount', 'entireClosedCount', 'entireKivCount'));
    }

    //---------------------------------------------------------------------------------------------------------------------------

    // try chatbot sementara
    public function chat()
    {
        return view('chat');
    }

    //---------------------------------------------------------------------- PARAMOUNT ----------------------------------------------------------------------
    
    // super admin's paramount
    // new today (current)
    public function allnewtoday()
    {        
        // $allNewTodayData = DB::table('tickets')
        //     ->join('ticketlogs', 'tickets.id', '=', 'ticketlogs.ticket_id')
        //     ->where('ticketlogs.ticstatus_id', 2)
        //     ->whereDate('ticketlogs.response_date', Carbon::today())
        //     ->select('tickets.*', 'ticketlogs.response_date', 'ticketlogs.response_time')
        //     ->get();

        // $allNewTodayData = Ticket::with(['issue.site', 'issue.equipment', 'severity'])
        //                             ->whereHas('ticketlog', function($query) {
        //                                 $query->where('ticstatus_id', 2)
        //                                     ->whereDate('response_date', Carbon::today());
        //                             })
        //                             ->get();

        // $allNewTodayData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        // ->whereHas('ticketlog', function($query) {
        //     $query->where('ticstatus_id', 1)
        //           ->whereDate('report_received', Carbon::today());
        // })
        // ->get();

        // ni betul dah
        // date_default_timezone_set("Asia/Kuala_Lumpur");
        // Carbon::setTimezone('Asia/Kuala_Lumpur');
        // setTimezone('Asia/Kuala_Lumpur');

        // guna query ni fx untuk display ticket yang ada log. Kalau takda log, ticket row takkan display
        // $allNewTodayData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        //                             ->whereHas('ticketlog', function($query) {
        //                                 $query->whereDate('report_received', Carbon::today());
        //                             })
        //                             ->get();


        // latest 12/6 guna query ni
        $allNewTodayData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                                    // ->where('ticstatus_id', 1)
                                    ->whereDate('report_received', Carbon::today('Asia/Kuala_Lumpur'))
                                    ->orderBy('ticket_no', 'desc')
                                    ->get();

        $allNewTodayCount = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                                    ->where('ticstatus_id', 1)                          //  extract current status = 1 (New Ticket)
                                    ->whereDate('report_received', Carbon::today())
                                    ->count();

        // $allNewTodayCount = $allNewTodayData->count();

        // ni pun betul juga. display new ticket ada.
        // $allNewTodayData = Ticket::with('ticketlog')
        //     ->whereDate('report_received', '2024-06-11')
        //     ->get();

        return view('/dashboard/paramount/allnewtoday', compact('allNewTodayData', 'allNewTodayCount'));
    }

    // upcomingdue
    public function allupcomingdue()
    {   
        // $dueDate = Carbon::now()->addDays(5)->toDateString();       // due in 5 days from today

        // // Query to retrieve upcoming due data
        // // $allUpcomingDueData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        // //     ->whereHas('ticketlog', function($query) use ($dueDate) {
        // //         $query->where('ticstatus_id', 2)
        // //             ->whereDate('response_date', '<=', $dueDate); // Due in 5 days or earlier
        // //     })
        // //     ->get();

        // // $allUpcomingDueCount = $allUpcomingDueData->count();

        // // boleh guna ni tapi bukan result yang saya nak. function yg sepatutnya display mana mana ticket yang hampir nak due dalam masa 5 hari dari sekarang.
        // // guide date expected_closure_time.
        // // expected_closure_time 12 to 16 jun 2024, next 5 day from today, then should ticket row display, tapi if 17 jun onwards takperlu display lagi.
        // // $allUpcomingDueData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        // //                             // ->where('ticstatus_id', 1)
        // //                             ->whereDate('report_received', '<=', $dueDate)  // should be expected_closure_time
        // //                             ->get();

        // $allTickets = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        // // ->where('ticstatus_id', 1)
        // // ->whereDate('report_received', '<=', $dueDate)  // should be expected_closure_time
        // ->get();
                
        // $allUpcomingDueData = $allTickets->filter(function ($ticket) use ($dueDate) {
        //     return $ticket->expected_closure_time <= $dueDate;
        // });
                

        // return view('/dashboard/paramount/allupcomingdue', compact('allUpcomingDueData', 'allUpcomingDueCount'));


        // failure: expected_closure_time column cannot display since it is function in Ticket.php
        // $today = \Carbon\Carbon::now();
        // $upcomingDueDate = $today->addDays(5);

        // $allUpcomingDueData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        //                             ->whereBetween('expected_closure_time', [$today, $upcomingDueDate])  
        //                             ->orderBy('ticket_no', 'desc')
        //                             ->get();

        // return view('/dashboard/paramount/allupcomingdue', compact('allUpcomingDueData'));


        $today = \Carbon\Carbon::now('Asia/Kuala_Lumpur');  // current date and time
        $upcomingDueDate = $today->copy()->addDays(5);      // next 5 days from today and add to today to get upcoming due

        $allTickets = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                            ->orderBy('ticket_no', 'desc')
                            ->get();

        // filter tickets to keep only those whose expected closure time is between today and the next 5 days
        $allUpcomingDueData = $allTickets->filter(function ($ticket) use ($today, $upcomingDueDate) {
            $expectedClosureTime = $ticket->expected_closure_time;                                      // get expected closure time using model function
            return $expectedClosureTime && $expectedClosureTime->between($today, $upcomingDueDate);     // check if expected closure time is between today and the upcoming due date
        });

        return view('/dashboard/paramount/allupcomingdue', compact('allUpcomingDueData'));
    }
    
    // overdue
    public function alloverdue()
    {        
        // $tickets = Ticket::all();
        // $overdueTickets = [];

        // foreach ($tickets as $ticket) {
        //     $ticketlogs = Ticketlog::where('ticket_id', $ticket->id)->orderBy('date', 'asc')->get();

        //     foreach ($ticketlogs as $log) {
        //         $isOverdue = false;
        //         try {
        //             $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $log->response_date . ' ' . $log->response_time);
        //         } catch (\Exception $e) {
        //             continue; // skip this log if date-time parsing fails
        //         }

        //         if ($ticket->severity_id == 1) {
        //             if ($log->ticstatus_id == 2) {
        //                 $endDate = $startDate->copy()->addHours(72);
        //                 if (now()->greaterThan($endDate)) {
        //                     $isOverdue = true;
        //                 }
        //             } elseif ($log->ticstatus_id == 4) {
        //                 break; // Stop count
        //             }
        //         } elseif ($ticket->severity_id == 2) {
        //             if ($log->ticstatus_id == 2) {
        //                 $endDate = $startDate->copy()->addDays(14);
        //                 if (now()->greaterThan($endDate)) {
        //                     $isOverdue = true;
        //                 }
        //             } elseif ($log->ticstatus_id == 4) {
        //                 break; // Stop count
        //             }
        //         } elseif ($ticket->severity_id == 3) {
        //             if ($log->ticstatus_id == 2) {
        //                 $endDate = $startDate->copy()->addMonths(3);
        //                 if (now()->greaterThan($endDate)) {
        //                     $isOverdue = true;
        //                 }
        //             } elseif ($log->ticstatus_id == 4) {
        //                 break; // Stop count
        //             }
        //         }

        //         if ($isOverdue) {
        //             $overdueTickets[] = $ticket;
        //             break;
        //         }
        //     }
        // }

        // return view('dashboard.paramount.alloverdue', compact('overdueTickets'));


        // $allOverdueData = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
        // ->whereHas('ticketlog', function($query) {
        //     $query->where('ticstatus_id', 2)
        //           ->whereDate('response_date', Carbon::today());
        // })
        // ->get();

        // $allOverdueCount = $allOverdueData->count();

        // return view('/dashboard/paramount/alloverdue', compact('allOverdueData', 'allOverdueCount'));


        $today = \Carbon\Carbon::now('Asia/Kuala_Lumpur');  // current date and time
        // $overDueDate = $today->copy()->addDays(5);      // next 5 days from today and add to today to get upcoming due

        $allTickets = Ticket::with(['issue.site', 'issue.equipment', 'severity', 'ticketlog.reaction'])
                            ->orderBy('ticket_no', 'desc')
                            ->get();

        // filter tickets to keep only those whose expected closure time is before today (overdue)
        $allOverdueData = $allTickets->filter(function ($ticket) use ($today) {
            $expectedClosureTime = $ticket->expected_closure_time;               // get expected closure time using model function
            return $expectedClosureTime && $expectedClosureTime->lt($today);     // check if expected closure time is before today (overdue), lt() means less than
        });

        return view('/dashboard/paramount/alloverdue', compact('allOverdueData', 'allOverdueCount'));
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