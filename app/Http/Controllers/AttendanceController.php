<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('member')
            ->orderByDesc('tanggal')
            ->orderByDesc('jam_masuk')
            ->get();

        return view('attendance.index', compact('attendances'));
    }

    public function scanPage()
    {
        return view('attendance.scan');
    }

    public function scanProcess(Request $request)
    {
        $request->validate([
            'qr' => 'required|string',
        ]);

        $qr = $request->qr;

        $member = Member::where('qr_code', $qr)->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ]);
        }

        $today = Carbon::today();
        $now = Carbon::now();

        $masaAktif = Carbon::parse($member->masa_aktif);
        $sisaHari = $today->diffInDays($masaAktif, false);

        if ($sisaHari > 1) {
            $status = "Aktif";
            $sisaWaktu = $sisaHari . " hari";
        } elseif ($sisaHari == 1) {
            $status = "Segera Perpanjang";
            $sisaWaktu = "1 hari";
        } else{
            $status = "Expired";
            $sisaWaktu = "0 hari";
        }

        if ($status == "Expired") {
            return response()->json([
                'success' => false,
                'data' => [
                    'nama' => $member->nama,
                    'status' => $status,
                    'sisa_waktu' => $sisaWaktu
                ],
                'message' => 'Membership sudah habis'
            ]);
        }

        $cek = Attendance::where('member_id', $member->id)
            ->where('tanggal', $now->toDateString())
            ->first();

        if ($cek) {
            return response()->json([
                'success' => false,
                'message' => 'Member sudah absensi hari ini'
            ]);
        }

        Attendance::create([
            'member_id' => $member->id,
            'tanggal' => $now->toDateString(),
            'jam_masuk' => $now->toTimeString(),
            'status' => 'Hadir',
            'keterangan' => null,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'nama' => $member->nama,
                'status' => $status,
                'sisa_waktu' => $sisaWaktu
            ]
        ]);
    }
}