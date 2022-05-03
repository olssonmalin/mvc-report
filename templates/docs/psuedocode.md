
### Pseudokod och planering för spel i uppgift kmom03

*Spelaren* **tar** ett *kort*. *Kortet* **visas**.
*Spelaren* kan bestämma att **stanna** eller **ta ytterligare** ett *kort*.
    "Om spelaren får över 21" vinner banken.
När *spelaren* **stannar** så är det *bankens* tur.
*Banken* är inte medveten om *spelarens* *korthand*.
*Banken* **plockar** *kort* tills den **stannar** "eller har över 21".
    *Banken* vinner "vid lika" eller "om *banken* har mer än **spelaren**."
    *Spelaren* vinner om *banken* får "över 21."
"Därefter" kan man **påbörja** en ny omgång.

Jag tänker utgå ifrån reglerna för att få upp en struktur på mina klasser och vilka metoder och hur koden ska bete sig. 
De ord som är kursiva är olika object. Dessa ska jag göra klasser av. Spelaren och banken har ungefär samma funktion så dessa kommer utgå ifrån samma klass: Player. 

Jag har en del funderingar kring vart plockandet ska hända, eftersom spelaren plockar kort men det logiska är mer att den tilldelas kort. Eftersom jag vill minksa logik i controllern tänkter jag skapa en klass som får heta "Game". Game har i uppgift att implementera de olika delarna i spelet och hålla koll på regler. 

Klassen Player har främt i uppgift att representera spelaren med en hand och poäng. Kort-klassen och Deck-klassen är redan definerade i tidiagre kmom. De kommer ha samma funktionalitet som i tidgare uppgifter. 

De fetsitlta orden är verb som har eller kommer utföras av metoder i klasserna. De orden/fraserna som är markerade med citattecken är olika conditionals som kommer finnas med i klasserna. 

