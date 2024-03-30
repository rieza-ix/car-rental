<?php
// Define arrays to store the seat capacity and cost of each car size
$seatCapacity = ["small" => 5, "medium" => 10, "large" => 15];
$cost = ["small" => 5000, "medium" => 8000, "large" => 12000];

// Get the seat capacity from the user input
$seat = (int)readline('Please input seat number : ');

// Determine the optimal car size and calculate the optimized cost
determineOptimalSize($seat, $seatCapacity, $cost);

// Determine the optimalSize based on the seat capacity
function determineOptimalSize($seat, $seatCapacity, $cost)
{
    if ($seat <= 0) {
        // Display error if the seat capacity entered is less or equal to 0
        echo 'Please enter a valid number of seats greater than zero.';
    } else if ($seat < $seatCapacity["small"]) {
        // Set the optimalSize if the seat capacity is less than the size of the small car
        $optimalSize = $seatCapacity["small"];
    } else if ($seat % $seatCapacity["large"] === 0) {
        // Set the optimalSize to the seat capacity if it is divisible by the size of the large car
        $optimalSize = $seat;
    } else if ($seat % $seatCapacity["medium"] === 0) {
        // Set the optimalSize to the seat capacity if it is divisible by the size of the medium car
        $optimalSize = $seat;
    } else {
        // Round up the seat capacity to the nearest multiple of the small car size
        $optimalSize = ceil($seat / $seatCapacity["small"]) * $seatCapacity["small"];
    }

    // Pass the optimalSize value to the getOptimizedCost() function to calculate and display the optimized cost
    getOptimizedCost($optimalSize, $seatCapacity, $cost);
}

// Determine the right car size based on the optimalSize
function determineCarSize($optimalSize, $seatCapacity)
{
    // Calculate the count of each car size based on the optimalSize
    $largeCount = floor($optimalSize / $seatCapacity["large"]);
    $optimalSize -= $largeCount * $seatCapacity["large"];

    $mediumCount = floor($optimalSize / $seatCapacity["medium"]);
    $optimalSize -= $mediumCount * $seatCapacity["medium"];

    $smallCount = floor($optimalSize / $seatCapacity["small"]);

    return array($largeCount, $mediumCount, $smallCount);
}

// Calculate the optimized cost and display the chosen car sizes
function getOptimizedCost($optimalSize, $seatCapacity, $cost)
{
    // Get the counts of each car size
    list($largeCount, $mediumCount, $smallCount) = determineCarSize($optimalSize, $seatCapacity);

    // Initialize an empty array to store the chosen car sizes
    $chosenCarSizes = array();

    // Check if the count of each car size is more than 0, and add it to the chosen car sizes array
    if ($largeCount > 0) {
        $chosenCarSizes[] = "L x $largeCount";
    }
    if ($mediumCount > 0) {
        $chosenCarSizes[] = "M x $mediumCount";
    }
    if ($smallCount > 0) {
        $chosenCarSizes[] = "S x $smallCount";
    }

    // Calculate the total cost
    $totalCost = ($largeCount * $cost["large"]) + ($mediumCount * $cost["medium"]) + ($smallCount * $cost["small"]);

    // Display the chosen car sizes and total cost
    echo implode(', ', $chosenCarSizes) . "\nTotal = PHP $totalCost";
}
