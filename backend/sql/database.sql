/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  24/10/2023 17:09:29                      */
/*==============================================================*/

drop table if exists CONTIENIR;

drop table if exists ALLERGIE;

drop table if exists CONSOMMER;

drop table if exists PERSONNE;

drop table if exists ALIMENT;

drop table if exists REGIME_ALIMENTAIRE;

/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   ID_ALIMENT           BIGINT,
   ID_REGIME            int null,
   NOM                  char(63) not null,
   IMAGE_URL            varchar(255),
   TYPE                 smallint,
   GLUCIDE              decimal(7,3),
   ENERGIE              decimal(7,3),
   GRAS                 decimal(7,3),
   FIBRE                decimal(7,3),
   PROTEINE             decimal(7,3),
   SEL                  decimal(7,3),
   GRAISSES_SATUREES    decimal(7,3),
   SUCRE                decimal(7,3),
   BICARBONATE          decimal(7,3),
   CALCIUM              decimal(7,3),
   CHLORURE             decimal(7,3),
   FLUOR                decimal(7,3),
   MAGNESIUM            decimal(7,3),
   NITRATE              decimal(7,3),
   POTASSIUM            decimal(7,3),
   SILICE               decimal(7,3),
   SODIUM               decimal(7,3),
   SULFATE              decimal(7,3),
   primary key (ID_ALIMENT)
);

/*==============================================================*/
/* Table : ALLERGIE                                             */
/*==============================================================*/
create table ALLERGIE
(
   LOGIN                char(63) not null,
   ID_ALIMENT           BIGINT,
   primary key (LOGIN, ID_ALIMENT)
);

/*==============================================================*/
/* Table : CONSOMMER                                            */
/*==============================================================*/
create table CONSOMMER
(
   LOGIN                char(63) not null,
   ID_ALIMENT           BIGINT,
   QUANTITE             decimal(15,2) not null,
   primary key (LOGIN, ID_ALIMENT)
);

/*==============================================================*/
/* Table : CONTIENIR                                            */
/*==============================================================*/
create table CONTIENIR
(
   ID_ALIMENT           BIGINT,
   ALI_ID_ALIMENT       BIGINT,
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

