<?php

namespace Phansible\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Phansible\RoleManager;
use Phansible\Application;
use Phansible\Model\VagrantBundle;
use Symfony\Component\HttpFoundation\Response;

class BundleControllerTest extends TestCase
{
    /**
     * @var BundleController
     */
    private $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->controller = new BundleController();
    }

    /**
     * @covers \Phansible\Controller\BundleController::extractLocale
     */
    public function testShouldExtractLocale(): void
    {
        $result = $this->controller->extractLocale('en');

        $expected = 'en_US.UTF-8';

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers \Phansible\Controller\BundleController::extractLocale
     */
    public function testShouldExtractLocaleIfArray(): void
    {
        $langs = [
            'en_US',
            'en',
        ];

        $result = $this->controller->extractLocale($langs);

        $expected = 'en_US.UTF-8';

        $this->assertEquals($expected, $result);
    }

    /**
     * @covers \Phansible\Controller\BundleController::indexAction
     * @covers \Phansible\Controller\BundleController::getVagrantBundle
     * @covers \Phansible\Controller\BundleController::setVagrantBundle
     * @covers \Phansible\Controller\BundleController::getInventory
     */
    public function testShouldResponseWithErrorMessage(): void
    {
        $data = [
            'vagrant_local' => [
                'vm' => [
                    'ip' => '',
                ],
            ],
        ];

        $request = new Request([], $data);

        $roles = $this->createMock(RoleManager::class);

        $app = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['offsetGet'])
            ->getMock();

        $app->expects($this->once())
            ->method('offsetGet')
            ->with('roles')
            ->willReturn($roles);

        $bundle = $this->getMockBuilder(VagrantBundle::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['generateBundle'])
            ->getMock();

        $bundle->expects($this->once())
            ->method('generateBundle')
            ->willReturn(false);

        $this->controller->setVagrantBundle($bundle);
        $response = $this->controller->indexAction($request, $app);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('An error occurred.', $response->getContent());
    }
}
