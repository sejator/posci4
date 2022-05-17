<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // load helper
        helper('fungsi');
        if (get_user('id_role') != 1) {
            return redirect()->to('dashboard')->with('pesan', 'Tidak diizinkan!');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // load helper
        helper('fungsi');
        if (get_user('id_role') == 3) {
            return redirect()->to('dashboard')->with('pesan', 'Tidak diizinkan!');
        }
    }
}
