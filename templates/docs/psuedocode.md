
### Pseudokod för spel i uppgift kmom03

regler:
Spelet leder till en landningssida där man kan läsa spelregler och se dokumentation om spelet samt påbörja ett spel.
Spelplanen visas och spelaren och banken har inte tagit några kort.

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
De ord som är kursiva är olika object. Dessa ska jag göra klasser av. Spelaren och banken har egentligen samma grund. Banken får därför ärva av spelaren med någon extra metod för att kunna spela "själv". Alternativt händer detta i controllern, det har jag inte bestämt mig än. 

Lite funderingar finns kring vart plockandet ska hända, eftersom spelaren plockar kort men det logiska är mer att den tilldelas kort. Eftersom jag vill minksa logik i controllern tänkter jag skapa en klass som får heta "Game". Game har i uppgift att implementera de olika delarna i spelet och hålla koll på regler. 

Klassen Player har främt i uppgift att representera spelaren med en hand och poäng. Kort-klassen och Deck-klassen är redan definerade i tidiagre kmom. De kommer ha samma funktionalitet som i tidgare uppgifter. 

De fetsitlta orden är verb som har eller kommer utföras av metoder i klasserna. De understrukna orden/fraserna är olika conditionals som kommer finnas med i klasserna. 

