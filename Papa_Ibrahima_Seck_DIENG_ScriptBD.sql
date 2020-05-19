/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  16/05/2020 21:12:47                      */
/*==============================================================*/


drop table if exists CHAMBRE;

drop table if exists DEPARTEMENT;

drop table if exists INTERNER;

drop table if exists LIT;

drop table if exists MEDECIN;

drop table if exists OCCUPER;

drop table if exists PATIENT;

drop table if exists SUIVRE;

/*==============================================================*/
/* Table : CHAMBRE                                              */
/*==============================================================*/
create table CHAMBRE
(
   IDCHAMBRE            int not null,
   CATEGORIE            longtext,
   TYPECHAMBRE          varchar(25),
   primary key (IDCHAMBRE)
);

/*==============================================================*/
/* Table : DEPARTEMENT                                          */
/*==============================================================*/
create table DEPARTEMENT
(
   IDDEP                int not null,
   NOM                  varchar(50),
   primary key (IDDEP)
);

/*==============================================================*/
/* Table : INTERNER                                             */
/*==============================================================*/
create table INTERNER
(
   IDPATIENT            int not null,
   IDDEP                int not null,
   NUMEROFEUILLE        int,
   DATE                 date not null,
   primary key (IDPATIENT, IDDEP),
   key AK_IDENTIFIANT_1 (IDPATIENT, IDDEP),
   key AK_IDENTIFIANT_2 (IDPATIENT, IDDEP, DATE)
);

/*==============================================================*/
/* Table : LIT                                                  */
/*==============================================================*/
create table LIT
(
   IDLIT                int not null,
   IDCHAMBRE            int not null,
   primary key (IDLIT)
);

/*==============================================================*/
/* Table : MEDECIN                                              */
/*==============================================================*/
create table MEDECIN
(
   IDMED                int not null,
   IDDEP                int not null,
   NOMMED               varchar(25),
   SPECIALITE           varchar(25),
   primary key (IDMED)
);

/*==============================================================*/
/* Table : OCCUPER                                              */
/*==============================================================*/
create table OCCUPER
(
   IDPATIENT            int not null,
   IDLIT                int not null,
   DATE                 date not null,
   primary key (IDPATIENT, IDLIT, DATE),
   key AK_IDENTIFIANT_1 (IDPATIENT, IDLIT)
);

/*==============================================================*/
/* Table : PATIENT                                              */
/*==============================================================*/
create table PATIENT
(
   IDPATIENT            int not null,
   NOM                  varchar(50),
   ADRESSE              varchar(50),
   SEXE                 varchar(15),
   DATENAISSANCE        date,
   LIEUNAISSANCE        longtext,
   primary key (IDPATIENT)
);

/*==============================================================*/
/* Table : SUIVRE                                               */
/*==============================================================*/
create table SUIVRE
(
   IDMED                int not null,
   IDPATIENT            int not null,
   DATE                 date,
   primary key (IDMED, IDPATIENT)
);

alter table INTERNER add constraint FK_INTERNER foreign key (IDDEP)
      references DEPARTEMENT (IDDEP) on delete restrict on update restrict;

alter table INTERNER add constraint FK_INTERNER2 foreign key (IDPATIENT)
      references PATIENT (IDPATIENT) on delete restrict on update restrict;

alter table LIT add constraint FK_SETROUVER foreign key (IDCHAMBRE)
      references CHAMBRE (IDCHAMBRE) on delete restrict on update restrict;

alter table MEDECIN add constraint FK_AFFECTER foreign key (IDDEP)
      references DEPARTEMENT (IDDEP) on delete restrict on update restrict;

alter table OCCUPER add constraint FK_OCCUPER foreign key (IDLIT)
      references LIT (IDLIT) on delete restrict on update restrict;

alter table OCCUPER add constraint FK_OCCUPER2 foreign key (IDPATIENT)
      references PATIENT (IDPATIENT) on delete restrict on update restrict;

alter table SUIVRE add constraint FK_SUIVRE foreign key (IDPATIENT)
      references PATIENT (IDPATIENT) on delete restrict on update restrict;

alter table SUIVRE add constraint FK_SUIVRE2 foreign key (IDMED)
      references MEDECIN (IDMED) on delete restrict on update restrict;

