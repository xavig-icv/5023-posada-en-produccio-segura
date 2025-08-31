# Consideracions de desplegament

## La carpeta arrel

Actualment l'arrel es considera /mvc/, per tant teniu 3 opcions:

1. Copiar el projecte a /var/www/html/mvc
2. Modificar l'arrel de les rutes /mvc/?route a /?route
3. Crear un virtualhost amb Apache
4. Crear un fitxer .htaccess amb mod_rewrite

## Funcionalitats pendents

1. Perfil d'usuari (amb modificació de dades personals i les seves estadístiques)
2. Ranking d'usuaris (classificació per cada joc i un ranking global)
3. API funcional separada del MVC
4. Aspecte visual (CSS)
5. Integració del joc principal
6. Pujada d'imatges de perfil sense validació (per tractar la vulnerabilitat file upload)

## Els jocs (opcional)

Opcional: Podeu crear un CRUD per afegir nous jocs a la plataforma. Només els administradors o desenvolupadors indie podrien accedir al CRUD de jocs per integrar un nou joc. Podríeu fins i tot crear 3 tipus d'usuari (admin, developer i usuari).

Funcionalitats avançades (opcionals):

- Sistema de badges/assoliments
- Xat en temps real entre jugadors
- Torneos i competicions
- Sistema d'amics i reptes
- Estadístiques avançades amb gràfics