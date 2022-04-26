-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: chatapp
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `approve` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` longtext NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `iv` longtext NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private_key` longtext NOT NULL,
  `cipher` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'!@#%$Phoenix!@#$Encryption!@#$','AES-256-CTR');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'default.png',
  `status` varchar(255) NOT NULL,
  `verify` int(1) DEFAULT 0,
  `public_key` longtext NOT NULL,
  `private_key` longtext NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,753923532,'Admin','User','admin@email.com','0192023a7bbd73250516f069df18b500','default.png','Online',0,'-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4hBR3JKzg10UxsUS9MgN\nrPsruzeiSlIxwtrBCzjW52nAy5HW8W0NOzQohnR5Hs5MUpiZaBbx0KObyEUXiSYT\nNuBDREwgzBM8Y+s0eWhqaPpJA9sjr6Sx343vyh43TMnv7+M/lhuq2lBjTcH/FMn0\n43oiBWqWwFXqsu/VuIIkPnRYyT6UUHkp6tMuWXGdS12wXxClgxD5Ntgys6c/KFbo\nvV75nPdCSDQ1yvy8GW6FaF3Zqh7sU66fpQtandxtgbKVnSPANIWjUUx08sy+6kWC\nwxXJksNdGbEkT3mGltxDWI9OhCbLhCiOjwvtfFG4TFHX4W6MkQmScelTTqPyHuft\nxwIDAQAB\n-----END PUBLIC KEY-----\n','-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDiEFHckrODXRTG\nxRL0yA2s+yu7N6JKUjHC2sELONbnacDLkdbxbQ07NCiGdHkezkxSmJloFvHQo5vI\nRReJJhM24ENETCDMEzxj6zR5aGpo+kkD2yOvpLHfje/KHjdMye/v4z+WG6raUGNN\nwf8UyfTjeiIFapbAVeqy79W4giQ+dFjJPpRQeSnq0y5ZcZ1LXbBfEKWDEPk22DKz\npz8oVui9Xvmc90JINDXK/LwZboVoXdmqHuxTrp+lC1qd3G2BspWdI8A0haNRTHTy\nzL7qRYLDFcmSw10ZsSRPeYaW3ENYj06EJsuEKI6PC+18UbhMUdfhboyRCZJx6VNO\no/Ie5+3HAgMBAAECggEBAIwK3huNicVsKU3FkiuvrsElS/8LxO7Tol36lDI2gPMU\n0UmKzCP9kX/GnQBGMS5DUIauYAJajGzancvf+WeN/cM2BJXPr1Wc6QFhGL3JUHo9\n6nOIEsBhf4tk61JDi7B3PLtYBPEhrKLXv9zQvAuN3LX62A6Q7Fi0INO+vaAyhu9k\ni/LRhp9/Xu+qQJP52D1lI/JMuRyg3p9NYUEm4sUXEfKsKX3YsUn3Jyfj/EZ8OE8I\njcC5031jwyDF8Wm7DHf2tdKJrb2aYwc1JZM3aaUH/fRKbfpRRnTO8fdXY9ocrwYk\ns48ttcZNXvOEYH7P8s22xxJoZ+4sqAexgoHg8NMJXXECgYEA87DM0oER+dt3xN8N\nUqJvM7sZyR9StXz6N6k1N8ENxW0++r4n0Dhf6iu081qE+KHeQ42GNAMPy3ILyqRE\n2/2Psv8laoHgBmzwfDNAs8zG42P+eUb7hLUyJr9vMOlKvCj7xTqrk5VEcTGJtS2x\nX6cQwxSf9kP9ttxCRJaTlLt5vvkCgYEA7XuVe06xmNojCEhUQvJYUUY3EWX7WFZ/\nX+UlpmYOnzm22vw7IZx1r5C1E9+qqM7xQiBBpriULoxkV90c+WTkGhrKTkMEv1RO\nrLHE+jHOolIXxbN7A2cAzgROfYuD1nrCaFDh4tobY0UCayKatiWObt4gGN3oKR2f\nYEQ76BrYgr8CgYEAxs9X2ukYHErzxHbhLKh+pqqfV9kpJg2nKZ/vXeQvcwE0n2Zh\nnttPTQGJZ/xSfXG5nk0ozugsi6MogZNQ5lVQVg0YnnMErNlVvU4nHEkVfdBHfPPv\nIQ6essP9V98MbMPW28qIzie6JcrveROlIM9wumbqNgS0SeoaWlCqaG4m3ikCgYBJ\nETEY00mJQfRtY/Oo9W9+8h+XVs1SjKp8EsDWxafSDavZDKoU2VLMRbWw+6xCbAmG\n0u3gIgJVoBRvhDSZ9xTHg16jXbNkOshKEhgM8q4k+yUdSu+aSGLTADg2IGrb3sFZ\n3yjg50Jt9Jmd5PO8/yknq2gsvnnjzJ1wvQ3BiCD9eQKBgQDKXtdAv0EN79e1gnQ7\nC9YZUUAD62J753iEPPG5TfuQ9ykwxN62XXM3tZOBFriieboloyXUqiI6F1S/RQXQ\nPpuWgaFNW25KhIM3EQnFSeF6IPFHJM8zUO8qyIxfD30rdbrqac9TLysW4YrdhsoU\nNgKNvL5AcW8FAh4ulcgGL7PQuQ==\n-----END PRIVATE KEY-----\n'),(2,1503812408,'Test1','User','test1@email.com','cc03e747a6afbbcbf8be7668acfebee5','default.png','Online',0,'-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4v8WO9ZOqaAMTo7npBfg\n/Mj48zWtzQN+1M7aCYv3/rK3o+W6RSwwsPHuRqsd/xMoHWZ/9TLA8wvxEwOS3qJE\nF/vfGi1fP0nfQHynj6Urm9s8SyovW2hq8oroHUGA/neXK9QRecHtIu6kv4TkJPO8\nwcRzWPLyus2/BmBlqpNOhLArqT+BmMvzdGtX/55MhSSWYkTzUuNlw2esLHUW19R4\nihgARKUxgLP9rCrcHDaUxb2DUR3VVMo75V8j4+DFrqQABg6OmvIjZ4psO508lj5k\noX4mTjl4FgQm6CuFYfkNa+dwZzEU2/BW+XMCNpz3KBYM6N8AYsvBtnuIeRA1JomN\nBQIDAQAB\n-----END PUBLIC KEY-----\n','-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDi/xY71k6poAxO\njuekF+D8yPjzNa3NA37UztoJi/f+srej5bpFLDCw8e5Gqx3/EygdZn/1MsDzC/ET\nA5LeokQX+98aLV8/Sd9AfKePpSub2zxLKi9baGryiugdQYD+d5cr1BF5we0i7qS/\nhOQk87zBxHNY8vK6zb8GYGWqk06EsCupP4GYy/N0a1f/nkyFJJZiRPNS42XDZ6ws\ndRbX1HiKGABEpTGAs/2sKtwcNpTFvYNRHdVUyjvlXyPj4MWupAAGDo6a8iNnimw7\nnTyWPmShfiZOOXgWBCboK4Vh+Q1r53BnMRTb8Fb5cwI2nPcoFgzo3wBiy8G2e4h5\nEDUmiY0FAgMBAAECggEBANdT0uuAJ66QvBvpQ6NNY4dnvYA4c13+6tlEP2C+/ckG\nD13SFhh4CthPJxCyUgodSfhZuxgFxTLJKS44PaIjmySFMOXMFIYctUKe/PQuYme+\nWDuVEMdNDeZ2DilyccLx/tz8lndBlomEh5OFpEXJUE0e5ayDCe5aLdMGrmpYwirq\niTPzrIntRDJa6efROuC59oQPNwBJI69f4JzoJMSOFMWF6abfb4Z+7q09M4eZDTX7\nbbef8r/fhqeDT9lhsJDQMBIxb8amtFgVeXmItxvBpNJcjNuwrhHulYdzcoW4cEJa\nCc2gC2NY8ccUmZx4SYhlfNNR5ByioVIUkSLJn/5lqCECgYEA/AC7FiSLXNzAi9BC\nxmwe/hX4Z1GC8xB4quF46mtVUxl1HZ2aJxyOfLti3qOua8qiKCrIuwN7QfWwQehh\nIRX7KQYFdIBurqa50UXYuDByVdaxZQ0bVWmWn2qKVpCOCJ9zGHcQYMO1nVAqpS5v\nMdg15OadMtqym2FaP75VJD2sC88CgYEA5pjQ+ixMIENFWTxS+wEeRbfVk7/A9GS2\nV9ju7G3eWJXqq+ocTy9HgzJJ8nK3DRUHxc57q1VZ4vItv7PO7cCdxHGEmN4rDsRE\nMiO2z2xh8i5hfuf77vE6AjYjqXXCKUm6KmEU59335U+FCqMaFD2YpgMvSo5tsJua\nkSQJwWKZausCgYEAzEa3YWKsSdF0j6F5j6jzkpoyq2Xq1afDeRmez7/EAcHAKwqn\nfA7s/fVUVw+uAxjWS+MqplZTIwvLHhIGMjDEUOPdpiu6DP9/30FURTKYbDbFxBlU\nz+7wtzdA/pzdVeYTAYD6mMXswaHLf+zdHDWcsnmychfP8p5+7u8Vy3PmtAcCgYAr\nyecdKp5GHiAkIuVrDrpN6Ovgw7ADeMB7jBFKyk5HqihG/wzjKIo+6qTKKmiCTnUM\nZfpr/ag1BWIUnjN0SHhtHlVcpgutIS4GC2wilWVAFPikna7kn+AxHVDGVDtLldmJ\nRKgwo6D4ZZJRA8nnAA9lrwMi+EryF4pRd3N2yp9xgwKBgQCHuLSaVEUoKtgG63Eh\ngdUTieBhHjIcrXCg5jMi5w1ABW9kX7JPj7R4PqJ5lRk52E3Cji3VnqKzt+TH7Nkk\n5KnKAdlR3RFO694YcnhuWefMKTN0mMJN6X7YUYqhyQyj+jvsgngSr5qPcZdJFzrg\nLoW5px7Vzkws+Fcbojb3Iu0HVQ==\n-----END PRIVATE KEY-----\n');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'chatapp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-25  0:23:17
