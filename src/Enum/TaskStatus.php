<?php

namespace App\Enum;

enum TaskStatus: string {
    case urgent   = 'urgent';
    case important = 'important';
    case normal  = 'normal';
}