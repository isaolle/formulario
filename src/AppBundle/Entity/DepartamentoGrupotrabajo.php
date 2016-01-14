<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DepartamentoGrupotrabajo
 *
 * @ORM\Table(name="departamento_grupotrabajo", uniqueConstraints={@ORM\UniqueConstraint(name="idDepartamento", columns={"idDepartamento", "idGrupoTrabajo"})})
 * @ORM\Entity
 */
class DepartamentoGrupotrabajo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDepartamento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $iddepartamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idGrupoTrabajo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idgrupotrabajo;



    /**
     * Set iddepartamento
     *
     * @param integer $iddepartamento
     *
     * @return DepartamentoGrupotrabajo
     */
    public function setIddepartamento($iddepartamento)
    {
        $this->iddepartamento = $iddepartamento;

        return $this;
    }

    /**
     * Get iddepartamento
     *
     * @return integer
     */
    public function getIddepartamento()
    {
        return $this->iddepartamento;
    }

    /**
     * Set idgrupotrabajo
     *
     * @param integer $idgrupotrabajo
     *
     * @return DepartamentoGrupotrabajo
     */
    public function setIdgrupotrabajo($idgrupotrabajo)
    {
        $this->idgrupotrabajo = $idgrupotrabajo;

        return $this;
    }

    /**
     * Get idgrupotrabajo
     *
     * @return integer
     */
    public function getIdgrupotrabajo()
    {
        return $this->idgrupotrabajo;
    }
}
