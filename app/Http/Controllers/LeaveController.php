<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeLeaveMaster;
use App\Models\LeaveMaster;
use App\Models\LeaveBalance;
use App\Models\NonWorkingDay;
use Carbon\Carbon;
use DB;
class LeaveController extends Controller
{
    /**
     * Show leave form.
     */
    public function create()
    {
        $leaveTypes = LeaveMaster::all();
        return view('leaves.create', compact('leaveTypes'));
    }

    /**
     * Store leave application.
     */
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'employeecode' => 'required|string|exists:employee_master,employee_code',
            'fromdate' => 'required|date',
            'todate' => 'required|date|after:fromdate',
            'leavetype' => 'required|exists:leave_master,id',
            'comment' => 'nullable|string|max:300',
        ]);
        
        // Check if the leave dates overlap with existing leaves
        $existingLeave = EmployeeLeaveMaster::where('employeecode', $request->employeecode)
        ->where(function ($query) use ($request) {
            $query->whereBetween('fromdate', [$request->fromdate, $request->todate])
                  ->orWhereBetween('todate', [$request->fromdate, $request->todate]);
        })
        ->exists();
        
        if ($existingLeave) {
            return back()->withErrors(['Leave for the selected date range already exists!'])->withInput();
        }
        
        // Calculate the number of leave days excluding non-working days
        $fromDate = Carbon::parse($request->fromdate);
        $toDate = Carbon::parse($request->todate);
        $totalDays = $fromDate->diffInDays($toDate) + 1;
  

        $nonWorkingDays = NonWorkingDay::whereBetween('date', [$fromDate, $toDate])->count();
        $leaveDays = $totalDays - $nonWorkingDays;

        if ($leaveDays <= 0) {
            return back()->withErrors(['No working days available in the selected date range!'])->withInput();
        }

        $leaveBalance = LeaveBalance::where('leavetype', $request->leavetype)
        ->where('employeecode', $request->employeecode)
        ->first();
    
    if (!$leaveBalance || $leaveBalance->leavebalance < $leaveDays) {
        return back()->withErrors(['Insufficient leave balance!'])->withInput();
    }
    
    $leaveBalance->leavebalance -= $leaveDays;
    $leaveBalance->save();
        // Store the leave application
       EmployeeLeaveMaster::create([
    'leavetype' => $request->leavetype,
    'employeecode' => $request->employeecode,
    'fromdate' => $fromDate,
    'todate' => $toDate,
    'numberofDays' => $leaveDays,
    'comment' => $request->comment,
]);


        return redirect()->route('leaves.index')->with('success', 'Leave application submitted successfully!');
    }

    /**
     * Display leave listing page.
     */
    public function index()
    {
        $leaves = EmployeeLeaveMaster::with('leaveType')->paginate(10);

        // Fetch report data for the table and graph
        $reportData = DB::table('employee_leave_master')
            ->join('employee_master', 'employee_leave_master.employeecode', '=', 'employee_master.employee_code')
            ->select(
                'employee_leave_master.employeecode',
                'employee_master.employee_name',
                DB::raw('SUM(employee_leave_master.numberofDays) as total_leaves')
            )
            ->groupBy('employee_leave_master.employeecode', 'employee_master.employee_name')
            ->get();
    
        // Prepare graph data
        $graphData = $reportData->map(function ($data) {
            return [
                'employee' => $data->employee_name,
                'total_leaves' => $data->total_leaves,
            ];
        });
    
        return view('leaves.index', compact('leaves', 'reportData', 'graphData'));
    }

    /**
     * Generate leave report (user-wise graph).
     */
    public function report()
    {
        // Fetch report data
        $reportData = DB::table('employee_leave_master')
            ->join('employee_master', 'employee_leave_master.employeecode', '=', 'employee_master.employee_code')
            ->select(
                'employee_leave_master.employeecode',
                'employee_master.employee_name',
                DB::raw('SUM(employee_leave_master.numberofDays) as total_leaves')
            )
            ->groupBy('employee_leave_master.employeecode', 'employee_master.employee_name')
            ->get();
    
        // Prepare graph data
        $graphData = $reportData->map(function ($data) {
            return [
                'employee' => $data->employee_name,
                'total_leaves' => $data->total_leaves,
            ];
        });
    
        return view('leaves.report', compact('reportData', 'graphData'));
    }
    
    
}
