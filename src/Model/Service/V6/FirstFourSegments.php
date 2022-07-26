<?php
namespace MonthlyBasis\IpAddress\Model\Service\V6;

class FirstFourSegments
{
    public function getFirstFourSegments(string $ipAddress)
    {
        $segments = explode(':', $ipAddress);
        $firstFourSegments = array_slice($segments, 0, 4);
        return implode(':', $firstFourSegments);
    }
}
