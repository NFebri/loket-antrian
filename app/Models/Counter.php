<?php

namespace App\Models;

use CodeIgniter\Model;

class Counter extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'counters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'name'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id' => 'required|is_unique[counters.user_id,id,{id}]',
        'name' => 'required',
    ];
    protected $validationMessages   = [
        'user_id' => [
            'is_unique' => 'Sorry. user_id sudah digunakan',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     *
     * @throws \CodeIgniter\Exceptions\PageNotFoundException
     */
    public function findOrFail($id)
    {
        if (empty($user = $this->find($id))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $user;
    }
}
