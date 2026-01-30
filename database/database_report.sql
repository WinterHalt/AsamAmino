USE djamil_ticketing;

CREATE OR REPLACE VIEW join_permintaan_aplikasi AS
  SELECT
    tma.uuid,
    tma.unit,
    tma.pengusul as pengusul_identifier,
    s_pengusul.name AS pengusul,
    tma.pic,
    tma.status,
    tma.tanggal_pengajuan as tanggal,
    tma.judul,
    tma.deskripsi,
    tma.surat,
    tma.alur,
    tma.alasan
  FROM
    tabel_minta_aplikasi tma
  JOIN
    staff s_pengusul ON tma.pengusul = s_pengusul.staff_id;

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

CREATE OR REPLACE VIEW `issue_log_report` AS
  SELECT
    uuid,
    -- Selisih Tindak Lanjut dari Pending
    GREATEST(
      TIMESTAMPDIFF(
        HOUR,
        pending,
        COALESCE(lanjut, NOW())
      ), 0
    ) as lanjut,
    -- Selisih Selesai dari Tindak Lanjut
    GREATEST(
      TIMESTAMPDIFF(
        HOUR,
        COALESCE(lanjut, pending),
        COALESCE(selesai, NOW())
      ), 0
    ) as selesai,
    -- Selisih Selesai dari Pending
    GREATEST(
      TIMESTAMPDIFF(
        HOUR,
        pending,
        COALESCE(selesai, NOW())
      ), 0
    ) as total
  FROM
    tabel_issue_logtime;
