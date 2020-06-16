<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


// This filter is used for checking users url
class UsersCheck implements FilterInterface
{
  public function before(RequestInterface $request)
  {
    // Do something here
    // If Segment 1 == users
    // Redirect to second segment/ the method
    $uri = service('uri');
    if ($uri->getSegment(1) == 'users') {
      if ($uri->getSegment(2) == '')
        $segment = '/';
      else
        $segment = '/' . $uri->getSegment(2);
      return redirect()->to($segment);
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response)
  {
    // Do something here
  }
}
