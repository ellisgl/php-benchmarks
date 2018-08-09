<?php

namespace Acme\doctrine\entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="salaries")
 * @property-read \DateTime $fromDate
 * @property-read \DateTime $toDate
 */
class Salary
{
	/**
	 * @Id
	 * @ManyToOne(targetEntity="Employee", inversedBy="salaries")
     * @JoinColumn(name="emp_no", referencedColumnName="emp_no")
	 */
	protected $employee;

	/**
	 * @Column(name="salary", type="integer")
	 * @var int $salary
	 */
	protected $salary;

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
	 * @return int
	 */
	public function getSalary()
	{
		return $this->salary;
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
