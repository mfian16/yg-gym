<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return redirect('/member');
});

Route::resource('member', MemberController::class);
Route::get('/member/card/{id}', [MemberController::class,'card'])->name('member.card');
Route::get('/member/qrcode/{id}', [MemberController::class,'downloadQrCode'])->name('member.qrcode.download');
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/scan', [AttendanceController::class, 'scanPage'])->name('attendance.scan');
Route::post('/attendance/process', [AttendanceController::class, 'scanProcess'])->name('attendance.process');