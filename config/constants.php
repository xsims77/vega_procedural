<?php


/**
 * -------------------------------------------------------------------
 *                          Les constantes (Raccourci)
 * 
 * Les constantes représentent des raccourcis permettant d'accéder plus rapidement aux dossiers et fichiers * souhaités
 * -----------------------------------------------------------------------
 */


/**
 * Cette constante représente le raccourci permettant d'accéder à la racine du dossier vega-procédural
 */

 define("ROOT", dirname(__DIR__));



/**
 * Cette constante représente le raccouci permettant d'accéder au dossier de configuration
 */

const CONFIG = ROOT . "/config"; 



/**
 * Cette constante représente le raccouci permettant d'accéder au dossier de "src"
 */

const SRC = ROOT . "/src"; 


/**
 * Cette constante représente le raccouci permettant d'accéder au coeur de Vega
 */

const VEGA_CORE = ROOT . "/vegaCore"; 


/**
 * Cette constante représente le raccouci permettant d'accéder au dossier controller
 */
const CONTROLLER = ROOT . "/src/controller"; 


/**
 * Cette constante représente le raccouci permettant d'accéder au dossier des templates
 */
const TEMPLATES = ROOT . "/templates"; 


/**
 * Cette constante représente le raccouci permettant d'accéder au controller abstrait
 */
const ABSTRACT_CONTROLLER = ROOT . "/vegaCore/abstractController/abstractController.php"; 


/**
 * Cette constante représente le raccouci permettant d'accéder au validateur
 */
const VALIDATOR = VEGA_CORE . "/validation/validator.php"; 


/**
 * Cette constante représente le raccouci permettant d'accéder à la base de données
 */
const DB = CONFIG . "/database.php"; 


/**
 * Cette constante représente le raccouci permettant d'accéder aux managers
 */
const USER = SRC . "/manager/user.php"; 







