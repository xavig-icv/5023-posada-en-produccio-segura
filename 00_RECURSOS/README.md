# Recursos del Mòdul 5023 - Posada en producció segura

## Eines de l'Entorn de Treball (TEMA 1 i TEMA 2)

### Eines de Virtualització
- [VirtualBox](https://www.virtualbox.org/wiki/Downloads) - Màquines Virtuals
- [VMware Workstation Player](https://www.vmware.com/products/workstation-player.html) - Alternativa a VirtualBox

### Editors de Codi
- [Visual Studio Code](https://code.visualstudio.com/) - Editor de codi
- [Sublime Text](https://www.sublimetext.com/) - Editor de text avançat

### Distribucions Linux de Ciberseguretat
- [Kali Linux OVA](https://www.kali.org/get-kali/#kali-virtual-machines) - OVA per VirtualBox
- [Kali Linux ISO](https://www.kali.org/get-kali/#kali-installer-images) - ISO per la instal·lació

### Distribucions Linux Recomanades
- [Debian](https://www.debian.org/distrib/) - Base per a Servidors i Clients
- [Ubuntu](https://ubuntu.com/download) - Distribució molt utilitzada en entorns educatius
- [Ubuntu Server](https://ubuntu.com/download/server) - Versió Ubuntu per a servidors

### Android per Hacking Mòbil
- [Android x86](https://www.android-x86.org/download) - Android per executar a una VM
- [Android Studio](https://developer.android.com/studio) - IDE oficial Android

### Aplicacions Web Vulnerables (Plataformes de Pràctiques)
- [DVWA](https://github.com/digininja/DVWA) - Damn Vulnerable Web Application
- [bWAPP](http://www.itsecgames.com/) - Buggy Web Application - Recomano OVA
- [OWASP WebGoat](https://owasp.org/www-project-webgoat/) - Aplicació Educativa Hacking Web
- [Mutillidae II](https://github.com/webpwnized/mutillidae) - Aplicació LAMP vulnerable
- [OWASP Juice Shop](https://owasp.org/www-project-juice-shop/) - Aplicació Web vulnerable
- [Juice Shop Docker](https://hub.docker.com/r/bkimminich/juice-shop) - Versió per desplegar amb Docker

### Aplicacions Android Vulnerables (Plataformes de Pràctiques)
- [DIVA Android](https://github.com/payatu/diva-android) - Damn Insecure Vulnerable APP
- [MSTG-Hacking-Playground](https://github.com/OWASP/MSTG-Hacking-Playground) - Projecte OWASP APP per Mòbil
- [InsecureBankv2](https://github.com/dineshshetty/Android-InsecureBankv2) - Aplicació bancària vulnerable
- [VyAPI](https://github.com/appsecco/VyAPI) - API vulnerable per mòbils

### Plataformes d'Aprenentatge de Ciberseguretat
- [TryHackMe](https://tryhackme.com/) - Plataforma que recomano amb Màquines Vulnerables
- [VulnHub](https://www.vulnhub.com/) - Plataforma que recomano per descarregar Màquines Vulnerables
- [PortSwigger Web Security Academy](https://portswigger.net/web-security) - Pràctiques que recomano per aprendre Burp Suite
- [Over The Wire](https://overthewire.org/) - Plataforma per l'aprenentatge de comandes de Linux i explotació bàsica de sistemes
- [PentesterLab](https://pentesterlab.com/) - Exercicis progressius amb laboratoris gratuïts.
- [HackTheBox](https://www.hackthebox.com/) - Plataforma de Hacking avançada (alguns laboratoris gratuïts)

## Eines de Hacking Web (TEMA 3)

### Descobriment i Reconeixement
- [Nmap](https://nmap.org/download.html) - Escaneig de xarxes i ports oberts en equips
- [Gobuster](https://github.com/OJ/gobuster) - Eina per realitzar l'atac de força bruta de directoris i fitxers
- [amass](https://github.com/OWASP/Amass) - Eina pel descobriment de subdominis i mapeig de xarxes
- [subfinder](https://github.com/projectdiscovery/subfinder) - Eina per al descobriment de subdominis
- [httpx](https://github.com/ProjectDiscovery/httpx) - Eina per fer peticions HTTP/2 i HTTP/3
- [Whatweb](https://github.com/urbanadventurer/WhatWeb) - Eina per l'identificació de tecnologies web
- [Wappalyzer](https://www.wappalyzer.com/) - Extensió del navegador per identificar tecnologies web

### Escaneig i Explotació de Vulnerabilitats
- [Burp Suite](https://portswigger.net/burp) - Proxy per interceptar i modificar trànsit HTTP/HTTPS
- [SQLmap](https://github.com/sqlmapproject/sqlmap) - SQL injection automàtic
- [Commix](https://github.com/commixproject/commix) - Command injection automàtic
- [XSStrike](https://github.com/s0md3v/XSStrike) - XSS escàner avançat
- [Hydra](https://github.com/vanhauser-thc/thc-hydra) - Atac de força bruta per inici de sessió
- [WPScan](https://wpscan.com/) - Escàner de vulnerabilitats per WordPress
- [nuclei](https://github.com/projectdiscovery/nuclei) - Eina per escaneig de vulnerabilitats web 
- [Nikto](https://github.com/sullo/nikto) - Escàner automàtic de vulnerabilitats web (antic però mantingut)
- [Nessus](https://www.tenable.com/products/nessus) - Escàner de vulnerabilitats (versió gratuïta limitada)
- [OpenVAS](https://www.openvas.org/) - Escàner de vulnerabilitats de codi obert
- [Skipfish](https://github.com/spinkham/skipfish) - Antic Escàner per auditories web (recull molta informació)
- [Metasploit](https://www.metasploit.com/) - Framework de seguretat per l'explotació de vulnerabilitats

### Eines pel testing d'APIs
- [Postman](https://www.postman.com/downloads/) - Testing d'APIs
- [Arjun](https://github.com/s0md3v/Arjun) - HTTP parameter discovery (per APIS i formularis web)
- [Kiterunner](https://github.com/assetnote/kiterunner) - Content discovery per APIs

### Wordlists i Diccionaris
- [SecLists](https://github.com/danielmiessler/SecLists) - Recomano aquest repositori de wordlists
- [PayloadsAllTheThings](https://github.com/swisskyrepo/PayloadsAllTheThings) - Recomano aquest repositori de payloads
- [FuzzDB](https://github.com/fuzzdb-project/fuzzdb) - Diccionaris per fuzzing web

## Eines de Hacking Mòbil (TEMA 4)

### Anàlisi Estàtic (codi)
- [MobSF](https://github.com/MobSF/Mobile-Security-Framework-MobSF) - Plataforma unificada per l'anàlisi d'APPs (Mobile Security Framework)
- [APKTool](https://github.com/iBotPeaches/Apktool) - Descompilador i compilador d'APKs per (Reverse engineering)
- [JADX](https://github.com/skylot/jadx) - Descompilador d'aplicacions Android (fitxer DEX en codi Java)
- [Dex2jar](https://github.com/pxb1988/dex2jar) - Eina de conversió de DEX a JAR per poder visualitzar amb entorn gràfic

### Anàlisi Dinàmic (aplicació en marxa)
- [Frida](https://frida.re/docs/installation/) - Framework d'instrumentació
- [Objection](https://github.com/sensepost/objection) - Toolkit basat en Frida
- [Drozer](https://github.com/WithSecureLabs/drozer) - Framework pentesting Android

## Eines DevSecOps (TEMA 5)

### Control de Versions i Desplegament (Integració Continua)
- [Git](https://git-scm.com/downloads) - Eina de Control de versions
- [Jenkins](https://www.jenkins.io/download/) - Servidor integració i desplegament continu (CI/CD)
- [Docker](https://docs.docker.com/get-docker/) - Eina per crear contenidors aïllats pel desplegament d'aplicacions
- [Docker Compose](https://docs.docker.com/compose/install/) - Eina per crear aplicacions amb múltiples contenidors
- [GitLab](https://about.gitlab.com/install/) - Plataforma DevOps completa (Git + CI/CD)
- [GitHub](https://github.com/) - Plataforma de desenvolupament col·laboratiu i Github Actions per automatitzar flux de treball

### Virtualització i Entorns de Desenvolupament
- [Proxmox VE](https://www.proxmox.com/en/downloads) - Plataforma de virtualització baremetal (VM i LXC amb una interfície web de gestió)
- [Vagrant](https://www.vagrantup.com/downloads) - Eina per crear i configurar entorns de desenvolupament virtualitzats

## Documentació Oficial

### Estàndards de Seguretat OWASP
- [OWASP Top 10 Web (2021)](https://owasp.org/www-project-top-ten/)
- [OWASP Mobile Top 10 (2024)](https://owasp.org/www-project-mobile-top-10/)
- [OWASP ASVS 4.0](https://owasp.org/www-project-application-security-verification-standard/)
- [OWASP Testing Guide](https://owasp.org/www-project-web-security-testing-guide/)
- [OWASP Mobile Security Testing Guide (MSTG)](https://owasp.org/www-project-mobile-security-testing-guide/)
- [OWASP Mobile App Security Verification Standard (MASVS)](https://owasp.org/www-project-mobile-app-security/)

### Guies Oficials

#### Hacking Web
- [Burp Suite Documentation](https://portswigger.net/burp/documentation)
- [Nmap Documentation](https://nmap.org/book/)
- [SQLmap User Guide](https://github.com/sqlmapproject/sqlmap/wiki)
- [Postman Learning Center](https://learning.postman.com/)

#### Hacking Mòbil
- [Frida Documentation](https://frida.re/docs/)
- [Objection Documentation](https://github.com/sensepost/objection/wiki)
- [MobSF Documentation](https://mobsf.github.io/docs/)
- [APKTool Documentation](https://apktool.org/docs)
- [JADX Documentation](https://github.com/skylot/jadx/wiki)
- [Drozer Documentation](https://github.com/WithSecureLabs/drozer/wiki)

#### Anàlisi de Seguretat i DevSecOps
- [Docker Security Best Practices](https://docs.docker.com/engine/security/)
- [Proxmox VE Documentation](https://pve.proxmox.com/pve-docs/)
- [Vagrant Documentation](https://developer.hashicorp.com/vagrant/docs)
- [SonarQube Documentation](https://docs.sonarqube.org/)
- [OWASP Dependency Check Documentation](https://jeremylong.github.io/DependencyCheck/)
- [Semgrep Documentation](https://semgrep.dev/docs/)