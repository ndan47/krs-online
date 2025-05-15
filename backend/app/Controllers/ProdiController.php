<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Database;

class ProdiController extends ResourceController
{
    protected $db;
    protected $format = 'json';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index()
    {
        $query = $this->db->query("SELECT * FROM program_studi");
        $result = $query->getResult();

        return $this->respond([
            'message' => 'success',
            'data_prodi' => $result
        ], 200);
    }

    public function show($id = null)
    {
        $query = $this->db->query("SELECT * FROM program_studi WHERE id_prodi = ?", [$id]);
        $row = $query->getRow();

        if ($row === null) {
            return $this->failNotFound('Data prodi tidak ditemukan');
        }

        return $this->respond([
            'message' => 'success',
            'prodi_byid' => $row
        ], 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'nama_prodi' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $namaProdi = $this->request->getVar('nama_prodi');

        $this->db->query("INSERT INTO program_studi (nama_prodi) VALUES (?)", [$namaProdi]);

        return $this->respondCreated([
            'message' => 'Data prodi berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $query = $this->db->query("SELECT * FROM program_studi WHERE id_prodi = ?", [$id]);
        if ($query->getRow() === null) {
            return $this->failNotFound('Data prodi tidak ditemukan');
        }

        $rules = $this->validate([
            'nama_prodi' => 'required',
        ]);

        if (!$rules) {
            return $this->failValidationErrors([
                'message' => $this->validator->getErrors()
            ]);
        }

        $namaProdi = $this->request->getVar('nama_prodi');

        $this->db->query("UPDATE program_studi SET nama_prodi = ? WHERE id_prodi = ?", [$namaProdi, $id]);

        return $this->respond([
            'message' => 'Data prodi berhasil diubah'
        ], 200);
    }

    public function delete($id = null)
    {
        $query = $this->db->query("SELECT * FROM program_studi WHERE id_prodi = ?", [$id]);
        if ($query->getRow() === null) {
            return $this->failNotFound('Data prodi tidak ditemukan');
        }

        $this->db->query("DELETE FROM program_studi WHERE id_prodi = ?", [$id]);

        return $this->respondDeleted([
            'message' => 'Data prodi berhasil dihapus'
        ]);
    }
}