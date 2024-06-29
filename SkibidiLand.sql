DROP DATABASE IF EXISTS skibidi_land;


-- Create the new database if it does not exist already
CREATE DATABASE skibidi_land;


USE skibidi_land;

-- Create table 'world'
CREATE TABLE world
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    world_name VARCHAR(255) NOT NULL,
    world_minimum_player_level INT NOT NULL,
    world_maximum_player_level INT NOT NULL,
    world_maximum_player INT NOT NULL
);

-- Create table 'server_region'
CREATE TABLE server_region
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    server_name VARCHAR(6) NOT NULL
);

-- Create table 'server_location'
CREATE TABLE server_location
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    server_name VARCHAR(6) NOT NULL,
    maximum_player INT NOT NULL,
    fk_server_region INT NOT NULL,
    FOREIGN KEY (fk_server_region) REFERENCES server_region(id)
);

-- Create table 'class'
CREATE TABLE class
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    class_name VARCHAR(255) NOT NULL,
    tier ENUM('D','C','B','A','S','SS','SSR','SSR+')
);

-- Create table 'npc_type'
CREATE TABLE npc_type
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    npc_type_name VARCHAR(255) NOT NULL,
    is_aggressive BOOLEAN NOT NULL
);

-- Create table 'login_method'
CREATE TABLE login_method
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    method VARCHAR(255) NOT NULL
);

-- Create table 'npc'
CREATE TABLE npc
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    npc_display_name VARCHAR(255) NOT NULL,
    npc_dps INT NOT NULL,
    fk_npc_type INT NOT NULL,
    FOREIGN KEY (fk_npc_type) REFERENCES npc_type(id)
);

-- Create table 'player'
CREATE TABLE player
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    display_name VARCHAR(255) NOT NULL,
    player_level INT NOT NULL,
    fk_class INT NOT NULL,
    fk_server INT NOT NULL,
    FOREIGN KEY (fk_class) REFERENCES class(id),
    FOREIGN KEY (fk_server) REFERENCES server_location(id)
);

-- Create table 'player_login_method'
CREATE TABLE player_login_method
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    passwords VARCHAR(255) NOT NULL,
    fk_player INT NOT NULL,
    fk_login_method INT NOT NULL,
    FOREIGN KEY (fk_player) REFERENCES player(id),
    FOREIGN KEY (fk_login_method) REFERENCES login_method(id)
);

-- Create table 'saved_player_locations'
CREATE TABLE saved_player_locations
(
    x_axis INT NOT NULL,
    y_axis INT NOT NULL,
    z_axis INT NOT NULL,
    fk_player INT NOT NULL,
    fk_world INT NOT NULL,
    FOREIGN KEY (fk_player) REFERENCES player(id),
    FOREIGN KEY (fk_world) REFERENCES world(id)
);

-- Create table 'npc_locations'
CREATE TABLE npc_locations
(
    x_axis INT NOT NULL,
    y_axis INT NOT NULL,
    z_axis INT NOT NULL,
    fk_npc INT NOT NULL,
    fk_world INT NOT NULL,
    FOREIGN KEY (fk_npc) REFERENCES npc(id),
    FOREIGN KEY (fk_world) REFERENCES world(id)
);



-- Insert data into 'world'
INSERT INTO world (world_name, world_minimum_player_level, world_maximum_player_level, world_maximum_player) 
VALUES 
('Earth', 1, 100, 1000),
('Mars', 10, 200, 800),
('Venus', 20, 150, 600),
('Jupiter', 30, 250, 500),
('Saturn', 40, 300, 300);

-- Insert data into 'server_region'
INSERT INTO server_region (server_name) 
VALUES 
('NA-East'),
('NA-West'),
('EU-Central'),
('EU-East'),
('AS-South');

-- Insert data into 'server_location'
INSERT INTO server_location (server_name, maximum_player, fk_server_region) 
VALUES 
('Srv01', 1000, 1),
('Srv02', 800, 2),
('Srv03', 600, 3),
('Srv04', 500, 4),
('Srv05', 300, 5);

-- Insert data into 'class'
INSERT INTO class (class_name, tier) 
VALUES 
('Warrior', 'A'),
('Mage', 'S'),
('Archer', 'B'),
('Rogue', 'C'),
('Healer', 'A');

