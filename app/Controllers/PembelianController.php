<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class PembelianController extends BaseController
{
    protected $transactionModel;
    protected $transactionDetailModel;

    public function __construct()
    {
        helper(['number', 'form']);
        $this->transactionModel       = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
    }

    /**
     * Tampilkan semua data transaksi pembelian (khusus admin).
     */
    public function index()
    {
        $transactions   = $this->transactionModel->orderBy('id', 'DESC')->findAll();
        $transactionIds = array_column($transactions, 'id');
        $products       = $this->transactionDetailModel->getProductsByTransactionIds($transactionIds);

        return view('v_pembelian', [
            'transactions' => $transactions,
            'products'     => $products,
        ]);
    }

    /**
     * Tampilkan detail transaksi pembelian (halaman/route terpisah).
     */
    public function detail($id)
    {
        $transaction = $this->transactionModel->find($id);

        if (!$transaction) {
            return redirect()->to('pembelian')->with('failed', 'Transaksi tidak ditemukan.');
        }

        $products = $this->transactionDetailModel->getProductsByTransactionIds([$id]);

        return view('v_pembelian_detail', [
            'transaction' => $transaction,
            'products'     => $products[$id] ?? [],
        ]);
    }

    /**
     * Ubah status transaksi (toggle 0 <-> 1).
     * Hanya menerima POST, hanya admin (dijaga oleh filter di route).
     */
    public function updateStatus($id)
    {
        $transaction = $this->transactionModel->find($id);

        if (!$transaction) {
            return redirect('pembelian')->with('failed', 'Transaksi tidak ditemukan.');
        }

        $statusBaru = $this->request->getPost('status');

        // Validasi: status hanya boleh 0 atau 1
        if (!in_array($statusBaru, ['0', '1'], true)) {
            return redirect('pembelian')->with('failed', 'Status tidak valid.');
        }

        $this->transactionModel->update($id, [
            'status' => (int) $statusBaru,
        ]);

        return redirect('pembelian')->with('success', 'Status transaksi berhasil diubah.');
    }
}
