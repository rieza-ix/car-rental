// Define objects to store the seat capacity and cost of each car size
const seatCapacity = { small: 5, medium: 10, large: 15 };
const cost = { small: 5000, medium: 8000, large: 12000 };

// Read input from the console
const readline = require("readline").createInterface({
  input: process.stdin,
  output: process.stdout,
});

// Get the seat capacity from the user input
readline.question("Please input seat number : ", (seatInput) => {
  const seat = parseInt(seatInput);
  readline.close();

  // Determine the optimal car size and calculate the optimized cost
  determineOptimalSize(seat);
});

// Determine the optimal car size based on the seat capacity
function determineOptimalSize(seat) {
  let optimalSize = 0;

  if (seat <= 0) {
    // Display error if the seat capacity entered is less or equal to 0
    console.log("Please enter a valid number of seats greater than zero.");
    return;
  } else if (seat < seatCapacity.small) {
    // Set the optimalSize if the seat capacity is less than the size of the small car
    optimalSize = seatCapacity.small;
  } else if (seat % seatCapacity.large === 0) {
    // Set the optimalSize to the seat capacity if it is divisible by the size of the large car
    optimalSize = seat;
  } else if (seat % seatCapacity.medium === 0) {
    // Set the optimalSize to the seat capacity if it is divisible by the size of the medium car
    optimalSize = seat;
  } else {
    // Round up the seat capacity to the nearest multiple of the small car size
    optimalSize = Math.ceil(seat / seatCapacity.small) * seatCapacity.small;
  }

  // Pass the optimalSize value to the getOptimizedCost() function to calculate and display the optimized cost
  getOptimizedCost(optimalSize);
}

// Determine the right car size based on the optimalSize
function determineCarSize(optimalSize) {
  const largeCount = Math.floor(optimalSize / seatCapacity.large);
  optimalSize -= largeCount * seatCapacity.large;

  const mediumCount = Math.floor(optimalSize / seatCapacity.medium);
  optimalSize -= mediumCount * seatCapacity.medium;

  const smallCount = Math.floor(optimalSize / seatCapacity.small);

  return [largeCount, mediumCount, smallCount];
}

// Calculate the optimized cost and display the chosen car sizes
function getOptimizedCost(optimalSize) {
  const [largeCount, mediumCount, smallCount] = determineCarSize(optimalSize);
  const chosenCarSizes = [];

  // Check if the count of each car size is more than 0, and add it to the chosen car sizes array
  if (largeCount > 0) {
    chosenCarSizes.push(`L x ${largeCount}`);
  }
  if (mediumCount > 0) {
    chosenCarSizes.push(`M x ${mediumCount}`);
  }
  if (smallCount > 0) {
    chosenCarSizes.push(`S x ${smallCount}`);
  }

  // Calculate the total cost
  const totalCost =
    largeCount * cost.large +
    mediumCount * cost.medium +
    smallCount * cost.small;

  // Display the chosen car sizes and total cost
  console.log(`${chosenCarSizes.join(", ")}\nTotal = PHP ${totalCost}`);
}
