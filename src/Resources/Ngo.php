<?php

declare(strict_types=1);

namespace Anaf\Resources;

use Anaf\Exceptions\TaxIdentificationNumberNotFoundException;
use Anaf\Exceptions\TransporterException;
use Anaf\Exceptions\UnserializableResponse;
use Anaf\Responses\Ngo\GetResponse;
use Anaf\ValueObjects\Transporter\Payload;

final class Ngo
{
    use Concerns\Transportable;

    /**
     * Get public info about the given tax identification number if are registered in the Register of religious entities/units
     *
     * @see https://static.anaf.ro/static/10/Anaf/Informatii_R/index_cult_v2.html
     * @return array<int, GetResponse>
     * @throws TaxIdentificationNumberNotFoundException
     * @throws TransporterException
     * @throws UnserializableResponse
     */
    public function get(): array
    {
        $payload = Payload::create('RegCult/api/v2/ws/cult', $this->getParameters());

        /**
         * @var array{cod: int, message: string, found: array<int, array{cui: int, data: string, denumire: string, adresa: string, nrRegCom: string, telefon: string, fax: string, codPostal: string, act: string, stare_inregistrare: string, dataInceputRegCult: string, dataAnulareRegCult: string, statusRegCult: bool}>, notFound: array<int,string>} $result
         */
        $result = $this->transporter->requestObject($payload);

        $response = [];

        foreach ($result['found'] as $found) {
            $response[] = GetResponse::from($found);
        }

        return $response;
    }
}
