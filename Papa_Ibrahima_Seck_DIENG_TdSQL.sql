#------------------------------------------------------------------------------------------------------------
# 1.	Donnez le numéro, le nom de tous les médecins ayant la spécialité S1
SELECT idMed, nomMed
FROM `medecin`
WHERE specialite = "S1"
LIMIT 0 , 30

#-------------------------------------------------------------------------------------------------------------
# 2.	Donnez les différentes spécialités.
SELECT DISTINCT specialite
FROM medecin

#--------------------------------------------------------------------------------------------------------------
# 3.	Donnez le numéro, le nom et la date de naissance de tous les malades de sexe
#masculin par ordre croissant de l’âge
SELECT idPatient, nom, dateNaissance
FROM `patient`
WHERE sexe = "M"
ORDER BY dateNaissance DESC

#-------------------------------------------------------------------------------------------------------------
# 4.	Donnez le numéro, le nom et la date de naissance de tous les malades de sexe
#féminin dont l’adresseesse contient « p » par ordre croissant du nom.

SELECT idPatient, nom, dateNaissance
FROM `patient`
WHERE sexe = "F"
AND adresseesse LIKE '%p%'
ORDER BY nom ASC

#---------------------------------------------------------------------------------------------------------------
#5.	Donnez le numéro, le nom et la date de naissance du malade ainsi que le numéro, la catégorie 
# et le type de la chambre occupé par chaque malade.
SELECT patient.idPatient, patient.nom, patient.dateNaissance, chambre.idChambre, chambre.categorie,chambre.typeChambre
FROM patient,chambre,occuper,lit
WHERE patient.idPatient=occuper.idPatient
AND occuper.idLit=lit.idLit
AND lit.idChambre = chambre.idChambre

#---------------------------------------------------------------------------------------------------------------
#6.	Donnez le numéro, le nom et la date de naissance du malade ainsi que le numéro et 
#le des départements où le malade né le 22-4-2012 ont été internés. 
SELECT DISTINCT patient.idPatient, patient.nom, patient.dateNaissance, departement.idDepartement, departement.nom
FROM patient, departement, interner
WHERE patient.idPatient = interner.idPatient
AND departement.idDepartement=interner.idDepartement
AND patient.dateNaissance = "2012-04-22"

#------------------------------------------------------------------------------------------------------------------------------------------------------------------
#7.	Donnez le numéro, le nom et la date de naissance de tous les malades suivis par le médecin M3
SELECT DISTINCT patient.idPatient, patient.nom, patient.dateNaissance
FROM patient, medecin, suivre
WHERE medecin.idMedecin=suivre.idMedecin
AND patient.idPatient=suivre.idPatient
AND medecin.nomMed="M3"

#------------------------------------------------------------------------------------------------------------------------------------------------------------------
#8.	Donnez le numéro, le nom et la date de naissance de tous les malades suivis par le médecin M3 et qui ont occupé le lit numéro 21.
SELECT DISTINCT patient.idPatient, patient.nom, patient.dateNaissance
FROM patient, lit, occuper,suivre,medecin
WHERE patient.idPatient = occuper.idPatient
AND lit.idLit = occuper.idLit
AND suivre.idMedecin=medecin.idMedecin
AND suivre.idPatient=patient.idPatient
AND medecin.nomMed="M3"
AND lit.idLit=21
LIMIT 0 , 30


#------------------------------------------------------------------------------------------------------------------------------------------------------------------
#9.	Donnez le numéro, le nom et la date de naissance de tous les malades qui ont occupé le lit numéro 21.

SELECT DISTINCT patient.idPatient, patient.nom, patient.dateNaissance
FROM patient, lit, occuper
WHERE patient.idPatient = occuper.idPatient
AND lit.idLit = occuper.idLit
AND lit.idLit=21
LIMIT 0 , 30


#------------------------------------------------------------------------------------------------------------------------------------------------------------------
#10.Donnez le numéro, le nom et la date de naissance du malade ainsi que le numéro et la date pour le suivit de l’évolution du malade numéro 11.

SELECT patient.idPatient, patient.nom, patient.dateNaissance,interner.numeroFeuille,interner.date
FROM patient,interner
WHERE patient.idPatient = interner.idPatient
AND patient.nom ="Malade11"

#------------------------------------------------------------------------------------------------------------------------------------------------------------------
#11.	Donnez le nombre de malades internés dans chaque département.

