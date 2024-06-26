# Laravel Product Management API

This project is a Laravel-based API for managing products. It uses Laravel Passport for authentication and follows repository patterns to separate business logic from data access.

## ProductController

The `ProductController` handles product-related operations and delegates the actual data access to the `ProductRepository` interface, which is implemented by `EloquentProductRepository`.

## API Routes

### Authentication Routes

- `POST /api/register` - Register a new user.
- `POST /api/login` - Log in an existing user.

### Authenticated Routes

These routes require a valid Bearer token obtained via the login route. Make sure to use the `auth:api` middleware for securing these routes.

#### Inventory Routes

- `POST /api/inventory/logout` - Log out the authenticated user.
- `POST /api/inventory/update-password` - Update the password of the authenticated user.
- `GET /api/inventory/product` - Retrieve a list of all products.
- `POST /api/inventory/product` - Create a new product.
- `GET /api/inventory/product/{id}` - Retrieve a specific product by ID.
- `PUT /api/inventory/product/{id}` - Update a specific product by ID.
- `DELETE /api/inventory/product/{id}` - Delete a specific product by ID.
- `GET /api/inventory/product/category/{categoryId}` - Retrieve products by category ID.
- `GET /api/inventory/product/brand/{brandId}` - Retrieve products by brand ID.

## Notes

- Please use the header `Accept: application/json` to retrieve any product in JSON format.
- Do not forget to use a Bearer token for all requests made to the `/api/inventory/product/*` endpoints.

Thank you.
