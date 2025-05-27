<?php
namespace App\Enums;

enum Role: string
{
    case CLIENTE = 'cliente';
    case CAJERO  = 'cajero';
    case CHEF    = 'chef';
    case GERENTE = 'gerente';
}
