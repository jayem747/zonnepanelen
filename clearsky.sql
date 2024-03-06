-- Create the clearsky database if it does not exist
CREATE DATABASE IF NOT EXISTS clearsky;

-- Use the clearsky database
USE clearsky;

-- Create Klant table
CREATE TABLE Klant (
    KlantID INT AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(55),
    Email VARCHAR(255),
    Wachtwoord VARCHAR(255),
    Adres VARCHAR(255),
    Postcode VARCHAR(10)
);

-- Create KlantInfo table
CREATE TABLE KlantInfo (
    KlantID INT,
    Admin BOOLEAN,
    FOREIGN KEY (KlantID) REFERENCES Klant(KlantID)
);

-- Create Producten table
CREATE TABLE Producten (
    ProductID INT AUTO_INCREMENT  PRIMARY KEY,
    Titel VARCHAR(55),
    KleineOmschrijving VARCHAR(255),
    Omschrijving TEXT,
    Prijs DECIMAL(10,2),
    Voorraad INT,
    Foto LONGBLOB,
    Specificaties VARCHAR(255)
);

-- Create Afspraken table
CREATE TABLE Afspraken (
    AfspraakID INT AUTO_INCREMENT PRIMARY KEY,
    KlantID INT,
    VolledigeNaam VARCHAR(55),
    Telefoonnummer VARCHAR(20),
    Email VARCHAR(255),
    FOREIGN KEY (KlantID) REFERENCES Klant(KlantID)
);

-- Create Facturen table
CREATE TABLE Facturen (
    FactuurID INT AUTO_INCREMENT PRIMARY KEY,
    KlantID INT,
    Naam VARCHAR(55),
    Adres VARCHAR(255),
    Postcode VARCHAR(10),
    FOREIGN KEY (KlantID) REFERENCES Klant(KlantID)
);
