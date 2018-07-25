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
        //Probar diagonales
        $f = $this->board->setPositions(['O',null,null,null,'O',null,null,null,'O']);
        $p = $this->serv->gameVictory($f);
        $this->assertEquals($p,[0,4,8],'malBernie1');

        $o = $this->board->setPositions([null,null,'O',null,'O',null,'O',null,null]);
        $q = $this->serv->gameVictory($o);
        $this->assertEquals($q,[2,4,6],'malBernie2');

        //Rows y Columns
        $i = $this->board->setPositions(['X','X','X',null,null,null,null,null,null]);
        $j = $this->serv->gameVictory($i);
        $this->assertEquals($j,[0,1,2],'malBernie3');

        $k = $this->board->setPositions([null,null,null,'X','X','X',null,null,null]);
        $l = $this->serv->gameVictory($k);
        $this->assertEquals($l,[3,4,5],'malBernie4');

        $m = $this->board->setPositions([null,null,null,null,null,null,'X','X','X']);
        $n = $this->serv->gameVictory($m);
        $this->assertEquals($n,[6,7,8],'malBernie5');

        //Todo Null
        $g = $this->board->setPositions([null,null,null,null,null,null,null,null,null]);
        $h = $this->serv->gameVictory($g);
        $this->assertEquals($h,[],'malBernie6');

        //Signos Diferentes
        for ($t = 0; $t < 4; $t++) {
            $tt=[null,null,null,null,'O','O',null,'O','O'];
            $tt[$t]='X';
            $r = $this->board->setPositions($tt);
            $s = $this->serv->gameVictory($r);
            $this->assertEquals($s,[],'malBernie7');
            echo $t;
        }

    }
}