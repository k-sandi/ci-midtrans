APLIKASI CHECKOUT SEDERHANA MENGGUNAKAN CODEIGNITER DENGAN INTEGRASI MIDTRANS

********************************************************************

Nama : Kurnia Sandi

Email : kurniya097@gmail.com

********************************************************************

Syarat-Syarat :
1. Minimal PHP versi 5.4.x ke atas.
2. Minimal Codeigniter versi 2.2.x ke atas.

Langkah Install :
1. Download atau Clone Project ci-midtrans.
2. Ganti base_url di folder application/config/config.php menjadi "http://localhost/ci-midtrans/" (Jika menggunakan localhost).
3. Jika belum punya akun Midtrans, Silahkan daftar terlebih dahulu (https://account.midtrans.com/register).
4. Jika Berhasil, Login ke sistem Midtrans.
5. Gunakan versi testing atau sendbox.
6. Pada Side Bar pilih menu "SETTINGS" --> "ACCESS KEY".
7. Copy "Server Key" akun Midtrans anda (Ingat, gunakan versi Sendbox karena ini hanya Testing bukan Production).
8. Paste ke application/controllers/snap.php pada function construct line/baris ke-26. 
9. Kembali ke Akun Midtrans anda, lalu Menu "SETTINGS" --> "ACCESS KEY" tadi, kemudian copy "Client Key".
10. Paste ke application/views/checkout_product.php --> "data-client-key" pada line/baris ke-12.
11. Save ALL, lalu jalankan project di browser kesayangkan anda.
12. Jangan lupa sambungkan INTERNET.
13. Selesai, Salam Luar Biasa.

********************************************************
#PHP #JQuery #Codeigniter #Midtrans #Bootstrap #HTML

********************************************************