-- Insert data into 'npc_type'
INSERT INTO npc_type (npc_type_name, is_aggressive) 
VALUES 
('Goblin', TRUE),
('Dragon', TRUE),
('Merchant', FALSE),
('Guard', FALSE),
('Bandit', TRUE);

-- Insert data into 'login_method'
INSERT INTO login_method (method) 
VALUES 
('Email'),
('Facebook'),
('Google'),
('Apple'),
('Twitter');

-- Insert data into 'npc'
INSERT INTO npc (npc_display_name, npc_dps, fk_npc_type) 
VALUES 
('Goblin Grunt', 10, 1),
('Red Dragon', 100, 2),
('Village Merchant', 0, 3),
('Castle Guard', 5, 4),
('Highway Bandit', 15, 5);

-- Insert data into 'player'
INSERT INTO player (username, display_name, player_level, fk_class, fk_server) 
VALUES 
('user1', 'PlayerOne', 15, 1, 1),
('user2', 'PlayerTwo', 30, 2, 2),
('user3', 'PlayerThree', 45, 3, 3),
('user4', 'PlayerFour', 60, 4, 4),
('user5', 'PlayerFive', 75, 5, 5);

-- Insert data into 'player_login_method'
INSERT INTO player_login_method (email, passwords, fk_player, fk_login_method) 
VALUES 
('playerone@example.com', 'password123', 1, 1),
('playertwo@example.com', 'password123', 2, 2),
('playerthree@example.com', 'password123', 3, 3),
('playerfour@example.com', 'password123', 4, 4),
('playerfive@example.com', 'password123', 5, 5);

-- Insert data into 'saved_player_locations'
INSERT INTO saved_player_locations (x_axis, y_axis, z_axis, fk_player, fk_world) 
VALUES 
(100, 200, 300, 1, 1),
(110, 210, 310, 2, 2),
(120, 220, 320, 3, 3),
(130, 230, 330, 4, 4),
(140, 240, 340, 5, 5);

-- Insert data into 'npc_locations'
INSERT INTO npc_locations (x_axis, y_axis, z_axis, fk_npc, fk_world) 
VALUES 
(150, 250, 350, 1, 1),
(160, 260, 360, 2, 2),
(170, 270, 370, 3, 3),
(180, 280, 380, 4, 4),
(190, 290, 390, 5, 5);



-- VIEWS

-- Create view 'player_info'
CREATE VIEW player_info AS
SELECT 
    p.id AS player_id,
    p.username,
    p.display_name,
    p.player_level,
    c.class_name,
    c.tier AS class_tier,
    s.server_name AS server_location_name,
    sr.server_name AS server_region_name,
    plm.email AS login_email,
    plm.passwords AS login_password,
    lm.method AS login_method,
    spl.x_axis AS saved_x_axis,
    spl.y_axis AS saved_y_axis,
    spl.z_axis AS saved_z_axis,
    w.world_name AS saved_world_name
FROM 
    player p
JOIN 
    class c ON p.fk_class = c.id
JOIN 
    server_location s ON p.fk_server = s.id
JOIN 
    server_region sr ON s.fk_server_region = sr.id
JOIN 
    player_login_method plm ON p.id = plm.fk_player
JOIN 
    login_method lm ON plm.fk_login_method = lm.id
JOIN 
    saved_player_locations spl ON p.id = spl.fk_player
JOIN 
    world w ON spl.fk_world = w.id;


-- Create view 'npc_info'
CREATE VIEW npc_info AS
SELECT 
    n.id AS npc_id,
    n.npc_display_name,
    n.npc_dps,
    nt.npc_type_name,
    nt.is_aggressive
FROM 
    npc n
JOIN 
    npc_type nt ON n.fk_npc_type = nt.id;



-- Create view 'server_capacity'
CREATE VIEW server_capacity AS
SELECT 
    s.id AS server_id,
    s.server_name,
    s.maximum_player,
    sr.server_name AS server_region_name
FROM 
    server_location s
JOIN 
    server_region sr ON s.fk_server_region = sr.id;


-- Create view 'world_info'
CREATE VIEW world_info AS
SELECT 
    w.id AS world_id,
    w.world_name,
    w.world_minimum_player_level,
    w.world_maximum_player_level,
    w.world_maximum_player
FROM 
    world w;


-- stored routines

