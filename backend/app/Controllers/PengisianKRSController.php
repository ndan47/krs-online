<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Database\BaseConnection;

class PengisianKRSController extends ResourceController
{
    protected $db;
    protected $format = 'json';

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $query = $this->db->query("
            SELECT pk.*, m.nama_mahasiswa, mk.nama_matkul, ps.nama_prodi, mk.semester, mk.banyak_sks, mk.banyak_jam_matkul, mk.keterangan
            FROM pengisian_krs pk
            JOIN mahasiswa m ON pk.NPM = m.NPM
            JOIN mata_kuliah mk ON pk.id_matkul = mk.id_matkul
            JOIN program_studi ps ON m.id_prodi = ps.id_prodi
        ");
        $result = $query->getResult();

        $programStudi = $this->db->table('program_studi')->get()->getResultArray();

        return $this->respond([
            'message' => 'success',
            'data_pengisian_krs' => $result,
            'data_prodi' => $programStudi
        ], 200);
    }

    public function show($id = null)
    {
        $query = $this->db->query("
            SELECT pk.*, m.nama_mahasiswa, mk.nama_matkul, ps.nama_prodi, mk.semester, mk.banyak_sks, mk.banyak_jam_matkul, mk.keterangan
            FROM pengisian_krs pk
            JOIN mahasiswa m ON pk.NPM = m.NPM
            JOIN mata_kuliah mk ON pk.id_matkul = mk.id_matkul
            JOIN program_studi ps ON m.id_prodi = ps.id_prodi
            WHERE pk.id_pengisian = ?
        ", [$id]);
        $data = $query->getRow();

        if (!$data) {
            return $this->failNotFound('Data pengisian KRS tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'pengisiankrs_byid' => $data
        ], 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'timestamp' => 'required',
            'tahun_akademik' => 'required',
            'NPM' => 'required',
            'id_matkul' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->query("
            INSERT INTO pengisian_krs (timestamp, tahun_akademik, NPM, id_matkul)
            VALUES (?, ?, ?, ?)
        ", [
            $this->request->getVar('timestamp'),
            $this->request->getVar('tahun_akademik'),
            $this->request->getVar('NPM'),
            $this->request->getVar('id_matkul'),
        ]);

        return $this->respondCreated([
            'message' => 'Data pengisian KRS berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $check = $this->db->query("SELECT * FROM pengisian_krs WHERE id_pengisian = ?", [$id])->getRow();
        if (!$check) {
            return $this->failNotFound('Data pengisian KRS tidak ditemukan');
        }

        $rules = $this->validate([
            'timestamp' => 'required',
            'tahun_akademik' => 'required',
            'NPM' => 'required',
            'id_matkul' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->query("
            UPDATE pengisian_krs
            SET timestamp = ?, tahun_akademik = ?, NPM = ?, id_matkul = ?
            WHERE id_pengisian = ?
        ", [
            $this->request->getVar('timestamp'),
            $this->request->getVar('tahun_akademik'),
            $this->request->getVar('NPM'),
            $this->request->getVar('id_matkul'),
            $id
        ]);

        return $this->respond([
            'message' => 'Data pengisian KRS berhasil diubah'
        ], 200);
    }

    public function delete($id = null)
    {
        $check = $this->db->query("SELECT * FROM pengisian_krs WHERE id_pengisian = ?", [$id])->getRow();
        if (!$check) {
            return $this->failNotFound('Data pengisian KRS tidak ditemukan');
        }

        $this->db->query("DELETE FROM pengisian_krs WHERE id_pengisian = ?", [$id]);

        return $this->respondDeleted([
            'message' => 'Data pengisian KRS berhasil dihapus'
        ]);
    }
}