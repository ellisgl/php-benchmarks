<?php

namespace Acme\doctrine\entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="titles")
 * @property-read Employee $employee
 * @property-read string $name
 */
class Title
{
	/**
	 * @Id
	 * @ManyToOne(targetEntity="Employee", inversedBy="titles")
	 * @JoinColumn(name="emp_no", referencedColumnName="emp_no", nullable=false)
	 * @var Employee
	 */
	protected $employee;

	/**
	 * @Id
	 * @Column(type="string", name="title")
	 * @var string
	 */
	protected $name;
	/**
	 * @Id
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
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
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
