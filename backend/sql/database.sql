/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  24/10/2023 17:09:29                      */
/*==============================================================*/


drop table if exists ALIMENT;

drop table if exists ALLERGIE;

drop table if exists CONSOMMER;

drop table if exists CONTIENIR;

drop table if exists PERSONNE;

drop table if exists REGIME_ALIMENTAIRE;

/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   ID_ALIMENT           BIGINT,
   ID_REGIME            int not null,
   NOM                  char(63) not null,
   IMAGE_URL            varchar(255),
   TYPE                 smallint,
   GLUCIDE              decimal(30,15),
   ENERGIE              decimal(30,15),
   GRAS                 decimal(30,15),
   FIBRE                decimal(30,15),
   PROTEINE             decimal(30,15),
   SEL                  decimal(30,15),
   GRAISSES_SATUREES    decimal(30,15),
   SUCRE                decimal(30,15),
   BICARBONATE          decimal(30,15),
   CALCIUM              decimal(30,15),
   CHLORURE             decimal(30,15),
   FLUOR                decimal(30,15),
   MAGNESIUM            decimal(30,15),
   NITRATE              decimal(30,15),
   POTASSIUM            decimal(30,15),
   SILICE               decimal(30,15),
   SODIUM               decimal(30,15),
   SULFATE              decimal(30,15),
   primary key (ID_ALIMENT)
);

/*==============================================================*/
/* Table : ALLERGIE                                             */
/*==============================================================*/
create table ALLERGIE
(
   LOGIN                char(63) not null,
   ID_ALIMENT           int not null,
   primary key (LOGIN, ID_ALIMENT)
);

/*==============================================================*/
/* Table : CONSOMMER                                            */
/*==============================================================*/
create table CONSOMMER
(
   LOGIN                char(63) not null,
   ID_ALIMENT           int not null,
   QUANTITE             decimal(15,2) not null,
   primary key (LOGIN, ID_ALIMENT)
);

/*==============================================================*/
/* Table : CONTIENIR                                            */
/*==============================================================*/
create table CONTIENIR
(
   ID_ALIMENT           int not null,
   ALI_ID_ALIMENT       int not null,
   POURCENTAGE          smallint not null,
   primary key (ID_ALIMENT, ALI_ID_ALIMENT)
);

/*==============================================================*/
/* Table : PERSONNE                                             */
/*==============================================================*/
create table PERSONNE
(
   LOGIN                char(63) not null,
   ID_REGIME            int not null,
   PASSWORD             char(63) not null,
   SEXE                 smallint,
   ADMIN                bool not null,
   MAIL                 char(63) not null,
   AGE                  smallint,
   SPORT                smallint,
   primary key (LOGIN)
);

/*==============================================================*/
/* Table : REGIME_ALIMENTAIRE                                   */
/*==============================================================*/
create table REGIME_ALIMENTAIRE
(
   ID_REGIME            int not null,
   VEGETARIEN           bool,
   VEGAN                bool,
   PESCETARIEN          bool,
   primary key (ID_REGIME)
);

alter table ALIMENT add constraint FK_RESPECTER foreign key (ID_REGIME)
      references REGIME_ALIMENTAIRE (ID_REGIME) on delete restrict on update restrict;

alter table ALLERGIE add constraint FK_ALLERGIE foreign key (LOGIN)
      references PERSONNE (LOGIN) on delete restrict on update restrict;

alter table ALLERGIE add constraint FK_ALLERGIE2 foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table CONSOMMER add constraint FK_CONSOMMER foreign key (LOGIN)
      references PERSONNE (LOGIN) on delete restrict on update restrict;

alter table CONSOMMER add constraint FK_CONSOMMER2 foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table CONTIENIR add constraint FK_CONTIENIR foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table CONTIENIR add constraint FK_CONTIENIR2 foreign key (ALI_ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update restrict;

alter table PERSONNE add constraint FK_SUIVRE foreign key (ID_REGIME)
      references REGIME_ALIMENTAIRE (ID_REGIME) on delete restrict on update restrict;

