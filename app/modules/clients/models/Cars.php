<?php
namespace App\Clients\Models;

class Cars extends \App\Models\BaseModel
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $iCarId;

    /**
     * @Column(type="string", length=10, nullable=false)
     */
    public $iClientId;

    /**
     * @Column(type="string", length=30, nullable=false)
     */
    public $sDesc;

    /**
     * @Column(type="string", length=10, nullable=false)
     */
    public $sPlate;    
}
