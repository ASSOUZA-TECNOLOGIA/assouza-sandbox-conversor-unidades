<?php

declare(strict_types=1);

namespace ConversorUnidades\Tests;

use ConversorUnidades\ConversorTemperatura;
use PHPUnit\Framework\TestCase;

final class ConversorTemperaturaTest extends TestCase
{
    public function testCelsiusParaFahrenheit(): void
    {
        $this->assertSame(32.0, ConversorTemperatura::converter(0, 'C', 'F'));
        $this->assertSame(212.0, ConversorTemperatura::converter(100, 'C', 'F'));
    }

    public function testFahrenheitParaCelsius(): void
    {
        $this->assertEqualsWithDelta(0.0, ConversorTemperatura::converter(32, 'F', 'C'), 1e-9);
    }

    public function testCelsiusParaKelvin(): void
    {
        $this->assertSame(273.15, ConversorTemperatura::converter(0, 'C', 'K'));
    }

    public function testKelvinParaCelsius(): void
    {
        $this->assertEqualsWithDelta(0.0, ConversorTemperatura::converter(273.15, 'K', 'C'), 1e-9);
    }

    public function testMesmaUnidadeRetornaValorOriginal(): void
    {
        $this->assertSame(36.5, ConversorTemperatura::converter(36.5, 'C', 'C'));
    }

    public function testTemperaturaNegativa(): void
    {
        $this->assertEqualsWithDelta(-17.7778, ConversorTemperatura::converter(0, 'F', 'C'), 1e-4);
    }

    public function testZeroAbsolutoKelvinParaCelsius(): void
    {
        $this->assertEqualsWithDelta(-273.15, ConversorTemperatura::converter(0, 'K', 'C'), 1e-9);
    }

    public function testConversaoInversaConsistente(): void
    {
        $original = 23.4;
        $ida = ConversorTemperatura::converter($original, 'C', 'F');
        $volta = ConversorTemperatura::converter($ida, 'F', 'C');

        $this->assertEqualsWithDelta($original, $volta, 1e-9);
    }

    public function testUnidadeOrigemInvalidaLancaExcecao(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ConversorTemperatura::converter(1, 'R', 'C');
    }

    public function testUnidadeDestinoInvalidaLancaExcecao(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ConversorTemperatura::converter(1, 'C', 'R');
    }

    public function testUnidadeAceitaCaixaMista(): void
    {
        $this->assertSame(32.0, ConversorTemperatura::converter(0, 'c', 'f'));
    }
}
