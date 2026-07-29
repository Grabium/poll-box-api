<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // O trait CreatesApplication é responsável por instanciar a aplicação
    // Laravel para que os testes tenham acesso aos serviços e configurações.
    use CreatesApplication;
}