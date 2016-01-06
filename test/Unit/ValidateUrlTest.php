<?php

class ValidateUrlTest extends PHPUnit_Framework_TestCase {

    public function testFuncExists()
    {
        $this->assertTrue(function_exists('ValidateRapper\validate_url'));
    }

    public function testValidAsciiUrl() {
        $this->assertTrue(ValidateRapper\validate_url('http://www.lifeofguenter.de'));
    }

    public function testValidIdnaUrl() {
        $this->assertTrue(ValidateRapper\validate_url('http://www.lifeofgünter.de'));
    }
}