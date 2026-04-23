<?php

namespace App\Enum;

enum taskStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case ARCHIVED = 'archived';

    // Optionnel : Une méthode pour afficher des noms propres dans ton interface
    public function getLabel(): string
    {
        return match($this) {
            self::PENDING => 'En attente',
            self::COMPLETED => 'Terminée',
            self::ARCHIVED => 'Archivée',
        };
    }
}