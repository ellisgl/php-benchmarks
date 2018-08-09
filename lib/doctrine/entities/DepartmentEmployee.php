<?php

namespace Acme\doctrine\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 * @Table(name="dept_emp")
 * @property-read \DateTime $fromDate
 * @property-read \DateTime $toDate
 */
class DepartmentEmployee
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Employee", inversedBy="affiliatedDepartments")
     * @JoinColumn(name="emp_no", referencedColumnName="emp_no", nullable=false)
     * @var Employee
     */
    protected $employee;

    /**
     * @Id
     * @ManyToOne(targetEntity="Department")
     * @JoinColumn(name="dept_no", referencedColumnName="dept_no", nullable=false)
     * @var Department
     */
    protected $department;

    /**
     * @Column(type="date", name="from_date")
     * @var \DateTime
     */
    protected $fromDate;

    /**
     * @Column(type="date", name="to_date")
     * @var \DateTime
     */
    protected $toDate;

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }
}
