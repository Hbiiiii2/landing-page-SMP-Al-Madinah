<?php

namespace Tests\Feature;

use App\Models\SchoolProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomePageButtonsTest extends TestCase
{
    public function test_home_page_contains_all_active_cta_buttons_and_modals(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Buttons
        $response->assertSee('DAFTAR ONLINE');
        $response->assertSee('UNDUH BROSUR');
        $response->assertSee('BIAYA PPDB');
        $response->assertSee('CHAT WA PANITIA');

        // Modals
        $response->assertSee('id="ppdb-brosur-modal"', false);
        $response->assertSee('id="ppdb-biaya-modal"', false);
        $response->assertSee('id="ppdb-qr-modal"', false);

        // Active handlers
        $response->assertSee('openBrosurPpdbModal()', false);
        $response->assertSee('openBiayaPpdbModal()', false);
        $response->assertSee('openPpdbQrModal()', false);
    }

    public function test_brosur_route_redirects_when_not_uploaded(): void
    {
        $profile = SchoolProfile::first();
        if ($profile) {
            $profile->update(['brochure_file' => null]);
        }

        $response = $this->get(route('school.brochure'));
        $response->assertRedirect(route('home'));
    }

    public function test_biaya_ppdb_route_redirects_when_not_uploaded(): void
    {
        $profile = SchoolProfile::first();
        if ($profile) {
            $profile->update(['ppdb_fee_file' => null]);
        }

        $response = $this->get(route('school.fee'));
        $response->assertRedirect(route('home'));
    }

    public function test_brosur_and_fee_download_when_files_exist(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('school/documents/test-brosur.pdf', 'dummy pdf content');
        Storage::disk('public')->put('school/documents/test-biaya.pdf', 'dummy fee content');

        $profile = SchoolProfile::first();
        $profile->update([
            'brochure_file' => 'school/documents/test-brosur.pdf',
            'ppdb_fee_file' => 'school/documents/test-biaya.pdf',
        ]);

        $brochureResponse = $this->get(route('school.brochure'));
        $brochureResponse->assertDownload();

        $feeResponse = $this->get(route('school.fee'));
        $feeResponse->assertDownload();
    }

    public function test_home_page_renders_custom_photos_when_configured(): void
    {
        $profile = SchoolProfile::first();
        $profile->update([
            'why_choose_us_image' => 'school/photos/custom-why.jpg',
            'why_choose_us_badge_title' => 'Akreditasi A Plus',
            'why_choose_us_badge_subtitle' => 'Sekolah Karakter Unggul',
            'cta_collage_image_1' => 'school/photos/cta1.jpg',
            'cta_collage_image_2' => 'school/photos/cta2.jpg',
            'cta_collage_image_3' => 'school/photos/cta3.jpg',
            'cta_collage_image_4' => 'school/photos/cta4.jpg',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);

        $response->assertSee('/storage/school/photos/custom-why.jpg');
        $response->assertSee('Akreditasi A Plus');
        $response->assertSee('Sekolah Karakter Unggul');
        $response->assertSee('/storage/school/photos/cta1.jpg');
        $response->assertSee('/storage/school/photos/cta2.jpg');
        $response->assertSee('/storage/school/photos/cta3.jpg');
        $response->assertSee('/storage/school/photos/cta4.jpg');
    }

    public function test_home_page_renders_custom_whatsapp_links_and_messages(): void
    {
        $profile = SchoolProfile::first();
        $profile->update([
            'whatsapp_custom_url' => null,
            'whatsapp_ppdb' => '0877-1122-3344',
            'whatsapp_message_panitia' => 'Halo Panitia Saya Mau Tanya PPDB',
            'whatsapp_message_brosur' => 'Halo Minta Brosur Versi Lengkap',
            'whatsapp_message_biaya' => 'Halo Mau Tanya Rincian Biaya',
            'whatsapp_message_floating' => 'Halo Helpdesk Al Madinah',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);

        $expectedPanitia = $profile->fresh()->whatsapp_panitia_url;
        $expectedBrosur = $profile->fresh()->whatsapp_brosur_url;
        $expectedBiaya = $profile->fresh()->whatsapp_biaya_url;
        $expectedFloating = $profile->fresh()->whatsapp_floating_url;

        $response->assertSee($expectedPanitia, false);
        $response->assertSee($expectedBrosur, false);
        $response->assertSee($expectedBiaya, false);
        $response->assertSee($expectedFloating, false);
    }

    public function test_custom_whatsapp_direct_url_override(): void
    {
        $profile = SchoolProfile::first();
        $profile->update([
            'whatsapp_custom_url' => 'https://wa.link/almadinah-official',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);

        $response->assertSee('https://wa.link/almadinah-official');
    }
}
