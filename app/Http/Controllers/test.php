<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 3/5/2018
 * Time: 9:34 PM
 */


for ($i = 0; $i < 100; $i++)
    $A[$i] = rand(0, 10);
foreach ($A as $item)
    print ($item." ");
print("\n");

$change = true;
$start  = 0;
$end    = sizeof($A) - 1;
while ($change) //for ($i = 0; $i < sizeof($A) && $change; $i++)
{
    $change = false;
    for ($j = $start; $j < $end; $j++)
    {
        if ($A[$j + 1] < $A[$j])
        {
            $temp      = $A[$j];
            $A[$j]     = $A[$j + 1];
            $A[$j + 1] = $temp;
            $change    = true;
        }
    }
    $end--;
    for ($j = $end; $start < $j; $j--)
    {
        if ($A[$j] < $A[$j - 1])
        {
            $temp      = $A[$j];
            $A[$j]     = $A[$j - 1];
            $A[$j - 1] = $temp;
            $change    = true;
        }
    }
    $start++;
}
foreach ($A as $item)
    print ($item." ");