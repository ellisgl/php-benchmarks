<?php

namespace Acme\doctrine\entities;

/**
 * @Entity @Table(name="dept_manager")
 */
class DepartmentManager
{
    /**
     * @Id
     * @ManyToOne(targetEntity="Employee", inversedBy="managedDepartments")
     * @JoinColumn(name="emp_no", referencedColumnName="emp_no", nullable=false)
     */
    protected $employee;

    /**
     * @Id
     * @ManyToOne(targetEntity="Department")
     * @JoinColumn(name="dept_no", referencedColumnName="dept_no", nullable=false)
     */
    protected $department;

    /**
     * @Column(type="date", name="from_date")
     * @var \DateTime
     */
    protected $fromDate;

    /**
     * @ORM\Column(type="date", name="to_date")
     * @var \DateTime
     */
    protected $toDate;

    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
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
