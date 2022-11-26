<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;
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


class ProjController extends AbstractController
{
    /**
    * @Route("/proj",
    *      name="proj index",
    *      methods={"GET"})
    */
    public function index(ChartBuilderInterface $chartBuilder,
    YearRepository $yearRepository,
    RegionRepository $regionRepository,
    PopulationStationRepository $populationStationRepository,
    CompletedResidencesRepository $completedResidencesRepository,
    ResidenceStationRepository $residenceStationRepository): Response
    {
        $title = "Hållbar utveckling";


        $years = [];
        foreach ($yearRepository->findAll() as $yearObject) {
            $years[] = $yearObject->getId();
        }

        // One per region
        $colors = ['#004B23', '#03045E', '#590D22', '#800F2F', '#A4133C',
         '#C9184A', '#FF4D6D', '#FF758F', '#FF8FA3', '#023E8A', '#0077B6', 
         '#0096C7', '#00B4D8', '#48CAE4', '#ADE8F4', '#006400', '#007200', '#008000', '#38B000', '#70E000', '#9EF01A'];
        
        // Competed resideces multiple recidence houses
        $compResMultichart = $chartBuilder->createChart(Chart::TYPE_LINE);
        
        $completedResidences = $completedResidencesRepository->findBy(['type' => 'flerbostadshus']);
        $datasetsCRMulti = [];
        $crMultiLabelData = [];
        foreach ($completedResidences as $crObject) {
            // Create an array with region => amount[]
            $crMultiLabelData[$crObject->getRegion()->getName()][] = $crObject->getAmount();
        }
        $colorIndex = 0;
        foreach ($crMultiLabelData as $name => $data) {
            $datasetsCRMulti[] = ['label' => $name, 'data' => $data, 'borderColor' => $colors[$colorIndex]];
            $colorIndex++;
        }
        $compResMultichart->setData([
            'labels' => $years,
            'datasets' => $datasetsCRMulti,
        ]);

        $compResMultichart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        // Competed resideces small houses
        $compResSmallchart = $chartBuilder->createChart(Chart::TYPE_LINE);
        
        $completedResidencesSmall = $completedResidencesRepository->findBy(['type' => 'småhus']);
        $datasetsCRSmall = [];
        $crSmallLabelData = [];
        foreach ($completedResidencesSmall as $crObject) {
            // Create an array with region => amount[]
            $crSmallLabelData[$crObject->getRegion()->getName()][] = $crObject->getAmount();
        }
        $colorIndex = 0;
        foreach ($crSmallLabelData as $name => $data) {
            $datasetsCRSmall[] = ['label' => $name, 'data' => $data, 'borderColor' => $colors[$colorIndex]];
            $colorIndex++;
        }
        $compResSmallchart->setData([
            'labels' => $years,
            'datasets' => $datasetsCRSmall,
        ]);

        $compResSmallchart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        $colors = ['#15616d', '#001524', '#ff7d00', '#78290f'];
        // Population and distance to station (Urban area)
        $popStationUrbanChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        
        $completedResidencesSmall = $populationStationRepository->findBy(['urban' => 'inom tätort']);
        $datasetsPSurban = [];
        $psUrbanDataRegion = [];
        // Stack year
        // Dataset meters
        // Labels region
        foreach ($completedResidencesSmall as $psObject) {
            $psUrbanDataRegion[$psObject->getRegion()->getName()][$psObject->getYear()->getId()][$psObject->getDistance()] = $psObject->getAmount();
        }
        $regions = [];
        $psUrbanData = [];
        foreach ($psUrbanDataRegion as $name => $data) {
            $regions[] = $name;
            foreach ($data as $year => $data) {
                $prevPop = 0;
                foreach ($data as $meters => $population) {
                    $psUrbanData[$meters . 'm'][$year][] = $population - $prevPop;
                    $prevPop = $population;
                }
            }
        }
        $colorIndex = 0;
        $datasetsPSurban = [];
        foreach ($psUrbanData as $meters => $data) {
            foreach ($data as $year => $data) {
                $datasetsPSurban[] = ['label' => $meters . ' ' . $year, 'data' => $data, 'stack' => $year, 'backgroundColor' => $colors[$colorIndex]];
            }
            $colorIndex++;
        }
        $popStationUrbanChart->setData([
            'labels' => $regions,
            'datasets' => $datasetsPSurban,
        ]);

        $popStationUrbanChart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        // Population and distence to station non-urban
        $popStationNonUrbanChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        
        $completedResidencesSmall = $populationStationRepository->findBy(['urban' => 'utanför tätort']);
        $datasetsPSurban = [];
        $psUrbanDataRegion = [];
        // Stack year
        // Dataset meters
        // Labels region
        foreach ($completedResidencesSmall as $psObject) {
            $psUrbanDataRegion[$psObject->getRegion()->getName()][$psObject->getYear()->getId()][$psObject->getDistance()] = $psObject->getAmount();
        }
        $regions = [];
        $psUrbanData = [];
        foreach ($psUrbanDataRegion as $name => $data) {
            $regions[] = $name;
            foreach ($data as $year => $data) {
                $prevPop = 0;
                foreach ($data as $meters => $population) {
                    $psUrbanData[$meters . 'm'][$year][] = $population - $prevPop;
                    $prevPop = $population;
                }
            }
        }
        $colorIndex = 0;
        $datasetsPSurban = [];
        foreach ($psUrbanData as $meters => $data) {
            foreach ($data as $year => $data) {
                $datasetsPSurban[] = ['label' => $meters . ' ' . $year, 'data' => $data, 'stack' => $year, 'backgroundColor' => $colors[$colorIndex]];
            }
            $colorIndex++;
        }
        $popStationNonUrbanChart->setData([
            'labels' => $regions,
            'datasets' => $datasetsPSurban,
        ]);

        $popStationNonUrbanChart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        // Residences and distance to station newly built
        $resStationNewChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        
        $completedResidencesSmall = $residenceStationRepository->findBy(['stock' => 'nytillkomna bostäder']);
        $datasetsPSurban = [];
        $psUrbanDataRegion = [];
        // Stack year
        // Dataset meters
        // Labels region
        foreach ($completedResidencesSmall as $psObject) {
            $psUrbanDataRegion[$psObject->getRegion()->getName()][$psObject->getYear()->getId()][$psObject->getDistance()] = $psObject->getAmount();
        }
        $regions = [];
        $psUrbanData = [];
        foreach ($psUrbanDataRegion as $name => $data) {
            $regions[] = $name;
            foreach ($data as $year => $data) {
                $prevPop = 0;
                foreach ($data as $meters => $population) {
                    $psUrbanData[$meters . 'm'][$year][] = $population - $prevPop;
                    $prevPop = $population;
                }
            }
        }
        $colorIndex = 0;
        $datasetsPSurban = [];
        foreach ($psUrbanData as $meters => $data) {
            foreach ($data as $year => $data) {
                $datasetsPSurban[] = ['label' => $meters . ' ' . $year, 'data' => $data, 'stack' => $year, 'backgroundColor' => $colors[$colorIndex]];
            }
            $colorIndex++;
        }
        $resStationNewChart->setData([
            'labels' => $regions,
            'datasets' => $datasetsPSurban,
        ]);

        $resStationNewChart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        // Residences and distance to station all
        $resStationAllChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        
        $completedResidencesSmall = $residenceStationRepository->findBy(['stock' => 'samtliga bostäder']);
        $datasetsPSurban = [];
        $psUrbanDataRegion = [];
        // Stack year
        // Dataset meters
        // Labels region
        foreach ($completedResidencesSmall as $psObject) {
            $psUrbanDataRegion[$psObject->getRegion()->getName()][$psObject->getYear()->getId()][$psObject->getDistance()] = $psObject->getAmount();
        }
        $regions = [];
        $psUrbanData = [];
        foreach ($psUrbanDataRegion as $name => $data) {
            $regions[] = $name;
            foreach ($data as $year => $data) {
                $prevPop = 0;
                foreach ($data as $meters => $population) {
                    $psUrbanData[$meters . 'm'][$year][] = $population - $prevPop;
                    $prevPop = $population;
                }
            }
        }
        $colorIndex = 0;
        $datasetsPSurban = [];
        foreach ($psUrbanData as $meters => $data) {
            foreach ($data as $year => $data) {
                $datasetsPSurban[] = ['label' => $meters . ' ' . $year, 'data' => $data, 'stack' => $year, 'backgroundColor' => $colors[$colorIndex]];
            }
            $colorIndex++;
        }
        $resStationAllChart->setData([
            'labels' => $regions,
            'datasets' => $datasetsPSurban,
        ]);

        $resStationAllChart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        // ['label' => 'Cookies eaten 🍪', 'data' => $years],
        // ['label' => 'Km walked 🏃‍♀️', 'data' => [10, 15, 4, 3, 25, 41, 25]],

        return $this->render('proj/index.html.twig', [
            'title' => $title,
            'compResMultiChart' => $compResMultichart,
            'compResSmallChart' => $compResSmallchart,
            'popStationUrbanChart' => $popStationUrbanChart,
            'popStationNonUrbanChart' => $popStationNonUrbanChart,
            'resStationNewChart' => $resStationNewChart,
            'resStationAllChart' => $resStationAllChart,
        ]);
        // return $this->json($psUrbanData);
    }

