<?php

declare(strict_types=1);

namespace ConversorUnidades;

final class ConversorPeso
{
    /** Fator de cada unidade em relacao ao grama (unidade canonica). */
    private const FATORES_GRAMA = [
        'kg' => 1000.0,
        'g' => 1.0,
    ];

    public static function converter(float $valor, string $de, string $para): float
    {
        $de = strtolower($de);
        $para = strtolower($para);

        if (!isset(self::FATORES_GRAMA[$de])) {
            throw new \InvalidArgumentException("Unidade de origem desconhecida: {$de}");
        }
        if (!isset(self::FATORES_GRAMA[$para])) {
            throw new \InvalidArgumentException("Unidade de destino desconhecida: {$para}");
        }

        $gramas = $valor * self::FATORES_GRAMA[$de];

        return $gramas / self::FATORES_GRAMA[$para];
    }
}
