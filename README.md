# TheGrandMaster v1.0
TheGrandMaster is a mastermind game written in JavaScript. You can play it [here](https://oanarosca.github.io/TheGrandMaster).

Each ball represents a digit from 0 to 7. A function returns a random 4-digit number, and another function checks whether the number only contains digits from 0 to 7 or not. After the number is chosen, its digits are placed one by one into an array. When the user chooses a ball, the `clicked()` function pushes its corresponding digit into an array. After the array has been filled (i.e. the user has chosen the 4 balls), the `eval()` function compares the two arrays and `feedback()` colors the little squares accordingly.

##To-do:
- [x] generate a number
- [x] transform user's input into a number
- [x] feedback function
- [x] feedback tables
- [ ] place on page to display "You won!/You lost!"
- [x] make the tables have the same height (maybe use canvas)
- [x] change the color of the green ball
- [x] create an "Undo" button
- [ ] create an "Instructions" button
