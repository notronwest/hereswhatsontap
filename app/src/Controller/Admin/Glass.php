<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/12/18
 * Time: 10:13 PM
 */

namespace App\Controller\Admin;


use App\BaseController;
use App\Service\GlassService;
use App\Service\SessionService;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Glass
 * @package App\Controller\Admin
 * @Route("/admin/glass")
 */
class Glass extends BaseController
{

    private $glassService;
    public function __construct(SessionService $sessionService, GlassService $glassService)
    {
        parent::__construct($sessionService);
        $this->glassService             = $glassService;
    }

    /**
     * @Route("/setup")
     */
    public function setupGlassFromAPI()
    {
        $glassesCreated = [];
        $glasses = [ 1,2,3,4,5,6,7,8,9,10 ];

        foreach ($glasses as $APIID) {

            // get the glass API object
            $glassEntity = $this->glassService->getByAPIID($APIID);
            if( $glassEntity ){
                // save the glass object
                $this->glassService->save($glassEntity);
                array_push($glassesCreated, $glassEntity);
            }
        }

        return $this->render('@App/admin/glass/setup.html.twig', [
            'glassesCreated' => $glassesCreated,
        ]);
    }

}