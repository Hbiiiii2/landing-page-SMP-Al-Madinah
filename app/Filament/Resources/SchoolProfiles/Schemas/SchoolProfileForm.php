<?php

namespace App\Filament\Resources\SchoolProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SchoolProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Profil Sekolah')
                    ->columnSpanFull()
                    ->tabs([
                        // ==========================================
                        // TAB 1: IDENTITAS & BRANDING
                        // ==========================================
                        Tab::make('Identitas & Media')
                            ->icon('heroicon-o-building-library')
                            ->schema([
                                Grid::make(12)->schema([
                                    Section::make('Identitas Utama Sekolah')
                                        ->description('Informasi legalitas dan identitas resmi lembaga')
                                        ->columnSpan(['default' => 12, 'lg' => 7])
                                        ->schema([
                                            Grid::make(2)->schema([
                                                TextInput::make('name')
                                                    ->label('Nama Resmi Sekolah')
                                                    ->required()
                                                    ->default('SMP Al-Madinah')
                                                    ->prefixIcon('heroicon-o-academic-cap'),

                                                TextInput::make('npsn')
                                                    ->label('NPSN')
                                                    ->placeholder('Contoh: 10812345')
                                                    ->prefixIcon('heroicon-o-identification'),
                                            ]),

                                            Grid::make(2)->schema([
                                                Select::make('accreditation')
                                                    ->label('Akreditasi')
                                                    ->required()
                                                    ->default('A')
                                                    ->options([
                                                        'A' => 'A (Unggul / Sangat Baik)',
                                                        'B' => 'B (Baik)',
                                                        'C' => 'C (Cukup)',
                                                        'Belum Terakreditasi' => 'Belum Terakreditasi',
                                                    ])
                                                    ->native(false),

                                                TextInput::make('statistic_year_founded')
                                                    ->label('Tahun Berdiri')
                                                    ->numeric()
                                                    ->default(2012)
                                                    ->prefixIcon('heroicon-o-calendar'),
                                            ]),

                                            TextInput::make('tagline')
                                                ->label('Motto / Slogan Sekolah')
                                                ->placeholder('Contoh: Cerdas, Berkarakter & Berakhlak Mulia')
                                                ->prefixIcon('heroicon-o-sparkles')
                                                ->columnSpanFull(),
                                        ]),

                                    Section::make('Aset Visual & Branding')
                                        ->description('Logo resmi dan banner utama website')
                                        ->columnSpan(['default' => 12, 'lg' => 5])
                                        ->schema([
                                            FileUpload::make('logo')
                                                ->label('Logo Resmi Sekolah')
                                                ->image()
                                                ->directory('school/branding')
                                                ->maxSize(2048)
                                                ->helperText('Format PNG/JPG transparan/persegi, maks. 2MB'),

                                            FileUpload::make('hero_image')
                                                ->label('Banner Utama Beranda (Hero Image)')
                                                ->image()
                                                ->directory('school/branding')
                                                ->maxSize(4096)
                                                ->helperText('Foto gedung sekolah / aktivitas utama (Landscape, maks. 4MB)'),
                                        ]),
                                ]),
                            ]),

                        // ==========================================
                        // TAB 2: KEPALA SEKOLAH & SAMBUTAN
                        // ==========================================
                        Tab::make('Kepala Sekolah')
                            ->icon('heroicon-o-user-circle')
                            ->schema([
                                Grid::make(12)->schema([
                                    Section::make('Foto Kepala Sekolah')
                                        ->columnSpan(['default' => 12, 'md' => 4])
                                        ->schema([
                                            FileUpload::make('headmaster_photo')
                                                ->label('Foto Formal Kepala Sekolah')
                                                ->image()
                                                ->directory('school/staff')
                                                ->maxSize(2048)
                                                ->helperText('Foto portrait/setengah badan formal berlatar rapi (maks. 2MB)'),
                                        ]),

                                    Section::make('Profil & Kata Sambutan')
                                        ->columnSpan(['default' => 12, 'md' => 8])
                                        ->schema([
                                            TextInput::make('headmaster_name')
                                                ->label('Nama Lengkap & Gelar')
                                                ->placeholder('Contoh: H. M. Syaifullah, M.Pd.')
                                                ->prefixIcon('heroicon-o-user')
                                                ->required(),

                                            Textarea::make('headmaster_welcome')
                                                ->label('Sambutan Resmi Kepala Sekolah')
                                                ->rows(7)
                                                ->placeholder('Tuliskan kata sambutan hangat dari kepala sekolah kepada calon peserta didik, wali murid, dan seluruh pengunjung website...')
                                                ->helperText('Akan ditampilkan di bagian Sambutan Kepala Sekolah pada beranda'),
                                        ]),
                                ]),
                            ]),

                        // ==========================================
                        // TAB 3: VISI, MISI & TENTANG SEKOLAH
                        // ==========================================
                        Tab::make('Visi, Misi & Profil')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Section::make('Tentang Sekolah')
                                    ->description('Profil ringkas dan sejarah singkat yang tampil di beranda')
                                    ->schema([
                                        Textarea::make('about')
                                            ->label('Profil Singkat & Sejarah Lembaga')
                                            ->rows(4)
                                            ->placeholder('Jelaskan secara ringkas sejarah pendirian, visi pembinaan karakter, dan identitas keunggulan SMP Al-Madinah...')
                                            ->helperText('Tampil di section Tentang Kami di landing page'),
                                    ]),

                                Grid::make(2)->schema([
                                    Section::make('Visi Sekolah')
                                        ->schema([
                                            Textarea::make('vision')
                                                ->label('Pernyataan Visi')
                                                ->rows(5)
                                                ->placeholder('Contoh: Terwujudnya generasi Qurani yang cerdas, berakhlak mulia, unggul dalam prestasi, dan berwawasan global.'),
                                        ]),

                                    Section::make('Misi Sekolah')
                                        ->schema([
                                            Textarea::make('mission')
                                                ->label('Poin-Poin Misi')
                                                ->rows(5)
                                                ->placeholder("1. Menyelenggarakan pendidikan Islam terpadu yang berorientasi pada mutu akademik dan akhlak.\n2. Mengintegrasikan kurikulum nasional dengan program tahfidz dan pembiasaan adab Islami.\n3. Membimbing dan mengembangkan minat, bakat, serta potensi siswa secara berkesinambungan."),
                                        ]),
                                ]),
                            ]),

                        // ==========================================
                        // TAB 4: STATISTIK CAPAIAN
                        // ==========================================
                        Tab::make('Statistik Capaian')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Section::make('Counter Angka Landing Page')
                                    ->description('Statistik prestasi dan kapasitas sekolah yang tampil sebagai angka beranimasi pada halaman depan')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('statistic_students')
                                                ->label('Jumlah Siswa Aktif')
                                                ->numeric()
                                                ->default(350)
                                                ->suffix('Siswa')
                                                ->prefixIcon('heroicon-o-user-group'),

                                            TextInput::make('statistic_teachers')
                                                ->label('Tenaga Pendidik & Staf')
                                                ->numeric()
                                                ->default(25)
                                                ->suffix('Orang')
                                                ->prefixIcon('heroicon-o-academic-cap'),

                                            TextInput::make('statistic_achievements')
                                                ->label('Total Prestasi Diraih')
                                                ->numeric()
                                                ->default(48)
                                                ->suffix('Prestasi')
                                                ->prefixIcon('heroicon-o-trophy'),
                                        ]),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 5: KONTAK & LOKASI
                        // ==========================================
                        Tab::make('Kontak & Lokasi')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Section::make('Saluran Komunikasi Resmi')
                                    ->description('Nomor telepon, WhatsApp, dan alamat email resmi sekolah')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('phone')
                                                ->label('Telepon Kantor')
                                                ->tel()
                                                ->prefixIcon('heroicon-o-phone')
                                                ->placeholder('(021) 555-1234'),

                                            TextInput::make('whatsapp')
                                                ->label('WhatsApp Resmi / Panitia')
                                                ->tel()
                                                ->prefixIcon('heroicon-o-chat-bubble-left-ellipsis')
                                                ->placeholder('Contoh: 6281234567890')
                                                ->helperText('Gunakan kode negara 62 tanpa awalan 0 atau +'),

                                            TextInput::make('email')
                                                ->label('Email Resmi')
                                                ->email()
                                                ->prefixIcon('heroicon-o-envelope')
                                                ->placeholder('info@almadinah.sch.id'),
                                        ]),
                                    ]),

                                Section::make('Alamat Fisik & Peta Google Maps')
                                    ->schema([
                                        Textarea::make('address')
                                            ->label('Alamat Lengkap Sekolah')
                                            ->rows(2)
                                            ->placeholder('Jl. Al-Madinah No. 12, Kelurahan Harapan Baru, Kecamatan Cipondoh, Kota Tangerang, Banten 15148')
                                            ->helperText('Alamat fisik yang ditampilkan di footer dan halaman kontak sekolah'),

                                        Textarea::make('google_maps_embed')
                                            ->label('Kode Sematan Peta Google Maps (Iframe Embed)')
                                            ->rows(3)
                                            ->placeholder('<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>')
                                            ->helperText('Buka Google Maps -> Cari lokasi sekolah -> Klik Bagikan (Share) -> Sematkan peta (Embed a map) -> Salin kode HTML'),
                                    ]),
                            ]),

                        // ==========================================
                        // TAB 6: MEDIA SOSIAL & VIDEO PROFIL
                        // ==========================================
                        Tab::make('Media Sosial & Video')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Tautan Media Sosial')
                                    ->description('Tautan ke channel resmi media sosial sekolah')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('instagram_url')
                                                ->label('Instagram URL')
                                                ->url()
                                                ->prefixIcon('heroicon-o-camera')
                                                ->placeholder('https://instagram.com/smpalmadinah'),

                                            TextInput::make('youtube_url')
                                                ->label('YouTube Channel URL')
                                                ->url()
                                                ->prefixIcon('heroicon-o-video-camera')
                                                ->placeholder('https://youtube.com/@smpalmadinah'),

                                            TextInput::make('facebook_url')
                                                ->label('Facebook URL')
                                                ->url()
                                                ->prefixIcon('heroicon-o-globe-alt')
                                                ->placeholder('https://facebook.com/smpalmadinah'),

                                            TextInput::make('tiktok_url')
                                                ->label('TikTok URL')
                                                ->url()
                                                ->prefixIcon('heroicon-o-musical-note')
                                                ->placeholder('https://tiktok.com/@smpalmadinah'),
                                        ]),
                                    ]),

                                Section::make('Video Profil Sekolah')
                                    ->schema([
                                        TextInput::make('hero_video_url')
                                            ->label('Tautan Video Profil (YouTube URL)')
                                            ->url()
                                            ->prefixIcon('heroicon-o-play')
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->helperText('Tautan video profil sekolah yang dapat diputar langsung di homepage'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
