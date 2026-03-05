<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    // Menampilkan semua member
    public function index()
    {
        $members = Member::all(); // ambil semua member
        return view('member.index', compact('members'));
    }

    // Form tambah member
    public function create()
    {
        return view('member.create');
    }

    // Simpan data member baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'paket' => 'required',
            'masa_aktif' => 'required|date',
            'foto' => 'nullable|string|max:5000000'
        ]);

        $data = $request->all();

        // Generate QR Code otomatis (sebagai barcode)
        $latest = Member::latest()->first();
        $nextId = $latest ? $latest->id + 1 : 1;
        $data['qr_code'] = 'GYM-' . date('Ymd') . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);


        // Upload foto (jika ada)
        if ($request->foto) {
            $image = $request->foto;
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = base64_decode($image);
            $fileName = time().'.jpg';
            file_put_contents(public_path('uploads/members/'.$fileName), $image);
            $data['foto'] = $fileName;
        }

        Member::create($data);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan');
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'paket' => 'required',
            'masa_aktif' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
            if ($member->foto && file_exists(public_path('uploads/members/' . $member->foto))) {
                unlink(public_path('uploads/members/' . $member->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/members'), $fileName);
            $data['foto'] = $fileName;
        }

        $member->update($data);

        return redirect()->route('member.index')->with('success', 'Member berhasil diperbarui');
    }


    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('member.edit', compact('member'));
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus');
    }
    
    public function downloadQrCode($id)
    {
        $member = Member::findOrFail($id);

        $qr = QrCode::format('svg')
            ->size(300)
            ->margin(1)
            ->generate($member->qr_code);

        return response($qr)
            ->header('Content-Type', 'image/psvg+xml')
            ->header('Content-Disposition', 'attachment; filename="qrcode-'.$member->id.'.svg"');
    }

    public function card($id)
    {
        $member = Member::findOrFail($id);

        $qr_svg = QrCode::format('svg')
            ->size(150)
            ->generate($member->qr_code);

        $qr = base64_encode($qr_svg);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('member.card', compact('member','qr'));

        return $pdf->download('member-card-'.$member->id.'.pdf');
    }
}