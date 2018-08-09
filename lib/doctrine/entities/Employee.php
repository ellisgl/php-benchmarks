<?php

namespace Acme\doctrine\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="employees")
 * @property-read \DateTime $birthDate
 * @property-read \DateTime $hireDate
 */
class Employee
{
    /**
     * @Id
     * @Column(type="integer", name="emp_no")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="date", name="birth_date")
     * @var \DateTime $birthDate
     */
    protected $birthDate;

    /**
     * @Column(type="string", name="first_name")
     * @var string $firstName
     */
    protected $firstName;

    /**
     * @Column(type="string", name="last_name")
     * @var string $lastName
     */
    protected $lastName;

    /**
     * @Column(type="string", name="gender")
     * @var string $gender
     */
    protected $gender;

    /**
     * @Column(type="date", name="hire_date")
     * @var \DateTime $hireDate
     */
    protected $hireDate;

    /**
     * @OneToMany(targetEntity="Title", mappedBy="employee", fetch="EXTRA_LAZY")
     * @var Collection|Title[] $titles
     */
    protected $titles;

    /**
     * @OneToMany(targetEntity="DepartmentEmployee", mappedBy="employee", fetch="EXTRA_LAZY")
     * @var Collection|DepartmentEmployee[] $affiliatedDepartments
     */
    protected $affiliatedDepartments;

    /**
     * @OneToMany(targetEntity="DepartmentManager", mappedBy="employee", fetch="EXTRA_LAZY")
     * @var Collection|DepartmentManager[] $managedDepartments
     */
    protected $managedDepartments;

    /**
     * @OneToMany(targetEntity="Salary", mappedBy="employee")
     */
    protected $salaries;

    public function __construct()
    {
        $this->titles                = new ArrayCollection();
        $this->affiliatedDepartments = new ArrayCollection();
        $this->managedDepartments    = new ArrayCollection();
        $this->salaries              = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return \DateTime
     */
    public function getHireDate()
    {
        return $this->hireDate;
    }

    /**
     * @return Collection|Title[]
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * @return Collection|DepartmentEmployee[]
     */
    public function getAffiliatedDepartments()
    {
      return $this->affiliatedDepartments;
    }

    /**
     * @return Collection|DepartmentManager[]
     */
    public function getManagedDepartments()
    {
        return $this->managedDepartments;
    }

    /**
     * @return ArrayCollection|Salary[]
     */
    public function getSalaries()
    {
        return $this->salaries;
    }
}
