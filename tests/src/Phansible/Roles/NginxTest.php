<?php

namespace Phansible\Roles;

use PHPUnit\Framework\TestCase;
use Phansible\Application;
use Phansible\Role;

class NginxTest extends TestCase
{
    private $role;

    public function setUp(): void
    {
        $app = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->role = new Nginx($app);
    }

    public function tearDown(): void
    {
        unset($this->role);
    }

    /**
     * @covers \Phansible\Roles\Nginx
     */
    public function testShouldInstanceOf(): void
    {
        $this->assertInstanceOf(Role::class, $this->role);
    }

    /**
     * @covers \Phansible\Roles\Nginx::getName
     */
    public function testShouldGetName(): void
    {
        $this->assertEquals('Nginx', $this->role->getName());
    }

    /**
     * @covers \Phansible\Roles\Nginx::getSlug
     */
    public function testShouldGetSlug(): void
    {
        $this->assertEquals('nginx', $this->role->getSlug());
    }

    /**
     * @covers \Phansible\Roles\Nginx::getRole
     */
    public function testShouldGetRole(): void
    {
        $this->assertEquals('nginx', $this->role->getRole());
    }

    /**
     * @covers \Phansible\Roles\Nginx::getInitialValues
     */
    public function testShouldGetInitialValues(): void
    {
        $expected = [
            'install'    => 1,
            'docroot'    => '/vagrant',
            'servername' => 'myApp.vb',
        ];

        $this->assertEquals($expected, $this->role->getInitialValues());
    }
}
