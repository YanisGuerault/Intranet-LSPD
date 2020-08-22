CREATE DATABASE LSPD_Osmoze_RP;

CREATE TABLE compte_lspd (
    id INTEGER not null AUTO_INCREMENT,
    utilisateur VARCHAR(50),
    motdepasse text,
    grade INTEGER,
    matricule INTEGER,
    rh INTEGER,
    isadmin INTEGER,
    PRIMARY KEY (id)
);

INSERT INTO compte_lspd VALUES (1, 'Bollin0', '7e2feac95dcd7d1df803345e197369af4b156e4e7a95fcb2955bdbbb3a11afd8bb9d35931bf15511370b18143e38b01b903f55c5ecbded4af99934602fcdf38c', 15, 24, 0, 1);

CREATE TABLE log_panel (
    id INTEGER not null AUTO_INCREMENT,
    utilisateur text,
    historique text,
    quand VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE casier (
    id INTEGER not null AUTO_INCREMENT,
    quand VARCHAR(100),
    utilisateur VARCHAR(50),
    matri INTEGER,
    grade VARCHAR(50),
    lieu VARCHAR(100),
    nom_crim VARCHAR(50),
    date_de_naissance VARCHAR(50),
    sexe VARCHAR(2),
    taille INTEGER,
    piece_id text,
    PRIMARY KEY (id)
);

CREATE TABLE avis_de_recherche (
    id INTEGER not null AUTO_INCREMENT,
    quand VARCHAR(100),
    utilisateur VARCHAR(50),
    matri INTEGER,
    grade VARCHAR(50),
    nom_crim VARCHAR(50),
    sexe VARCHAR(2),
    pourquoi text,
    PRIMARY KEY (id)
);

CREATE TABLE infraction (
    id INTEGER not null AUTO_INCREMENT,
    nom_crim VARCHAR(100),
    quand VARCHAR(100),
    utilisateur VARCHAR(50),
    matri INTEGER,
    grade VARCHAR(50),
    infra VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE rapport (
    id INTEGER not null AUTO_INCREMENT,
    quand VARCHAR(100),
    lieu VARCHAR(100),
    utilisateur VARCHAR(50),
    matri INTEGER,
    grade VARCHAR(50),
    nom_crim text,
    maison_crim text,
    qst_1 text,
    rep_1 text,
    qst_2 text,
    rep_2 text,
    qst_3 text,
    rep_3 text,
    qst_4 text,
    rep_4 text,
    qst_5 text,
    rep_5 text,
    rap_situ text,
    preuve text,
    etat INTEGER,
    signa text,
    PRIMARY KEY (id)
);

CREATE TABLE plainte (
    id INTEGER not null AUTO_INCREMENT,
    quand VARCHAR(100),
    utilisateur VARCHAR(50),
    matri INTEGER,
    grade VARCHAR(50),
    lieu VARCHAR(100),
    victime text,
    tel_victime text,
    suspect text,
    tel_suspect text,
    des_info_suspect text,
    vers_victime text,
    vers_suspect text,
    preuve text,
    etat INTEGER,
    signa text,
    PRIMARY KEY (id)
);