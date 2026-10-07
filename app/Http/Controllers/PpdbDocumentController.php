<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PpdbDocumentController extends Controller
{
    /**
     * Allowed document fields on PpdbRegistration model.
     *
     * @var array<string>
     */
    protected array $allowedFields = [
        'family_card_file',
        'birth_certificate_file',
        'graduation_certificate_file',
        'achievement_certificate_file',
        'student_photo_file',
    ];

    /**
     * Securely serve PPDB registration documents to authenticated users only.
     */
    public function show(Request $request, PpdbRegistration $registration, string $field): BinaryFileResponse
    {
        // 1. Strict Authentication Check
        if (! auth()->check()) {
            abort(403, 'Akses ditolak. Anda harus login ke panel admin terlebih dahulu untuk melihat berkas ini.');
        }

        // 2. Validate requested document field name
        if (! in_array($field, $this->allowedFields, true)) {
            abort(404, 'Jenis dokumen tidak valid.');
        }

        $relativePath = $registration->{$field};

        if (blank($relativePath)) {
            abort(404, 'Dokumen ini belum diunggah oleh pendaftar.');
        }

        // 3. Resolve file from private storage (disk 'local')
        $fullPath = null;

        if (Storage::disk('local')->exists($relativePath)) {
            $fullPath = Storage::disk('local')->path($relativePath);
        } elseif (Storage::disk('public')->exists($relativePath)) {
            $fullPath = Storage::disk('public')->path($relativePath);
        }

        if (! $fullPath || ! file_exists($fullPath)) {
            abort(404, 'Berkas fisik dokumen tidak ditemukan di server.');
        }

        // 4. Determine mime type
        $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';
        $filename = basename($fullPath);

        // 5. If download parameter is passed, download the file
        if ($request->boolean('download')) {
            return response()->download($fullPath, $filename);
        }

        // 6. Return inline response for PDF preview / image preview with no-cache headers
        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, private, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
