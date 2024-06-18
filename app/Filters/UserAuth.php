<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserAuth implements FilterInterface
{


    #[\Override] public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') != 2) {
            return redirect()->to(base_url())->with('error', 'Nie masz dostępu do tej witryny.');
        }
    }


    #[\Override] public function after(RequestInterface $request,ResponseInterface $response, $arguments = null)
    {
    }
}