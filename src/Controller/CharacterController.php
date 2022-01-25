<?php

namespace App\Controller;

use App\Facades\View;
use App\Facades\Route;
use App\Model\Character;
use Ronanchilvers\Orm\Orm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Controller for the characters
 *
 * @author Ronan Chilvers <ronan@d3r.com>
 */
class CharacterController
{
    public function index(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $characters = Orm::finder(Character::class)->all();

        return View::render(
            $response,
            'characters/index.html.twig',
            [
                'characters' => $characters,
            ]
        );
    }

    // public function new(
    //     ServerRequestInterface $request,
    //     ResponseInterface $response
    // ) {
    //     $character = new Character();
    //     if ('POST' == $request->getMethod()) {
    //         $data = $request->getParsedBody()['data'];
    //         $character->fromArray($data);
    //         if ($character->saveWithValidation()) {
    //             return $response
    //                 ->withStatus(302)
    //                 ->withHeader('Location', Route::urlFor('characters.edit', $character->id))
    //                 ;
    //         }
    //     }
        
    //     return View::render(
    //         $response,
    //         'characters/new.html.twig',
    //         [
    //             'character' => $character,
    //         ]
    //     );
    // }

    public function edit(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $id
    ) {
        if ('new' == $id) {
            $character = new Character();
        } else if (filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1] ])) {
            $character = Orm::finder(Character::class)->one($id);
        } else {
            return $response
                ->withStatus(302)
                ->withHeader('Location', Route::urlFor('characters.index'))
                ;
        }

        $error = false;
        if ('POST' == $request->getMethod()) {
            $data = $request->getParsedBody()['data'];
            $character->fromArray($data);
            if ($character->saveWithValidation()) {
                return $response
                    ->withStatus(302)
                    ->withHeader('Location', Route::urlFor('characters.edit', ['id' => $character->id]))
                    ;
            }
            $error = true;
        }

        return View::render(
            $response,
            'characters/edit.html.twig',
            [
                'character' => $character,
                'error'     => $error,
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
