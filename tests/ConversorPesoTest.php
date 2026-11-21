<?php

declare(strict_types=1);

namespace ConversorUnidades\Tests;

use ConversorUnidades\ConversorPeso;
use PHPUnit\Framework\TestCase;

final class ConversorPesoTest extends TestCase
{
    public function testKgParaG(): void
    {
        $this->assertSame(2000.0, ConversorPeso::converter(2, 'kg', 'g'));
    }

    public function testGParaKg(): void
    {
        $this->assertSame(0.5, ConversorPeso::converter(500, 'g', 'kg'));
    }

    public function testMesmaUnidadeRetornaValorOriginal(): void
    {
        $this->assertSame(10.0, ConversorPeso::converter(10, 'kg', 'kg'));
    }

    public function testZero(): void
    {
        $this->assertSame(0.0, ConversorPeso::converter(0, 'kg', 'g'));
    }

    public function testValorNegativo(): void
    {
        $this->assertSame(-2000.0, ConversorPeso::converter(-2, 'kg', 'g'));
    }

    public function testConversaoInversaConsistente(): void
    {
        $original = 3.4;
        $ida = ConversorPeso::converter($original, 'kg', 'g');
        $volta = ConversorPeso::converter($ida, 'g', 'kg');

        $this->assertEqualsWithDelta($original, $volta, 1e-9);
    }

    public function testUnidadeOrigemInvalidaLancaExcecao(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ConversorPeso::converter(1, 'lb', 'kg');
    }

    public function testUnidadeDestinoInvalidaLancaExcecao(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ConversorPeso::converter(1, 'kg', 'lb');
    }

    public function testUnidadeAceitaCaixaMista(): void
    {
        $this->assertSame(1000.0, ConversorPeso::converter(1, 'KG', 'G'));
    }
}
