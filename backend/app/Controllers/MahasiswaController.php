<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class MahasiswaController extends ResourceController
{
    protected $db;
    protected $format = 'json';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index()
    {
        $query = $this->db->query("
            SELECT m.*, p.nama_prodi 
            FROM mahasiswa m
            JOIN program_studi p ON p.id_prodi = m.id_prodi
        ");
        $result = $query->getResult();

        return $this->respond([
            'message' => 'success',
            'data_mahasiswa' => $result
        ], 200);
    }

    public function show($id = null)
    {
        $query = $this->db->query("
            SELECT m.*, p.nama_prodi 
            FROM mahasiswa m
            JOIN program_studi p ON p.id_prodi = m.id_prodi
            WHERE m.id_mahasiswa = ?
        ", [$id]);
        $row = $query->getRow();

        if ($row === null) {
            return $this->failNotFound('Data mahasiswa tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'mhs_byid' => $row
        ], 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'nama_mahasiswa' => 'required',
            'alamat_mahasiswa' => 'required',
            'id_prodi' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->query("
            INSERT INTO mahasiswa (nama_mahasiswa, alamat_mahasiswa, id_prodi) 
            VALUES (?, ?, ?)
        ", [
            $this->request->getVar('nama_mahasiswa'),
            $this->request->getVar('alamat_mahasiswa'),
            $this->request->getVar('id_prodi'),
        ]);

        return $this->respondCreated([
            'message' => 'Data mahasiswa berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $check = $this->db->query("SELECT * FROM mahasiswa WHERE id_mahasiswa = ?", [$id])->getRow();
        if ($check === null) {
            return $this->failNotFound('Data mahasiswa tidak ditemukan');
        }

        $rules = $this->validate([
            'nama_mahasiswa' => 'required',
            'alamat_mahasiswa' => 'required',
            'id_prodi' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $this->db->query("
            UPDATE mahasiswa 
            SET nama_mahasiswa = ?, alamat_mahasiswa = ?, id_prodi = ? 
            WHERE id_mahasiswa = ?
        ", [
            $this->request->getVar('nama_mahasiswa'),
            $this->request->getVar('alamat_mahasiswa'),
            $this->request->getVar('id_prodi'),
            $id
        ]);

        return $this->respond([
            'message' => 'Data mahasiswa berhasil diubah'
        ], 200);
    }

    public function delete($id = null)
    {
        $check = $this->db->query("SELECT * FROM mahasiswa WHERE id_mahasiswa = ?", [$id])->getRow();
        if ($check === null) {
            return $this->failNotFound('Data mahasiswa tidak ditemukan');
        }

        $this->db->query("DELETE FROM mahasiswa WHERE id_mahasiswa = ?", [$id]);

        return $this->respondDeleted([
            'message' => 'Data mahasiswa berhasil dihapus'
        ]);
    }
}