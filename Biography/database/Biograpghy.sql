CREATE TABLE Person (
    person_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    birth_date DATE,
    birth_place VARCHAR(255),
    biography TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Education (
    education_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    institution VARCHAR(255),
    degree VARCHAR(100),
    field VARCHAR(100),
    start_year YEAR,
    end_year YEAR,
    description TEXT,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Career (
    career_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    title VARCHAR(255),
    organization VARCHAR(255),
    start_year YEAR,
    end_year YEAR,
    description TEXT,
    is_challenge BOOLEAN,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Research (
    research_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    title VARCHAR(255),
    description TEXT,
    year YEAR,
    is_nobel_related BOOLEAN,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Awards (
    award_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    award_name VARCHAR(255),
    year YEAR,
    organization VARCHAR(255),
    description TEXT,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Works (
    work_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    title VARCHAR(255),
    type VARCHAR(100),
    publication_year YEAR,
    description TEXT,
    link VARCHAR(255),
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Gallery (
    image_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    image_url VARCHAR(255),
    caption VARCHAR(255),
    upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE References (
    reference_id INT PRIMARY KEY AUTO_INCREMENT,
    person_id INT,
    title VARCHAR(255),
    source VARCHAR(255),
    link VARCHAR(255),
    description TEXT,
    FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Visits (
    visit_id INT PRIMARY KEY AUTO_INCREMENT,
    visit_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    page_url VARCHAR(255)
);

Admin
CREATE TABLE Admins (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    role ENUM('super_admin', 'editor', 'viewer') DEFAULT 'editor',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    last_login DATETIME
);

CREATE TABLE AuditLogs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    admin_id INT,
    action VARCHAR(50) NOT NULL,
    table_name VARCHAR(50) NOT NULL,
    record_id INT,
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES Admins(admin_id)
);

INSERT INTO person (person_id, full_name, birth_date, birth_place, biography, created_at, updated_at)
    VALUES (1, 'Marie Skłodowska Curie', '1867-11-07', 'Warsaw, Ba Lan', 
    'Marie Curie là nhà khoa học tiên phong trong nghiên cứu phóng xạ, người phụ nữ đầu tiên đoạt giải Nobel và duy nhất nhận Nobel ở hai lĩnh vực khác nhau (Vật lý 1903, Hóa học 1911). Bà mất năm 1934 vì bệnh thiếu máu bất sản do phơi nhiễm phóng xạ.', 
    NOW(), NOW()
);

INSERT INTO education (education_id, person_id, institution, degree, field, start_year, end_year, description) VALUES
    (1, 1, 'Flying University, Warsaw', 'Không chính thức', 'Khoa học', 1885, 1891, 'Học tại trường bí mật dành cho phụ nữ ở Ba Lan.'),
    (2, 1, 'Sorbonne (University of Paris)', 'Cử nhân', 'Vật lý', 1891, 1893, 'Hoàn thành cử nhân Vật lý.'),
    (3, 1, 'Sorbonne (University of Paris)', 'Cử nhân', 'Toán học', 1893, 1894, 'Hoàn thành cử nhân Toán học.');

INSERT INTO career (career_id, person_id, title, organization, start_year, end_year, description, is_challenge)
VALUES
(1, 1, 'Giảng viên', 'Sorbonne University', 1906, 1934, 'Nữ giáo sư đầu tiên của Sorbonne sau cái chết của Pierre Curie.', 1),
(2, 1, 'Nhà sáng lập', 'Institut du Radium, Paris', 1914, 1934, 'Thành lập và điều hành Viện Radium (nay là Institut Curie).', 0),
(3, 1, 'Người sáng lập', 'Viện Radium, Warsaw', 1932, 1934, 'Hỗ trợ thành lập viện nghiên cứu tại quê hương Ba Lan.', 0);

INSERT INTO research (research_id, person_id, title, description, year, is_nobel_related)
VALUES
(1, 1, 'Khái niệm Radioactivity', 'Đặt ra thuật ngữ phóng xạ và chứng minh đây là tính chất nguyên tử.', 1898, 1),
(2, 1, 'Phát hiện Polonium', 'Chiết xuất poloni từ quặng pitchblende, đặt tên theo quê hương Ba Lan.', 1898, 1),
(3, 1, 'Phát hiện Radium', 'Cùng Pierre Curie công bố radium, nguyên tố phóng xạ mới.', 1898, 1),
(4, 1, 'Ứng dụng y học hạt nhân', 'Phát triển điều trị ung thư bằng muối radium và X-quang di động trong WWI.', 1914, 0);

INSERT INTO awards (award_id, person_id, award_name, year, organization, description)
VALUES
(1, 1, 'Giải Nobel Vật lý', 1903, 'Viện Hàn lâm Khoa học Thụy Điển', 'Chia sẻ cùng Pierre Curie và Henri Becquerel cho nghiên cứu về phóng xạ.'),
(2, 1, 'Giải Nobel Hóa học', 1911, 'Viện Hàn lâm Khoa học Thụy Điển', 'Cho việc khám phá và cô lập radium và polonium.'),
(3, 1, 'Davy Medal', 1903, 'Royal Society', 'Giải thưởng khoa học danh giá của Hoàng gia Anh.'),
(4, 1, 'Matteucci Medal', 1904, 'Học viện Khoa học Ý', 'Công trình xuất sắc về khoa học.'),
(5, 1, 'Franklin Medal', 1921, 'The Franklin Institute, USA', 'Vinh danh cống hiến khoa học.'),
(6, 1, 'Cameron Prize', 1931, 'University of Edinburgh', 'Đóng góp trong lĩnh vực y học.'),
(7, 1, 'Panthéon Honor', 1995, 'Chính phủ Pháp', 'Phụ nữ đầu tiên an táng tại Panthéon vì công lao khoa học.');

INSERT INTO works (work_id, person_id, title, type, publication_year, description, link)
VALUES
(1, 1, 'Recherches sur les substances radioactives', 'Luận án tiến sĩ', 1903, 'Luận án tiến sĩ về các chất phóng xạ.', 'https://gallica.bnf.fr/ark:/12148/bpt6k9631529'),
(2, 1, 'Traité de radioactivité', 'Sách', 1910, 'Tác phẩm tổng hợp toàn diện về phóng xạ.', 'https://archive.org/details/traitederadioact'),
(3, 1, 'Sur une nouvelle substance fortement radio-active contenue dans la pechblende', 'Bài báo khoa học', 1898, 'Công bố phát hiện radium.', 'https://curie.fr/history/radium-discovery'),
(4, 1, 'Pierre Curie', 'Sách tiểu sử', 1923, 'Sách viết về Pierre Curie.', 'https://archive.org/details/pierrecurie');

INSERT INTO `references` (reference_id, person_id, title, source, link, description)
VALUES
(1, 1, 'Marie Curie Biography', 'NobelPrize.org', 'https://www.nobelprize.org/prizes/physics/1903/marie-curie/biographical/', 'Tiểu sử chính thức trên trang Nobel.'),
(2, 1, 'Marie Curie', 'Britannica', 'https://www.britannica.com/biography/Marie-Curie', 'Bài viết tổng hợp từ Britannica.'),
(3, 1, 'Marie Curie', 'Wikipedia', 'https://en.wikipedia.org/wiki/Marie_Curie', 'Trang Wikipedia tiếng Anh.'),
(4, 1, 'Marie Curie and the Science of Radioactivity', 'AIP', 'https://history.aip.org/exhibits/curie', 'Triển lãm trực tuyến của AIP.'),
(5, 1, 'Institut Curie', 'Institut Curie', 'https://curie.fr', 'Thông tin Viện Curie và lịch sử.');

INSERT INTO gallery (image_id, person_id, image_url, caption, upload_date)
VALUES
(1, 1, 'https://upload.wikimedia.org/wikipedia/commons/7/7e/Marie_Curie_c1920.jpg', 'Chân dung Marie Curie (khoảng 1920)', NOW()),
(2, 1, 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Curie1898.jpg', 'Pierre và Marie Curie trong phòng thí nghiệm (1898)', NOW()),
(3, 1, 'https://upload.wikimedia.org/wikipedia/commons/f/f0/Curie_-_Traite_de_radioactivite%2C_1910.djvu', 'Bìa sách Traité de radioactivité (1910)', NOW()),
(4, 1, 'https://upload.wikimedia.org/wikipedia/commons/4/44/Panth%C3%A9on_Paris_DSC_0180.jpg', 'Panthéon Paris – nơi an táng Marie Curie', NOW());

