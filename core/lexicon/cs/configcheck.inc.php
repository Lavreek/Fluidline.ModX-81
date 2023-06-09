<?php
/**
 * Config Check English lexicon topic
 *
 * @language en
 * @package modx
 * @subpackage lexicon
 */
$_lang['configcheck_admin'] = 'Kontaktujte prosím administrátora systému a sdělte mu varování z této zprávy!';
$_lang['configcheck_allowtagsinpost_context_enabled'] = 'allow_tags_in_post povoleno v nastavení kontextu mimo `mgr`';
$_lang['configcheck_allowtagsinpost_context_enabled_msg'] = 'Nastavení kontextu allow_tags_in_post je povoleno v instalaci MODX mimo kontext mgr. MODX doporučuje toto nastavení zakázat pokud nepotřebujete, aby uživatelé MODX mohli posílat MODX značky, číselné entity nebo HTML skript tagy pomocí POST metody do formuláře. Toto by mělo být obecně zakázáno kromě kontextu mgr.';
$_lang['configcheck_allowtagsinpost_system_enabled'] = 'allow_tags_in_post povoleno v Konfiguraci systému';
$_lang['configcheck_allowtagsinpost_system_enabled_msg'] = 'Nastavení allow_tags_in_post v Konfiguraci systému System Setting je povoleno v instalaci MODX. MODX doporučuje toto nastavení zakázat pokud nepotřebujete, aby uživatelé MODX mohli posílat MODX značky, číselné entity nebo HTML skript tagy pomocí POST metody do formuláře. Je lepší tuto hodnotu aktivovat v rámci nastavení daných kontextů.';
$_lang['configcheck_cache'] = 'Do složky "cache" nelze zapisovat';
$_lang['configcheck_cache_msg'] = 'MODX nemůže zapisovat do složky "cache". MODX bude fungovat, ale nebude se provádět ukládání do cache. Pro vyřešení tohoto problému nastavte atributy složky "/cache/" pro zápis.';
$_lang['configcheck_configinc'] = 'Do konfiguračního souboru je stále možno zapisovat!';
$_lang['configcheck_configinc_msg'] = 'Váš portál je zranitelný hackery a mohlo by dojít k jeho poškození. Nastavte atributy konfiguračního souboru "[[+path]]" pouze pro čtení!';
$_lang['configcheck_default_msg'] = 'Bylo zjištěno nespecifikované varování. To je teda krapet divné.';
$_lang['configcheck_errorpage_unavailable'] = 'Chybová stránka Vašeho portálu není dostupná.';
$_lang['configcheck_errorpage_unavailable_msg'] = 'To znamená, že chybová stránka není dostupná pro návštěvníky webu nebo neexistuje. Může to vést k rekurzivní smyčce a mnoha chybám v chybových zprávách. Ujistěte se, že tu není žádná skupina webových uživatelů přiřazená k této stránce.';
$_lang['configcheck_errorpage_unpublished'] = 'Chybová stránka portálu není publikována nebo neexistuje.';
$_lang['configcheck_errorpage_unpublished_msg'] = 'Znamená, že chybová stránka není dostupná pro návštěvníky webu. Publikujte tuto stránku a ujistěte se, že je chybová stránka definována v menu "Systém &gt; Konfigurace systému".';
$_lang['configcheck_htaccess'] = 'Složka "core" je přístupná z webu';
$_lang['configcheck_htaccess_msg'] = 'MODX detected that your core folder is (partially) accessible to the public.
<strong>This is not recommended and a security risk.</strong>
If your MODX installation is running on a Apache webserver
you should at least set up the .htaccess file inside the core folder <em>[[+fileLocation]]</em>.
This can be easily done by renaming the existing .htaccess example file there to .htaccess.
<p>There are other methods and webservers you may use, please read the <a href="https://docs.modx.com/3.x/en/getting-started/maintenance/securing-modx">Hardening MODX Guide</a>
for further information about securing your site.</p>
If you setup everything correctly, browsing e.g. to the <a href="[[+checkUrl]]" target="_blank">Changelog</a>
should give you a 403 (permission denied) or better a 404 (not found). If you can see the changelog
there in the browser, something is still wrong and you need to reconfigure or call an expert to solve this.';
$_lang['configcheck_images'] = 'Do složky pro obrázky nelze zapisovat';
$_lang['configcheck_images_msg'] = 'Složka pro obrázky je pouze pro čtení nebo neexistuje. To znamená, že správce obrázků nebude pracovat správně!';
$_lang['configcheck_installer'] = 'Instalátor stále existuje!';
$_lang['configcheck_installer_msg'] = 'The setup/ directory contains the installer for MODX. Just imagine what might happen if an evil person finds this folder and runs the installer! They probably won\'t get too far, because they\'ll need to enter some user information for the database, but it\'s still best to delete this folder from your server. It is located at: [[+path]]';
$_lang['configcheck_lang_difference'] = 'Nesprávný počet záznamů v jazykovém souboru';
$_lang['configcheck_lang_difference_msg'] = 'Aktuálně vybraný jazyk má rozdílný počet záznamů než výchozí jazyk angličtina. Mělo by dojít k aktualizaci jazykového souboru pro tuto verzi MODX.';
$_lang['configcheck_notok'] = 'Jeden nebo více konfiguračních údajů není správně nastaveno: ';
$_lang['configcheck_phpversion'] = 'Verze PHP je zastaralá';
$_lang['configcheck_phpversion_msg'] = 'Vaše verze PHP [[+phpversion]] již není vyvíjena vývojáři PHP, což znamená, že nejsou k dispozici žádné aktualizace zabezpečení. Je rovněž pravděpodobné, že MODX nebo některý z balíčků již dnes nebo v blízké budoucnosti nebude podporovat tuto verzi. Prosím aktualizujte své prostředí na serveru alespoň na verzi PHP [[+phprequired]] co nejdříve.';
$_lang['configcheck_register_globals'] = 'register_globals v php.ini je nastaveno na ON';
$_lang['configcheck_register_globals_msg'] = 'Díky tomtuto nastavení je Váš portál mnohem více náchylný k hackerským útokům typu Cross Site Scripting (XSS). Měli by jste pohovořit se svým poskytovatelem hostingu a zjistit co je možné udělat k deaktivaci tohoto nastavení.';
$_lang['configcheck_title'] = 'Kontrola nastavení';
$_lang['configcheck_unauthorizedpage_unavailable'] = 'Stránko o neautorizovaném přístupu není publikována nebo neexistuje.';
$_lang['configcheck_unauthorizedpage_unavailable_msg'] = 'To znamená, že stránka o neautorizovaném přístupu není dostupná pro návštěvníky webu nebo neexistuje. To může vést k rekurzivní smyčce a mnoha chybám v chybových zprávách. Ujistěte se, že tu není žádná skupina webových uživatelů přiřazená k této stránce.';
$_lang['configcheck_unauthorizedpage_unpublished'] = 'Stránka o neautorizovaném přístupu definovaná v nastavení portálu není publikována.';
$_lang['configcheck_unauthorizedpage_unpublished_msg'] = 'To znamená, že stránka o neautorizovaném přístupu není dostupná pro návštěvníky webu. Publikujte stránku a ujistěte se, že je tato stránka definována v menu "Systém &gt; Konfigurace systému".';
$_lang['configcheck_warning'] = 'Varování:';
$_lang['configcheck_what'] = 'Co to znamená?';
