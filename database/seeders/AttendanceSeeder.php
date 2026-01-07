<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 4; // 田中さん

        // 期間
        $start = Carbon::create(2025, 12, 1);
        $end   = Carbon::create(2025, 12, 26);

        // 既存データ削除（unique制約対策）
        DB::table('attendances')
            ->where('user_id', $userId)
            ->whereBetween('work_date', [
                $start->toDateString(),
                $end->toDateString()
            ])
            ->delete();

        $date = $start->copy();

        while ($date->lte($end)) {

            // 土日スキップ
            if ($date->isWeekend()) {
                $date->addDay();
                continue;
            }

            // 出勤
            $clockIn = '09:00:00';

            // 休憩（±5分ランダム）
            $breakIn  = Carbon::createFromTime(12, 0)->addMinutes(rand(-5, 5));
            $breakOut = Carbon::createFromTime(13, 0)->addMinutes(rand(-5, 5));

            // 退勤（17:30〜19:00）
            $clockOut = Carbon::createFromTime(17, 30)
                ->addMinutes(rand(0, 90));

            DB::table('attendances')->insert([
                'user_id'    => $userId,
                'work_date'  => $date->toDateString(),
                'clock_in'   => $clockIn,
                'break_in'   => $breakIn->format('H:i:s'),
                'break_out'  => $breakOut->format('H:i:s'),
                'clock_out'  => $clockOut->format('H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $date->addDay();
        }
    }
}
