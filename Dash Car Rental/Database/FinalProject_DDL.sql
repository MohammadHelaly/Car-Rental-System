CREATE DATABASE IF NOT EXISTS car_rental_system;

CREATE TABLE IF NOT EXISTS car_rental_system.system_admin (
system_admin_id INT NOT NULL  , 
system_admin_name TEXT NOT NULL ,
system_admin_email VARCHAR(255) NOT NULL , 
system_admin_password VARCHAR(255) NOT NULL ,  
PRIMARY KEY (system_admin_id));

CREATE TABLE IF NOT EXISTS car_rental_system.customer (
customer_id INT AUTO_INCREMENT, 
customer_name TEXT NOT NULL ,
customer_email VARCHAR(255) NOT NULL , 
customer_password VARCHAR(255) NOT NULL ,
customer_phone INT NOT NULL ,
customer_city TEXT NOT NULL , 
PRIMARY KEY (customer_id));

CREATE TABLE IF NOT EXISTS car_rental_system.reservation (
reservation_id INT UNIQUE AUTO_INCREMENT,
customer_id INT,
car_plate_id VARCHAR(255) , 
reservation_date DATE NOT NULL,
office_id INT NOT NULL ,
reservation_payment INT NOT NULL,
reservation_pickup_date DATE NOT NULL ,
reservation_return_date DATE NOT NULL,
PRIMARY KEY (reservation_id,customer_id,car_plate_id,office_id));

CREATE TABLE IF NOT EXISTS car_rental_system.car (
car_plate_id VARCHAR(255), 
car_make TEXT  ,
car_model VARCHAR(255),
car_price INT,
car_year INT, 
PRIMARY KEY (car_plate_id));

CREATE TABLE IF NOT EXISTS car_rental_system.car_status (
car_plate_id VARCHAR(255), 
car_status TEXT NOT NULL ,
car_status_date DATE NOT NULL , 
PRIMARY KEY (car_plate_id, car_status_date));
	
CREATE TABLE IF NOT EXISTS car_rental_system.office (
office_id INT , 
office_city TEXT,  
PRIMARY KEY (office_id));

ALTER TABLE reservation ADD CONSTRAINT reservation_fk1 FOREIGN KEY (customer_id) REFERENCES customer(customer_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE reservation ADD CONSTRAINT reservation_fk2 FOREIGN KEY (office_id) REFERENCES office(office_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE reservation ADD CONSTRAINT reservation_fk3 FOREIGN KEY (car_plate_id) REFERENCES car(car_plate_id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE car_status ADD CONSTRAINT car_status_fk FOREIGN KEY (car_plate_id) REFERENCES car(car_plate_id) ON DELETE CASCADE ON UPDATE CASCADE; 
 
