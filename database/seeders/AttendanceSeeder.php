<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Member;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::all();

        foreach ($members as $member) {

            Attendance::create([
                'member_id' => $member->id,
                'tanggal' => Carbon::now()->subDays(rand(0,9))->toDateString(),
                'jam_masuk' => Carbon::now()->format('H:i:s'),
                'status' => 'Hadir',
                'keterangan' => null,
            ]);

        }
    }
}