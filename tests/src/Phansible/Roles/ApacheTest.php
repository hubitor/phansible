<?php

namespace Phansible\Roles;

use PHPUnit\Framework\TestCase;
use Phansible\Application;
use Phansible\Role;

class ApacheTest extends TestCase
{
    private $role;

    public function setUp(): void
    {
        $app = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->role = new Apache($app);
    }

    public function tearDown(): void
    {
        unset($this->role);
    }

    /**
     * @covers \Phansible\Roles\Apache
     */
    public function testShouldInstanceOf(): void
    {
        $this->assertInstanceOf(Role::class, $this->role);
    }

    /**
     * @covers \Phansible\Roles\Apache::getName
     */
    public function testShouldGetName(): void
    {
        $this->assertEquals('Apache', $this->role->getName());
    }

    /**
     * @covers \Phansible\Roles\Apache::getSlug
     */
    public function testShouldGetSlug(): void
    {
        $this->assertEquals('apache', $this->role->getSlug());
    }

    /**
     * @covers \Phansible\Roles\Apache::getRole
     */
    public function testShouldGetRole(): void
    {
        $this->assertEquals('apache', $this->role->getRole());
    }

    /**
     * @covers \Phansible\Roles\Apache::getInitialValues
     */
    public function testShouldGetInitialValues(): void
    {
        $expected = [
            'install'    => 0,
            'docroot'    => '/vagrant',
            'servername' => 'myApp.vb',
        ];

        $this->assertEquals($expected, $this->role->getInitialValues());
    }
}
