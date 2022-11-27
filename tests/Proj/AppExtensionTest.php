<?php

declare(strict_types=1);

namespace Test\App\Twig\Extension;

use Twig\Test\IntegrationTestCase;
use App\Twig\AppExtension;
use PHPUnit\Framework\TestCase;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

final class AppExtensionTest extends TestCase
{
    /**
     * Confirms instance of AppExtension is created
     *
     * @return void
     */
    public function testExtension()
    {   
        $extension = new AppExtension();

        $this->assertInstanceOf("App\Twig\AppExtension", $extension);
    }

    /**
     * Confirms getComResChart method returs instance of Chartjs Chart
     *
     * @return void
     */
    public function testGetComResChart()
    {   
        $extension = new AppExtension();
        $chartBuilderInterface = $this->createMock(ChartBuilderInterface::class);

        $chart = $extension->getComResChart([], [], $chartBuilderInterface);

        $this->assertInstanceOf("Symfony\UX\Chartjs\Model\Chart", $chart);
    }

    /**
     * Confirms getStationDistChart method returs instance of Chartjs Chart
     *
     * @return void
     */
    public function testGetStationDistChart()
    {   
        $extension = new AppExtension();
        $chartBuilderInterface = $this->createMock(ChartBuilderInterface::class);
        $chart = $extension->getStationDistChart([], $chartBuilderInterface);

        $this->assertInstanceOf("Symfony\UX\Chartjs\Model\Chart", $chart);
    }
}