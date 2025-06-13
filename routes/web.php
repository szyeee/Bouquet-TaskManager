<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

//Route::view('/', 'welcome');

Route::get('/', function () {
    return file_get_contents(public_path('index.html'));
});

// Group: Hanya auth, tidak peduli sudah verifikasi atau belum
Route::middleware('auth')->group(function () {
    // Halaman profil user
    //Route::view('profile', 'profile')->name('profile');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Edit profile
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Update password
    Route::get('profile/password', function () {
        return view('profile.update-password');
    })->name('profile.password.edit');

    Route::put('profile/password', [PasswordController::class, 'update'])->name('profile.password.update');

    // Hapus akun
    Route::delete('profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kirim ulang email verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // Halaman verifikasi email notice
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Verifikasi email lewat link
    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

// Group: Auth dan sudah verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('pengiriman', PengirimanController::class);
});

// “Tes dashboard” tanpa middleware, lalu panggil auth.php
Route::get('dashboard-tes', function () {
    return '→ Kalau Anda melihat teks ini, berarti route di-load dengan benar tanpa middleware';
});

require __DIR__.'/auth.php';
