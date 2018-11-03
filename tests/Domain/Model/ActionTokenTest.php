<?php

/*
 * This file is part of the Ekklesion project.
 * (c) Matías Navarro Carter <mnavarrocarter@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekklesion\People\Tests\Domain\Model;

use Ekklesion\People\Domain\Model\ActionToken;
use PHPUnit\Framework\TestCase;

/**
 * Class ActionTokenTest.
 *
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ActionTokenTest extends TestCase
{
    public function testGenerationIsRandom(): void
    {
        $tokenOne = ActionToken::generate();
        $tokenTwo = ActionToken::generate();

        $this->assertNotSame($tokenOne->value(), $tokenTwo->value());
    }

    public function testThatTokenCanExpire(): void
    {
        $token = ActionToken::generate('-3 days');
        $this->assertTrue($token->isExpired());
    }

    public function testTokenValidationFailsForExpiration(): void
    {
        $token = ActionToken::generate('-4 days');
        $this->expectException(\DomainException::class);
        $token->ensureTokenIsValid($token->value());
    }

    public function testTokenValidationFailsForWrongToken(): void
    {
        $token = ActionToken::generate();
        $this->expectException(\DomainException::class);
        $token->ensureTokenIsValid('wrong-token-dude');
    }
}
