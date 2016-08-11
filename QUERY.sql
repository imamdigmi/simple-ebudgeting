-- LATIHAN QUERY --


-- SATU TABEL
SELECT * FROM kriteria_masuk

-- DUA TABEL
SELECT * FROM kriteria_keluar k JOIN variabel_guna_keluar v ON k.kd_kriteria_keluar=v.kd_kriteria_keluar

-- TIGA TABEL
SELECT * FROM kriteria_keluar k JOIN variabel_guna_keluar v ON k.kd_kriteria_keluar=v.kd_kriteria_keluar JOIN sub_var_guna_keluar s ON v.kd_var_guna_keluar=s.kd_var_guna_keluar

-- EMPAT TABEL
SELECT * FROM kriteria_keluar k JOIN variabel_guna_keluar v ON k.kd_kriteria_keluar=v.kd_kriteria_keluar JOIN sub_var_guna_keluar s ON v.kd_var_guna_keluar=s.kd_var_guna_keluar JOIN komponen_sub_var_guna ks ON ks.kd_sub_var_guna_keluar=s.kd_sub_var_guna_keluar

--  MENAMPILKAN PEGNAMBILAN DANA (REKAP C)
SELECT * AS jml FROM pengambilan_dana p JOIN komponen_sub_var_guna k ON p.kd_komp_sub_var_guna=k.kd_komp_sub_var_guna JOIN variabel_guna_masuk v ON p.kd_var_guna_masuk=v.kd_var_guna_masuk