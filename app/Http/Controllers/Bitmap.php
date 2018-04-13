<?php

class Bitmap {

    /**
     * toBitArray(int,int):int[]
     * Converts a bitmap integer to an integer array as the binary representation of the bitmap.
     * @param int $bitmap
     * @param int $size
     * @return int[] $bits
     */
    public function toBitArray($bitmap, int $size) {
        $bits = []; // Binary representation of bitmap
        while (0 < $bitmap) {
            $bits[] = $bitmap % 2;
            $bitmap = (int)($bitmap / 2);
        }
        $len = sizeof($bits);
        for ($i = 0; $i < $len / 2; $i++)
        {
            $temp = $bits[$i];
            $bits[$i] = $bits[$len - $i];
            $bits[$len - $i] = $temp;
        }
        while ($len < $size) {
            array_unshift($bits, 0);    // Push 0 to the front of the array
            $len++;
        }
        while ($size < $len) {
            array_shift($bits);         // Pop the front of the array
            $len--;
        }
        return $bits;
    }

    public function stringToIntArray(string $value) {
        $arr = str_split($value);
        foreach ($arr as $a)
            $a = (int)$a;
        return $arr;
    }
}

$bitmap = "1010";
$bitmap = Bitmap::stringToIntArray($bitmap);
print("\n");
foreach ($bitmap as $bit)
    print($bit);
$bits = Bitmap::toBitArray(69, 8);
print("\n");
foreach ($bits as $bit)
    print($bit);
