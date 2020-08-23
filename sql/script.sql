CREATE DATABASE LSPD_Osmoze_RP;

CREATE TABLE compte_lspd (
    id int(11) NOT NULL AUTO_INCREMENT,
    utilisateur varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    motdepasse text CHARACTER SET utf8,
    grade int(11) DEFAULT NULL,
    matricule int(11) DEFAULT NULL,
    rh int(11) DEFAULT NULL,
    isadmin int(11) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO compte_lspd VALUES (1, 'Bollin0', '7e2feac95dcd7d1df803345e197369af4b156e4e7a95fcb2955bdbbb3a11afd8bb9d35931bf15511370b18143e38b01b903f55c5ecbded4af99934602fcdf38c', 15, 24, 0, 1);

CREATE TABLE log_panel (
  id int(11) NOT NULL AUTO_INCREMENT,
  utilisateur text CHARACTER SET utf8,
  historique text CHARACTER SET utf8,
  quand varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE casier (
    id int(11) NOT NULL AUTO_INCREMENT,
    quand varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    utilisateur varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    matri int(11) DEFAULT NULL,
    grade varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    lieu varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    nom_crim varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    date_de_naissance varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    sexe varchar(2) CHARACTER SET utf8 DEFAULT NULL,
    taille int(11) DEFAULT NULL,
    piece_id text CHARACTER SET utf8, 
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE avis_de_recherche (
    id int(11) NOT NULL AUTO_INCREMENT,
    quand varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    utilisateur varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    matri int(11) DEFAULT NULL,
    grade varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    nom_crim varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    sexe varchar(2) CHARACTER SET utf8 DEFAULT NULL,
    pourquoi text CHARACTER SET utf8,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE infraction (
    id int(11) NOT NULL AUTO_INCREMENT,
    nom_crim varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    quand varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    utilisateur varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    matri int(11) DEFAULT NULL,
    grade varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    infra varchar(255) CHARACTER SET utf8 DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE rapport (
    id int(11) NOT NULL AUTO_INCREMENT,
    quand varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    lieu varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    utilisateur varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    matri int(11) DEFAULT NULL,
    grade varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    nom_crim text CHARACTER SET utf8,
    maison_crim text CHARACTER SET utf8,
    qst_1 text CHARACTER SET utf8,
    rep_1 text CHARACTER SET utf8,
    qst_2 text CHARACTER SET utf8,
    rep_2 text CHARACTER SET utf8,
    qst_3 text CHARACTER SET utf8,
    rep_3 text CHARACTER SET utf8,
    qst_4 text CHARACTER SET utf8,
    rep_4 text CHARACTER SET utf8,
    qst_5 text CHARACTER SET utf8,
    rep_5 text CHARACTER SET utf8,
    rap_situ text CHARACTER SET utf8,
    preuve text CHARACTER SET utf8,
    etat int(11) DEFAULT NULL,
    signa text CHARACTER SET utf8,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE plainte (
    id int(11) NOT NULL AUTO_INCREMENT,
    quand varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    utilisateur varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    matri int(11) DEFAULT NULL,
    grade varchar(50) CHARACTER SET utf8 DEFAULT NULL,
    lieu varchar(100) CHARACTER SET utf8 DEFAULT NULL,
    victime text CHARACTER SET utf8,
    tel_victime text CHARACTER SET utf8,
    suspect text CHARACTER SET utf8,
    tel_suspect text CHARACTER SET utf8,
    des_info_suspect text CHARACTER SET utf8,
    vers_victime text CHARACTER SET utf8,
    vers_suspect text CHARACTER SET utf8,
    preuve text CHARACTER SET utf8,
    etat int(11) DEFAULT NULL,
    signa text CHARACTER SET utf8,
    PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;