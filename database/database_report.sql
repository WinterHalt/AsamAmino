USE djamil_ticketing;

CREATE OR REPLACE VIEW join_permintaan_aplikasi AS
  SELECT
    tma.uuid,
    tma.unit as unit_identifier,
    tma.pengusul as pengusul_identifier,
    sd.name AS unit,
    s_pengusul.name AS pengusul,
    tma.pic,
    tma.status,
    tma.tanggal_pengajuan,
    tma.judul,
    tma.deskripsi,
    tma.surat,
    tma.alur,
    tma.alasan
  FROM
    tabel_minta_aplikasi tma
  JOIN
    staff_department sd ON tma.unit = sd.id
  JOIN
    staff s_pengusul ON tma.pengusul = s_pengusul.staff_id;

CREATE OR REPLACE VIEW tabel_monthly_minta_aplikasi AS
  SELECT
    CONCAT(MONTHNAME(tma.tanggal_pengajuan), ' ', YEAR(tma.tanggal_pengajuan)) AS periode,
    tma.tanggal_pengajuan,
    tma.judul,
    sd.name as unit
  FROM tabel_minta_aplikasi tma
  JOIN staff_department sd ON tma.unit = sd.id
  ORDER BY periode DESC;

CREATE OR REPLACE VIEW view_pelaporan_issue AS
  SELECT 
    tpi.uuid, 
    tpi.unit,
    tpi.pelapor as pl_id,
    s.name as pelapor,
    tpi.telephone,
    tpi.deskripsi, 
    tpi.tanggal_pelaporan, 
    tpi.kategorikal, 
    tpi.lampiran,
    tpi.status
  FROM 
    tabel_pelaporan_issue tpi
  JOIN
    staff s ON tpi.pelapor = s.staff_id;