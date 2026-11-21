<?php

declare(strict_types=1);

namespace ConversorUnidades;

final class ConversorComprimento
{
    /** Fator de cada unidade em relacao ao metro (unidade canonica). */
    private const FATORES_METRO = [
        'km' => 1000.0,
        'm' => 1.0,
        'cm' => 0.01,
    ];

    public static function converter(float $valor, string $de, string $para): float
    {
        $de = strtolower($de);
        $para = strtolower($para);

        if (!isset(self::FATORES_METRO[$de])) {
            throw new \InvalidArgumentException("Unidade de origem desconhecida: {$de}");
        }
        if (!isset(self::FATORES_METRO[$para])) {
            throw new \InvalidArgumentException("Unidade de destino desconhecida: {$para}");
        }

        $metros = $valor * self::FATORES_METRO[$de];

        return $metros / self::FATORES_METRO[$para];
    }
}
