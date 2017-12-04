<?php

declare(strict_types = 1);

namespace byrokrat\checkdigit;

use hanneskod\readmetester\PHPUnit\AssertReadme;

/**
 * @coversNothing
 */
class ReadmeIntegration extends \PHPUnit\Framework\TestCase
{
    public function testReadmeIntegrationTests()
    {
        if (!class_exists(AssertReadme::CLASS)) {
            return $this->markTestSkipped('Readme-tester is not available.');
        }

        (new AssertReadme($this))->assertReadme('README.md');
    }
}
