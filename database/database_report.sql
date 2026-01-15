USE djamil_ticketing;

CREATE OR REPLACE VIEW join_permintaan_aplikasi AS
  SELECT
    tma.uuid,
    tma.unit,
    tma.pengusul as pengusul_identifier,
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

CREATE OR REPLACE VIEW `issue_log_report_time_diff` AS
  SELECT
    til.uuid,
    tpi.tanggal_pelaporan,
    tpi.kategorikal,
    -- Selisih Tindak Lanjut dari Pending
    GREATEST(
      TIMESTAMPDIFF(
        HOUR,
        til.pending,
        COALESCE(til.lanjut, NOW())
      ), 0
    ) as lanjut,
    -- Selisih Selesai dari Tindak Lanjut
    GREATEST(
      TIMESTAMPDIFF(
        HOUR,
        COALESCE(til.lanjut, til.pending),
        COALESCE(til.selesai, NOW())
      ), 0
    ) as selesai,
    -- Selisih Selesai dari Pending
    GREATEST(
      TIMESTAMPDIFF(
        HOUR,
        til.pending,
        COALESCE(til.selesai, NOW())
      ), 0
    ) as total
  FROM
    tabel_issue_logtime til
  JOIN tabel_pelaporan_issue tpi ON til.uuid = tpi.uuid;

CREATE OR REPLACE VIEW `laporan_issue_logtime` AS
  SELECT
    til.uuid,
    til.pending,
    sp.name as userp,
    til.lanjut,
    sl.name as userl,
    til.selesai,
    ss.name as users
  FROM
    tabel_issue_logtime til
  LEFT JOIN staff sp ON til.userp = sp.staff_id
  LEFT JOIN staff sl ON til.userl = sl.staff_id
  LEFT JOIN staff ss ON til.users = ss.staff_id;