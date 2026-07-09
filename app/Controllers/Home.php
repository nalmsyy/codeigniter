<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\DiscountModel;

class Home extends BaseController
{
    protected $productModel;
    protected $discountModel;

    function __construct()
    {
        helper(['number', 'form']);
        $this->productModel  = new ProductModel();
        $this->discountModel = new DiscountModel();
    }

    public function index(): string
    {
        $products = $this->productModel->findAll();

        // Ambil diskon aktif hari ini (deleted_at = NULL otomatis oleh useSoftDeletes)
        $discountHariIni = $this->discountModel->getDiscountHariIni();

        // Simpan ke session agar bisa digunakan di Keranjang dan Checkout
        if ($discountHariIni !== null) {
            session()->set('active_discount', [
                'id'      => $discountHariIni['id'],
                'tanggal' => $discountHariIni['tanggal'],
                'nominal' => $discountHariIni['nominal'],
            ]);
        } else {
            // Tidak ada diskon hari ini, hapus session active_discount
            session()->remove('active_discount');
        }

        $data['products'] = $products;

        return view('v_home', $data);
    }

    public function index2(): string
    {
        return view('v_FAQ');
    }
}
