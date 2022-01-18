<?php

namespace App\Controller;

use App\Facades\View;
use App\Model\Character;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Ronanchilvers\Orm\Orm;

/**
 * Controller for the index
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class IndexController
{
    /**
     * Index action
     *
     * @author Ronan Chilvers <ronan@d3r.com>
     */
    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $characters = Orm::finder(Character::class)->all();

        return View::render(
            $response,
            'index/index.html.twig',
            [
                'characters' => $characters,
            ]
        );
    }

    public function edit(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $id
    ) {
        $character = Orm::finder(Character::class)->one($id);
        
        return View::render(
            $response,
            'index/edit.html.twig',
            [
                'character' => $character,
            ]
        );
    }

    public function generate(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $character = new Character();
        $character->assignStandardArray();
        $character->save();

        return $response
            ->withStatus(302)
            ->withHeader(
                'Location',
                '/'
            );
    }
}
