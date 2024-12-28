DROP DATABASE IF EXISTS kriwni;
CREATE DATABASE kriwni;
USE kriwni;

CREATE TABLE Properties (
    PropertyID INT PRIMARY KEY,
    p_name VARCHAR(100) UNIQUE,
    p_location VARCHAR(255),
    p_type ENUM('room', 'house'),
    p_price DECIMAL(10, 2),
    AvailabilityStatus BOOLEAN
);

CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    customer_name VARCHAR(100),
    customer_email VARCHAR(100),
    property_name VARCHAR(100),
    StartDate DATE,
    EndDate DATE,
    Status ENUM('confirmed', 'pending', 'canceled'),
    FOREIGN KEY (property_name) REFERENCES Properties(p_name)
);

CREATE TABLE Reviews (
    ReviewID INT PRIMARY KEY  AUTO_INCREMENT,
    reviewer_name VARCHAR(100) NOT NULL,
    property_name VARCHAR(100) NOT NULL,
    rating INT NOT NULL,
    review_text TEXT NOT NULL,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add booking history table
CREATE TABLE BookingHistory (
    HistoryID INT PRIMARY KEY AUTO_INCREMENT,
    BookingID INT,
    PropertyName VARCHAR(100),
    Status VARCHAR(20),
    ChangedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (BookingID) REFERENCES Bookings(BookingID)
);

DELIMITER //

-- Trigger to log booking status changes
CREATE TRIGGER after_booking_update 
AFTER UPDATE ON Bookings
FOR EACH ROW
BEGIN
    INSERT INTO BookingHistory (BookingID, PropertyName, Status)
    VALUES (NEW.BookingID, NEW.property_name, NEW.Status);
END;//

-- Trigger to update property availability when booking is confirmed
CREATE TRIGGER after_booking_confirmation
AFTER INSERT ON Bookings
FOR EACH ROW
BEGIN
    IF NEW.Status = 'confirmed' THEN
        UPDATE Properties 
        SET AvailabilityStatus = FALSE
        WHERE p_name = NEW.property_name;
    END IF;
END;//

-- Trigger to validate booking dates
CREATE TRIGGER before_booking_insert
BEFORE INSERT ON Bookings
FOR EACH ROW
BEGIN
    IF NEW.StartDate >= NEW.EndDate THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'End date must be after start date';
    END IF;
    
    -- Check for overlapping bookings
    IF EXISTS (
        SELECT 1 FROM Bookings
        WHERE property_name = NEW.property_name
        AND Status = 'confirmed'
        AND ((NEW.StartDate BETWEEN StartDate AND EndDate)
        OR (NEW.EndDate BETWEEN StartDate AND EndDate))
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Property is already booked for these dates';
    END IF;
END;//

DELIMITER ;

INSERT INTO Properties (PropertyID, p_name, p_location, p_type, p_price, AvailabilityStatus) VALUES
(1, 'Sunny Villa', 'Los Angeles, CA', 'house', 3500.00, TRUE),
(2, 'Cozy Apartment', 'New York, NY', 'room', 800.00, TRUE),
(3, 'Mountain Retreat', 'Aspen, CO', 'house', 5000.00, FALSE),
(4, 'Beachfront Bungalow', 'Miami, FL', 'house', 4500.00, TRUE),
(5, 'Urban Loft', 'Chicago, IL', 'room', 1200.00, TRUE),
(6, 'Country Cottage', 'Austin, TX', 'house', 3000.00, TRUE),
(7, 'Downtown Studio', 'San Francisco, CA', 'room', 1500.00, FALSE),
(8, 'Luxury Penthouse', 'Las Vegas, NV', 'house', 7000.00, TRUE),
(9, 'Suburban Ranch', 'Dallas, TX', 'house', 4000.00, TRUE),
(10, 'Mountain Lodge', 'Lake Tahoe, CA', 'house', 6000.00, TRUE);

