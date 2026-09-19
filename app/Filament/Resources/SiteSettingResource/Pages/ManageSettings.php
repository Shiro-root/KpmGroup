<?php
// app/Filament/Resources/SiteSettingResource/Pages/ManageSettings.php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;

class ManageSettings extends Page
{
    use WithFileUploads;

    protected static string $resource = SiteSettingResource::class;
    protected static string $view = 'filament.resources.site-setting-resource.pages.manage-settings';

    #[Url]
    public string $activeTab = 'home';

    // Menyimpan URL halaman saat mount() (request GET asli),
    // dipakai untuk redirect setelah save agar tidak salah
    // mengarah ke endpoint internal /livewire/update.
    #[Locked]
    public string $pageUrl = '';

    // ══ HOME ══
    public ?string $home_hero_title = null;
    public ?string $home_hero_subtitle = null;
    public ?string $home_company_intro = null;
    public ?string $home_company_intro_sub = null;
    public ?string $home_stats_exp = null;
    public ?string $home_stats_divisions = null;
    public ?string $home_stats_projects = null;
    public ?string $home_stats_team = null;
    public ?string $home_cta_title = null;
    public ?string $home_cta_subtitle = null;
    public ?string $home_established_year = null;

    // Tagline & gambar intro
    public ?string $home_intro_tagline_line1 = null;
    public ?string $home_intro_tagline_line2 = null;
    public array $home_intro_images = [];
    public array $home_intro_new_uploads = [];

    // Deskripsi singkat per divisi
    public ?string $home_div_construction_desc = null;
    public ?string $home_div_engineering_desc = null;
    public ?string $home_div_rd_desc = null;
    public ?string $home_div_farm_desc = null;
    public ?string $home_div_procurement_desc = null;

    // 5 gambar grid Why Us
    public ?string $home_whyus_img_1_current = 'thumb-construction.jpg';
    public ?string $home_whyus_img_2_current = 'thumb-engineering.jpg';
    public ?string $home_whyus_img_3_current = 'thumb-rd.jpg';
    public ?string $home_whyus_img_4_current = 'thumb-farm.jpg';
    public ?string $home_whyus_img_5_current = 'thumb-procurement.jpg';

    public $home_whyus_img_1_preview = null;
    public $home_whyus_img_2_preview = null;
    public $home_whyus_img_3_preview = null;
    public $home_whyus_img_4_preview = null;
    public $home_whyus_img_5_preview = null;

    // Label overlay tiap gambar
    public ?string $home_whyus_label_1 = 'Construction';
    public ?string $home_whyus_label_2 = 'Engineering';
    public ?string $home_whyus_label_3 = 'R & D';
    public ?string $home_whyus_label_4 = 'Farm';
    public ?string $home_whyus_label_5 = 'Procurement';

    // Why us — heading & poin-poin
    public ?string $home_whyus_title = 'Komitmen Kami';
    public ?string $home_whyus_subtitle = 'untuk Anda';
    public array $home_whyus_points = [];

    // ══ ABOUT ══
    public ?string $about_company_name = null;
    public ?string $about_profile_paragraph1 = null;
    public ?string $about_profile_paragraph2 = null;
    public ?string $about_profile_paragraph3 = null;
    public ?string $about_vision = null;
    public ?string $about_mission_1 = null;
    public ?string $about_mission_2 = null;
    public ?string $about_mission_3 = null;
    public ?string $about_mission_4 = null;
    public ?string $about_mission_5 = null;
    public ?string $about_business_field = null;
    public ?string $about_operation_area = null;
    public array $milestones = [];

    // ══ SERVICES ══
    public ?string $services_page_title = null;
    public ?string $services_page_subtitle = null;
    public ?string $services_cta_title = null;
    public ?string $services_cta_subtitle = null;

    // ══ CONTACT ══
    public ?string $contact_whatsapp = null;
    public ?string $contact_whatsapp_display = null;
    public ?string $contact_email = null;
    public ?string $contact_address = null;
    public ?string $contact_instagram_url = null;
    public ?string $contact_instagram_handle = null;
    public ?string $contact_tiktok_url = null;
    public ?string $contact_tiktok_handle = null;
    public ?string $contact_maps_embed_url = null;
    public ?string $contact_office_hours = null;

