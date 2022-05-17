<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('login')) {
            return redirect()->to(base_url())->with('pesan', 'Silahkan login dulu!');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $current = (string)current_url(true)->setHost('')->setScheme('')->stripQuery('token');
        // // jika sudah login
        if (in_array((string)$current, [route_to('login'), route_to('lupa-password'), route_to('reset')]) && session()->has('login')) {
            return redirect()->to('dashboard');
        }
    }
}
