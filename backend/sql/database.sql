/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  24/10/2023 17:09:29                      */
/*==============================================================*/

drop table if exists CONTENIR;

drop table if exists CONSOMMER;

drop table if exists PERSONNE;

drop table if exists ALIMENT;

drop table if exists REGIME_ALIMENTAIRE;

/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   ID_ALIMENT           BIGINT AUTO_INCREMENT,
   ID_REGIME            int null,
   NOM                  char(63) not null,
   IMAGE_URL            varchar(255),
   TYPE                 smallint,
   GLUCIDE              decimal(7,3) null,
   ENERGIE              decimal(7,3) null,
   GRAS                 decimal(7,3) null,
   FIBRE                decimal(7,3) null,
   PROTEINE             decimal(7,3) null,
   SEL                  decimal(7,3) null,
   GRAISSES_SATUREES    decimal(7,3) null,
   SUCRE                decimal(7,3) null,
   BICARBONATE          decimal(7,3) null,
   CALCIUM              decimal(7,3) null,
   CHLORURE             decimal(7,3) null,
   FLUOR                decimal(7,3) null,
   MAGNESIUM            decimal(7,3) null,
   NITRATE              decimal(7,3) null,
   POTASSIUM            decimal(7,3) null,
   SILICE               decimal(7,3) null,
   SODIUM               decimal(7,3) null,
   SULFATE              decimal(7,3) null,
   primary key (ID_ALIMENT)
);

/*==============================================================*/
/* Table : CONSOMMER                                            */
/*==============================================================*/
create table CONSOMMER
(
   ID_CONSOMMATION      int AUTO_INCREMENT,
   LOGIN                char(63) not null,
   ID_ALIMENT           BIGINT,
   QUANTITE             decimal(15,2),
   DATE_CONSOMMATION    DATE,
   primary key (ID_CONSOMMATION)
);

/*==============================================================*/
/* Table : CONTENIR                                            */
/*==============================================================*/
create table CONTENIR
(
   ID_ALIMENT           BIGINT,
   ALI_ID_ALIMENT       BIGINT,
   POIDS          smallint not null,
   primary key (ID_ALIMENT, ALI_ID_ALIMENT)
);

/*==============================================================*/
/* Table : PERSONNE                                             */
/*==============================================================*/
create table PERSONNE
(
   LOGIN                char(63) not null,
   ID_REGIME            int null,
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
      references REGIME_ALIMENTAIRE (ID_REGIME) on delete restrict on update cascade;

alter table CONSOMMER add constraint FK_CONSOMMER foreign key (LOGIN)
      references PERSONNE (LOGIN) on delete restrict on update cascade;

alter table CONSOMMER add constraint FK_CONSOMMER2 foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update cascade;

alter table CONTENIR add constraint FK_CONTENIR foreign key (ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update cascade;

alter table CONTENIR add constraint FK_CONTENIR2 foreign key (ALI_ID_ALIMENT)
      references ALIMENT (ID_ALIMENT) on delete restrict on update cascade;

alter table PERSONNE add constraint FK_SUIVRE foreign key (ID_REGIME)
      references REGIME_ALIMENTAIRE (ID_REGIME) on delete restrict on update restrict;

INSERT INTO `regime_alimentaire` (`ID_REGIME`, `VEGETARIEN`, `VEGAN`, `PESCETARIEN`) VALUES
(1, 0, 0, 0),
(2, 0, 0, 1),
(3, 1, 0, 0),
(4, 0, 1, 0);

INSERT INTO `personne` (`LOGIN`, `ID_REGIME`, `PASSWORD`, `SEXE`, `ADMIN`, `MAIL`, `AGE`, `SPORT`) VALUES
('admin', NULL, 'admin_mdpcomplike', NULL, 1, '', NULL, NULL);

COMMIT;