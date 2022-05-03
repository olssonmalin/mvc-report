
<pre>
Class gameController

    *route game*
    **function game**    
        render game/game tamplate

    *route game/doc*
    **function gameDoc**
        render game/doc template

    *route game/start*
    **function gameStart**
        set session game to new game if not set already
        hit one card for player
        get player hand
        get player score
        render game/start template with player hand and score

    *route game/hit*
    **function hit**
        hit one card for player
        get player hand
        get player score
        render game/start template with player hand and score

    *route game/stand*
    **function stand**
        stand player
        play bank
        check if player won
        set game over to true

    *route game/restart*
    **function Restart**
        set session game to new game
        redirect to game/start
</pre>