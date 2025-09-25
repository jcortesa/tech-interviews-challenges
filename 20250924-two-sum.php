<?php

// # Code challenge
// Interview done on 2025-09-24
// 
// Given an array of integers nums and an integer target, return 
// the two numbers such that they add up to target.


// vvvv Write your solution here vvvv

/**
 * Find two sum using brute force
 * 
 * Time Complexity: O(n^2)
 * Space Complexity: O(1)
 * 
 * Steps:
 *   - loop over array for number1
 *   - inside first loop, loop over same array for number2
 *   - for each pair of numbers, check if its sum equals target
 */

function twoSumBruteForce(array $numbers, int $target): array {
    for ($i = 0; $i < count($numbers); $i++) {
        for ($j = 0; $j < count($numbers); $j++) {
            if ($i === $j) {
                continue;
            }

            if ($target === $numbers[$i] + $numbers[$j]) {
                return [$numbers[$i], $numbers[$j]];
            }
        }
    }

    return [];
}

assert([1,2] === twoSumBruteForce ([1,2,3,4,5,6], 3));

