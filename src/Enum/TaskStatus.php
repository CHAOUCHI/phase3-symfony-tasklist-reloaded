<?php
namespace App\Enum;

enum TaskStatus: string
{
    case pending = 'pending';
    case completed = 'completed';
    case archived = 'archived';
}