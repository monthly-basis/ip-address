<?php
namespace MonthlyBasis\IpAddress\Model\Service\V4;

class FirstThreeQuadrants
{
    public function getFirstThreeQuadrants(string $ipAddress)
    {
        $quadrants = explode('.', $ipAddress);
        $firstThreeQuadrants = array_slice($quadrants, 0, 3);
        return implode('.', $firstThreeQuadrants);
    }
}
