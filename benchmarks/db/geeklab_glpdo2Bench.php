<?php
// vendor\bin\phpbench run benchmarks\db\geeklab_glpdo2Bench.php --report=aggregate

/**
 * @Revs(10)
 * @Iterations(10)
 * @BeforeMethods({"init"})
 * @AfterMethods({"done"});
 */
class geeklab_glpdo2bench
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var \GeekLab\GLPDO2\GLPDO2
     */
    private $db;

    /**
     * @var string
     */
    private $output;

    public function init()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=employees', 'root', '');
        $this->db  = new GeekLab\GLPDO2\GLPDO2($this->pdo);
    }

    public function benchQuery()
    {
        $this->output    = '';
        $Statement = new GeekLab\GLPDO2\Statement();

        $Statement->sql('SELECT *')
                  ->sql('FROM   `employees`')
                  ->sql('LIMIT 500;');

        // kKey set to emp_no, so the array will be indexed with the employee id (number) instead.
        $employees = $this->db->selectRows($Statement, 'emp_no');

        $Statement->reset()
                  ->sql('SELECT `emp_no`,')
                  ->sql('       `salary`')
                  ->sql('FROM   `salaries`')
                  ->sql('WHERE  `emp_no` IN (%%);')->bIntArray(array_keys($employees));

        $salaries = $this->db->selectRows($Statement);

        foreach ($salaries as $salary)
        {
            $employees[$salary['emp_no']]['salaries'][] = $salary['salary'];
        }

        // Clear out some memory.
        unset($salaries);

        $Statement->reset()
                  ->sql('SELECT e.`emp_no`,')
                  ->sql('       `dept_name`')
                  ->sql('FROM   `departments` dd')
                  ->sql('  INNER JOIN `dept_emp` d')
                  ->sql('    ON dd.dept_no = d.dept_no')
                  ->sql('  INNER JOIN `employees` e')
                  ->sql('    ON d.emp_no = e.emp_no')
                  ->sql('WHERE  e.emp_no IN (%%);')->bIntArray(array_keys($employees));

        $departments = $this->db->selectRows($Statement);

        foreach($departments as $department)
        {
            $employees[$department['emp_no']]['departments'][] = $department['dept_name'];
        }

        // Clear out some memory.
        unset($departments);

        foreach($employees as $employee)
        {

            $this->output .= sprintf('%s %s (%d):', $employee['first_name'], $employee['last_name'], $employee['emp_no']) . PHP_EOL;
            $this->output .= "\tSalaries:" . PHP_EOL;

            foreach($employee['salaries'] as $salary)
            {
                $this->output .= "\t\t" . $salary . PHP_EOL;
            }

            $this->output .= "\tDepartments:" . PHP_EOL;

            foreach($employee['departments'] as $department)
            {
                $this->output .= "\t\t" . $department . PHP_EOL;
            }
        }
    }

    public function done()
    {
        $fp = fopen('benchmarks/db/GLPDO2Output.txt', 'w');
        fwrite($fp, $this->output);
        fclose($fp);
    }
}