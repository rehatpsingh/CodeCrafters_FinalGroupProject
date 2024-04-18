CREATE DATABASE IF NOT EXISTS mydb;
use mydb;

INSERT INTO `mydb`.`Address` (`address_id`, `street_addressl`, `city`, `state`, `postal_code`) VALUES
(1, '123 Main St', 'Springfield', 'IL', '62704'),
(2, '456 Elm St', 'Springfield', 'IL', '62704'),
(3, '789 Oak St', 'Springfield', 'IL', '62704'),
(4, '101 Pine St', 'Springfield', 'IL', '62704'),
(5, '202 Maple St', 'Springfield', 'IL', '62704');

INSERT INTO `mydb`.`Customers` (`customer_id`, `first_name`, `last_name`, `email`, `address_id`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', 1),
(2, 'Jane', 'Smith', 'jane.smith@example.com', 2),
(3, 'Robert', 'Brown', 'robert.brown@example.com', 3),
(4, 'Emily', 'Davis', 'emily.davis@example.com', 4),
(5, 'Michael', 'Johnson', 'michael.johnson@example.com', 5);

INSERT INTO `mydb`.`Products` (`product_id`, `name`, `description`, `price`) VALUES
(1, 'Product A', 'Description of Product A', 9.99),
(2, 'Product B', 'Description of Product B', 14.99),
(3, 'Product C', 'Description of Product C', 19.99),
(4, 'Product D', 'Description of Product D', 24.99),
(5, 'Product E', 'Description of Product E', 29.99);

INSERT INTO `mydb`.`Orders` (`order_id`, `customer_id`, `order_date`, `total_amount`, `status`) VALUES
(1, 1, '2023-04-12', 49.95, 'completed'),
(2, 2, '2023-04-13', 29.99, 'pending'),
(3, 3, '2023-04-14', 39.98, 'completed'),
(4, 4, '2023-04-15', 19.99, 'canceled'),
(5, 5, '2023-04-16', 59.97, 'completed');

INSERT INTO `mydb`.`Order_Items` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 1),
(3, 3, 3, 2),
(4, 4, 4, 1),
(5, 5, 5, 2);
