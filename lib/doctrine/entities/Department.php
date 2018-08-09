<?php

namespace Acme\doctrine\entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="departments")
 */
class Department
{
    /**
     * @Column(name="dept_no")
     * @Id
     * @var string
     */
    protected $number;
    /**
     * @Column(name="dept_name")
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}