<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends MY_Model
{
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'nama_kelas',
                'label' => 'Nama Kelas',
                'rules' => 'trim|required|min_length[1]|max_length[30]|callback_alpha_numeric_coma_dash_dot_space|callback_nama_kelas_unik'
            ],
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'nama_kelas'    => ''
        ];
    }
}