    // ══ SEO ══
    public ?string $seo_title = null;
    public ?string $seo_description = null;

    // ────────────────────────────────────────────────────────────
    public function mount(): void
    {
        $this->pageUrl = request()->fullUrl();

        // SiteSetting::get() kini hanya lookup array (1 query total, ter-cache).
        $get = fn(string $key, string $default = '') => SiteSetting::get($key, $default);

        // Home
        $this->home_hero_title = $get('home_hero_title');
        $this->home_hero_subtitle = $get('home_hero_subtitle');
        $this->home_company_intro = $get('home_company_intro');
        $this->home_company_intro_sub = $get('home_company_intro_sub');
        $this->home_stats_exp = $get('home_stats_exp', '10+');
        $this->home_stats_divisions = $get('home_stats_divisions', '5');
        $this->home_stats_projects = $get('home_stats_projects', '50+');
        $this->home_stats_team = $get('home_stats_team', '100+');
        $this->home_cta_title = $get('home_cta_title');
        $this->home_cta_subtitle = $get('home_cta_subtitle');
        $this->home_established_year = $get('home_established_year', '2010');
        $this->home_intro_tagline_line1 = $get('home_intro_tagline_line1', 'Satu Group,');
        $this->home_intro_tagline_line2 = $get('home_intro_tagline_line2', 'Lima Kekuatan');
        $raw = $get('home_intro_images', '');
        $this->home_intro_images = $raw
            ? json_decode($raw, true)
            : array_filter([$get('home_intro_image', 'about-visual.jpg')]);

        $this->home_div_construction_desc = $get('home_div_construction_desc');
        $this->home_div_engineering_desc = $get('home_div_engineering_desc');
        $this->home_div_rd_desc = $get('home_div_rd_desc');
        $this->home_div_farm_desc = $get('home_div_farm_desc');
        $this->home_div_procurement_desc = $get('home_div_procurement_desc');

        $this->home_whyus_img_1_current = $get('home_whyus_img_1', 'thumb-construction.jpg');
        $this->home_whyus_img_2_current = $get('home_whyus_img_2', 'thumb-engineering.jpg');
        $this->home_whyus_img_3_current = $get('home_whyus_img_3', 'thumb-rd.jpg');
        $this->home_whyus_img_4_current = $get('home_whyus_img_4', 'thumb-farm.jpg');
        $this->home_whyus_img_5_current = $get('home_whyus_img_5', 'thumb-procurement.jpg');

        $this->home_whyus_label_1 = $get('home_whyus_label_1', 'Construction');
        $this->home_whyus_label_2 = $get('home_whyus_label_2', 'Engineering');
        $this->home_whyus_label_3 = $get('home_whyus_label_3', 'R & D');
        $this->home_whyus_label_4 = $get('home_whyus_label_4', 'Farm');
        $this->home_whyus_label_5 = $get('home_whyus_label_5', 'Procurement');

        $this->home_whyus_title = $get('home_whyus_title', 'Komitmen Kami');
        $this->home_whyus_subtitle = $get('home_whyus_subtitle', 'untuk Anda');
        $this->home_whyus_points = json_decode($get('home_whyus_points', '[]'), true) ?: [
            ['title' => 'Kualitas Terstandar', 'desc' => 'Setiap proyek dikerjakan mengikuti standar teknis dan keselamatan internasional dengan tim bersertifikat.'],
            ['title' => 'Tim Berpengalaman', 'desc' => 'Lebih dari 100 tenaga profesional di bidangnya — insinyur, teknisi, dan manajer proyek berpengalaman.'],
            ['title' => 'Solusi Terintegrasi', 'desc' => 'Lima divisi yang saling mendukung memungkinkan kami memberikan solusi end-to-end dari perencanaan hingga pemeliharaan.'],
            ['title' => 'Tepat Waktu & Transparan', 'desc' => 'Manajemen proyek yang ketat memastikan penyelesaian sesuai jadwal dengan pelaporan berkala yang transparan.'],
        ];

        // About
        $this->about_company_name = $get('about_company_name');
        $this->about_profile_paragraph1 = $get('about_profile_paragraph1');
        $this->about_profile_paragraph2 = $get('about_profile_paragraph2');
        $this->about_profile_paragraph3 = $get('about_profile_paragraph3');
        $this->about_vision = $get('about_vision');
        for ($i = 1; $i <= 5; $i++) {
            $this->{"about_mission_{$i}"} = $get("about_mission_{$i}");
        }
        $this->about_business_field = $get('about_business_field');
        $this->about_operation_area = $get('about_operation_area');

        $raw = SiteSetting::get('milestones');
        $this->milestones = $raw ? json_decode($raw, true) : [];

        // Services
        $this->services_page_title = $get('services_page_title');
        $this->services_page_subtitle = $get('services_page_subtitle');
        $this->services_cta_title = $get('services_cta_title');
        $this->services_cta_subtitle = $get('services_cta_subtitle');

        // Contact
        $this->contact_whatsapp = $get('contact_whatsapp');
        $this->contact_whatsapp_display = $get('contact_whatsapp_display');
        $this->contact_email = $get('contact_email');
        $this->contact_address = $get('contact_address');
        $this->contact_instagram_url = $get('contact_instagram_url');
        $this->contact_instagram_handle = $get('contact_instagram_handle');
        $this->contact_tiktok_url = $get('contact_tiktok_url');
        $this->contact_tiktok_handle = $get('contact_tiktok_handle');
        $this->contact_maps_embed_url = $get('contact_maps_embed_url');
        $this->contact_office_hours = $get('contact_office_hours');

        // SEO
        $this->seo_title = $get('seo_title', 'KPM Group');
        $this->seo_description = $get('seo_description', 'KPM Group — Solusi terpadu Construction, Engineering, R&D, Farm & Procurement di Indonesia.');
    }

