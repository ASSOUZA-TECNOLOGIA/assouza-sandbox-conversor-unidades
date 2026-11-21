<?php

declare(strict_types=1);

namespace ConversorUnidades\Tests;

use ConversorUnidades\ConversorComprimento;
use PHPUnit\Framework\TestCase;

final class ConversorComprimentoTest extends TestCase
{
    public function testKmParaM(): void
    {
        $this->assertSame(1500.0, ConversorComprimento::converter(1.5, 'km', 'm'));
    }

    public function testMParaCm(): void
    {
        $this->assertSame(250.0, ConversorComprimento::converter(2.5, 'm', 'cm'));
    }

    public function testCmParaKm(): void
    {
        $this->assertSame(0.00015, ConversorComprimento::converter(15, 'cm', 'km'));
    }

    public function testMesmaUnidadeRetornaValorOriginal(): void
    {
        $this->assertSame(42.0, ConversorComprimento::converter(42, 'm', 'm'));
    }

    public function testZero(): void
    {
        $this->assertSame(0.0, ConversorComprimento::converter(0, 'km', 'cm'));
    }

    public function testValorNegativo(): void
    {
        $this->assertSame(-1000.0, ConversorComprimento::converter(-1, 'km', 'm'));
    }

    public function testConversaoInversaConsistente(): void
    {
        $original = 7.25;
        $ida = ConversorComprimento::converter($original, 'km', 'cm');
        $volta = ConversorComprimento::converter($ida, 'cm', 'km');

        $this->assertEqualsWithDelta($original, $volta, 1e-9);
    }

    public function testUnidadeOrigemInvalidaLancaExcecao(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ConversorComprimento::converter(1, 'milha', 'm');
    }

    public function testUnidadeDestinoInvalidaLancaExcecao(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ConversorComprimento::converter(1, 'm', 'milha');
    }

    public function testUnidadeAceitaCaixaMista(): void
    {
        $this->assertSame(1000.0, ConversorComprimento::converter(1, 'KM', 'M'));
    }
}
