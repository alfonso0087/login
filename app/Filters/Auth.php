<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


// This filter is used for preventing users to access some pages ex:profile without logged in before
class Auth implements FilterInterface
{
  public function before(RequestInterface $request)
  {
    // Do something here
    if (!session()->get('isLoggedIn')) {
      return redirect()->to('/');
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response)
  {
    // Do something here
  }
}
