<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\CPF;

class CPFTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCPFValidation()
    {
        $cpfTrue = new CPF('08771225633');
        $cpfFalse = new CPF('12345678910');
        $equalNumbers = new CPF('00000000000');
        $noCPF = new CPF('123');

        $this->assertTrue($cpfTrue->isValidCPF());
        $this->assertTrue(!$cpfFalse->isValidCPF());
        $this->assertTrue(!$equalNumbers->isValidCPF());
        $this->assertTrue(!$noCPF->isValidCPF());
    }
}
