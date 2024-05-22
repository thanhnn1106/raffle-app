## About Raffle App

**Features:**

- Buy controller: POST http://localhost/api/buy
- Unit test for TransactionService

**To do list:**

- Create DB transaction middleware. (For any route that have multiple updating query, we should use DB transaction to ensure data consistency).
- Create cronjob to handle raffle action on certain time.
- Create API documentation using Swagger or OpenAPI tool.
- Write Unit Test for Repository layer.
- Write intergration test for Buy controller.

**Q & A**

- I separated the Entry model from transaction table because later on we can scale to using Entry model for other purposes such as: by campaign type? Not sure if we have it or not in the future, but Transaction table should be used only for payment.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
