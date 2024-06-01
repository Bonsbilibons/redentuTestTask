<?php

namespace App\DTO\Manufacturer;

class CreateManufacturerDTO
{
    /**
     * @var string
     */
    protected $ident;

    /**
     * @param string $ident
     */
    public function __construct(string $ident)
    {
        $this->ident = $ident;
    }

    public function getIdent(): string
    {
        return $this->ident;
    }

    public function setIdent(string $ident): void
    {
        $this->ident = $ident;
    }

    /**
     * @return array[]
     */
    public function getDataAsArray(): array
    {
        return [
            'ident' => $this->ident
        ];
    }
}
