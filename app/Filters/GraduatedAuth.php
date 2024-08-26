<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GraduatedAuth implements FilterInterface
{
    #[\Override] public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') != 3) {
            return redirect()->to(base_url())->with('error', 'Nie masz dostępu do tej witryny.');
        }
    }


    #[\Override] public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}