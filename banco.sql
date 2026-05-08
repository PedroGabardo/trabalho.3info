CREATE DATABASE IF NOT EXISTS duel_commander
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE duel_commander;

CREATE TABLE IF NOT EXISTS decks (
  id         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  comandante VARCHAR(100)    NOT NULL,
  link       VARCHAR(500)    NOT NULL,
  standings  VARCHAR(20)     NOT NULL,
  posicao    SMALLINT UNSIGNED NOT NULL,
  arquetipo  ENUM('midrange','aggro','controle','combo') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
