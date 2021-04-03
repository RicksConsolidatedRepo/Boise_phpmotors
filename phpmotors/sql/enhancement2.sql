/* Step 1 */
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) 
  VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, 'I am the real Ironman');
/* Step 2 */
UPDATE clients SET clientLevel = 3 WHERE clientLevel = 1;
/* Step 3 */
UPDATE inventory
SET invDescription = REPLACE(invDescription, "small interior", "spacious interior")
WHERE invId = 12;
/* Step 4 */
SELECT invModel, classificationName
FROM inventory
INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationId = 1;
/* Step 5 */
DELETE FROM inventory WHERE invId = 1;
/* Step 6 */
UPDATE inventory
SET invImage = CONCAT("/phpmotors", invImage), invThumbnail = CONCAT("/phpmotors", invThumbnail);