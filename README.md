## About Raffle App

**Features:**

- Buy controller: POST http://localhost/api/buy
- Required fields: email, amount. (I have created a user with email: puppy@betterworld.org)
- Amount = 1 => 1 entry
- Unit test for TransactionService

**To-do list:**

- Create DB transaction middleware. (For any route that has multiple updating queries, we should use DB transaction to ensure data consistency).
- Create a cronjob to handle raffle action at a certain time.
- Create API documentation using Swagger or the OpenAPI tool.
- Write Unit Test for the Repository layer.
- Write integration test for Transaction controller.

**Q & A**

- I separated the Entry model from transaction table because later on we can scale to using Entry model for other purposes such as: by campaign type? Not sure if we have it or not in the future, but Transaction table should be used only for payment.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
