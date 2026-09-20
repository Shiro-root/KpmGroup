<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\WithFileUploads;

class ManagePageBanners extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Banner Halaman';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int    $navigationSort  = 4;
    protected static ?string $title           = 'Kelola Banner & Hero Slider';

    protected static string $view = 'filament.pages.manage-page-banners';

    // ── Hero Slider (Beranda) — dipindah dari Home settings ──
    public array $home_hero_images = [];
    public array $home_hero_new_uploads = [];

    // ── Banner per halaman (1 gambar saja, bukan slider) ──
    public ?string $about_banner_current = null;
    public $about_banner_preview = null;

    public ?string $services_banner_current = null;
    public $services_banner_preview = null;

    public ?string $contact_banner_current = null;
    public $contact_banner_preview = null;

    public function mount(): void
    {
        $raw = SiteSetting::get('home_hero_images', '');
        $this->home_hero_images = $raw ? (json_decode($raw, true) ?: []) : [];

        $this->about_banner_current    = SiteSetting::get('about_banner_image', '') ?: null;
        $this->services_banner_current = SiteSetting::get('services_banner_image', '') ?: null;
        $this->contact_banner_current  = SiteSetting::get('contact_banner_image', '') ?: null;
    }

    public function imageUrl(?string $filename): string
    {
        if (!$filename) {
            return '';
        }
        $path = base_path('images/' . $filename);
        $version = file_exists($path) ? filemtime($path) : time();

        return asset('images/' . $filename) . '?v=' . $version;
    }

    protected function saveUpload($upload, string $baseName): string
    {
        $ext  = strtolower($upload->getClientOriginalExtension());
        $name = $baseName . '-' . uniqid() . '.' . $ext;

        $dest = base_path('images');
        if (!is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        copy($upload->getRealPath(), $dest . DIRECTORY_SEPARATOR . $name);

        return $name;
    }

    public function removeHeroImage(int $index): void
    {
        $filename = $this->home_hero_images[$index] ?? null;

        if ($filename) {
            $path = base_path('images/' . $filename);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        array_splice($this->home_hero_images, $index, 1);
        $this->home_hero_images = array_values($this->home_hero_images);
    }

    public function save(): void
    {
        try {
            $this->validate([
                'home_hero_new_uploads.*'  => 'nullable|image|max:2048',
                'about_banner_preview'     => 'nullable|image|max:2048',
                'services_banner_preview'  => 'nullable|image|max:2048',
                'contact_banner_preview'   => 'nullable|image|max:2048',
            ], [
                'home_hero_new_uploads.*.image' => 'Setiap slide hero harus berupa gambar (JPG, PNG, atau WebP).',
                'home_hero_new_uploads.*.max'   => 'Ukuran tiap gambar hero maksimal 2 MB.',
                'about_banner_preview.image'    => 'Banner About harus berupa gambar.',
                'about_banner_preview.max'      => 'Banner About maksimal 2 MB.',
                'services_banner_preview.image' => 'Banner Services harus berupa gambar.',
                'services_banner_preview.max'   => 'Banner Services maksimal 2 MB.',
                'contact_banner_preview.image'  => 'Banner Contact harus berupa gambar.',
                'contact_banner_preview.max'    => 'Banner Contact maksimal 2 MB.',
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

        // ── Hero slider ──
        if (!empty($this->home_hero_new_uploads)) {
            foreach ($this->home_hero_new_uploads as $upload) {
                $this->home_hero_images[] = $this->saveUpload($upload, 'hero');
            }
            $this->home_hero_new_uploads = [];
        }
        SiteSetting::set('home_hero_images', json_encode(array_values($this->home_hero_images)), 'home');

        // ── Banner per halaman ──
        $map = [
            'about_banner_preview'    => ['key' => 'about_banner_image',    'base' => 'banner-about',    'curr' => 'about_banner_current'],
            'services_banner_preview' => ['key' => 'services_banner_image', 'base' => 'banner-services', 'curr' => 'services_banner_current'],
            'contact_banner_preview'  => ['key' => 'contact_banner_image',  'base' => 'banner-contact',  'curr' => 'contact_banner_current'],
        ];

        foreach ($map as $prop => $meta) {
            if ($this->{$prop}) {
                $filename = $this->saveUpload($this->{$prop}, $meta['base']);
                SiteSetting::set($meta['key'], $filename, 'banners');
                $this->{$meta['curr']} = $filename;
                $this->{$prop} = null;
            }
        }

        Notification::make()
            ->title('Banner & Hero Slider berhasil disimpan!')
            ->success()
            ->send();

        $this->redirect(request()->fullUrl());
    }
}