    /**
    * @Route("/proj/about",
    *      name="proj about",
    *      methods={"GET"})
    */
    public function about(): Response
    {
        $title = "About proj";
        return $this->render('proj/about.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * Get Year object for table
     * and create if it does not exist
     *
     * @param string $year
     * @param ManagerRegistry $doctrine
     * @return Year
     */
    public function getYear(
        string $year,
        ManagerRegistry $doctrine
        ): Year
    {
        $entityManager = $doctrine->getManager();
        // check exists
        $yearObject = $doctrine->getRepository(Year::class)->find(intval($year));
        if ($yearObject) {
            return $yearObject;
        }
        $newYear = new Year;
        $newYear->setId(intval($year));
        $entityManager->persist($newYear);
        $entityManager->flush();
        // $entityManager->clear();
        $newYearObject = $doctrine->getRepository(Year::class)->find(intval($year));
        return $newYearObject;
    }

    /**
     * Get Region object,
     * creates new if it does not exist
     *
     * @param string $region
     * @param ManagerRegistry $doctrine
     * @return Region
     */
    public function getRegion(
        string $region,
        ManagerRegistry $doctrine
    ): Region
    {
        $entityManager = $doctrine->getManager();
        // check exists
        $regionObject = $doctrine->getRepository(Region::class)->findOneBy(['name' => $region]);
        if ($regionObject) {
            return $regionObject;
        }
        $newRegion = new Region;
        $newRegion->setName($region);
        $entityManager->persist($newRegion);
        $entityManager->flush();
        // $entityManager->clear();
        $newRegionObject = $doctrine->getRepository(Region::class)->findOneBy(['name' => $region]);
        return $newRegionObject;
    }

    /**
     * Function to reset table Completed Residences
     *
     * @param CompletedResidencesRepository $completedResidencesRepository
     * @param ManagerRegistry $doctrine
     * @return void
     */
    public function resetCompletedResidences(
        CompletedResidencesRepository $completedResidencesRepository,
        ManagerRegistry $doctrine
    ): void
    {
        $entityManager = $doctrine->getManager();

        $filename = "csv/fardigstallda-lagenheter.csv";

        // Reset Auto increment
        $connection = $entityManager->getConnection();
        $connection->exec('ALTER TABLE completed_residences AUTO_INCREMENT = 1;');
        unset($connection);

        $batchSize = 20;
        $i = 1;
        $handle = @fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096, ";")) !== false) {
                $data = new CompletedResidences();
                // region;type;year;amount
                if ($i == 1) {
                    $i++;
                    continue;
                }
                $region = $this->getRegion($row[0], $doctrine);
                $type = $row[1];
                $year = $this->getYear($row[2], $doctrine);
                $amount = $row[3];

                $data->setRegion($region);
                $data->setType($type);
                $data->setYear($year);
                $data->setAmount($amount);
                $entityManager->persist($data);
                if (($i % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear(); // Detaches all objects from Doctrine!
                }
                $i++;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        $entityManager->flush(); // Persist objects that did not make up an entire batch
        $entityManager->clear();
    }


    /**
     * Function to reset table Population Station
     *
     * @param PopulationStationRepository $populationStationRepository
     * @param ManagerRegistry $doctrine
     * @return void
     */
    public function resetPopulationStation(
        PopulationStationRepository $populationStationRepository,
        ManagerRegistry $doctrine
    ): void
    {
        $entityManager = $doctrine->getManager();

        $filename = "csv/befolkning-hallplats.csv";

        // Reset Auto increment
        $connection = $entityManager->getConnection();
        $connection->exec('ALTER TABLE population_station AUTO_INCREMENT = 1;');
        unset($connection);

        $batchSize = 20;
        $i = 1;
        $handle = @fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096, ";")) !== false) {
                $data = new PopulationStation();
                // region;distance;urban;year;amount
                if ($i == 1) {
                    $i++;
                    continue;
                }
                $region = $this->getRegion($row[0], $doctrine);
                $distance = intval($row[1]);
                $urban = $row[2];
                $year = $this->getYear($row[3], $doctrine);
                $amount = $row[4];

                $data->setRegion($region);
                $data->setDistance($distance);
                $data->setUrban($urban);
                $data->setYear($year);
                $data->setAmount($amount);
                $entityManager->persist($data);
                if (($i % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear(); // Detaches all objects from Doctrine!
                }
                $i++;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }

        $entityManager->flush(); // Persist objects that did not make up an entire batch
        $entityManager->clear();
    }

    /**
     * Function to reset table Residence station
     *
     * @param ResidenceStationRepository $residenceStationRepository
     * @param ManagerRegistry $doctrine
     * @return void
     */
    public function resetResidenceStation(
        ResidenceStationRepository $residenceStationRepository,
        ManagerRegistry $doctrine
    ): void
    {
        $entityManager = $doctrine->getManager();

        $filename = "csv/kollektivnara-bostader.csv";

        // Reset Auto increment
        $connection = $entityManager->getConnection();
        $connection->exec('ALTER TABLE residence_station AUTO_INCREMENT = 1;');
        unset($connection);

        $batchSize = 20;
        $i = 1;
        $handle = @fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096, ";")) !== false) {
                $data = new ResidenceStation();
                // region;distance;stock;year;amount
                if ($i == 1) {
                    $i++;
                    continue;
                }
                $region = $this->getRegion($row[0], $doctrine);
                $distance = intval($row[1]);
                $stock = $row[2];
                $year = $this->getYear($row[3], $doctrine);
                $amount = $row[4];

                $data->setRegion($region);
                $data->setDistance($distance);
                $data->setStock($stock);
                $data->setYear($year);
                $data->setAmount($amount);
                $entityManager->persist($data);
                if (($i % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear(); // Detaches all objects from Doctrine!
                }
                $i++;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        $entityManager->flush(); // Persist objects that did not make up an entire batch
        $entityManager->clear();
    }

    /**
    * @Route("/proj/reset",
    *      name="proj reset",
    *      methods={"GET"})
    */
    public function reset(
        CompletedResidencesRepository $completedResidencesRepository,
        PopulationStationRepository $populationStationRepository,
        ResidenceStationRepository $residenceStationRepository,
        YearRepository $yearRepository,
        RegionRepository $regionRepository,
        ManagerRegistry $doctrine
    ): Response
    {
        $entityManager = $doctrine->getManager();

        // Delete from DB Completed Residences
        $qCR = $entityManager->createQuery('delete from App\Entity\CompletedResidences');
        $qCR->execute();
        unset($qCR);

        // Delete from DB Population Station
        $qPS = $entityManager->createQuery('delete from App\Entity\PopulationStation');
        $qPS->execute();
        unset($qPS);

        // Delete from DB Residence Station
        $qRS = $entityManager->createQuery('delete from App\Entity\ResidenceStation');
        $qRS->execute();
        unset($qRS);

        $qYear = $entityManager->createQuery('delete from App\Entity\Year');
        $qYear->execute();
        unset($qYear);

        $qRegion = $entityManager->createQuery('delete from App\Entity\Region');
        $qRegion->execute();
        unset($qRegion);

        $connection = $entityManager->getConnection();
        $connection->exec('ALTER TABLE region AUTO_INCREMENT = 1;');
        unset($entityManager);
        $this->resetCompletedResidences($completedResidencesRepository, $doctrine);
        $this->resetPopulationStation($populationStationRepository, $doctrine);
        $this->resetResidenceStation($residenceStationRepository, $doctrine);
        return $this->redirectToRoute('proj about');
    }
}
