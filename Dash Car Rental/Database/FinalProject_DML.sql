INSERT INTO car_rental_system.system_admin (system_admin_name,system_admin_email,system_admin_password) VALUES 
('admin','admin@admin.com',md5('admin')); 

INSERT INTO car_rental_system.customer (customer_name,customer_email,customer_password,customer_phone,customer_city) VALUES 
('test','test@test.com',md5('test'),'453675322','test');