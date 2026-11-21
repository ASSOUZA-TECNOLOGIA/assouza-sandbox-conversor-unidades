# assouza-sandbox-conversor-unidades

Projeto piloto **descartável** criado como teste operacional da equipe de
agentes da Assouza Tecnologia ([ASS-106](https://app.paperclip.ing)).

Não tem relação com o sistema de Controle de Estoque em produção
(`AislanSouza35/assouza-estoque`) nem com qualquer ambiente real.

## O que é

Uma biblioteca PHP simples para conversão de unidades:

- Comprimento: km, m, cm
- Peso: kg, g
- Temperatura: Celsius, Fahrenheit, Kelvin

Sem interface web — uso via API de classes/funções (ver `src/`).

## Requisitos

- PHP 8.1+
- Composer

## Instalação

```bash
composer install
```

## Uso

```php
require 'vendor/autoload.php';

use ConversorUnidades\ConversorComprimento;
use ConversorUnidades\ConversorPeso;
use ConversorUnidades\ConversorTemperatura;

ConversorComprimento::converter(1.5, 'km', 'm'); // 1500.0
ConversorPeso::converter(2, 'kg', 'g');           // 2000.0
ConversorTemperatura::converter(0, 'C', 'F');     // 32.0
```

## Testes

```bash
composer test
# ou
vendor/bin/phpunit
```
