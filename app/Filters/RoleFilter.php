<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $requiredRole = $arguments[0] ?? null;
        $userRole = session()->get('role');

        if ($requiredRole && $userRole !== $requiredRole) {
            $redirectUrl = $userRole === 'admin' ? '/admin/dashboard' : '/customer/dashboard';
            return service('response')
                ->setStatusCode(403)
                ->setBody(view('errors/unauthorized', ['redirectUrl' => $redirectUrl]));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
