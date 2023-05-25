# MyRealDigital Assessment


Simple CRUD with [CakePHP](https://cakephp.org) 4.4.x.

Project ini merupakan assessment melamar di My Real Digital.

## Alat Pengembangan
1. PHP 8.2.2
2. MariaDB 10.3.10
3. Laragon (VirtualHost)
4. VS Code

## Langkah installasi

1. Jalankan composer 

```bash
composer install
```

2. Atur koneksi database di file `'config/app_local.php'` bagian `'Datasources'`

3. Jalankan migration

```bash
bin/cake migrations migrate
```

atau jika anda ingin mengimport database, silahkan gunakan file `'database.sql'` yang terdapat di root directory.


Sekarang anda bisa menjalan webserver melalui virtual host laragon atau dengan built-in webserver cakephp dengan perintah:

```bash
bin/cake server -p 8765
```

## Fitur-fitur
1. List user
2. Tambah user (Ajax)
3. Lihat user (Ajax)
4. Ubah user (Ajax)
5. Hapus user (Ajax)
6. List Task
7. Tambah task (Ajax)
8. Lihat task (Ajax)
9. Ubah task (Ajax)
10. Hapus task (Ajax)