    // ── Helpers ────────────────────────────────────────────────

    /**
     * Simpan satu setting (cache dibersihkan otomatis oleh SiteSetting).
     */
    protected function set(string $key, $value, string $group = 'general'): void
    {
        SiteSetting::set($key, $value ?? '', $group);
    }

    /**
     * Simpan banyak property sekaligus dalam 1 query.
     *
     * @param  string[]  $keys  nama property yang sekaligus menjadi key setting
     */
    protected function saveMany(array $keys, string $group): void
    {
        $values = [];

        foreach ($keys as $key) {
            $values[$key] = $this->{$key};
        }

        SiteSetting::setMany($values, $group);
    }

    /**
     * Generate URL gambar dengan cache-busting otomatis berdasarkan
     * waktu modifikasi file (filemtime). Dipakai di Blade lewat
     * $this->imageUrl(...) supaya browser selalu ambil versi terbaru
     * tanpa perlu hard refresh (Ctrl+Shift+R).
     */
    public function imageUrl(string $filename): string
    {
        $path = base_path('images/' . $filename);
        $version = file_exists($path) ? filemtime($path) : time();

        return asset('images/' . $filename) . '?v=' . $version;
    }

    protected function saveImage($upload, string $baseName): string
    {
        $ext = strtolower($upload->getClientOriginalExtension());
        $name = $baseName . '.' . $ext;

        // FIX: gunakan base_path(), bukan public_path().
        // Di hosting cPanel ini, web root = public_html/, sedangkan
        // public_path() mengarah ke public_html/public/ (bukan web root).
        // base_path('images') => public_html/images/ — sesuai dengan
        // asset('images/...') yang dipakai di seluruh Blade view.
        $dest = base_path('images');

        if (!is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        foreach (['jpg', 'jpeg', 'png', 'webp'] as $oldExt) {
            if ($oldExt !== $ext) {
                $old = $dest . DIRECTORY_SEPARATOR . $baseName . '.' . $oldExt;
                if (file_exists($old)) {
                    @unlink($old);
                }
            }
        }

        copy($upload->getRealPath(), $dest . DIRECTORY_SEPARATOR . $name);

        return $name;
    }

    // ── Milestone helpers ──────────────────────────────────────

    public function addMilestone(): void
    {
        $this->milestones[] = ['year' => '', 'title' => '', 'description' => ''];
    }

    public function removeMilestone(int $index): void
    {
        array_splice($this->milestones, $index, 1);
        $this->milestones = array_values($this->milestones);
    }

    // Helper methode hapus & tambah slide
    public function removeIntroImage(int $index): void
    {
        $filename = $this->home_intro_images[$index] ?? null;

        if ($filename) {
            $path = base_path('images/' . $filename);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        array_splice($this->home_intro_images, $index, 1);
        $this->home_intro_images = array_values($this->home_intro_images);
    }

    // ── Why Us point helpers ───────────────────────────────────

    public function addWhyusPoint(): void
    {
        $this->home_whyus_points[] = ['title' => '', 'desc' => ''];
    }

    public function removeWhyusPoint(int $index): void
    {
        array_splice($this->home_whyus_points, $index, 1);
        $this->home_whyus_points = array_values($this->home_whyus_points);
    }

    // ══ SAVE METHODS ══════════════════════════════════════════

    public function saveHome(): void
    {
        try {
            $this->validate([
                'home_intro_new_uploads.*' => 'nullable|image|max:2048',
                'home_whyus_img_1_preview' => 'nullable|image|max:2048',
                'home_whyus_img_2_preview' => 'nullable|image|max:2048',
                'home_whyus_img_3_preview' => 'nullable|image|max:2048',
                'home_whyus_img_4_preview' => 'nullable|image|max:2048',
                'home_whyus_img_5_preview' => 'nullable|image|max:2048',
            ], [
                'home_intro_new_uploads.*.image' => 'Setiap slide harus berupa gambar (JPG, PNG, atau WebP).',
                'home_intro_new_uploads.*.max' => 'Ukuran tiap gambar maksimal 2 MB.',
                'home_whyus_img_1_preview.image' => 'Gambar 1 (Construction) harus berupa gambar (JPG, PNG, atau WebP).',
                'home_whyus_img_1_preview.max' => 'Gambar 1 (Construction) terlalu besar. Maksimal ukuran file adalah 2 MB.',
                'home_whyus_img_2_preview.image' => 'Gambar 2 (Engineering) harus berupa gambar (JPG, PNG, atau WebP).',
                'home_whyus_img_2_preview.max' => 'Gambar 2 (Engineering) terlalu besar. Maksimal ukuran file adalah 2 MB.',
                'home_whyus_img_3_preview.image' => 'Gambar 3 (R&D) harus berupa gambar (JPG, PNG, atau WebP).',
                'home_whyus_img_3_preview.max' => 'Gambar 3 (R&D) terlalu besar. Maksimal ukuran file adalah 2 MB.',
                'home_whyus_img_4_preview.image' => 'Gambar 4 (Farm) harus berupa gambar (JPG, PNG, atau WebP).',
                'home_whyus_img_4_preview.max' => 'Gambar 4 (Farm) terlalu besar. Maksimal ukuran file adalah 2 MB.',
                'home_whyus_img_5_preview.image' => 'Gambar 5 (Procurement) harus berupa gambar (JPG, PNG, atau WebP).',
                'home_whyus_img_5_preview.max' => 'Gambar 5 (Procurement) terlalu besar. Maksimal ukuran file adalah 2 MB.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $messages = collect($e->errors())->flatten()->join("\n");

            Notification::make()
                ->title('Gagal Menyimpan — File Tidak Valid')
                ->body($messages)
                ->danger()
                ->persistent()
                ->send();

            return;
        }

        $this->saveMany([
            'home_hero_title',
            'home_hero_subtitle',
            'home_company_intro',
            'home_company_intro_sub',
            'home_stats_exp',
            'home_stats_divisions',
            'home_stats_projects',
            'home_stats_team',
            'home_cta_title',
            'home_cta_subtitle',
            'home_established_year',
            'home_intro_tagline_line1',
            'home_intro_tagline_line2',
            'home_div_construction_desc',
            'home_div_engineering_desc',
            'home_div_rd_desc',
            'home_div_farm_desc',
            'home_div_procurement_desc',
            'home_whyus_label_1',
            'home_whyus_label_2',
            'home_whyus_label_3',
            'home_whyus_label_4',
            'home_whyus_label_5',
            'home_whyus_title',
            'home_whyus_subtitle',
        ], 'home');

        $this->set('home_whyus_points', json_encode($this->home_whyus_points), 'home');

        $imgMap = [
            'home_whyus_img_1_preview' => [
                'db_key' => 'home_whyus_img_1',
                'base' => 'thumb-construction',
                'curr' => 'home_whyus_img_1_current',
            ],
            'home_whyus_img_2_preview' => [
                'db_key' => 'home_whyus_img_2',
                'base' => 'thumb-engineering',
                'curr' => 'home_whyus_img_2_current',
            ],
            'home_whyus_img_3_preview' => [
                'db_key' => 'home_whyus_img_3',
                'base' => 'thumb-rd',
                'curr' => 'home_whyus_img_3_current',
            ],
            'home_whyus_img_4_preview' => [
                'db_key' => 'home_whyus_img_4',
                'base' => 'thumb-farm',
                'curr' => 'home_whyus_img_4_current',
            ],
            'home_whyus_img_5_preview' => [
                'db_key' => 'home_whyus_img_5',
                'base' => 'thumb-procurement',
                'curr' => 'home_whyus_img_5_current',
            ],
        ];

        foreach ($imgMap as $prop => $meta) {
            if ($this->{$prop}) {
                $filename = $this->saveImage($this->{$prop}, $meta['base']);
                $this->set($meta['db_key'], $filename, 'home');
                $this->{$meta['curr']} = $filename;
                $this->{$prop} = null;
            }
        }

        if (!empty($this->home_intro_new_uploads)) {
            foreach ($this->home_intro_new_uploads as $upload) {
                $ext = strtolower($upload->getClientOriginalExtension());
                $name = 'about-visual-' . uniqid() . '.' . $ext;

                $dest = base_path('images');
                if (!is_dir($dest)) {
                    mkdir($dest, 0755, true);
                }

                copy($upload->getRealPath(), $dest . DIRECTORY_SEPARATOR . $name);
                $this->home_intro_images[] = $name;
            }
            $this->home_intro_new_uploads = [];
        }

        $this->set('home_intro_images', json_encode(array_values($this->home_intro_images)), 'home');

        Notification::make()
            ->title('Halaman Home berhasil disimpan!')
            ->success()
            ->send();

        // Full page redirect agar gambar & data ter-refresh dari server
        // (menggantikan kebutuhan hard refresh / Ctrl+Shift+R manual).
        $this->redirect($this->pageUrl);
    }

    public function saveAbout(): void
    {
        $this->saveMany([
            'about_company_name',
            'about_profile_paragraph1',
            'about_profile_paragraph2',
            'about_profile_paragraph3',
            'about_vision',
            'about_mission_1',
            'about_mission_2',
            'about_mission_3',
            'about_mission_4',
            'about_mission_5',
            'about_business_field',
            'about_operation_area',
        ], 'about');

        usort($this->milestones, fn($a, $b) => ($a['year'] ?? '') <=> ($b['year'] ?? ''));
        $this->set('milestones', json_encode($this->milestones), 'about');

        Notification::make()
            ->title('Halaman About berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect($this->pageUrl);
    }

    public function saveServices(): void
    {
        $this->saveMany([
            'services_page_title',
            'services_page_subtitle',
            'services_cta_title',
            'services_cta_subtitle',
        ], 'services');

        Notification::make()
            ->title('Halaman Services berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect($this->pageUrl);
    }

    public function saveContact(): void
    {
        $this->saveMany([
            'contact_whatsapp',
            'contact_whatsapp_display',
            'contact_email',
            'contact_address',
            'contact_instagram_url',
            'contact_instagram_handle',
            'contact_tiktok_url',
            'contact_tiktok_handle',
            'contact_maps_embed_url',
            'contact_office_hours',
        ], 'contact');

        Notification::make()
            ->title('Halaman Contact berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect($this->pageUrl);
    }

    public function saveSeo(): void
    {
        $this->saveMany(['seo_title', 'seo_description'], 'general');

        Notification::make()
            ->title('Pengaturan SEO berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect($this->pageUrl);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}