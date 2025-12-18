<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * 仮の社員ID
     */
    private function tempEmployeeId()
    {
        return 1; // employees.id
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
}
