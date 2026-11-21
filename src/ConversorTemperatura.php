<?php

declare(strict_types=1);

namespace ConversorUnidades;

final class ConversorTemperatura
{
    private const UNIDADES_VALIDAS = ['c', 'f', 'k'];

    public static function converter(float $valor, string $de, string $para): float
    {
        $de = strtolower($de);
        $para = strtolower($para);

        if (!in_array($de, self::UNIDADES_VALIDAS, true)) {
            throw new \InvalidArgumentException("Unidade de origem desconhecida: {$de}");
        }
        if (!in_array($para, self::UNIDADES_VALIDAS, true)) {
            throw new \InvalidArgumentException("Unidade de destino desconhecida: {$para}");
        }

        $celsius = self::paraCelsius($valor, $de);

        return self::deCelsius($celsius, $para);
    }

    private static function paraCelsius(float $valor, string $unidade): float
    {
        return match ($unidade) {
            'c' => $valor,
            'f' => ($valor - 32) * 5 / 9,
            'k' => $valor - 273.15,
        };
    }

    private static function deCelsius(float $celsius, string $unidade): float
    {
        return match ($unidade) {
            'c' => $celsius,
            'f' => $celsius * 9 / 5 + 32,
            'k' => $celsius + 273.15,
        };
    }
}
