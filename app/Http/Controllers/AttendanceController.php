<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    /**
     * 仮の社員ID
     */
    private function tempUserId()
    {
        return Auth::id(); // users.id
        // return 1; // users.id
    }

    public function index(Request $request)
    {
        // $attendances = Attendance::where('user_id', $this->tempUserId())
        //     ->orderBy('work_date', 'desc')
        //     ->get();

        // return view('attendances.index', compact('attendances'));
        // 表示月（YYYY-MM）
        $month = $request->input('month', now()->format('Y-m'));

        $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $end   = Carbon::createFromFormat('Y-m', $month)->endOfMonth();
        $dates = CarbonPeriod::create($start, $end);

        $attendances = Attendance::where('user_id', $this->tempUserId())
            ->whereBetween('work_date', [$start, $end])
            ->orderBy('work_date')
            ->get()
            ->keyBy(fn($a) => $a->work_date->format('Y-m-d'));


        return view('attendances.index', compact('month', 'attendances', 'dates'));
    }

    public function create()
    {
        $user = User::find($this->tempUserId());

        return view('attendances.create', compact('user'));
    }

    /**
     * 出勤
     */
    public function clockIn()
    {
        Attendance::updateOrCreate(
            [
                'user_id' => $this->tempUserId(),
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
                'user_id' => $this->tempUserId(),
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
                'user_id' => $this->tempUserId(),
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
                'user_id' => $this->tempUserId(),
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

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'clock_in'  => 'nullable',
            'clock_out' => 'nullable',
            'break_in'  => 'nullable',
            'break_out' => 'nullable',
        ]);

        $date = $attendance->work_date->format('Y-m-d');

        $data = [];

        foreach (['clock_in', 'clock_out', 'break_in', 'break_out'] as $field) {
            if ($request->filled($field)) {
                $data[$field] = Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $date . ' ' . $request->input($field)
                );
            }
        }

        $attendance->update($data);

        return redirect()
            ->route('attendances.index')
            ->with('success', '出退勤を更新しました');
    }
}
