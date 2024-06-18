## Froots PHP Technical Challenge

### Setup Instructions
1. Create a new [API Platform](https://api-platform.com/) Symfony project using Composer.
2. Create a DB connection in Symfony using the `.env` file.

### Project Requirements

1. **Entities and Basic Endpoints:**
   - Create the following entities:
     ```plaintext
     * Orders: id, amount, created_at, updated_at
     * Products: id, name, price, created_at, updated_at
     ```
   - Create these basic API endpoints using API Platform:
     ```plaintext
     * GET /orders: List all orders.
     * GET /products: List all products.
     ```

2. **Custom Sub-resource Endpoint:**
   - Implement the following sub-resource endpoint:
     ```plaintext
     * GET /orders/{id}/products: Return all products in a specific order.
     ```

3. **Authentication Layer:**
   - Implement JWT authentication to protect the endpoint `/orders/{id}/products`.
   - Ensure users can obtain a JWT token via a login endpoint.

4. **Testing:**
   - Write a simple test to verify that the `/orders/{id}/products` endpoint works as expected.
   - Use PHPUnit for writing and running the test.

### Tips:
- Use [Faker](https://github.com/fzaninotto/Faker) to simplify seeding your database with test data.
- Follow best practices for code structure, readability, and maintainability.