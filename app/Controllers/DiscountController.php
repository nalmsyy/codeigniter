<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiscountModel;

class DiscountController extends BaseController
{
    protected $discountModel;

    function __construct()
    {
        helper(['number', 'form']);
        $this->discountModel = new DiscountModel();
    }

    public function index()
    {
        return view('diskon/index', [
            'discounts' => $this->discountModel->orderBy('tanggal', 'ASC')->findAll()
        ]);
    }

    public function create()
    {
        $rules = [
            'tanggal' => 'required|valid_date|is_unique[discount.tanggal]',
            'nominal' => 'required|numeric',
        ];

        $messages = [
            'tanggal' => [
                'is_unique' => 'The tanggal field must contain a unique value.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect('diskon')->with('failed', $this->validator->listErrors());
        }

        $dataForm = [
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
        ];

        $this->discountModel->insert($dataForm);

        return redirect('diskon')->with('success', 'Data Diskon Berhasil Ditambah');
    }

    public function edit($id)
    {
        // Edit hanya boleh mengubah nominal, tanggal tidak berubah
        $rules = [
            'nominal' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect('diskon')->with('failed', $this->validator->listErrors());
        }

        $dataForm = [
            'nominal' => $this->request->getPost('nominal'),
        ];

        $this->discountModel->update($id, $dataForm);

        return redirect('diskon')->with('success', 'Data Diskon Berhasil Diubah');
    }

    public function delete($id)
    {
        // Soft delete otomatis karena useSoftDeletes = true pada DiscountModel
        $this->discountModel->delete($id);

        return redirect('diskon')->with('success', 'Data Diskon Berhasil Dihapus');
    }
}
