<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * @param mixed $dump
 * @return void
 */
#[NoReturn] function dd(mixed ...$dump): void
{
    var_dump($dump); die();
}