<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
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
    public function index(
        ChartBuilderInterface $chartBuilder,
        YearRepository $yearRepository,
        PopulationStationRepository $popStationRepository,
        CompletedResidencesRepository $compResRepository,
        ResidenceStationRepository $resStationRepository
    ): Response {
        $title = "Hållbar utveckling";


        $years = [];
        foreach ($yearRepository->findAll() as $yearObject) {
            $years[] = $yearObject->getId();
        }

        // Competed resideces multiple recidence houses

        $completedResidences = $compResRepository->findBy(['type' => 'flerbostadshus']);

        // Competed resideces small houses

        $compResSmall = $compResRepository->findBy(['type' => 'småhus']);

        // Population and distance to station (Urban area)

        $popStationUrban = $popStationRepository->findBy(['urban' => 'inom tätort']);

        // Population and distence to station non-urban

        $popStationNonUrban = $popStationRepository->findBy(['urban' => 'utanför tätort']);

        $resStationNew = $resStationRepository->findBy(['stock' => 'nytillkomna bostäder']);

        $resStationAll = $resStationRepository->findBy(['stock' => 'samtliga bostäder']);

        // ['label' => 'Cookies eaten 🍪', 'data' => $years],
        // ['label' => 'Km walked 🏃‍♀️', 'data' => [10, 15, 4, 3, 25, 41, 25]],

        return $this->render('proj/index.html.twig', [
            'title' => $title,
            'completedResidences' => $completedResidences,
            'completedResidencesSmall' => $compResSmall,
            'popStationUrban' => $popStationUrban,
            'popStationNonUrban' => $popStationNonUrban,
            'resStationNew' => $resStationNew,
            'resStationAll' => $resStationAll,
            'chartBuilder' => $chartBuilder,
            'years' => $years,

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
    ): ?Year {
        $entityManager = $doctrine->getManager();
        // check exists
        $yearObject = $doctrine->getRepository(Year::class)->find(intval($year));
        if ($yearObject) {
            return $yearObject;
        }
        $newYear = new Year();
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
    ): ?Region {
        $entityManager = $doctrine->getManager();
        // check exists
        $regionObject = $doctrine->getRepository(Region::class)->findOneBy(['name' => $region]);
        if ($regionObject) {
            return $regionObject;
        }
        $newRegion = new Region();
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
     * @param ManagerRegistry $doctrine
     * @return void
     */
    public function resetCompletedResidences(
        ManagerRegistry $doctrine
    ): void {
        $entityManager = $doctrine->getManager();

        $filename = "csv/fardigstallda-lagenheter.csv";

        $batchSize = 20;
        $index = 1;
        $handle = fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096, ";")) !== false) {
                $data = new CompletedResidences();
                // region;type;year;amount
                if ($index == 1) {
                    $index++;
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
                if (($index % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear(); // Detaches all objects from Doctrine!
                }
                $index++;
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
     * @param ManagerRegistry $doctrine
     * @return void
     */
    public function resetPopulationStation(
        ManagerRegistry $doctrine
    ): void {
        $entityManager = $doctrine->getManager();

        $filename = "csv/befolkning-hallplats.csv";

        $batchSize = 20;
        $index = 1;
        $handle = fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096, ";")) !== false) {
                $data = new PopulationStation();
                // region;distance;urban;year;amount
                if ($index == 1) {
                    $index++;
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
                if (($index % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear(); // Detaches all objects from Doctrine!
                }
                $index++;
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
     * @param ManagerRegistry $doctrine
     * @return void
     */
    public function resetResidenceStation(
        ManagerRegistry $doctrine
    ): void {
        $entityManager = $doctrine->getManager();

        $filename = "csv/kollektivnara-bostader.csv";

        $batchSize = 20;
        $index = 1;
        $handle = fopen($filename, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096, ";")) !== false) {
                $data = new ResidenceStation();
                // region;distance;stock;year;amount
                if ($index == 1) {
                    $index++;
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
                if (($index % $batchSize) === 0) {
                    $entityManager->flush();
                    $entityManager->clear(); // Detaches all objects from Doctrine!
                }
                $index++;
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
    *
    * @param ManagerRegistry $doctrine
    * @return Response
    *
    */
    public function reset(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        // Delete from DB Completed Residences
        /* @phpstan-ignore-next-line */
        $qCR = $entityManager->createQuery('delete from App\Entity\CompletedResidences');
        $qCR->execute();
        unset($qCR);

        // Delete from DB Population Station
        /* @phpstan-ignore-next-line */
        $qPS = $entityManager->createQuery('delete from App\Entity\PopulationStation');
        $qPS->execute();
        unset($qPS);

        // Delete from DB Residence Station
        /* @phpstan-ignore-next-line */
        $qRS = $entityManager->createQuery('delete from App\Entity\ResidenceStation');
        $qRS->execute();
        unset($qRS);

        /* @phpstan-ignore-next-line */
        $qYear = $entityManager->createQuery('delete from App\Entity\Year');
        $qYear->execute();
        unset($qYear);

        /* @phpstan-ignore-next-line */
        $qRegion = $entityManager->createQuery('delete from App\Entity\Region');
        $qRegion->execute();
        unset($qRegion);

        /* @phpstan-ignore-next-line */
        $connection = $entityManager->getConnection();
        $stm = 'UPDATE sqlite_sequence
                SET seq = 1;';
        $connection->exec($stm);
        unset($entityManager);
        $this->resetCompletedResidences($doctrine);
        $this->resetPopulationStation($doctrine);
        $this->resetResidenceStation($doctrine);
        return $this->redirectToRoute('proj about');
    }
}
