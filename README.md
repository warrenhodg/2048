# 2048
Online 2048 with AI.

## Techniques used:
### Snake:
#### Definition of snake:
* The concept of a snake is a non-decreasing string of numbers going from eg. top-left to top-right, one down
then from right back to left.
* Another slightly less valuable snake is eg. top-left to top-right, then down to
bottom-right.

#### Score of a snake:
* A snake consisting of bigger numbers is more valuable than smaller, mergable numbers. So each number is raised to a slight power to make them more valuable.

#### Penalties that reduce the score:
* It is best if the biggest number of the snake cannot be compromised, so:
  1. any leading spaces before the snake are heavily penalised, as a number could be inserted or moved there, 
messing up the pattern.
  2. any trailing spaces in the last line penalised, because a bad insert could result in the first case.

* A snake must be able to grow naturally, so:
  1. A snake that a) cannot internally merge and b) whose last row is fully blocked by non-snake numbers that are larger than themselves is penalised.
