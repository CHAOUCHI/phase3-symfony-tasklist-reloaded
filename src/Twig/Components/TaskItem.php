<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Twig\Error\RuntimeError;

#[AsTwigComponent]
final class TaskItem
{

    // twig attributes
    public string $title = "default_title";
    public string $priority = "normal";


    // private attributes
    public string $priorityCss;

    public function getPriorityToCSS(): string
    {
        return match ($this->priority) {
            "urgent" => "bg-[#FFE2E2] text-[#C10007] border-[#FFC9C9]",
            "important" => "bg-[#FFEDD4] text-[#CA3500] border-[#FFD6A8]",
            "normal" => "bg-[#DBEAFE] text-[#1447E6] border-[#BEDBFF]",
            default => "bg-gray-200 text-black border-black/10"
        };
    }
}
