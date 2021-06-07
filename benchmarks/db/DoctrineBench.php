<?php
// vendor\bin\phpbench run benchmarks\db\DoctrineBench.php --report=aggregate
// Stolen from: https://github.com/dg/db-benchmark
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(1)
 * @Iterations(1)
 * @BeforeMethods({"init"})
 * @AfterMethods({"done"});
 */
class DoctrineBench
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $output;

    public function init(): void
    {
        $paths     = array('../../lib/doctrine/entities');
        $isDevMode = true;

        // the connection configuration
        $conn = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'employees',
        );

        $config   = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/../../lib/doctrine/entities'), $isDevMode);
        $this->em = EntityManager::create($conn, $config);
    }

    public function benchQuery(): void
    {
        $employeeRepo = $this->em->getRepository('Acme\doctrine\entities\Employee');
        $employees    = $employeeRepo->findBy([], [], 500);
        $this->output = "";

        foreach ($employees as $emp)
        {
            $this->output .= sprintf('%s %s (%d):', $emp->getFirstName(), $emp->getLastName(), $emp->getId()) . PHP_EOL;
            $this->output .= "\tSalaries:" . PHP_EOL;
            $salaries     = $emp->getSalaries();

            foreach ($salaries as $salary)
            {
                $this->output .= "\t\t" . $salary->getSalary() . PHP_EOL;
            }


            $this->output .= "\tDepartments:" . PHP_EOL;

            foreach ($emp->getAffiliatedDepartments() as $department)
            {
                $this->output .= "\t\t" . $department->getDepartment()->getName() . PHP_EOL;
            }
        }
    }

    public function done(): void
    {
        $fp = fopen('benchmarks/db/DoctrineOutput.txt', 'w');
        fwrite($fp, $this->output);
        fclose($fp);
    }
}
