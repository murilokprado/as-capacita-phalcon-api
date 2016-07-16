<?php
namespace App\Clients\Models;

class Clients extends \App\Models\BaseModel
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */	
    public $iClientId;

   	/**
     * @Column(type="string", length=30, nullable=false)
    */
    public $sName;

   	/**
     * @Column(type="string", length=30, nullable=false)
    */

    public $sEmail;
}
