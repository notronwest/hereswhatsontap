<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/29/18
 * Time: 9:24 PM
 */

namespace App;

use App\Service\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public $sessionService;
    public $currentUser;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
        // set up the current customer and current location
        // TODO this should maybe be moved to a login event
        $this->sessionService->getCurrentCustomer();
        $this->sessionService->getCurrentLocation();
    }
}