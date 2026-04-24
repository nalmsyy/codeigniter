<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProdukController extends BaseController
{
    public function index()
    {
        // Panggil view v_produk
        return view('v_produk');
    }
}