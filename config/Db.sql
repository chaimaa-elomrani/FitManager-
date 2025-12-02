create Database fitmanager;

CREATE TABLE course (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    course_date DATE NOT NULL,
    heure TIME NOT NULL,
    duree INT NOT NULL,
    max_participants INT NOT NULL
);

 CREATE TABLE equipements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    quantite INT NOT NULL DEFAULT 1,
    etat ENUM('bon', 'moyen', 'a_remplacer') NOT NULL DEFAULT 'bon'
);


CREATE TABLE cours_equipements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    equipement_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES course(id) ON DELETE CASCADE,
    FOREIGN KEY (equipement_id) REFERENCES equipements(id) ON DELETE CASCADE
);


INSERT INTO course (fullname, category, course_date, heure, duree, max_participants)
VALUES 
('Yoga Matinal', 'Yoga', '2025-12-05', '08:00:00', 60, 15),
('Cardio Intense', 'Cardio', '2025-12-05', '10:00:00', 45, 20),
('Musculation Débutants', 'Musculation', '2025-12-06', '09:00:00', 60, 12);
