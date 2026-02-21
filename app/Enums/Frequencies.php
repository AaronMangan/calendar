<?php

namespace App\Enums;

enum Frequencies: string
{
    case DAILY = 1;
    case EVERY_BUSINESS_DAY = 2;
    case WEEKLY = 3;
    case FORTNIGHTLY = 4;
    case MONTHLY = 5;
    case QUARTERLY = 6;
    case YEARLY = 7; 
}
