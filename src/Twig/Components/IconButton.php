<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class IconButton
{
    public string $faicon = "fa-regular fa-house";
    public string $bgcolor = "bg-[#030213]";
    public string $bordercolor = "border-black/10";
    public string $textcolor = "text-white";
    public string $textcontent = "Toutes les tâches";
}
