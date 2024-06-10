[![IPS-Version](https://img.shields.io/badge/Symcon_Version-6.0+-red.svg)](https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/)
![Code](https://img.shields.io/badge/Code-PHP-blue.svg)
[![License](https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-green.svg)](https://creativecommons.org/licenses/by-nc-sa/4.0/)

## Dokumentation

**Inhaltsverzeichnis**

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Installation](#3-installation)
4. [Funktionsreferenz](#4-funktionsreferenz)
5. [Konfiguration](#5-konfiguration)
6. [Anhang](#6-anhang)
7. [Versions-Historie](#7-versions-historie)

## 1. Funktionsumfang

Berechnung der Entfernung zwischen zwei geografischen Koordinaten.

## 2. Voraussetzungen

- IP-Symcon ab Version 7.0

## 3. Installation

### a. Installation des Moduls

Im [Module Store](https://www.symcon.de/service/dokumentation/komponenten/verwaltungskonsole/module-store/) ist das Modul unter dem Suchbegriff *GeoDistance* zu finden.<br>
Alternativ kann das Modul über [Module Control](https://www.symcon.de/service/dokumentation/modulreferenz/module-control/) unter Angabe der URL `https://github.com/demel42/IPSymconGeoDistance` installiert werden.

### b. Einrichtung in IPS

## 4. Funktionsreferenz

`GeoDistance_Calc(string $InstanzID, array $cur_loc, array $home_loc = null)`<br>
Berechnet den Abstand der beiden Koordinaten.

_loc_ enthält die Angabe von Breiten- und Längengrad; ist _home_loc_ gleich **null**, wird die Position aus der _Location_-Instanz verwendet.

Beispiel:
```
$dist = GeoDistance_Calc(50148, ['latitude' => 51.460924, 'longitude' => 7.158265], null);
```

## 5. Konfiguration

### GeoDistance

die Instanz hat keine Einstellungen oder Aktionen

## 6. Anhang

### GUIDs
- Modul: `{7A135929-CE1A-9C4A-A74A-8E9C427D6FBA}`
- Instanzen:
  - GeoDistance: `{DF7B375A-83ED-329E-B9D3-2D4240E5F99D}`
- Nachrichten:

### Quellen

## 7. Versions-Historie

- 1.0 @ 10.06.2024 08:15
  - Initiale Version
