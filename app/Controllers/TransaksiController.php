<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    public function index()
    {
        // Panggil view v_keranjang
        return view('v_keranjang');
    }
}