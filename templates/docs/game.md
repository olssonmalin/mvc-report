<pre>
    class Game

    parameter player
    parameter bank
    parameter deck (playing deck)
    parameter current player (player or bank)
    

    function construct(deck, player, bank, card)
    {
        initialize deck with card as argument
        initialize player
        initialize bank
    }


    function hit
        {
        draw one card for current player 
    }


    function stand
        {
        if currentplayer is not bank
            change player
            start bank play
    }


    function playBank
    {
        while score is less than 15
            hit (draw card)
        
        stand
    }

    
    function playerWon
    {
        if bankscore is more than 21 or less than player score 
            return true
        return false
    }
</pre>