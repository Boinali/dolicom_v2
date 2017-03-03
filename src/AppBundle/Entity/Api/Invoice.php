<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 23/02/2017
 * Time: 11:45
 */

namespace AppBundle\Entity\Api;
use Symfony\Component\Validator\Constraints as Assert;

class Invoice
{
    protected $id_client;
    protected $total_ttc;
    protected $facture_name;
    protected $status;

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getTotalTtc()
    {
        return $this->total_ttc;
    }

    /**
     * @param mixed $total_ttc
     */
    public function setTotalTtc($total_ttc)
    {
        $this->total_ttc = $total_ttc;
    }

    /**
     * @return mixed
     */
    public function getFactureName()
    {
        return $this->facture_name;
    }

    /**
     * @param mixed $facture_name
     */
    public function setFactureName($facture_name)
    {
        $this->facture_name = $facture_name;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}