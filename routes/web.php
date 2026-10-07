<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PpdbDocumentController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [PublicPageController::class, 'about'])->name('about');
Route::get('/program', [PublicPageController::class, 'programs'])->name('programs');
Route::get('/prestasi', [PublicPageController::class, 'achievements'])->name('achievements');
Route::get('/galeri', [PublicPageController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PublicPageController::class, 'news'])->name('news');
Route::get('/berita/{slug}', [PublicPageController::class, 'newsDetail'])->name('news.show');

/*
|--------------------------------------------------------------------------
| PPDB Online Routes
|--------------------------------------------------------------------------
*/
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/sukses/{number}', [PpdbController::class, 'success'])->name('ppdb.success');
Route::get('/ppdb/cek-status', [PpdbController::class, 'checkStatus'])->name('ppdb.check-status');

/*
|--------------------------------------------------------------------------
| Auth & Admin Redirects
|--------------------------------------------------------------------------
*/
Route::redirect('/login', '/admin/login')->name('login');

Route::middleware(['auth'])->group(function () {
    // 1. Direct document viewer for PPDB Registrations
    Route::get('/admin/ppdb-registrations/{registration}/document/{field}', [PpdbDocumentController::class, 'show'])
        ->name('admin.ppdb.document');

    // 2. Signed temporary URL viewer for Filament form file uploads on local disk
    Route::get('/secure-files/{path}', function (Request $request, string $path) {
        if (! $request->hasValidSignature()) {
            abort(403, 'Tautan berkas tidak valid atau telah kedaluwarsa.');
        }

        if (! Storage::disk('local')->exists($path)) {
            abort(404, 'Berkas tidak ditemukan.');
        }

        $fullPath = Storage::disk('local')->path($path);
        $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, private',
        ]);
    })->where('path', '.*')->name('secure.private.file');
});
