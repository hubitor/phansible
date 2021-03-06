<?php

namespace Phansible\Roles;

use Phansible\Application;
use Phansible\Role;
use PHPUnit\Framework\TestCase;

class SolrTest extends TestCase
{
    private $role;

    public function setUp(): void
    {
        $app = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->role = new Solr($app);
    }

    public function tearDown(): void
    {
        unset($this->role);
    }

    /**
     * @covers \Phansible\Roles\Solr
     */
    public function testShouldInstanceOf(): void
    {
        $this->assertInstanceOf(Role::class, $this->role);
    }

    /**
     * @covers \Phansible\Roles\Solr::getName
     */
    public function testShouldGetName(): void
    {
        $this->assertEquals('Solr', $this->role->getName());
    }

    /**
     * @covers \Phansible\Roles\Solr::getSlug
     */
    public function testShouldGetSlug(): void
    {
        $this->assertEquals('solr', $this->role->getSlug());
    }

    /**
     * @covers \Phansible\Roles\Solr::getRole
     */
    public function testShouldGetRole(): void
    {
        $this->assertEquals('solr', $this->role->getRole());
    }

    /**
     * @covers \Phansible\Roles\Solr::getInitialValues
     */
    public function testShouldGetInitialValues(): void
    {
        $expected = [
            'install' => 0,
            'port'    => '8983',
            'version' => '5.2.0',
        ];

        $this->assertEquals($expected, $this->role->getInitialValues());
    }
}