SELECT COUNT( interner.idDep ) AS nombre, nom
FROM interner, departement
WHERE interner.idDep = departement.idDep
GROUP BY nom

##------------------------------------------------------------------------------------------------------------------------------------------------------------------
# 12 Donnez le numéro, le nom, l’adresseesse du malade ainsi que le nom du médecin de tous les malades suivis par un médecin du département D2.

SELECT patient.idPatient, patient.nom, patient.adresse, medecin.nomMed
FROM patient, medecin, departement, suivre
WHERE suivre.idMedecin = medecin.idMedecin
AND patient.idPatient = suivre.idPatient
AND medecin.idDep = departement.idDep
AND departement.nom ="M2"

#------------------------------------------------------------------------------------------------------------------------------------------------------------------
# 13 Donnez le numéro, le nom, l’adresseesse de tous les malades qui ont été internés au mois de février ou au mois de décembre.

SELECT DISTINCT patient.idPatient, patient.nom, patient.adresse
FROM patient, interner,interner
WHERE patient.idPatient = interner.idPatient
AND patient.idPatient=interner.idPatient
AND (MONTH( interner.date ) =12 OR MONTH( interner.date ) =02)

#-----------------------------------------------------------------------------------------------------------------------------------------------------------------
# 14  Donnez toutes les informations de la chambre ayant accueilli le plus de malade.

SELECT COUNT( chambre.idChambre ) AS nombre, chambre.idChambre, chambre.categorie, chambre.typeChambre,chambre.idDep
FROM lit, chambre, patient, occuper
WHERE lit.idChambre = chambre.idChambre
AND occuper.idPatient = patient.idPatient
AND occuper.idLit = lit.idLit
GROUP BY chambre.idChambre
ORDER BY nombre DESC
LIMIT 1

#
#15.Donnez toutes les informations du département ayant accueilli le plus de malade.


#-----------------------------------------------------------------------------------------------------------------------------------------------------------------
#16.Donnez toutes les informations de la chambre ayant accueilli le plus de malade.

SELECT COUNT( lit.idLit ) AS nombre, lit.idLit, lit.idChambre
FROM lit, patient, occuper
WHERE occuper.idPatient = patient.idPatient
AND occuper.idLit = lit.idLit
GROUP BY lit.idLit
ORDER BY nombre DESC
LIMIT 1

#-----------------------------------------------------------------------------------------------------------------------------------------------------------------
#17.Donnez toutes les informations du médecin ayant suivi le plus de malade.
SELECT COUNT( medecin.idMedecin ) AS nombre, medecin.idMedecin, nomMed, specialite, departement.idDep
FROM departement, medecin, patient, suivre
WHERE medecin.idDep = departement.idDep
AND suivre.idPatient = patient.idPatient
AND suivre.idMedecin = medecin.idMedecin
GROUP BY medecin.idMedecin
ORDER BY nombre DESC
LIMIT 1

#-----------------------------------------------------------------------------------------------------------------------------------------------------------------
# 18.Donnez le numéro, le nom et la date de naissance du malade, le numéro de la chambre et le numéro du lit des patients 
#qui son suivi par un médecin avec la spécialité S2

SELECT patient.idPatient, patient.nom, patient.dateNaissance, chambre.idChambre, lit.idLit
FROM patient, lit, chambre, suivre, medecin, occuper
WHERE suivre.idMedecin = medecin.idMedecin
AND suivre.idPatient = patient.idPatient
AND occuper.idLit = lit.idLit
AND occuper.idPatient = patient.idPatient
AND medecin.specialite = "S2"
AND lit.idChambre=chambre.idChambre
LIMIT 0 , 30


#-----------------------------------------------------------------------------------------------------------------------------------------------------------------
#19.Donnez l’évolution du premier malade qui à été interné au département D2 en juin 2020
SELECT numeroFeuille, date
FROM interner, interner, departement, patient
WHERE departement.nom = "D2"
AND departement.idDep = interner.idDep
AND patient.idPatient = interner.idPatient
AND interner.idPatient = patient.idPatient
AND interner.idDep = departement.idDep
AND (MONTH( interner.date ) =06 AND YEAR( interner.date ) =2020)
ORDER BY date ASC LIMIT 1

##-----------------------------------------------------------------------------------------------------------------------------------------------------------------
# 20

-- SELECT * FROM lit
-- WHERE idLit NOT IN (SELECT idLit FROM occuper) 











