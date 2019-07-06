<?php return [
    'plugin' => [
        'name' => 'Faceless API',
        'description' => 'Faceless API adalah plugin OctoberCMS untuk mengatur konten situs external',
        'custom_actions' => [
            'add_new_item' => 'Tambah rekor baru',
        ],
        'settings' => [
            'label' => [
                'manage_clients' => 'Atur Klien Faceless API',
                'manage_configs' => 'Atur Konfigurasi Faceless API',
                'manage_themes' => 'Atur Tema Faceless API',
                'manage_theme_categories' => 'Atur Kategori Tema Faceless API',
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
            'active_description' => 'Status aktif tema',
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
        ]
    ]
];