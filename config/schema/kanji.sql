-- Kanji Database Schema
-- This schema is based on the kanji-mnemonic project
-- Database from: http://www.rtega.be/chmn/

CREATE DATABASE IF NOT EXISTS kanji;
USE kanji;

-- Main Kanji table
CREATE TABLE IF NOT EXISTS kanji (
  ucs VARCHAR(6) NOT NULL,
  kanji VARCHAR(8) NOT NULL,
  jlpt INT NULL,
  grade INT NULL,
  strokes INT NULL,
  data LONGTEXT NOT NULL,
  PRIMARY KEY (ucs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Kanji Meanings table
CREATE TABLE IF NOT EXISTS kanji_meanings (
  id INT AUTO_INCREMENT NOT NULL,
  ucs VARCHAR(6) NOT NULL,
  language VARCHAR(4) NOT NULL,
  meaning VARCHAR(128) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  KEY idx_ucs (ucs),
  KEY idx_language (language)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Kanji Readings table
CREATE TABLE IF NOT EXISTS kanji_readings (
  id INT AUTO_INCREMENT NOT NULL,
  ucs VARCHAR(6) NOT NULL,
  type VARCHAR(16) NOT NULL,
  reading VARCHAR(64) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  KEY idx_ucs (ucs),
  KEY idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Kanji Codes table
CREATE TABLE IF NOT EXISTS kanji_codes (
  id INT AUTO_INCREMENT NOT NULL,
  ucs VARCHAR(6) NOT NULL,
  section VARCHAR(16) NULL,
  type VARCHAR(16) NOT NULL,
  value VARCHAR(16) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  KEY idx_ucs (ucs),
  KEY idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Kanji Radicals table
CREATE TABLE IF NOT EXISTS kanji_radicals (
  id INT AUTO_INCREMENT NOT NULL,
  ucs VARCHAR(6) NOT NULL,
  kanji_grade INT NULL,
  kanji_strokes INT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  KEY idx_ucs (ucs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- IDS table
CREATE TABLE IF NOT EXISTS ids (
  ucs VARCHAR(10) NOT NULL,
  ids VARCHAR(64) NULL,
  PRIMARY KEY (ucs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Mnemonics table
CREATE TABLE IF NOT EXISTS mnemonics (
  id INT AUTO_INCREMENT NOT NULL,
  reference INT NOT NULL,
  mnemonic VARCHAR(512) NOT NULL,
  PRIMARY KEY (id),
  KEY idx_reference (reference)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Alike table (relationships between kanji)
CREATE TABLE IF NOT EXISTS alike (
  id INT AUTO_INCREMENT NOT NULL,
  ucs VARCHAR(6) NOT NULL,
  alike_ucs VARCHAR(6) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  FOREIGN KEY (alike_ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  KEY idx_ucs (ucs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- CHMN table (from the original source)
CREATE TABLE IF NOT EXISTS chmn (
  id INT AUTO_INCREMENT NOT NULL,
  ucs VARCHAR(6) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ucs) REFERENCES kanji(ucs) ON DELETE CASCADE,
  KEY idx_ucs (ucs)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
