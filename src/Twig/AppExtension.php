<?php
// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

use App\Repository\CompletedResidencesRepository;
use App\Entity\CompletedResidences;
use App\Repository\PopulationStationRepository;
use App\Entity\PopulationStation;
use App\Repository\ResidenceStationRepository;
use App\Entity\ResidenceStation;
use App\Repository\RegionRepository;
use App\Repository\YearRepository;
use App\Entity\Year;
use App\Entity\Region;

class AppExtension extends AbstractExtension
{
    /**
     * Gets Twig functions
     *
     * @return array<TwigFunction>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('getComResChart', [$this, 'getComResChart']),
            new TwigFunction('getStationDistChart', [$this, 'getStationDistChart']),
        ];
    }

    /**
     * Builds line chart for CompletedResidences objects
     *
     * @param array<CompletedResidences> $objects 
     * @param array<Year> $years
     * @param ChartBuilderInterface $chartBuilder
     * @return Chart
     */
    public function getComResChart(array $objects, array $years, ChartBuilderInterface $chartBuilder): Chart
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $colors = ['#004B23', '#03045E', '#590D22', '#800F2F', '#A4133C',
         '#C9184A', '#FF4D6D', '#FF758F', '#FF8FA3', '#023E8A', '#0077B6', 
         '#0096C7', '#00B4D8', '#48CAE4', '#ADE8F4', '#006400', '#007200', '#008000', '#38B000', '#70E000', '#9EF01A'];
        
        // $completedResidences = $completedResidencesRepository->findBy(['type' => 'flerbostadshus']);
        $datasets = [];
        $dataRegion = [];
        foreach ($objects as $crObject) {
            // Create an array with region => amount[]
            $dataRegion[$crObject->getRegion()->getName()][] = $crObject->getAmount();
        }
        $colorIndex = 0;
        foreach ($dataRegion as $name => $data) {
            $datasets[] = ['label' => $name, 'data' => $data, 'borderColor' => $colors[$colorIndex]];
            $colorIndex++;
        }
        $chart->setData([
            'labels' => $years,
            'datasets' => $datasets,
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
        return $chart;
    }

    /**
     * Builds barcharts for population and residence station objects
     *
     * @param array<PopulationStation|ResidenceStation> $objects
     * @param ChartBuilderInterface $chartBuilder
     * @return Chart
     */
    public function getStationDistChart(array $objects, ChartBuilderInterface $chartBuilder): Chart
    {
        // Residences and distance to station newly built
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $colors = ['#15616d', '#001524', '#ff7d00', '#78290f'];
        
        $datasets = [];
        $dataRegion = [];
        // Stack year
        // Dataset meters
        // Labels region
        foreach ($objects as $psObject) {
            $dataRegion[$psObject->getRegion()->getName()][$psObject->getYear()->getId()][$psObject->getDistance()] = $psObject->getAmount();
        }
        $regions = [];
        $dataMeters = [];
        foreach ($dataRegion as $name => $data) {
            $regions[] = $name;
            foreach ($data as $year => $data) {
                $prevPop = 0;
                foreach ($data as $meters => $population) {
                    $dataMeters[$meters . 'm'][$year][] = $population - $prevPop;
                    $prevPop = $population;
                }
            }
        }
        $colorIndex = 0;
        foreach ($dataMeters as $meters => $data) {
            foreach ($data as $year => $data) {
                $datasets[] = ['label' => $meters . ' ' . $year, 'data' => $data, 'stack' => $year, 'backgroundColor' => $colors[$colorIndex]];
            }
            $colorIndex++;
        }
        $chart->setData([
            'labels' => $regions,
            'datasets' => $datasets,
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);
        return $chart;
    }
}