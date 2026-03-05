<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        Member::create([
            'nama' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'alamat' => 'Surabaya',
            'paket' => 'Bulanan',
            'masa_aktif' => Carbon::now()->addDays(10),
            'qr_code' => 'GYM001'
        ]);

        Member::create([
            'nama' => 'Andi Pratama',
            'no_hp' => '081234567891',
            'alamat' => 'Sidoarjo',
            'paket' => 'Bulanan',
            'masa_aktif' => Carbon::now()->addDays(1),
            'qr_code' => 'GYM002'
        ]);

        Member::create([
            'nama' => 'Siti Rahma',
            'no_hp' => '081234567892',
            'alamat' => 'Gresik',
            'paket' => 'Bulanan',
            'masa_aktif' => Carbon::now()->subDays(2),
            'qr_code' => 'GYM003'
        ]);

        Member::create([
            'nama' => 'Maulana Ibrahim',
            'no_hp' => '081231267892',
            'alamat' => 'Malang',
            'paket' => 'Bulanan',
            'masa_aktif' => Carbon::now()->subDays(2),
            'qr_code' => 'GYM004'
        ]);

        Member::create([
            'nama' => 'Dodi Pamungkas',
            'no_hp' => '081231226750',
            'alamat' => 'Denpasa',
            'paket' => 'Bulanan',
            'masa_aktif' => Carbon::now()->subDays(2),
            'qr_code' => 'GYM005'
        ]);
    }
}