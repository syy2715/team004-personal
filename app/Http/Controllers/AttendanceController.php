<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    /**
     * 仮の社員ID
     */
    private function tempEmployeeId()
    {
        // return Auth::id(); // employees.id
        return 1; // employees.id
    }

    public function index(Request $request)
    {
        // $attendances = Attendance::where('employee_id', $this->tempEmployeeId())
        //     ->orderBy('work_date', 'desc')
        //     ->get();

        // return view('attendances.index', compact('attendances'));
         // 表示月（YYYY-MM）
        $month = $request->input('month', now()->format('Y-m'));

        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end   = Carbon::createFromFormat('Y-m', $month)->endOfMonth();
        $dates = CarbonPeriod::create($start, $end);

        $attendances = Attendance::where('employee_id', $this->tempEmployeeId())
            ->whereBetween('work_date', [$start, $end])
            ->orderBy('work_date')
            ->get()
            ->keyBy(fn ($a) => $a->work_date->format('Y-m-d'));
            

        return view('attendances.index', compact('month', 'attendances', 'dates'));
    }

    public function create()
    {
        $employee = Employee::find($this->tempEmployeeId());

        return view('attendances.create', compact('employee'));
    }

    /**
     * 出勤
     */
    public function clockIn()
    {
        Attendance::updateOrCreate(
            [
                'employee_id' => $this->tempEmployeeId(),
                'work_date' => today(),
            ],
            [
                'clock_in' => now(),
            ]
        );

        return back()->with('success', '出勤を登録しました');
    }

    /**
     * 休憩入り
     */
    public function breakStart()
    {
        Attendance::updateOrCreate(
            [
                'employee_id' => $this->tempEmployeeId(),
                'work_date' => today(),
            ],
            [
                'break_in' => now(),
            ]
        );

        return back()->with('success', '休憩入りを登録しました');
    }

    /**
     * 休憩戻り
     */
    public function breakEnd()
    {
        Attendance::updateOrCreate(
            [
                'employee_id' => $this->tempEmployeeId(),
                'work_date' => today(),
            ],
            [
                'break_out' => now(),
            ]
        );

        return back()->with('success', '休憩戻りを登録しました');
    }

    /**
     * 退勤
     */
    public function clockOut()
    {
        Attendance::updateOrCreate(
            [
                'employee_id' => $this->tempEmployeeId(),
                'work_date' => today(),
            ],
            [
                'clock_out' => now(),
            ]
        );

        return back()->with('success', '退勤を登録しました');
    }

    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function update(Attendance $attendance, Request $request)
    {
        $attendance->update($request->all());

        return back()->with('success', '出退勤を更新しました');
    }
}
