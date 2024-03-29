<?php
namespace MonthlyBasis\IpAddress\Model\Service;

/**
 * @deprecated Use IpAddressService\V4\FirstThreeQuadrants() instead.
 */
class FirstThreeQuadrants
{
    public function getFirstThreeQuadrants(string $ipAddress)
    {
        $quadrants = explode('.', $ipAddress);
        $firstThreeQuadrants = array_slice($quadrants, 0, 3);
        return implode('.', $firstThreeQuadrants);
    }
}
