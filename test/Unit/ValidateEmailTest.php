<?php

class ValidateEmailTest extends PHPUnit_Framework_TestCase {

    public function testFuncExists()
    {
        $this->assertTrue(function_exists('ValidateRapper\validate_email'));
    }

    public function testInvalidEmail() {
        $this->assertFalse(ValidateRapper\validate_email('guntergrodotzki.co.za'));
    }

    public function testValidAsciiEmail() {
        $this->assertTrue(ValidateRapper\validate_email('gunter@grodotzki.co.za'));
    }

    public function testValidUtf8Email() {
        $this->assertTrue(ValidateRapper\validate_email('foo@günter.de'));
    }
}