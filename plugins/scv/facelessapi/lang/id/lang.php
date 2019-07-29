<?php return [
    'plugin' => [
        'name' => 'Faceless API',
        'name_admin' => 'API Admin',
        'name_global' => 'API Global',
        'name_pages' => 'API Halaman',
        'description' => 'Faceless API adalah plugin OctoberCMS untuk mengelola konten situs external',
        'custom_actions' => [
            'add_new_item' => 'Tambah rekor baru',
        ],
        'validations' => [
            'delete_error_record_exists' => 'Gagal menghapus, data ini berelasi dengan data lain',
        ],
        'settings' => [
            'label' => [
                'manage_clients' => 'Kelola Klien Faceless API',
                'manage_client_selector' => 'Pilih Sesi Klien Faceless API',
                'manage_configs' => 'Kelola Konfigurasi Faceless API',
                'manage_themes' => 'Kelola Tema Faceless API',
                'manage_theme_categories' => 'Kelola Kategori Tema Faceless API',
                'manage_blocks' => 'Kelola Konten Blok Faceless API',
                'manage_client_blocks' => 'Kelola Konten Blok Klien Faceless API',
                'manage_templates' => 'Kelola Pola Halaman Klien Faceless API',
                'manage_pages' => 'Kelola Halaman Klien Faceless API',
            ]
        ],
        'clients' => [
            'clients' => 'Klien',
            'active' => 'Aktif',
            'active_description' => 'Status aktifitas situs klien',
            'active_on' => 'Ya',
            'active_off' => 'Tdk',
            'name' => 'Nama Klien',
            'name_description' => 'Nama Klien Sederhana',
            'domain' => 'Alamat Domain Klien',
            'domain_description' => 'Alamat tampak depan situs klien',
            'description' => 'Deskripsi Klien',
            'description_description' => 'Informasi singkat tentang situs klien',
            'key' => 'Akses Klien',
            'key_description' => 'Akses kunci API untuk tampak depan situs klien',
            'key_copy' => 'Salin Akses Klien',
            'key_generate' => 'Buat Akses Klien Baru',
            'users_list' => 'Daftar Pengguna',
            'user_first_name' => 'Nama Depan',
            'user_last_name' => 'Nama Belakang',
            'user_email' => 'Surel',
            'client_selector' => 'Pilih Klien',
            'client_selector_description' => 'Aktifkan satu klien untuk memudahkan pengoperasian konten tanpa menyaring rekor berdasarkan klien di setiap halaman',
            'client_selector_toggle_on' => 'Sesi klien telah dimulai',
            'client_selector_toggle_off' => 'Sesi klien telah diakhiri',
        ],
        'configs' => [
            'configs' => 'Konfigurasi',
            'site_name' => 'Nama Situs',
            'site_name_description' => 'Nama situs',
            'site_address' => 'Alamat Situs',
            'site_address_description' => 'Alamat situs',
            'site_description' => 'Deskripsi Situs',
            'site_description_description' => 'Informasi singkat situs',
            'online' => 'Online',
            'online_description' => 'Status online situs',
            'site_locale' => 'Bahasa Situs',
            'site_locale_description' => 'Bahasa utama situs',
            'site_timezone' => 'Zona Waktu Situs',
            'site_timezone_description' => 'Zona waktu lokal situs',
        ],
        'themes' => [
            'themes' => 'Tema',
            'name' => 'Nama Tema',
            'name_description' => 'Nama tema',
            'description' => 'Deskripsi Tema',
            'description_description' => 'Informasi singkat tema',
            'client_id' => 'Klien',
            'client_id_description' => 'Klien yang bersangkutan',
            'active' => 'Aktif',
            'active_description' => 'Hanya satu tema aktif setiap saat',
            'no_theme_categories' => 'Tambah kategori tema sebelum mengatur tema',
            'add_theme_categories' => 'Gunakan pranala berikut untuk menambah kategori tema:',
            'theme_toggle_on' => 'Tema diaktifkan',
        ],
        'theme_categories' => [
            'theme_categories' => 'Kategori Tema',
            'name' => 'Nama Kategori',
            'name_description' => 'Nama kategori dari tema',
            'code' => 'Kode Kategori',
            'code_description' => 'kode kategori yang mudah dibaca',
            'validation' => [
                'duplicate' => 'Nama kategori sudah dipakai oleh klien'
            ],
        ],
        'theme_values' => [
            'theme_values' => 'Pengaturan Tema',
            'name' => 'Nama Pengaturan',
            'name_description' => 'Nama pengaturan dari tema',
            'type' => 'Tipe',
            'type_description' => 'Tipe pengaturan dari tema',
            'value_text' => 'Teks',
            'value_text_description' => 'Teks bebas',
            'value_number' => 'Nilai',
            'value_number_description' => 'Nilai angka',
            'value_color' => 'Warna',
            'value_color_description' => 'Pilihan warna heksadesimal',
            'value_media' => 'Media',
            'value_media_description' => 'Pilihan media',
            'validation' => [
                'name_required' => 'Nama pengaturan harus diisi',
                'name_alpha_dash' => 'Nama pengaturan harus berupa huruf, angka, _ atau - tanpa spasi',
                'type_required' => 'Tipe pengaturan harus diisi'
            ],
        ],
        'blocks' => [
            'blocks' => 'Blok Konten Contoh',
            'name' => 'Nama Blok',
            'name_description' => 'Nama untuk blok konten',
            'code' => 'Kode Blok',
            'code_description' => 'Kode blok yang mudah dibaca',
            'icon' => 'Ikon Blok',
            'icon_description' => 'Ikon untuk blok konten',
            'fields' => 'Daftar input',
            'fields_description' => 'Daftar input dalam blok konten',
            'fields_tab_main_settings' => 'Pengaturan Utama',
            'fields_tab_other_settings' => 'Lain',
            'fields_tab_advanced_settings' => 'Khusus',
            'field_required' => 'Wajib Diisi',
            'field_required_description' => 'Input wajib diisi',
            'field_readonly' => 'Hanya Dibaca',
            'field_readonly_description' => 'Input hanya dibaca',
            'field_code' => 'Kode Input',
            'field_code_description' => 'Kode input yang mudah dibaca',
            'field_label' => 'Label Input',
            'field_label_description' => 'Label input blok konten',
            'field_type' => 'Tipe Input',
            'field_type_description' => 'Tipe input blok konten',
            'field_comment' => 'Keterangan Input',
            'field_comment_description' => 'Keterangan input blok konten',
            'field_options' => 'Pilihan Input',
            'field_options_description' => 'Pilihan Input untuk blok konten',
            'field_options_value' => 'Kode Input',
            'field_options_value_description' => 'Kode pilihan input untuk blok konten',
            'field_options_label' => 'Label Input',
            'field_options_label_description' => 'Label pilihan input untuk blok konten',
            'field_tab' => 'Kategori Input',
            'field_tab_description' => 'Kategori input blok kontent',
            'field_tab_content' => 'Konten',
            'field_tab_settings' => 'Pengaturan',
            'field_span' => 'Posisi Input',
            'field_span_description' => 'Posisi input blok kontent',
            'field_span_auto' => 'Otomatis',
            'field_span_left' => 'Kiri',
            'field_span_right' => 'Kanan',
            'field_span_full' => 'Penuh',
            'field_span_storm' => 'Storm CSS',
            'field_css_class' => 'Kelas CSS Input',
            'field_css_class_description' => 'Pisahkan setiap kelas CSS dengan spasi',
            'field_number_min' => 'Angka Minimal',
            'field_number_min_description' => 'Angka terkecil untuk input',
            'field_number_max' => 'Angka Maksimal',
            'field_number_max_description' => 'Angka terbesar untuk input',
            'field_number_step' => 'Kelipatan Angka',
            'field_number_step_description' => 'Kelipatan yang diperbolehkan',
            'validation' => [
                'duplicate' => 'Kode blok sudah dipakai',
                'duplicate_field_code' => 'Kode setiap input di satu blok harus unik',
                'field_code_required' => 'Kode input harus diisi',
                'field_code_alpha_dash' => 'Kode input harus berupa huruf, angka, _ atau - tanpa spasi',
                'field_label_required' => 'Label input harus diisi',
                'field_type_required' => 'Tipe input harus diisi'
            ],
            'field_type_link' => 'Pranala',
            'field_type_form' => 'Formulir'
        ],
        'client_blocks' => [
            'client_blocks' => 'Blok Konten'
        ],
        'templates' => [
            'templates' => 'Pola Halaman',
            'name' => 'Nama Pola',
            'name_description' => 'Nama pola halaman',
            'code' => 'Kode Pola',
            'code_description' => 'Kode pola yang mudah dibaca',
            'blocks' => 'Konten Blok',
            'blocks_description' => 'Daftar konten blok untuk pola halaman',
            'block_purpose' => 'Fungsi Blok',
            'block_purpose_description' => 'Fungsi blok di pola halaman',
            'block_purpose_code' => 'Kode fungsi blok',
            'block_purpose_code_description' => 'Kode fungsi blok yang mudah dibaca',
            'validation' => [
                'duplicate' => 'Kode pola halaman sudah dipakai',
                'duplicate_block_purpose' => 'Fungsi setiap blok haru unik',
                'block_purpose_code_required' => 'Kode fungsi blok harus diisi',
                'block_purpose_code_alpha_dash' => 'Kode fungsi blok harus berupa huruf, angka, _ atau - tanpa spasi',
                'block_purpose_required' => 'Fungsi blok harus diisi',
                'block_code_required' => 'Kode blok harus diisi'
            ]
        ],
        'pages' => [
            'pages' => 'Halaman',
            'title' => 'Judul Halaman',
            'title_description' => 'Judul untuk halaman',
            'slug' => 'Alamat Halaman',
            'slug_description' => 'Alamat untuk halaman',
            'tab_content' => 'Konten',
            'tab_preview' => 'Pendahuluan',
            'tab_seo' => 'SEO',
            'tab_activity' => 'Aktivitas',
            'preview_title' => 'Judul Pendahuluan',
            'preview_title_description' => 'Judul pendahuluan untuk halaman',
            'preview_subtitle' => 'Subjudul Pendahuluan',
            'preview_subtitle_description' => 'Subjudul pendahuluan untuk halaman',
            'preview_description' => 'Keterangan Pendahuluan',
            'preview_description_description' => 'Keterangan pendahuluan untuk halaman',
            'preview_image' => 'Gambar Pendahuluan',
            'preview_image_description' => 'gambar pendahuluan untuk halaman',
            'seo_keywords' => 'Kata Kunci',
            'seo_keywords_description' => 'Kata kunci untuk SEO',
            'seo_author' => 'Penulis',
            'seo_author_description' => 'Penulis halaman',
            'seo_description' => 'Keterangan',
            'seo_description_description' => 'Keterangan untuk SEO',
            'active' => 'Aktivitas Halaman',
            'active_description' => 'Aktivitas halaman di tampak depan',
            'active_begin' => 'Waktu Mulai Aktif',
            'active_begin_description' => 'Waktu mulai halaman aktif',
            'active_end' => 'Waktu Selesai Aktif',
            'active_end_description' => 'Waktu selesai halaman aktif',
            'blocks' => 'Blok halaman',
            'blocks_description' => 'Daftar blok halaman',
            'template_id' => 'Pola Halaman',
            'template_id_description' => 'Pola halaman untuk konten',
        ]
    ]
];