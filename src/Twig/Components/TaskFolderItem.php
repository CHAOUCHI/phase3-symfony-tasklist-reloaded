<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class TaskFolderItem
{
    public string $color = "bg-green-500";
    public string $name = "FolderName";
    public int $tasksCount = 0;
}
