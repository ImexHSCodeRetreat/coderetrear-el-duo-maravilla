<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Service\GameService;
use App\Entity\Board;

class gameVictoryTest extends WebTestCase
{

    private $serv;
    private $board;
    //private $secret = 'def000004ba8fee5d13ac2b2d8f13d3762bd732df2513df86da00f96da48c36623de3fe1bd45d0e63b82066fe31ccd1f090883d60312c989cd4893797b143c4a33495263';

    public function setUp(){
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();
        $this->serv = new GameService($entityManager);
        $this->board = new Board();
    }

    public function testGameVictory()
    {
        //Una diagonal
        $f = $this->board->setPositions(['O',null,null,null,'O',null,null,null,'O']);
        $p = $this->serv->gameVictory($f);
        $this->assertEquals($p,[0,4,8],'malBernie');

        //Todo Null
        $g = $this->board->setPositions([null,null,null,null,null,null,null,null,null]);
        $h = $this->serv->gameVictory($g);
        $this->assertEquals($h,[],'malBernie');
    }
}