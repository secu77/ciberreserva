CREATE USER IF NOT EXISTS 'cb'@'%' IDENTIFIED BY 'cbP@ssw0rd';

CREATE DATABASE IF NOT EXISTS cbms;
GRANT SELECT ON cbms . * TO 'cb'@'%';

USE cbms;

CREATE TABLE IF NOT EXISTS `users`(
    `id` INT AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `posts`(
    `id` INT AUTO_INCREMENT,
    `image` VARCHAR(50) NOT NULL,
    `title` VARCHAR(200) NOT NULL,
    `description` VARCHAR(500) NOT NULL,
    `comments` INT NOT NULL,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=utf8;


INSERT INTO `users` (email,password) VALUES 
('luis.tamayo@ciberreserva.com','$2y$10$3cQ7a4uf9EpnxT8.9NAGs.sX5wxPR05tcRVWCrY/Yd4w0PapuWRyS'),
('luis.prieto@ciberreserva.com','$2y$10$Ln.cj4k0AFQNJyqBYPCK..a7C.Jo7iIlAQ4dKUMbod9V/K8GObMBC'),
('roberto.suarez@ciberreserva.com','$2y$10$JMHgBohXO67Bzizl72TPwuGSJh9GbWf.UO/2p298QefmpOCfrJH.2'),
('benito.antonanzas@ciberreserva.com','$2y$10$ZM67hNDBVRT8W7vd9Lb2i.PuckcV0q4dYuHJVrwytM1MkfgPhbDMm');


INSERT INTO `posts` (image,title,description,comments) VALUES 
('148932.png','Leveraging API Hooking for code deobfuscation with Frida', 'In this post we will discuss how to employ API hooking, a technique mostly used for binary targets, to deobfuscate malicious scripts. We will use the Frida framework to extract some key information for the analyst, such as the lists of C2 servers within the scripts, in some cases bypassing the obfuscation almost automatically.', 3),
('148933.png','The State of Ransomware in 2021', 'Rising to new levels of notoriety in 2020 as criminals sought to take advantage of the global chaos brought about by the COVID 19 pandemic, ransomware has continued to grow in maturity throughout the first half of 2021.', 5),
('148934.png','Use of Initial Access Brokers by Ransomware Groups', 'Initial Access Brokers (IABs) are financially motivated threat actors that profit through the sale of remote access to corporate networks in underground forums, like Exploit, XSS, or Raidforums. The type of accesses offered are mostly Remote Desktop Protocol (RDP), Virtual Private Network (VPN), web shells, and remote access software tools offered by companies such Citrix, Pulse Secure, Zoho, or VMware.', 2),
('148935.png','Massive Kaseya attack demands up to $70 million ransom from more than 200 US businesses', 'Florida based IT company Kaseya has been targeted in a colossal ransomware attack, believed to be at the hands of the Russia linked REvil group taking advantage of an existing vulnerability in its servers. The attack happened on Friday 2nd July, as businesses across the US wound down for the long Independence Day weekend.', 4),
('148936.png','The threat landscape in 2021 (so far)','The past 18 months from the rapid adoption of remote working, innovative new technologies being trialed and tested the world over, to pandemic fueled emotions have been the perfect conditions for cybercrime to thrive. Cybercriminals have shown no sign of slowing down in 2021 and, as we approach the halfway point and the gradual climb out of the COVID 19 pandemic, they are still not short of sophisticated and malicious ways to achieve their goals.', 6),
('148937.png','Dispelling ROCKYOU2021','As you may already be aware, a user recently made available a compilation of passwords dubbed ROCKYOU2021 on an underground forum and has since then shared on multiple sites. At Blueliv, we have already seen a few misconceptions regarding this compilation, from news outlets and regular users alike. During this blogpost, we will try to clarify exactly what ROCKYOU2021 is.', 1),
('148938.png','The most critical vulnerabilities right now','We may not yet be at the halfway point of 2021 but, over the course of the past 4 and a half months, Blueliv has already observed over 4,900 critical CVEs spanning widely used products from global vendors such as Panasonic, Cisco, Microsoft, and of course SolarWinds. It is clear that threat actors are still capitalizing on scattered, remote workforces, as evidenced in the platforms they are exploiting (Cisco Small Business, SAP Commerce Cloud).', 4),
('148939.png','An In Depth analysis of the new Taurus Stealer','Taurus Stealer, also known as Taurus or Taurus Project, is a C C++ information stealing malware that has been in the wild since April 2020. The initial attack vector usually starts with a malspam campaign that distributes a malicious attachment, although it has also been seen being delivered by the Fallout Exploit Kit.', 8),
('148940.png','Over One Million Clubhouse User Records Leaked','This week was reported that user data from from over 1.3 million user records was leaked from the popular social media application Clubhouse, after being  scraped from an SQL database and leaked online via a popular hacker forum. This is the latest in a series of successful social media breaches in 2021, happening just days after Facebook and LinkedIn saw more than a billion user profiles scraped and put to auction online.', 3);


CREATE DATABASE IF NOT EXISTS fmanager;
GRANT SELECT, INSERT ON fmanager . * TO 'cb'@'%';

USE fmanager;

CREATE TABLE IF NOT EXISTS `users`(
    `id` INT AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `pass` VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `files`(
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `path` VARCHAR(255) NOT NULL,
    `timestamp` VARCHAR(50) NOT NULL,
    `author` VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=utf8;


INSERT INTO `users` (email,pass) VALUES 
('demo','fe01ce2a7fbac8fafaed7c982a04e229'),
('admin','b4c8500e006e564cc823b1e87f216e7e'),
('benito','b9918b9f19418fa37932afc957d2411c');


INSERT INTO `files` (name,type,path,timestamp,author) VALUES 
('data.json','application/json','/var/www/html/files/data.json', '2021-09-20T00:06:38','benito'),
('data.xml','application/xml','/var/www/html/files/data.xml', '2021-09-20T00:26:38','benito'),
('148932.png','image/png','/var/www/html/files/148932.png','2021-09-20T01:37:55','benito'),
('slider_1.jpg','image/jpeg','/var/www/html/files/slider_1.jpg','2021-09-21T09:10:00','benito'),
('bootstrap.min.js','text/javascript','/var/www/html/files/bootstrap.min.js','2021-09-21T10:35:21','benito'),
('148940.png','image/png','/var/www/html/files/148940.png','2021-09-21T10:35:38','benito'),
('logo.jpeg','image/jpeg','/var/www/html/files/logo.jpeg','2021-09-21T14:23:30','benito');