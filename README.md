# CalorieCalc

# Calorie Calculator and Calorie Tracker

This application, built with PHP and Bootstrap, allows users to calculate the number of calories they need per day based on their weight (in kg) and height (in cm) using the Mifflin-St Jeor formula. It also includes a calorie tracker to log the calories consumed each day and stores the calculation history for future reference.

## Features

- **Mifflin-St Jeor Formula**: Estimates the number of calories a person needs per day based on their weight, height, age, gender, and activity level.
- **Calculation History**: Stores each result when the user calculates their daily caloric needs, allowing them to track their past calculations.
- **Calorie Tracker**: Users can log the calories they consume throughout the day. The app keeps track of their total daily calorie intake and shows whether they have met, exceeded, or are under their target caloric needs.

## Mifflin-St Jeor Formula

The Mifflin-St Jeor equation calculates the Basal Metabolic Rate (BMR), which is the number of calories your body needs to perform basic functions at rest. The formula is as follows:

### For Men:

```
BMR = 10 * weight (kg) + 6.25 * height (cm) - 5 * age (years) + 5

```

### For Women:

```
BMR = 10 * weight (kg) + 6.25 * height (cm) - 5 * age (years) - 161

```

Your Total Daily Energy Expenditure (TDEE) is calculated by multiplying your BMR by an activity factor:

- Sedentary (little or no exercise): BMR * 1.2
- Lightly active (light exercise/sports 1-3 days/week): BMR * 1.375
- Moderately active (moderate exercise/sports 3-5 days/week): BMR * 1.55
- Very active (hard exercise/sports 6-7 days a week): BMR * 1.725
- Super active (very hard exercise or physical job): BMR * 1.9

## Installation

To get started with the Calorie Calculator app, follow these steps:

1. Clone the repository:
    
    ```bash
    git clone https://github.com/yourusername/calorie-calculator.git
    
    ```
    
2. Place the project folder in the htdocs directory of your XAMPP installation:
For example, move it to `C:\xampp\htdocs\calorie-calculator`.
3. Start the XAMPP control panel and launch the Apache server.
4. Access the app by visiting `http://localhost/calorie-calculator` in your browser.

## Usage

1. Enter your personal details: Input your weight (kg), height (cm), age, gender, and activity level.
2. Calculate your daily caloric needs: The app will display the number of calories you need to maintain your current weight.
3. Track your calories: You can log the calories you consume throughout the day. The app will sum your total calories and compare them with your calculated daily target.
4. View and track history: Each time you calculate your calories, the result is stored in a history list. You can review your past calculations and calorie intake.

## Technologies Used

- **Frontend**: PHP, HTML, CSS, Bootstrap
- **Backend**: PHP (with XAMPP for local server setup)
- **Database**: MySQL (if needed for storing history or other data)
- **Libraries**: None (built with native PHP and Bootstrap)

## Future Integration

- **Food Search API**: Integrate an API that allows users to search for food items easily.
- **Nutrition Data API**: Use an API to fetch calorie and nutritional information for the searched food items.
- Allow users to click on a food item to instantly add its calories to their daily total.

## Developer

This application was developed by [Your Name]. For questions, feedback, or support, please contact:

- Email: santos.p.miguel46@gmail.com
- GitHub: [@Miguelkarma](https://github.com/Miguelkarma)

## Contributing

If you'd like to contribute to the project, please fork the repository and submit a pull request. You can also open issues for bug reports or feature requests.

## License

This project is licensed under the MIT License
