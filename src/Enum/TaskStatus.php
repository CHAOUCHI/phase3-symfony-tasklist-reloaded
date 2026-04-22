<?php

namespace App\Enum;

enum TaskStatus: string {
    case URGENT   = 'urgent';
    case IMPORTANT = 'important';
    case NORMAL  = 'normal';
}